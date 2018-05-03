@extends('layouts.app')
@section('content')
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Nickname</th>
                    <th>Real name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($superHeroes as $superHero)
                    <tr>
                        <td>
                            @if($superHero->images()->count())
                                <img src="{!! $superHero->images->first()->file !!}" width="40" />
                            @else
                                <img src="//placehold.it/40x40?text=No+image" width="40" />
                            @endif
                        </td>
                        <td>{!! $superHero->nickname !!}</td>
                        <td>{!! $superHero->real_name !!}</td>
                        <td>
                            {!! T::editBtn('superhero.edit', [$superHero->id]) !!}
                            {!! T::deleteBtn('superhero.destroy', [$superHero->id]) !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    {!! $superHeroes->render() !!}
@endsection