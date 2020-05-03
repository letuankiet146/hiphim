@extends('basic')

@section('title','Hi Phim | Phim Mới | Phim hay | Xem phim nhanh | Xem phim online | Phim HD')

@section('content')
<div class="khoi-trai">
<div class="slider top-slider">
   <?php
      foreach($phims as $phim){
          echo "<div class='item' style='float:left'>";
          echo"<a class='lazy' href='http://homestead.test/detail/$phim->id' title='$phim->tenphim'><img src='http://homestead.test/img/$phim->background' alt='' style='background-size: cover;background-repeat:no-repeat;width: inherit;height: inherit;'></a>";
          echo"</div>";
      }
    ?>
</div>
<div class="group-film group-film-category" id="cat-phim-chieu-rap" data-page="2" data-slug="">
   <h2><a title="Phim Đang Chiếu Rạp" href="https://bongngo.tv/phim-chieu-rap/">phim chiếu rạp<i class="fa fa-caret-right" aria-hidden="true"></i></a></h2>
   <a href="https://bongngo.tv/phim-chieu-rap/" class="more"></a> <span class="line-ngang"></span>
   <div class="phimdecu-slider">
      <?php
         foreach($phims as $phim){
          echo "<div class='item'>";
          echo "<a title='Triều Ca - Zhao Ge' href='https://bongngo.tv/trieu-ca-5819.html' style='background-image:url(http://homestead.test/img/poster_canh-sat-thanh-pho.jpg' tabindex='0'>";
          echo "<div class='black-gradient'>";
          echo "<b class='title-film'>Triều Ca</b>";
          echo " <p>Zhao Ge (2019)</p>";
          echo "<ul class='tag-film'>";
          echo "<li><div class='hd'></div></li>";
          echo " </ul>";
          echo " </div>";
          echo "<div class='play'></div>";
          echo "</a>";
          echo "</div>";
         }
         ?>
   </div>
