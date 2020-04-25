@extends('master')

@section('title','Homepage')

@section('content')
    <form  action="/insertFilm" id="insertFilmFrom" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="text" name="tenphim"  placeholder="Tên Phim"/><br>
        <textarea  name="mota" form="insertFilmFrom" rows=4 cols=50  placeholder="Mô tả"></textarea><br>
        <textarea  name="url" form="insertFilmFrom" rows=4 cols=50  placeholder="Movie link"></textarea><br>
        <textarea  name="fb" form="insertFilmFrom" rows=4 cols=50  placeholder="FB link"></textarea><br>
        <select name="theloaiId"  form="insertFilmFrom">
            <?php
                if(isset($theloaiKeys)){
                    foreach ($theloaiKeys as $key) {
                        $tentheloai = $theloaiArray[$key];
                        echo "<option value=$key>$tentheloai</option>";
                    }
                }
            ?>
        </select>
        <select name="danhmucId"  form="insertFilmFrom">
            <?php
               if(isset($danhmucKeys)){
                foreach ($danhmucKeys as $key) {
                    $tendanhmuc = $danhmucArray[$key];
                    echo "<option value=$key>$tendanhmuc</option>";
                }
               }
            ?>
        </select><br>
        <input type="number" name="imdb"  placeholder="IMDB" min="0" max="9.9"/><br>
        Poster img: <input type="file" name="poster" /><br>
        Backgr img: <input type="file" name="bg" /><br>
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
                echo "<p><a href='/delete/{$film->id}'>Delete</a> <a href='/update/{$film->id}'>Update</a> # $film->tenphim </p>";
            };
        };
    ?>

@endsection
