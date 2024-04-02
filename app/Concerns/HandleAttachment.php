<?php

namespace App\Concerns;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * Trait HandleImage
 * Author: Chrisdion Andrew
 * Date: 6/10/2023
 */

trait HandleAttachment
{
    protected function storeDocument(UploadedFile $document, $folder): string
    {
        $path = 'document/'.$folder.'/';
        $fileName = $path . $document->hashName();

        Storage::disk('public')->put($path, $document);

        return $fileName;
    }

    protected function storePhoto(UploadedFile $photo, $dimension, $folder): string
    {
        $fileName = 'image/'.$folder.'/'.$photo->hashName();

        $resizedPhoto = Image::make($photo)->resize($dimension, $dimension, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->encode($photo->getClientOriginalExtension(), 80);

        Storage::disk('public')->put($fileName, $resizedPhoto);

        return $fileName;
    }

    protected function deleteAttachment(?string $path): bool
    {
        if (! $path) {
            return false;
        }

        return Storage::disk('public')->delete($path);
    }
}
