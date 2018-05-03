<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSuperHeroRequest;
use Illuminate\Http\Request;
use App\Models\SuperHero as Model;

class SuperHero extends Controller
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    //
    public function index()
    {
        $superHeroes = $this->model->paginate(5);
        return view('superheroes.index', compact('superHeroes'));
    }

    public function create()
    {
        return view('superheroes.create');
    }

    /**
     * Create super hero.
     * @param CreateSuperHeroRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateSuperHeroRequest $request)
    {
        $model = new Model();
        $model->fill($request->all());
        $model->save();

        session()->put('success', 'Superhero created with success!');
        return redirect()->back();
    }

    /**
     * Edit existing superhero.
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $superHero = Model::findOrFail($id);
        return view('superheroes.edit', compact('superHero'));
    }

    /**
     * Update existing superhero.
     * @param                        $id
     * @param CreateSuperHeroRequest $request
     */
    public function update($id, CreateSuperHeroRequest $request)
    {
        $model = Model::findOrFail($id);
        $model->fill($request->all());
        $model->save();

        session()->put('success', 'Superhero updated with success!');
        return redirect()->back();
    }

    /**
     * Exclude a superhero.
     * using softdelete.
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        $superHero = Model::findOrFail($id);
        $superHero->delete();
        session()->put('success', 'Superhero sent to trash.');
        return redirect()->back();
    }


}
