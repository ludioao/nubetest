<?php

namespace App\Models;

use App\Models\Traits\Uploader;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuperHero extends Model
{
    use Uploader, SoftDeletes;
    //
    /**
     * @var string
     */
    protected $table = 'superheroes';

    protected $uploadables = ['files'];

    protected $upload_dir = 'images';

    /**
     * Fillable fields
     * @var array
     */
    protected $fillable = [
        'nickname',
        'real_name',
        'origin_description',
        'superpowers',
        'catch_phrase'
    ];

    public static $rules = [
        'nickname' => 'required|max:100',
        'real_name' => 'required|max:100',
        'origin_description' => 'required|max:500',
        'superpowers' => 'required|max:500',
        'catch_phrase' => 'required|max:255',
    ];

    /**
     * Images, relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(SuperHeroImage::class, 'superhero_id');
    }

}
