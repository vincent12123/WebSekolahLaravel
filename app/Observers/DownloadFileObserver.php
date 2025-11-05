<?php

namespace App\Observers;

use App\Models\DownloadFile;
use Illuminate\Support\Facades\Storage;

class DownloadFileObserver
{
    /**
     * Handle the model "saving" event to ensure metadata is populated.
     */
    public function saving(DownloadFile $file): void
    {
        if (empty($file->file_path)) {
            return;
        }

        // If file_path is a full URL to storage, try to convert to relative path
        $path = $file->file_path;
        $publicUrlPrefix = Storage::disk('public')->url('');
        if (str_starts_with($path, $publicUrlPrefix)) {
            $path = ltrim(str_replace($publicUrlPrefix, '', $path), '/');
        }

        // Populate file_type (extension uppercased)
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        if (!empty($ext)) {
            $file->file_type = strtoupper($ext);
        } else {
            // Fallback to mime type
            try {
                $mime = Storage::disk('public')->mimeType($path);
                if ($mime) {
                    $file->file_type = strtoupper(str_replace(['application/', 'image/', 'text/'], '', $mime));
                }
            } catch (\Throwable $e) {
                // ignore
            }
        }

        // Populate file_size_kb
        try {
            $bytes = Storage::disk('public')->size($path);
            if ($bytes !== false && $bytes !== null) {
                $file->file_size_kb = (int) ceil($bytes / 1024);
            }
        } catch (\Throwable $e) {
            // ignore
        }
    }
}
