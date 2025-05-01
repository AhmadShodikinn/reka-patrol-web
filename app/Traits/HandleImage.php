<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait HandleImage
{
    protected function handleImageUpload(array $data, mixed $keyOrModel = null, string $imageField = 'image_path', string $disk = 'public', ?string $customPath = null): array {
        if (request()->hasFile($imageField)) {
            // Use custom path if provided; otherwise, default to $this->imagePath
            $path = $customPath ?? $this->imagePath;

            // Delete old photo if updating
            if ($keyOrModel && $keyOrModel->$imageField) {
                $this->deleteImage($keyOrModel->$imageField, $disk);
            }

            // Store the new photo
            $data[$imageField] = request()->file($imageField)->store($path, $disk);
        }

        return $data;
    }

    
    protected function handleArrayImageUpload(array $data, mixed $keyOrModel = null, string $imageField = 'image_path', string $disk = 'public', ?string $customPath = null): array {
        if (request()->hasFile($imageField)) {
            // Use custom path if provided; otherwise, default to $this->imagePath
            $path = $customPath ?? $this->imagePath;

            // TODO: Delete old photo if updating
            // if ($keyOrModel && $keyOrModel->$imageField) {
            //     foreach ($keyOrModel->$imageField as $imagePath) {
            //         $this->deleteImage($imagePath, $disk);
            //     }
            // }

            // Store the new photo
            $images = [];
            $files = request()->file($imageField);
            foreach ($files as $file) {
                $images[] = $file->store($path, $disk);
            }
            $data[$imageField] = $images;
        }

        return $data;
    }

    protected function deleteImage(?string $photoPath, string $disk = 'public'): void {
        if ($photoPath && Storage::disk($disk)->exists($photoPath)) {
            Storage::disk($disk)->delete($photoPath);
        }
    }
}
