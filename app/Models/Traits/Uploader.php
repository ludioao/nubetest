<?php
/**
 * Created by PhpStorm.
 * User: ludio
 * Date: 03/05/18
 * Time: 02:49
 */

namespace App\Models\Traits;


use App\Models\SuperHeroImage;
use App\Observers\UploaderObserver;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

trait Uploader
{
    /**
     * Boot the trait's observer.
     *
     * @return void
     */
    public static function bootUploader()
    {
        static::observe(new UploaderObserver());
    }


    /**
     * When saving a model, upload any 'uploadable' fields.
     *
     * @return void
     */
    public function performUploads()
    {
        $this->checkForUploadables();
        foreach ($this->getUploadables() as $key) {
            if (request()->hasFile($key)) {
                $files = request()->file($key);

                if (is_array($files)) {
                    foreach ($files as $file) {
                        $image = new SuperHeroImage();
                        $image->file = $this->moveFile($file);
                        $this->images()->save($image);
                    }
                } else {
                    $image = new SuperHeroImage();
                    $image->file = $this->moveFile($files);
                    $this->images()->save($image);
                }
            }
        }
    }

    /**
     * Save file on disk
     *
     * @param $file \Illuminate\Http\UploadedFile;
     * @return string
     */
    private function moveFile($file)
    {
        try {
            $path = \Storage::disk('upload')->putFileAs($this->getUploadDir(), $file, $this->createFileName($file->getClientOriginalName()));
        } catch (\Exception $e) {
            throw new FileException($e->getMessage());
        }
        $path = "/upload/" . $path;
        return $path;
    }

    /**
     * Uploadable fields getter.
     *
     * @return array
     */
    public function getUploadables()
    {
        return $this->uploadables;
    }

    /**
     * Uploadable fields setter.
     *
     * @param array $uploadables
     */
    public function setUploadables($uploadables)
    {
        $this->uploadables = $uploadables;
    }

    /**
     * Check is $uploadables is a non-empty array.
     *
     * @return void
     * @throws \Exception
     */
    private function checkForUploadables()
    {
        if (!$this->getUploadables()) {
            throw new \Exception('$this->uploadables must be a non-empty array.');
        }
    }

    /**
     * @param string $upload_dir
     */
    public function setUploadDir(string $upload_dir)
    {
        $this->upload_dir = $upload_dir;
    }



    /**
     * @return string
     */
    public function getUploadDir()
    {
        $date = new Carbon();
        return $this->upload_dir . DIRECTORY_SEPARATOR . $date->year . DIRECTORY_SEPARATOR . $date->month;
    }
    /**
     * @param $file string
     * @return string
     */
    private function createFileName($file)
    {
        $path = pathinfo($file);
        return uniqid() . '_' . str_slug($path['filename'], '_') . '.' . $path['extension'];
    }

    public function deleteImage($path)
    {
        $path = public_path($path);
        if (file_exists($path) && is_file($path)) {
            return unlink($path);
        }
        return false;
    }

}
