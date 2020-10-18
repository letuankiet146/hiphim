@extends('master')

@section('title','Homepage')

@section('content')
    <div class="form d-flex p-2">
        <h2>{{$phim->tenphim}}</h2>
        <form  action="/addserver" id="addserverForm" method="post">
            {{csrf_field()}}
            <input hidden="true" value={{$phim->id}} type="text" name="id" /><br>
            <input hidden="true" type="number" name="new_server_id" value={{$newServerId}}>
            <h1>{{$phim->title}}</h1>
            <select name="server_type" form="addserverForm" style="background-color: yellow">
                <option value="MEDIA">MEDIA</option>
                <option value="NORMAL">NORMAL</option>
            </select> <br>
            <textarea  name="url" form="addserverForm" rows=4 cols=50  placeholder="Movie link"></textarea><br>
            <button type="submit">Update</button><hr>
        </form>
    </div>

@endsection