</div>
<div class="group-film group-film-category" id="cat-phim-bo" data-page="1" data-slug="">
   <h2><a title="Phim Bộ Mới" href="https://bongngo.tv/phim-bo/">phim bộ chọn lọc<i class="fa fa-caret-right" aria-hidden="true"></i></a></h2>
   <ul class="phanloai">
      <li><a href="javascript:;" onclick="phim_bo('han-quoc', 1, '');" title="Phim bộ Hàn Quốc">Hàn Quốc</a></li>
      <li><a href="javascript:;" onclick="phim_bo('trung-quoc', 1, '');" title="Phim bộ Trung Quốc">Trung Quốc</a></li>
      <li><a href="javascript:;" onclick="phim_bo('au-my', 1, '');" title="Phim bộ Âu - Mỹ">Phim Mỹ</a></li>
   </ul>
   <a href="https://bongngo.tv/phim-bo/" class="more"></a> <span class="line-ngang"></span>
   <div class="group-film-small">
      <?php
         for ($x = 1; $x <= 12; $x++) {
             echo "<a title='Đặc Cảnh Sân Bay  - Airport Strikers' href='https://bongngo.tv/dac-canh-san-bay-7980.html' class='film-small lazy'>";
             echo "<div class='poster-film-small ' style='background-image:url(http://homestead.test/img/poster_nguoi-vo-hinh.jpg'>";
             echo "<div class='sotap'>Tập $x</div>";
             echo "<ul class='tag-film'>";
             echo "<li><div class='hd'>HD</div></li>";
             echo "</ul> <div class='play'></div>";
             echo "</div>";
             echo "<div class='title-film-small'>";
             echo "<b class='title-film'>Đặc Cảnh Sân Bay</b>";
             echo "<p>Airport Strikers (2020)</p>";
             echo "</div>";
             echo "</a>";
         }

         ?>
   </div>
   <div class="group-film group-film-category" id="cat-phim-le" data-page="1" data-slug="">
      <h2><a title="Phim Lẻ Mới" href="https://bongngo.tv/phim-le/">phim lẻ chọn lọc<i class="fa fa-caret-right" aria-hidden="true"></i></a></h2>
      <ul class="phanloai">
         <li><a href="javascript:;" onclick="phim_le('hanh-dong', 1, '');" title="Phim lẻ Hành động">Hành động</a></li>
         <li><a href="javascript:;" onclick="phim_le('hai-huoc', 1, '');" title="Phim lẻ Hài">Hài Hước</a></li>
         <li><a href="javascript:;" onclick="phim_le('kinh-di', 1, '');" title="Phim lẻ Kinh dị">Kinh dị</a></li>
      </ul>
      <ul class="sapxep">
         <li><a href="javascript:;" onclick="phim_le('', 1, '');" title="Ngày cập nhật" class="active">Ngày cập nhật</a></li>
         <li><a href="javascript:;" onclick="phim_le('', 1, 'imdb');" title="IMDB">IMDB</a></li>
         <li><a href="javascript:;" onclick="phim_le('', 1, 'name');" title="Tên phim">Tên phim</a></li>
      </ul>
      <a href="https://bongngo.tv/phim-le/" class="more"></a> <span class="line-ngang"></span>
      <div class="group-film-small">
         <?php
            for ($x = 1; $x <= 12; $x++) {
                echo "<a title='Đặc Cảnh Sân Bay  - Airport Strikers' href='https://bongngo.tv/dac-canh-san-bay-7980.html' class='film-small lazy'>";
                echo "<div class='poster-film-small ' style='background-image:url(http://homestead.test/img/poster_nguoi-vo-hinh.jpg'>";
                echo "<div class='sotap'>Tập $x</div>";
                echo "<ul class='tag-film'>";
                echo "<li><div class='hd'>HD</div></li>";
                echo "</ul> <div class='play'></div>";
                echo "</div>";
                echo "<div class='title-film-small'>";
                echo "<b class='title-film'>Đặc Cảnh Sân Bay</b>";
                echo "<p>Airport Strikers (2020)</p>";
                echo "</div>";
                echo "</a>";
            }

            ?>
      </div>
   </div>
   <div class="group-film" id="cat-the-loai-tv-show" data-page="1" data-slug="">
      <h2><a href="https://bongngo.tv/the-loai/tv-show/">TV Shows<i class="fa fa-caret-right" aria-hidden="true"></i></a></h2>
      <a href="https://bongngo.tv/the-loai/tv-show/" class="more"></a> <span class="line-ngang"></span>
      <div class="group-film-small">
         <?php
            for ($x = 1; $x <= 12; $x++) {
                echo "<a title='Đặc Cảnh Sân Bay  - Airport Strikers' href='https://bongngo.tv/dac-canh-san-bay-7980.html' class='film-small lazy'>";
                echo "<div class='poster-film-small ' style='background-image:url(http://homestead.test/img/poster_nguoi-vo-hinh.jpg'>";
                echo "<div class='sotap'>Tập $x</div>";
                echo "<ul class='tag-film'>";
                echo "<li><div class='hd'>HD</div></li>";
                echo "</ul> <div class='play'></div>";
                echo "</div>";
                echo "<div class='title-film-small'>";
                echo "<b class='title-film'>Đặc Cảnh Sân Bay</b>";
                echo "<p>Airport Strikers (2020)</p>";
                echo "</div>";
                echo "</a>";
            }

            ?>
      </div>
   </div>
   <div class="group-film group-film-category" id="cat-phim-sap-chieu" data-page="1" data-slug="">
      <h2><a title="Phim Đang Chiếu Rạp" href="">Phim Sắp Chiếu<i class="fa fa-caret-right" aria-hidden="true"></i></a></h2>
      <a href="https://bongngo.tv/danh-sach/phim-sap-chieu/" class="more"></a> <span class="line-ngang"></span>
      <div class="phimdecu-slider">
         <?php
            foreach($phims as $phim){
             echo "<div class='item'>";
             echo "<a title='Triều Ca - Zhao Ge' href='https://bongngo.tv/trieu-ca-5819.html' style='background-image:url(http://homestead.test/img/poster_canh-sat-thanh-pho.jpg' tabindex='0'>";
             echo "<div class='black-gradient'>";
             echo "<b class='title-film'>Triều Ca</b>";
             echo " <p>Zhao Ge (2019)</p>";
             echo "<ul class='tag-film'>";
             echo "<li><div class='hd'></div></li>";
             echo " </ul>";
             echo " </div>";
             echo "<div class='play'></div>";
             echo "</a>";
             echo "</div>";
            }
            ?>
      </div>
   </div>
   <div class="quangcao">
   </div>
</div>
@endsection

