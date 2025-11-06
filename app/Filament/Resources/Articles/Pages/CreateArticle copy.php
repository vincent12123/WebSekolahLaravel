<?php

namespace App\Filament\Resources\Articles\Pages;

use App\Filament\Resources\Articles\ArticleResource;
use App\Services\AiArticleService;
use App\Services\UnsplashService;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('generateWithAi')
                ->label('Generate with AI')
                ->icon('heroicon-o-sparkles')
                ->form([
                    Forms\Components\Textarea::make('draft')
                        ->label('Draf/Topik Artikel')
                        ->rows(8)
                        ->required()
                        ->helperText('Tulis ringkasan/topik atau draf awal. AI akan menyempurnakan menjadi konten artikel.'),
                ])
                ->action(function (array $data) {
                    try {
                        $service = app(AiArticleService::class);
                        $result = $service->improveDraft($data['draft']);

                        // Isi field form: content & excerpt
                        $this->form->fill([
                            'content' => $result['content'] ?? null,
                            'excerpt' => $result['excerpt'] ?? null,
                        ]);

                        Notification::make()
                            ->title('Konten artikel berhasil dibuat oleh AI')
                            ->success()
                            ->send();
                    } catch (\Throwable $e) {
                        Notification::make()
                            ->title('Gagal generate konten')
                            ->body($e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),

            Actions\Action::make('chooseImageUnsplash')
                ->label('Pilih Gambar (Unsplash)')
                ->icon('heroicon-o-photo')
                ->form([
                    Forms\Components\TextInput::make('query')
                        ->label('Kata kunci')
                        ->default(fn () => $this->form->getState()['title'] ?? '')
                        ->required(),
                    Forms\Components\Select::make('unsplash_image')
                        ->label('Pilih gambar')
                        ->options(function ($get) {
                            $query = trim((string) $get('query'));
                            if ($query === '') {
                                return [];
                            }
                            try {
                                $svc = app(UnsplashService::class);
                                $results = $svc->search($query, 8);
                            } catch (\Throwable $e) {
                                return [];
                            }
                            $opts = [];
                            foreach ($results as $r) {
                                $label = ($r['alt'] ?? 'Gambar') . ' — ' . ($r['author'] ?? 'Unsplash');
                                $opts[$r['url']] = $label;
                            }
                            return $opts;
                        })
                        ->searchable()
                        ->required()
                        ->helperText('Pratinjau akan terlihat setelah disimpan ke field URL.'),
                ])
                ->action(function (array $data) {
                    $url = $data['unsplash_image'] ?? null;
                    if ($url) {
                        $this->form->fill([
                            'image_url_external' => $url,
                        ]);
                        Notification::make()
                            ->title('Gambar dari Unsplash dipilih')
                            ->success()
                            ->send();
                    }
                }),
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Jika ada URL eksternal, gunakan sebagai image_url (menimpa jika tidak ada upload)
        if (!empty($data['image_url_external'])) {
            $data['image_url'] = $data['image_url_external'];
        }
        // Bersihkan field helper agar tidak disimpan ke DB
        unset($data['image_url_external']);
        return $data;
    }
}
