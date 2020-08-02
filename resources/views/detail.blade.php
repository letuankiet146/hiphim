@extends('basic-detail')

@section('detail')
    <video controls crossorigin playsinline poster="{{asset('img/'.$phim->background.'')}}">
            <source src="{{$publicUrl}}" type="video/mp4" size="576">
            @if(isset($phim->sub))
            <track kind="captions" label="Vietsub" src="/sub/{{$phim->sub}}" srclang="vi" default />
            @endif
    </video>

    <script src="{{asset('js/plyr.js')}}"></script>
    <script>
        const player = new Plyr('video', {captions: {active: true}});
        window.player = player;
    </script>
@endsection
