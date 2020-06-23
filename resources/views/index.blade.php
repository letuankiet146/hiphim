@extends('basic')

@section('title','Xem phim nhanh | Xem phim online | Xem phim miễn phí')

@section('add-meta-data')
<meta name="keywords" content="Phim, xem phim, xem phim online, phim online, xem phim hd, phim hd, hiphim, hi phim, hiphim.org" />
<meta name="description" content="Xem phim hay online miễn phí, Tuyển tập những bộ phim online mới chất lượng cao, HiPhim.org cập nhật liên tục các bộ phim hành động thuyết minh, hàn quốc lồng tiếng, võ thuật đang HOT nhất, xem phim chất lượng HD miễn phí" />
@endsection

@section('add-og-data')
<meta property="og:title" content="Xem phim online, xem phim VietSub, phim thuyết minh lồng tiếng mới nhất - HiPhim.org" />
<meta property="og:description" content="Xem phim hay online miễn phí, Tuyển tập những bộ phim online mới chất lượng cao, HiPhim.org cập nhật liên tục các bộ phim hành động thuyết minh, hàn quốc lồng tiếng, võ thuật đang HOT nhất, xem phim chất lượng HD miễn phí" />
<meta property="og:image" content="{{asset('img/homepage-bn.jpg')}}" />
@endsection

@section('content')
<!-- <div class="khoi-trai"> -->
    <div class="slider top-slider">
        <?php
            $phims = $phims->sortByDesc('ngaytao');
            $i = 0;
        foreach($phims as $phim){
            if($phim->danhmucs_id == 3){
                echo "<div class='item' style='float:left'>";
                echo"<a class='lazy' href='/detail/$phim->id' title='$phim->tenphim'><img src='/img/$phim->background' alt='' style='background-size: cover;background-repeat:no-repeat;width: inherit;height: inherit;'></a>";
                echo"</div>";
                if($i >= 9){
                break;
                }
                $i++;
            }
        }
        ?>
    </div>
    <div class="group-film group-film-category" id="cat-phim-chieu-rap" data-page="2" data-slug="">
        <h2>
            <a title="Phim Đang Chiếu Rạp" href="/more/danh-muc/Phim+Chiếu+Rạp">phim chiếu rạp<i class="fa fa-caret-right" aria-hidden="true"></i></a>
        </h2>
        <a href="/more/danh-muc/Phim+Chiếu+Rạp" class="more" ></a>
        <span class="line-ngang"></span>
        <div class="phimdecu-slider">
            @foreach($phimChieuRap as $phim)
            <div class='item'>
                <a title='{{$phim->tenphim}}' href='/detail/{{$phim->id}}' style='background-image:url(/img/{{$phim->poster}}' tabindex='0'>
                    <div class='black-gradient'>
                        <b class='title-film'>{{$phim->tenphim}}</b>
                        <p>{{$phim->tenphim_en}} ({{$phim->nam}})</p>
                        <ul class='tag-film'>
                            <li>
                                <div class='hd'>{{$phim->imdb}}</div>
                            </li>
                        </ul>
                    </div>
                    <div class='play'></div>
                </a>
            </div>
            @endforeach
        </div>
    </div>

    <div class="group-film group-film-category" id="cat-phim-bo" data-page="1" data-slug="">
        <h2>
            <a title="Phim Bộ Mới" href="/more/danh-muc/Phim+Bộ">phim bộ chọn lọc<i class="fa fa-caret-right" aria-hidden="true"></i></a>
        </h2>
        <ul class="phanloai">
            <li><a href="/more/phim-bo/Trung+Quốc" title="Phim bộ Trung Quốc">Trung Quốc</a></li>
            <li><a href="/more/phim-bo/Hàn+Quốc" title="Phim bộ Hàn Quốc">Hàn Quốc</a></li>
            <li><a href="/more/phim-bo/Mỹ" title="Phim bộ Mỹ">Mỹ</a></li>
        </ul>
        <a href="/more/danh-muc/Phim+Bộ" class="more"></a>
        <span class="line-ngang"></span>
        <div class="group-film-small">
            @foreach($phimChieuBo as $phim)
            <a title='{{$phim->tenphim}}' href='/detail/{{$phim->id}}' class='film-small lazy'>
                    <div class='poster-film-small ' style='background-image:url(/img/{{$phim->poster}}'>
                        <div class='sotap'>{{count($phim->sotaps)}}/{{$phim->tongsotap}}</div>
                        <ul class='tag-film'>
                            <li>
                                <div class='hd'>HD</div>
                            </li>
                        </ul>
                        <div class='play'></div>
                    </div>
                    <div class='title-film-small'>
                        <b class='title-film'>{{$phim->tenphim}}</b>
                        <p>{{$phim->tenphim_en}} ({{$phim->nam}})</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    <div class="group-film group-film-category" id="cat-phim-le" data-page="1" data-slug="">
        <h2>
            <a title="Phim Lẻ Mới" href="/more/danh-muc/Phim+Lẻ">phim lẻ chọn lọc<i class="fa fa-caret-right" aria-hidden="true"></i></a>
        </h2>
        <ul class="phanloai">
            <li><a href="/more/phim-le/Hành+động" title="Phim lẻ Hành động">Hành động</a></li>
            <li><a href="/more/phim-le/Hài+Hước" title="Phim lẻ Hài">Hài hước</a></li>
            <li><a href="/more/phim-le/Kinh+dị" title="Phim lẻ Kinh dị">Kinh dị</a></li>
        </ul>
        <a href="/more/danh-muc/Phim+Lẻ" class="more" ></a>
        <span class="line-ngang"></span>
        <div class="group-film-small">
            @foreach($phimChieuLe as $phim)
            <a title='{{$phim->tenphim}}' href='/detail/{{$phim->id}}' class='film-small lazy'>
                <div class='poster-film-small ' style='background-image:url(/img/{{$phim->poster}}'>
                    <ul class='tag-film'>
                    <li><div class='hd'>{{$phim->imdb}}</div></li>
                    </ul> <div class='play'></div>
                </div>
                <div class='title-film-small'>
                    <b class='title-film'>{{$phim->tenphim}}</b>
                    <p>{{$phim->tenphim_en}} ({{$phim->nam}})</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    <div class="group-film" id="cat-the-loai-tv-show" data-page="1" data-slug="">
        <h2>
            <a href="/more/tv-show/all">TV Shows<i class="fa fa-caret-right" aria-hidden="true"></i></a>
        </h2>
        <a href="/more/tv-show/all" class="more" ></a>
        <span class="line-ngang"></span>
        <div class="group-film-small">
            @foreach($phimTv as $phim)
            <a title='{{$phim->tenphim}}' href='/detail/{{$phim->id}}' class='film-small lazy'>
                <div class='poster-film-small ' style='background-image:url(/img/{{$phim->poster}}'>
                    <ul class='tag-film'>
                    <li><div class='hd'>HD</div></li>
                    </ul> <div class='play'></div>
                </div>
                <div class='title-film-small'>
                    <b class='title-film'>{{$phim->tenphim}}</b>
                    <p>{{$phim->tenphim_en}} ({{$phim->nam}})</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
<!-- </div> -->

@endsection

