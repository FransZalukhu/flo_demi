<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageUploadService
{
    protected $manager;

    public function __construct()
    {
        // Inisialisasi ImageManager dengan driver GD (v3)
        $this->manager = new ImageManager(new Driver());
    }

    /**
     * Upload dan optimasi gambar.
     *
     * @param UploadedFile $file
     * @param string $folder
     * @param int|null $width
     * @param int $quality
     * @param string|null $oldPath
     * @return string
     */
    public function upload(UploadedFile $file, string $folder, ?int $width = 1200, int $quality = 80, ?string $oldPath = null): string
    {
        if ($oldPath && Storage::disk('public')->exists($oldPath)) {
            Storage::disk('public')->delete($oldPath);
        }

        $filename = uniqid() . '_' . time() . '.webp';
        $fullPath = "{$folder}/{$filename}";

        $image = $this->manager->read($file);

        if ($width && $image->width() > $width) {
            $image->scale(width: $width);
        }

        $encoded = $image->toWebp($quality);
        Storage::disk('public')->put($fullPath, (string) $encoded);

        return $fullPath;
    }
}
