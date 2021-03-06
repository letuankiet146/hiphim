@extends('basic')

@if($phim->danhmucs_id !== 2)
    @section('title','Xem Phim '.$phim->tenphim.' FULL HD Movie'.' ('.$phim->tenphim_en.') '.$phim->nam)
@elseif( !isset($taphientai) )
    @section('title','Xem Phim '.$phim->tenphim.' [Tập 1]'.' ('.$phim->tenphim_en.') '.$phim->nam)
@else
    @section('title','Xem Phim '.$phim->tenphim.' [Tập '.$taphientai.'] '.' ('.$phim->tenphim_en.') '.$phim->nam)
@endif

@section('add-meta-data')
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
    @if(isset($phim->meta_desc))
        <meta property="og:description"  content="{{$phim->meta_desc}}" />
    @elseif(isset($phim->mota))
        <meta property="og:description"  content="{{$phim->mota}}" />
    @endif
@endsection

@section('add-css')
    <link rel="stylesheet" href="{{asset('css/modal.css')}}" />
    <link rel="stylesheet" href="{{asset('css/basic-detail-v1.css')}}" />
@endsection
@section('add-js')
    <script type="text/javascript" src="{{asset('js/basic-detail_v1.js')}}"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
@endsection

@section('content')
<div class="path-folder-film">
    <ul>
        <li>
            <a title="Phim Mới, Phim Hay, Phim HD, Phim Rạp, Phim Miễn Phí" href="/"><span class="glyphicon glyphicon-home"></span> Trang chủ</a><i class="fa fa-angle-right" aria-hidden="true"></i>
        </li>
        <li><a href="/more/danh-muc/{{$phim->danhmuc->tendanhmuc}}">{{$phim->danhmuc->tendanhmuc}}</a><i class="fa fa-angle-right" aria-hidden="true"></i></li>
        <li style="color:#eaedb9">{{$phim->tenphim}}</li>
    </ul>
