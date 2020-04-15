@extends('master')

@section('title','Homepage')

@section('content')
    <form  action="/updateFilm" id="updateFilmFrom" method="post">
        {{csrf_field()}}
        <input hidden="true" value={{$film->id}} type="text" name="id"  placeholder="Film name"/><br>
        <h1>{{$film->title}}</h1><br>
        <textarea  name="url" form="updateFilmFrom" rows=4 cols=50  placeholder="Movie link"></textarea><br>
        <button type="submit">Update</button><hr>
        <i>{{$film->fb}}</i><br>
    </form>

@endsection
