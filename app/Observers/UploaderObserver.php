<?php
/**
 * Created by PhpStorm.
 * User: ludio
 * Date: 03/05/18
 * Time: 02:45
 */

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;

class UploaderObserver
{
    /**
     * Trigger function when saving a model (creating).
     *
     * @param  Model  $model
     * @return void
     */
    public function saved(Model $model)
    {
        $model->performUploads();
    }
}