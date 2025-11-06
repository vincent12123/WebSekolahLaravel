<?php

namespace App\Filament\Resources\Extracurriculars\Pages;

use App\Filament\Resources\Extracurriculars\ExtracurricularResource;
use App\Services\UnsplashService;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
use Illuminate\Support\HtmlString; // <-- 1. TAMBAHKAN IMPORT INI

class CreateExtracurricular extends CreateRecord
{
    protected static string $resource = ExtracurricularResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // --- INI ADALAH BAGIAN YANG DIREVISI ---
            Actions\Action::make('chooseLogoUnsplash')
                ->label('Pilih Logo (Unsplash)')
                ->icon('heroicon-o-photo')
                ->form([
                    Forms\Components\TextInput::make('query')
                        ->label('Kata kunci')
                        // Mengambil default dari 'name' (nama ekskul)
                        ->default(fn () => $this->form->getState()['name'] ?? '')
                        ->required()
                        ->live(debounce: '500ms'), // <-- 2. TAMBAHKAN LIVE DEBOUNCE

                    Forms\Components\Radio::make('unsplash_image') // <-- 3. GANTI DARI SELECT KE RADIO
                        ->hiddenLabel() // <-- 4. Sembunyikan label "Pilih gambar"
                        ->columns(['default' => 2, 'md' => 4]) // <-- 5. Gunakan ->columns()
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
                                // 6. Buat label HTML
                                $thumbnail = $r['thumbnail'] ?? $r['url'];
                                $label = e($r['alt'] ?? 'Gambar Unsplash');
                                $author = e($r['author'] ?? 'Unsplash');
                                $url = $r['url']; // Ini akan menjadi nilai dari radio button

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

                                $opts[$url] = $html; // Kunci adalah URL, Value adalah HTML
                            }
                            return $opts;
                        })
                        // ->searchable() // <-- 7. HAPUS ->searchable() (tidak ada di Radio)
                        ->required()
                        ->helperText('Pilih salah satu logo di atas.'), // <-- 8. Ubah helper text
                ])
                ->action(function (array $data) {
                    $url = $data['unsplash_image'] ?? null;
                    if ($url) {
                        $state = $this->form->getState();
                        $state['logo_url_external'] = $url;
                        $this->form->fill($state);
                        Notification::make()
                            ->title('Logo dari Unsplash dipilih')
                            ->success()
                            ->send();
                    }
                }),
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Fungsi ini sudah benar, memindahkan 'logo_url_external' ke 'logo_url'
        if (!empty($data['logo_url_external'])) {
            $data['logo_url'] = $data['logo_url_external'];
        }
        unset($data['logo_url_external']);
        return $data;
    }
}
