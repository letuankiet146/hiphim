@extends('master')

@section('title','Homepage')

@section('content')
    <?php

        foreach($keys as $key){
            echo "<h1>$key</h1>";
            echo " <video width='400' height='200' controls='controls'>";
            echo "<source src=$linkarray[$key] type='video/mp4'/>";
            echo "</video>";
        }
    ?>
@endsection
