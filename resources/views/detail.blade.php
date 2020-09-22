@extends('basic-detail')

@section('detail')
    @if(isset($isErrorUrl) && $isErrorUrl)
    <div id="mainLinkhongId" class="alert alert-danger text-monospace" role="alert" style="text-align: center">
    <i class='fas fa-sad-cry'></i><strong style="font-size: 110%; "> Link hỏng! </strong><i class='fas fa-sad-cry'></i>
    <br>
    <p style="font-size: 90%; ">Hãy chọn server khác(nếu có). Chúng tôi sẽ sớm cập nhật<p>
    </div>
    @endif
    <div id="linkhongId" class="alert alert-danger text-monospace" role="alert" style="text-align: center; display:none">
    <i class='fas fa-sad-cry'></i><strong id="alertContentId" style="font-size: 110%; "> Link hỏng! </strong><i class='fas fa-sad-cry'></i>
    <br>
    <p style="font-size: 90%; ">Chúng tôi sẽ sớm cập nhật<p>
    </div>
    <video id="phimContainId" controls crossorigin playsinline poster="{{asset('img/'.$phim->background.'')}}" autoplay>
            <source src="{{$publicUrl}}" type="video/mp4" size="576">
            @if(isset($phim->sub))
            <track kind="captions" label="Vietsub" src="/sub/{{$phim->sub}}" srclang="vi" default />
            @endif
    </video>

    <script src="{{asset('js/plyr.js')}}"></script>
    <script>
        const player = new Plyr('video', {captions: {active: true}});
        player.autoplay=true;
        window.player = player;
        document.getElementById("phimContainId").addEventListener('webkitfullscreenchange', onFullScreen);
    </script>
@endsection

@section('modal-dialog')
<!-- Modal Trailer-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 m-h-20 bg-img rounded-left">
                    </div>
                    <div class="col-md-12 py-5 px-sm-5 ">
                        <!-- 16:9 aspect ratio -->
                        <div class="embed-responsive embed-responsive-16by9">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <iframe width="100%" height="379" class="embed-responsive-item" src="" id="video" allowscriptaccess="always" allow="autoplay" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal QC -->
<div class="modal fade auto-off"  id="demoModal"  tabindex="-1" role="dialog"
        aria-labelledby="demoModal" aria-hidden="true">
    <div class="modal-dialog animated zoomInDown modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 m-h-20 bg-img rounded-left">
                    </div>
                    <div class="col-md-12 py-5 px-sm-5 ">
                        <img src="{{asset('img/cgvlogo.png')}}" alt="CGV Cinemas" class="large">
                        <h1>Đã có ở hiphim.org</h1>
                        <div>
                        <ul class="no_bullet">
                            @foreach($phimQC as $phimqce)
                            <li class="star" style="background: url('/img/{{$phimqce->poster}}') no-repeat left top;background-size: 11%; height: 70px; padding-left: 13%; padding-top: 2%;">
                                <a href='/phim/{{$phimqce->link_id}}.html' style='background-image:url(/img/{{$phimqce->poster}}' title='{{$phimqce->tenphim}}'>
                                    <div class="info">
                                        <b class="title-film">{{$phimqce->tenphim}}</b>
                                        <p>{{$phimqce->tenphim_en}} ({{$phimqce->nam}})</p>
                                    </div>
                                </a>
                                <hr >
                            </li>
                            @endforeach
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
