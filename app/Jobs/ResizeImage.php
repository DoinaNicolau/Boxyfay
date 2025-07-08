<?php

namespace App\Jobs;

use Spatie\Image\Image;
use Spatie\Image\Enums\Unit;
use Spatie\Image\Enums\CropPosition;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResizeImage implements ShouldQueue
{
    use Queueable;
    private $w, $h, $fileName, $path;
    /**
     * Create a new job instance.
     */
    public function __construct($filePath,$w,$h)
    {
        $this->w = $w;
        $this->h = $h;
        $this->fileName = basename($filePath); 
        $this->path = dirname($filePath); 
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $w=$this->w;
        $h=$this->h;
        $srcPath=storage_path() . '/app/public/' . $this->path . '/' . $this->fileName;
        $destPath=storage_path() . '/app/public/' . $this->path . "/crop_{$w}x{$h}_". $this->fileName;

        Image::load($srcPath)
            ->crop($w,$h,CropPosition::Center)
            ->watermark(
                base_path('/public/media/logo_background.png'),
                width: 100,
                height: 100,
                paddingX: 0,
                paddingY: 0,
                paddingUnit: Unit::Percent,
                widthUnit: Unit::Percent,
                heightUnit: Unit::Percent
            )
            ->save($destPath);
    }
}
