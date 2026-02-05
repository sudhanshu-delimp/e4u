<?php

namespace App\Services;

use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;




class ImageService
{
    /**
     * Get module wise paths
     */

    private static function paths($module = null)
    {
        return config("image.modules.$module") ?? config('image.default');
    }

    /**
     * Upload or Update image
     *
     * @param  UploadedFile  $file
     * @param  string|null   $oldImage
     * @param  string|null   $module
     * @param  array|null    $size        ['width'=>?, 'height'=>?]
     * @param  bool          $withThumb   true = create thumb, false = skip
     */

    public static function uploadOrUpdate(
        $file,
        $oldImage = null,
        $module = null,
        $size =  null,
        $withThumb = true
    ) {

 

        $disk = config('image.disk');
        $paths = self::paths($module);

        $manager = new ImageManager(new Driver());


        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        //Save Original
        Storage::disk($disk)->put(
            $paths['original'] . $filename,
            file_get_contents($file),
        );


        $manager2 = new ImageManager(new Driver());

        // Thumbnail size (fallback to default)
        if ($withThumb) {
            $width  = $size['width']  ?? config('image.thumb_size.width');
            $height = $size['height'] ?? config('image.thumb_size.height');

            $thumb = $manager
                ->read($file->getPathname())
                ->resize($width, $height)
                ->toJpeg(80); // quality control


            Storage::disk($disk)->put(
                $paths['thumb'] . $filename,
                $thumb
            );
        }


        /** -------- Delete Old Image -------- */
        if ($oldImage) {
            self::delete($oldImage, $disk, $withThumb);
        }

        return $filename;
    }


    /**
     * Delete image (original + thumb)
     */

    public static function delete(
        $imageName,
        $module = null,
        $withThumb = true
    ) {

        $disk  = config('image.disk');
        $paths = self::paths($module);

        $files = [$paths['original'] . $imageName];

        if ($withThumb) {
            $files[] = $paths['thumb'] . $imageName;
        }

        Storage::disk($disk)->delete($files);
    }

    /**
     * Get image URL (datatable / detail)
     */

    public static function url(
        $imageName,
        $type = 'thumb',
        $module = null
    ) {

        if (empty($imageName)) {
            return null;
        }
        $disk = config('image.disk');
        $paths = self::paths($module);

        $fullPath = $paths[$type] . $imageName;
        // Check file exist
        if (Storage::disk($disk)->exists($fullPath)) {
            return Storage::url($fullPath);
        }

    }
}
