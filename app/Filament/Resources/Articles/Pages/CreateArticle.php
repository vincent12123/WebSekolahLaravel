<?php

namespace App\Filament\Resources\Articles\Pages;

use App\Filament\Resources\Articles\ArticleResource;
use App\Services\AiArticleService;
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
        ];
    }
}
