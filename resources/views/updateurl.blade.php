@extends('master')

@section('title','Homepage')

@section('content')
    <div class="d-flex p-2">
        <h2>{{$film->tenphim}}</h2>
        <form  action="/updateFilm" id="updateFilmFrom" method="post">
            {{csrf_field()}}
            <input hidden="true" value={{$film->id}} type="text" name="id"  placeholder="Film name"/><br>
            <h1>{{$film->title}}</h1><br>
            <textarea  name="url" form="updateFilmFrom" rows=4 cols=50  placeholder="Movie link"></textarea><br>
            <button type="submit">Update</button><hr>
        </form>
    </div>

@endsection
