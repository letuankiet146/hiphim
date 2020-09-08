@extends('master')

@section('title','Homepage')

@section('content')
    <h1>3:00 pm 02/09(Media - dowload button)</h1>
    <video width='400' height='200' controls='controls'>
        <source src="{{$mediaUrl}}" type='video/mp4'/>
    </video>
@endsection

