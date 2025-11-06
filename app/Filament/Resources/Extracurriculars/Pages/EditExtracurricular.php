<?php

namespace App\Filament\Resources\Extracurriculars\Pages;

use App\Filament\Resources\Extracurriculars\ExtracurricularResource;
use App\Services\UnsplashService;
use Filament\Actions\DeleteAction;
use Filament\Actions;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditExtracurricular extends EditRecord
{
    protected static string $resource = ExtracurricularResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            Actions\Action::make('chooseLogoUnsplash')
                ->label('Pilih Logo (Unsplash)')
                ->icon('heroicon-o-photo')
                ->form([
                    Forms\Components\TextInput::make('query')
                        ->label('Kata kunci')
                        ->default(fn () => $this->form->getState()['name'] ?? '')
                        ->required()
                        ->live(debounce: '500ms'),
                    Forms\Components\Radio::make('unsplash_image')
                        ->hiddenLabel()
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
                                $thumb = $r['thumb'] ?? $r['url'];
                                $label = new \Illuminate\Support\HtmlString(
                                    '<div style="text-align:left">'
                                    .'<img src="'.e($thumb).'" style="width:100%;height:120px;object-fit:cover;border-radius:6px;margin-bottom:6px;border:1px solid #ddd;" />'
                                    .'<span style="display:block;font-size:.8rem;color:#555;line-height:1.2">by <strong>'.e($r['author'] ?? 'Unsplash').'</strong></span>'
                                    .'</div>'
                                );
                                $opts[$r['url']] = $label;
                            }
                            return $opts;
                        })
                        ->required()
                        ->helperText('Pilih salah satu logo di atas.'),
                ])
                ->action(function (array $data) {
                    $url = $data['unsplash_image'] ?? null;
                    if ($url) {
                        // Merge dengan state saat ini agar field lain tidak hilang
                        $state = $this->form->getState();
                        $state['logo_url_external'] = $url;
                        $state['logo_url'] = $url; // langsung isi untuk edit
                        $this->form->fill($state);
                        Notification::make()
                            ->title('Logo dari Unsplash dipilih')
                            ->success()
                            ->send();
                    }
                }),
        ];
    }
}
