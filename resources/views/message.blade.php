@extends('master')

@section('title','Message')

@section('content')
    <h3> {{$message->title}} </h3>
    <h3> {{$message->content}} </h3>
@endsection