</div>
<div class="group-detail" itemscope itemtype="https://schema.org/Movie">
    @yield("detail")
    @if(isset($phim->ghichu) && strcasecmp($phim->ghichu,"")!==0)
    <p class="custom-success"><strong>{{$phim->ghichu}}</strong></p>
    @endif
    @if(isset($phim->trailer))
        <!-- Button trigger modal -->
        <a title="trailer" class="btn btn-primary video-btn btn-info btn-lg play-film" data-toggle="modal" data-src="https://www.youtube.com/embed/{{$phim->trailer}}" data-target="#myModal">
            Trailer
        </a>
        <a title="trailer" class="btn btn-danger video-btn btn-info btn-lg play-film" onclick="baoloi()">
            Báo lỗi
        </a>
        @if($phim->danhmucs_id !== 2)
        <script>
            function baoloi() {
                $.ajax({
                type:'GET',
                url:'/baoloi/{{$phim->id}}/2',
                data:'_token = <?php echo csrf_token() ?>',
                success:function(data) {
                    alert('Cảm ơn bạn đã cho chúng tôi biết điều này');
                },
                });
            }
        </script>
        @elseif( !isset($taphientai) )
        <script>
            function baoloi() {
                $.ajax({
                type:'GET',
                url:'/baoloi/{{$phim->id}}/1',
                data:'_token = <?php echo csrf_token() ?>',
                success:function(data) {
                    alert('Cảm ơn bạn đã cho chúng tôi biết điều này');
                },
                });
            }
        </script>
        @else
        <script>
            function baoloi() {
                $.ajax({
                type:'GET',
                url:'/baoloi/{{$phim->id}}/{{$taphientai}}',
                data:'_token = <?php echo csrf_token() ?>',
                success:function(data) {
                    alert('Cảm ơn bạn đã cho chúng tôi biết điều này');
                },
                });
            }
        </script>
        @endif
        @yield("modal-dialog")
    @endif

    <h1 class="title-film-detail-1" itemprop="name">{{$phim->tenphim}}</h1>
    <h2 class="title-film-detail-2">{{$phim->tenphim_en}}({{$phim->nam}})</h2>
    <div class="imdb">IMDB {{$phim->imdb}}</div>
    @if($phim->luotxem > 1000)
        <span class="rated-text">{{bcdiv($phim->luotxem, 1000, 1)}}K lượt xem</span> <span class="hd">HD</span>
    @else
        <span class="rated-text">{{$phim->luotxem}} lượt xem</span> <span class="hd">HD</span>
    @endif
    <br>
    @if($phim->danhmucs_id==2)
    <div class="episode-film">
        <div id="episode-all" class="episode-main">
            <div class="episode-server-name">
                @if($phim->phude == 1) Phụ đề @else Thuyết minh @endif
            </div>
            <ul>
                @foreach($sotaps as $tap) @if((!isset($taphientai) && $tap->tap == 1) || (isset($taphientai) && $tap->tap == $taphientai))
                <li data-episode-id="BLthEcl"><a hreflang="vi" class="actived btn-episode" href="/phim/{{$phim->link_id}}/tap-{{$tap->tap}}.html">{{$tap->tap}}</a></li>
                @else
                <li data-episode-id="BLthEcl"><a hreflang="vi" class="btn-episode" href="/phim/{{$phim->link_id}}/tap-{{$tap->tap}}.html">{{$tap->tap}}</a></li>
                @endif @endforeach
            </ul>
        </div>
    </div>
    @else
    <div class="episode-film">
        <div id="episode-all" class="episode-main">
            <div class="episode-server-name">
               Link dự phòng
            </div>
            <ul class='ul-ds-du-phong'>
                <li id="serverId"><a hreflang="vi" class="btn actived btn-episode" onclick="backToMainServer('{{$publicUrl}}','{{$isErrorUrl}}')">Server</a></li>

                @foreach($okUrls as $okUrl)
                <li id="db_{{$okUrl->servers_id}}"><a hreflang="vi" class="btn btn-episode"  onclick="changeFrame('okframe','{{$okUrl->url}}',{{$okUrl->servers_id}})">K{{$okUrl->servers_id}}</a></li>
                @endforeach
                @foreach($hyUrls as $hyUrl)
                <li id="db_{{$hyUrl->servers_id}}"><a hreflang="vi" class="btn btn-episode"  onclick="changeFrame('hyframe','{{$hyUrl->url}}',{{$hyUrl->servers_id}})">Y{{$hyUrl->servers_id}}</a></li>
                @endforeach
                @foreach($mediaServers as $mediaServer)
                <li id="db_{{$mediaServer->servers_id}}"><a hreflang="vi" class="btn btn-episode"  onclick="changeStreamServer({{$phim->id}},{{$mediaServer->servers_id}})">G{{$mediaServer->servers_id}}</a></li>
                @endforeach
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
            @foreach($theloais as $theloai)
                <a href="/more/the-loai/{{$theloai->tentheloai}}" title="Phim lẻ mới">{{$theloai->tentheloai}}</a>,
            @endforeach
        </li>
        <li>Quốc gia: <a hreflang="vi" href="/more/{{$danhmuctitle}}/{{$quocgia->tenquocgia}}" title="Phim Hàn Quốc">{{$quocgia->tenquocgia}}</a></li>
    </ul>
</div>
<div class="group-ndfilm-detail" itemprop="description">
    <h2 class="ndf">Nội dung phim</h2>
    <div class="noi-dung-film">
    {!!$phim->mota!!}
    </div>
</div>
<div class="group-film group-film-category">
    <h2>cùng thể loại<i class="fa fa-caret-right" aria-hidden="true"></i></h2>
    <span class="line-ngang"></span>
    <div class="group-film-small">
        @foreach($phimLienQuan as $phimlq)
        <a hreflang="vi" href="/phim/{{$phimlq->link_id}}.html" title="{{$phimlq->tenphim}}" class="film-small">
            <div class="poster-film-small lazy" style="background-image:url(/img/{{$phimlq->poster}}">
                <div class="sotap">
                    <span>
                        @if($phimlq->phude === 1) Phụ đề @else Thuyết minh @endif
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
