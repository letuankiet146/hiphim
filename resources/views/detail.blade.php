@extends('basic')

@section('title',$phim->tenphim)

@section('content')
<div class="khoi-trai">
   <div class="group-detail" itemscope itemtype="https://schema.org/Movie">
      <a href="/xemphim/{{$phim->id}}" class="big-img-film-detail" style="background: url({{asset('img/'.$phim->background.'')}});background-repeat:no-repeat; background-size:contain; background-position:center;
         ">
         <div><i class="fa fa-play-circle" aria-hidden="true"></i></div>
      </a>
      <h1 class="title-film-detail-1" itemprop="name">{{$phim->tenphim}}</h1>
      <div class="imdb">IMDB {{$phim->imdb}}</div>
      <span class="rated-text">{{$phim->luotxem}} lượt xem</span> <span class="hd">HD</span>
      <br> <a href="/xemphim/{{$phim->id}}" title="{{$phim->tenphim}}" class="play-film" style="background:#77c282;color:#000000;font-weight: bold;">Xem Phim<i class="fa fa-caret-right" aria-hidden="true"></i></a>
      <p class="custom-error" style="display:none;"></p>
      <ul class="infomation-film">
         <li class="title">Thông tin:</li>
         <li>Đang phát : <span>Phụ đề</span> </li>
         <li>Ngày cập nhật :
            <span>
            <?php
               $date = new DateTime( $phim->ngaytao);
               echo $date->format('d-m-Y');
               ?>
            </span>
         </li>
         <li>Thời lượng: <span>110 phút</span></li>
         <li>Đạo diễn: <span><a href="https://bongngo.tv/tags/choi-won-sub/" rel="follow, index" title="Xem Phim CHOI Won-sub">CHOI Won-sub</a>, </span></li>
         <li>Diễn viên: <a href="https://bongngo.tv/dien-vien/kwon-sang-woo/" rel="follow, index" title="Diễn viên KWON Sang-woo">KWON Sang-woo</a>,<a href="https://bongngo.tv/dien-vien/jeoung-jun-ho/" rel="follow, index" title="Diễn viên JEOUNG Jun-ho">JEOUNG Jun-ho</a>,<a href="https://bongngo.tv/dien-vien/hwang-woo-seul-hye/" rel="follow, index" title="Diễn viên HWANG WOO Seul-hye">HWANG WOO Seul-hye</a>,<a href="https://bongngo.tv/dien-vien/lee-yi-kying/" rel="follow, index" title="Diễn viên LEE Yi-kying">LEE Yi-kying</a>, </li>
         <li>Thể loại:
            <?php
               foreach($theloais as $theloai){
                   echo $theloai->tentheloai.", ";
               }
               ?>
         </li>
         <li>Quốc gia: <a href="https://bongngo.tv/quoc-gia/phim-han-quoc/" title="Phim Hàn Quốc">Phim Hàn Quốc</a>, </li>
         <li class="tags"><span>TAGS: </span> <a href="https://bongngo.tv/tags/sat-thu-vo-cung-cuc/" rel="follow, index" title="Xem Phim sát thủ vô cùng cực">sát thủ vô cùng cực</a>, <a href="https://bongngo.tv/tags/hitman:-agent-jun/" rel="follow, index" title="Xem Phim hitman: agent jun">hitman: agent jun</a>, </li>
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
         <?php
            for($i=0; $i<=5 ; $i++){
                echo "<a href='https://bongngo.tv/sat-thu-mat-danh-47-556.html' title='Sát Thủ Mật Danh 47 - Hitman Agent 47' class='film-small '>";
                echo "<div class='poster-film-small lazy' style='background-image:url(http://homestead.test/img/poster_nguoi-vo-hinh.jpg'>";
                echo "<div class='sotap'>Thuyết Minh</div>";
                echo "<ul class='tag-film'>";
                echo "<li><div class='hd'>HD</div></li>";
                echo "</ul>";
                echo "<div class='play'></div>";
                echo "</div>";
                echo "<div class='title-film-small'>";
                echo "<b class='title-film'>Sát Thủ Mật Danh 47</b>";
                echo "<p>Hitman Agent 47 (2015)</p>";
                echo "</div>";
                echo "</a>";
            }

            ?>
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
