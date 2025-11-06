<?php

namespace App\Filament\Resources\Articles\Pages;

use App\Filament\Resources\Articles\ArticleResource;
use App\Services\AiArticleService;
use App\Services\UnsplashService;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
use Illuminate\Support\HtmlString;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('generateWithAi')
                // ... (action AI Anda tetap sama)
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

                        $state = $this->form->getState();
                        $state['content'] = $result['content'] ?? $state['content'] ?? null;
                        $state['excerpt'] = $result['excerpt'] ?? $state['excerpt'] ?? null;
                        $this->form->fill($state);

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

            // --- BAGIAN YANG DIREVISI ---
            Actions\Action::make('chooseImageUnsplash')
                ->label('Pilih Gambar (Unsplash)')
                ->icon('heroicon-o-photo')
                ->form([
                    Forms\Components\TextInput::make('query')
                        ->label('Kata kunci')
                        ->default(fn () => $this->form->getState()['title'] ?? '')
                        ->required()
                        ->live(debounce: '500ms'),

                    Forms\Components\Radio::make('unsplash_image')
                        ->hiddenLabel()
                        // <-- PERBAIKAN: Menggunakan ->columns() untuk opsi radio, bukan ->grid()
                        ->columns(['default' => 2, 'md' => 4])
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
                                $thumbnail = $r['thumbnail'] ?? $r['url'];
                                $label = e($r['alt'] ?? 'Gambar Unsplash');
                                $author = e($r['author'] ?? 'Unsplash');
                                $url = $r['url']; // Nilai dari radio button

                                $html = new HtmlString(
                                    sprintf(
                                        '<div style="text-align: left;">
                                            <img src="%s"
                                                 alt="%s"
                                                 style="width: 100%%; height: 120px; object-fit: cover; border-radius: 6px; margin-bottom: 6px; border: 1px solid #ddd;"
                                            >
                                            <span style="display: block; font-size: 0.8rem; color: #555; line-height: 1.2;">
                                                by <strong>%s</strong>
                                            </span>
                                        </div>',
                                        $thumbnail,
                                        $label,
                                        $author
                                    )
                                );

                                $opts[$url] = $html;
                            }
                            return $opts;
                        })
                        ->required()
                        ->helperText('Pilih salah satu gambar di atas.'),
                ])
                ->action(function (array $data) {
                    $url = $data['unsplash_image'] ?? null;
                    if ($url) {
                        try {
                            $svc = app(UnsplashService::class);
                            // Simpan ke storage agar URL relatif disimpan di DB
                            $stored = $svc->downloadToPublic($url, 'articles');
                            $state = $this->form->getState();
                            $state['image_url'] = $stored; // simpan path storage
                            $state['image_url_external'] = $url; // catatan sumber
                            $this->form->fill($state);
                        } catch (\Throwable $e) {
                            Notification::make()->title('Gagal menyimpan gambar dari Unsplash')->body($e->getMessage())->danger()->send();
                            return;
                        }
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
        // ... (Fungsi ini tetap sama)
        if (!empty($data['image_url_external'])) {
            $data['image_url'] = $data['image_url_external'];
        }
        unset($data['image_url_external']);
        return $data;
    }
}
