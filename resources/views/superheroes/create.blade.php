@extends('layouts.app')
@section('content')
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Add SuperHero</h5>
            {!! T::formOpen('superhero.store', true) !!}
                {!! T::colWidth(6)->formInput('nickname', 'Nickname', true) !!}
                {!! T::colWidth(6)->formInput('real_name', 'Real Name', true) !!}
                {!! T::colWidth(12)->formTextarea('origin_description', 'Origin Description', true) !!}
                {!! T::colWidth(12)->formTextarea('superpowers', 'Superpowers', true) !!}
                {!! T::colWidth(12)->formInput('catch_phrase', 'Catch Phrase', true) !!}
        
                <div class="col-md-12" style="margin-bottom: 20px">
                    Images
                    {!! Form::file('files', ['multiple']) !!}
                </div>
                
                {!! T::formSubmit('Save') !!}
            {!! T::formClose() !!}
        </div>
    </div>
    
@endsection