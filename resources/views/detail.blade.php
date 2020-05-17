@extends('basic-detail')

@section('detail')
    <div class="container">
    <video controls crossorigin playsinline poster="{{asset('img/'.$phim->background.'')}}">
            <source src="{{$publicUrl}}" type="video/mp4" size="576">
    </video>
    </div>

    <script src="{{asset('js/plyr.js')}}"></script>
    <script>
        const player = new Plyr('video', {captions: {active: true}});
        window.player = player;
    </script>
@endsection
