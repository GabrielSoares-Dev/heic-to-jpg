<?php

namespace GabrielSoaresMaciel\HeicToJPG;

require __DIR__ . '/../vendor/autoload.php';

use Maestroerror\HeicToJpg;

class HeicToJPGCustom
{
    private string $heicDir = __DIR__ . '/photos-heic';
    private string $jpgDir = __DIR__ . '/photos-jpg';

    private function findPhotos(): array
    {
        return array_filter(scandir($this->heicDir), function ($photo) {
            return !is_dir("{$this->heicDir}/{$photo}") && (pathinfo($photo, PATHINFO_EXTENSION) === 'heic' || pathinfo($photo, PATHINFO_EXTENSION) === 'HEIC');
        });
    }

    private function changeHeicToJPGExtension(string $heicPhoto): string
    {
        $pathInfo = pathinfo($heicPhoto);
        return "{$pathInfo['filename']}.jpg";
    }

    private function convertPhoto(string $photo): void
    {
        printf("Start processing photo: %s\n", $photo);
        $heicFilePath = "{$this->heicDir}/{$photo}";
        $photoToJpgExtension = $this->changeHeicToJPGExtension($photo);

        $jpgFilePath = "{$this->jpgDir}/{$photoToJpgExtension}";

        HeicToJpg::convert($heicFilePath)->saveAs($jpgFilePath);

        printf("Photo %s converted to %s\n", $heicFilePath, $jpgFilePath);
    }

    private function processingPhotos(array $photos): void
    {
        foreach ($photos as $photo) {
            $this->convertPhoto($photo);
        }
    }

    public function run(): void
    {
        $photos = $this->findPhotos();
        $this->processingPhotos($photos);
    }
}

$heicToJPG = new HeicToJPGCustom();
$heicToJPG->run();
