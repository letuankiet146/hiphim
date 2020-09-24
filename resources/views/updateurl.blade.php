@extends('master')

@section('title','Homepage')

@section('content')
    <div class="form d-flex p-2">
        <h2>{{$film->tenphim}}</h2>
        <form  action="/updateFilm" id="updateFilmFrom" method="post">
            {{csrf_field()}}
            <input hidden="true" value={{$film->id}} type="text" name="id"  placeholder="Film name"/><br>

            <h1>{{$film->title}}</h1><br>
            <div class="form-group">
                @if(isset($sotap))
                <input type="text" name="sotap" value={{$sotap->tap}} readonly>
                <br>
                @endif
                <textarea  name="url" form="updateFilmFrom" rows=4 cols=50  placeholder="Movie link"></textarea><br>
            </div>
            <button type="submit">Update</button><hr>
        </form>
    </div>

@endsection
