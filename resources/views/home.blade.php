@extends('master')

@section('title','Homepage')

@section('content')
    <form  action="/insertFilm" id="insertFilmFrom" method="post">
        {{csrf_field()}}
        <input type="text" name="title"  placeholder="Film name"/><br>
        <textarea  name="url" form="insertFilmFrom" rows=4 cols=50  placeholder="Movie link"></textarea><br>
        <textarea  name="fb" form="insertFilmFrom" rows=4 cols=50  placeholder="FB link"></textarea><br>
        <button type="submit">Save</button>
    </form>
    <br>
    <hr>
    <a href="/testlink">Test link</a>
    <br>
    <a href="/live">Review all</a>
    <br>
    <br>
    <form  action="/searchFilm" id="searchFilmFrom" method="post">
        {{csrf_field()}}
        <input type="text" name="title"  placeholder="Search film name"/><br>
        <button type="submit">Search</button>
    </form>
    <?php

        if(isset($films)){
            foreach($films as $film){
                echo "<p><a href='/delete/{$film->id}'>Delete</a> <a href='/update/{$film->id}'>Update</a> # $film->title </p>";
            };
        };
    ?>

@endsection
