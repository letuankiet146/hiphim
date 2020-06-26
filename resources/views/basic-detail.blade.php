@extends('basic')

@if($phim->danhmucs_id !== 2)
    @section('title','Xem Phim '.$phim->tenphim.' ('.$phim->tenphim_en.') '.$phim->nam)
@elseif( !isset($taphientai) )
    @section('title','Xem Phim '.$phim->tenphim.' [Tập 1]'.' ('.$phim->tenphim_en.') '.$phim->nam)
@else
    @section('title','Xem Phim '.$phim->tenphim.' [Tập '.$taphientai.'] '.' ('.$phim->tenphim_en.') '.$phim->nam)
@endif

@section('add-meta-data')
    @if(isset($phim->meta_keyword))
    <meta name="keywords" content="{{$phim->meta_keyword}}" />
    @else
        <meta name="keywords" content="{{$phim->tenphim.' ('.$phim->tenphim_en.') '.$phim->nam}}" />
    @endif

    @if(isset($phim->meta_desc))
        <meta name="description" content="{{$phim->meta_desc}}" />
    @else
        @if(isset($phim->mota))
            <meta name="description" content="{{$phim->mota}}" />
        @endif
    @endif

@endsection

@section('add-og-data')
    <meta  property="og:title" content="{{$phim->tenphim.' ('.$phim->tenphim_en.') '.$phim->nam}}" />
    <meta property="og:image" content="{{asset('img/'.$phim->background.'')}}" />
    @if(isset($phim->mota))
        <meta property="og:description"  content="{{$phim->mota}}" />
    @endif
@endsection

@section('add-css')
    <link rel="stylesheet" href="{{asset('css/trailer.css')}}" />
@endsection
@section('add-js')
    <script type="text/javascript" src="{{asset('js/trailer.js')}}"></script>
@endsection

@section('content')
<div class="group-detail" itemscope itemtype="https://schema.org/Movie">
    @yield("detail")
    @if(isset($phim->trailer))
    <!-- Button trigger modal -->
    <a title="trailer" class="btn btn-primary video-btn btn-info btn-lg play-film" data-toggle="modal" data-src="https://www.youtube.com/embed/{{$phim->trailer}}" data-target="#myModal">
        Trailer
    </a>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <!-- 16:9 aspect ratio -->
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe width="100%" height="379" class="embed-responsive-item" src="" id="video" allowscriptaccess="always" allow="autoplay" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endif

    <h1 class="title-film-detail-1" itemprop="name">{{$phim->tenphim}}</h1>
    <h2 class="title-film-detail-2">{{$phim->tenphim_en}}({{$phim->nam}})</h2>
    <div class="imdb">IMDB {{$phim->imdb}}</div>
    <span class="rated-text">{{$phim->luotxem}} lượt xem</span> <span class="hd">HD</span>
    <br>
    <p class="custom-error" style="display: none;"></p>
    @if($phim->danhmucs_id==2)
    <div class="episode-film">
        <div id="episode-all" class="episode-main">
            <div class="episode-server-name">
                @if($phim->phude == 1) Phụ đề @else Thuyết minh @endif
            </div>
            <ul>
                @foreach($sotaps as $tap) @if((!isset($taphientai) && $tap->tap == 1) || (isset($taphientai) && $tap->tap == $taphientai))
                <li data-episode-id="BLthEcl"><a hreflang="vi" class="actived btn-episode" href="/detail/{{$phim->id}}/tap-{{$tap->tap}}">{{$tap->tap}}</a></li>
                @else
                <li data-episode-id="BLthEcl"><a hreflang="vi" class="btn-episode" href="/detail/{{$phim->id}}/tap-{{$tap->tap}}">{{$tap->tap}}</a></li>
                @endif @endforeach
            </ul>
        </div>
    </div>
    @endif
    <ul class="infomation-film">
        <li class="title">Thông tin:</li>
        <li>
            Đang phát :
            <span>
                @if($phim->phude == 1) Phụ đề @else Thuyết minh @endif
            </span>
        </li>
        <li>
            Ngày cập nhật :
            <span>
                <?php
            $date = new DateTime( $phim->ngaytao); echo $date->format('d-m-Y'); ?>
            </span>
        </li>
        <li>Thời lượng: <span>{{$phim->thoiluong}} phút</span></li>
        <li>
            Diễn viên: @foreach($dienviens as $dienvien) @if(strcmp($dienvien->tendienvien,"N/A") != 0) <a hreflang="vi" href="/more/dien-vien/{{$dienvien->tendienvien}}">{{$dienvien->tendienvien}}</a><span>,</span>
            @endif @endforeach
        </li>
        <li>
            Thể loại:
            <?php
            foreach($theloais as $theloai){
                echo $theloai->tentheloai.", "; } ?>
        </li>
        <li>Quốc gia: <a hreflang="vi" href="/more/{{$danhmuctitle}}/{{$quocgia->tenquocgia}}" title="Phim Hàn Quốc">{{$quocgia->tenquocgia}}</a></li>
    </ul>
</div>
<div class="group-ndfilm-detail" itemprop="description">
    <h2 class="ndf">Nội dung phim</h2>
    <p class="content-film">
        {{$phim->mota}}
    </p>
</div>
<div class="fbchat">
    <div class="fb-comments" data-href="https://hiphim.org/detail/{{$phim->id}}" data-numposts="10" data-width="100%" data-order-by="reverse_time" data-colorscheme="dark"></div>
</div>
<div class="group-film group-film-category">
    <h2>phim cùng thể loại<i class="fa fa-caret-right" aria-hidden="true"></i></h2>
    <span class="line-ngang"></span>
    <div class="group-film-small">
        @foreach($phimLienQuan as $phimlq)
        <a hreflang="vi" href="/detail/{{$phimlq->id}}" title="{{$phimlq->tenphim}}" class="film-small">
            <div class="poster-film-small lazy" style="background-image:url(/img/{{$phimlq->poster}}">
                <div class="sotap">
                    <span>
                        @if($phim->phude == 1) Phụ đề @else Thuyết minh @endif
                    </span>
                </div>
                <ul class="tag-film">
                    <li><div class="hd">HD</div></li>
                </ul>
                <div class="play"></div>
            </div>
            <div class="title-film-small">
                <b class="title-film">{{$phimlq->tenphim}}</b>
                <p>{{$phimlq->tenphim_en}}({{$phimlq->nam}})</p>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection
