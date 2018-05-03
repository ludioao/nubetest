<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSuperHeroRequest;
use \App\Models\SuperHero as Model;

class SuperHero extends Controller
{

    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        return $this->model->paginate(10);
    }

    public function store(CreateSuperHeroRequest $request)
    {
        $model = new Model();
        $model->fill($request->all());
        $model->save();
        if ($model->exists) {
            return response()->json(['created' => true]);
        }
        return response()->json(['created' => false]);
    }


}