<?php
namespace App\CentralLogics;

use Illuminate\Support\Carbon;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class Helpers
{
    public static function upload(string $dir, string $format, $image = null, $oldImage = null)
    {
        if ($image !== null && $image->isValid()) {

            if (!empty($oldImage)) {
                $fileName = basename($oldImage);
                $oldPath = public_path('storage/' . $dir . '/' . $fileName);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $imageName = \Carbon\Carbon::now()->toDateString() . '-' . uniqid() . '.' . $format;
            $path = public_path('storage/' . $dir);
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }

            $manager = new ImageManager(new Driver());
            $img = $manager->read($image->getPathname());
            $img->scale(width: 1200);
            $jpegImage = $img->toJpeg(quality: 70);

            file_put_contents($path . '/' . $imageName, $jpegImage->toString());

            return $imageName;
        }

        return null;
    }

}
