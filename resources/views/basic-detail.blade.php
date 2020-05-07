@extends('basic')

@section('title',$phim->tenphim)

@section('content')
<div class="khoi-trai">
   <div class="group-detail" itemscope itemtype="https://schema.org/Movie">
      @yield("detail")
      <h1 class="title-film-detail-1" itemprop="name">{{$phim->tenphim}}</h1>
      <div class="imdb">IMDB {{$phim->imdb}}</div>
      <span class="rated-text">{{$phim->luotxem}} lượt xem</span> <span class="hd">HD</span>
      <br> <a href="/xemphim/{{$phim->id}}" title="{{$phim->tenphim}}" class="play-film" style="background:#77c282;color:#000000;font-weight: bold;">Xem Phim<i class="fa fa-caret-right" aria-hidden="true"></i></a>
      <p class="custom-error" style="display:none;"></p>
      <ul class="infomation-film">
         <li class="title">Thông tin:</li>
         <li>Đang phát :
             <span>
             @if($phim->phude == 1)
                Phụ đề
             @else
                Thuyết minh
             @endif
            </span> </li>
         <li>Ngày cập nhật :
            <span>
            <?php
               $date = new DateTime( $phim->ngaytao);
               echo $date->format('d-m-Y');
               ?>
            </span>
         </li>
         <li>Thời lượng: <span>{{$phim->thoiluong}} phút</span></li>
         <li>Diễn viên:
             @foreach($dienviens as $dienvien)
                <a href="#">{{$dienvien->tendienvien}}</a><span>,</span>
             @endforeach
         </li>
         <li>Thể loại:
            <?php
               foreach($theloais as $theloai){
                   echo $theloai->tentheloai.", ";
               }
               ?>
         </li>
         <li>Quốc gia: <a href="/more/{{$danhmuctitle}}/{{$quocgia->tenquocgia}}" title="Phim Hàn Quốc">{{$quocgia->tenquocgia}}</a> </li>
      </ul>
   </div>
   <div class="group-ndfilm-detail" itemprop="description">
      <h2 class="ndf">Nội dung phim</h2>
      <p class="content-film">
         {{$phim->mota}}
      </p>
   </div>
   <div class="group-film group-film-category">
      <h2>phim cùng thể loại<i class="fa fa-caret-right" aria-hidden="true"></i></h2>
      <span class="line-ngang"></span>
      <div class="group-film-small">
        @foreach($phimLienQuan as $phimlq)
        <a href='../detail/{{$phimlq->id}}' title='{{$phimlq->tenphim}}' class='film-small '>
            <div class='poster-film-small lazy' style='background-image:url(/img/{{$phimlq->poster}}'>
            <div class='sotap'>
                <span>
                @if($phim->phude == 1)
                    Phụ đề
                @else
                    Thuyết minh
                @endif
                </span>
            </div>
            <ul class='tag-film'>
            <li><div class='hd'>HD</div></li>
            </ul>
            <div class='play'></div>
            </div>
            <div class='title-film-small'>
            <b class='title-film'>{{$phimlq->tenphim}}</b>
            <p>{{$phimlq->tenphim_en}}</p>
            </div>
        </a>
        @endforeach
      </div>
   </div>
</div>
<div class="khoi-phai">
   <div class="topphim-doc">
      <h3>top phim lẻ</h3>
      <ul class="film">
         <?php
            for ($i=0 ; $i<=4 ; $i++){
                echo "<li>";
                echo "<a href='https://bongngo.tv/qua-nhanh-qua-nguy-hiem-9-6954.html' title='Quá Nhanh Quá Nguy Hiểm 9 - Fast & Furious Presents: Hobbs & Shaw'>";
                echo "<div class='image lazy' style='background-image:url(http://homestead.test/img/poster_canh-sat-thanh-pho.jpg'></div>";
                echo "<div class='info'>";
                echo "<b class='title-film'>Quá Nhanh Quá Nguy Hiểm 9</b>";
                echo "<p>Fast & Furious Presents: Hobbs & Shaw (2019)</p>";
                echo "<span class='luotxem'>Lượt xem: 38,454</span> <span class='imdb'>IMDB 7.0</span>";
                echo "</div>";
                echo "</a>";
                echo "</li>";
            }
            ?>
      </ul>
   </div>
   <div id="widget_top_film_country_by_type_phim-bo" class="topphim-ngang">
      <h3>Top phim bộ</h3>
      <ul class="phanloai">
         <li><a href="javascript:;" class="actived" onclick="top_view_country_by_type('my','phim-bo','week')">Mỹ</a></li>
         <li><a href="javascript:;" onclick="top_view_country_by_type('han-quoc', 'phim-bo','week')">Hàn Quốc</a></li>
         <li><a href="javascript:;" onclick="top_view_country_by_type('trung-quoc','phim-bo','week')">Trung Quốc</a></li>
      </ul>
      <ul id="blog1" class="film active">
         <?php
            for ($i=0 ; $i<=4 ; $i++){
                echo "<li>";
                echo "<a href='https://bongngo.tv/qua-nhanh-qua-nguy-hiem-9-6954.html' title='Quá Nhanh Quá Nguy Hiểm 9 - Fast & Furious Presents: Hobbs & Shaw'>";
                echo "<div class='image lazy' style='background-image:url(http://homestead.test/img/poster_canh-sat-thanh-pho.jpg'></div>";
                echo "<span class='imdb'>IMDb <br> <b>8.5</b></span>";
                echo "<div class='info'>";
                echo "<b class='title-film'>Quá Nhanh Quá Nguy Hiểm 9</b>";
                echo "<p>Fast & Furious Presents: Hobbs & Shaw (2019)</p>";
                echo "</div>";
                echo "</a>";
                echo "</li>";
            }
            ?>
      </ul>
   </div>
</div>
</div>
@endsection
