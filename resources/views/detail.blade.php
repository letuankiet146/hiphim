@extends('basic-detail')

@section('detail')
    <a href="/xemphim/{{$phim->id}}" class="big-img-film-detail" style="background: url({{asset('img/'.$phim->background.'')}});background-repeat:no-repeat; background-size:contain; background-position:center;
        ">
        <div><i class="fa fa-play-circle" aria-hidden="true"></i></div>
    </a>
@endsection
