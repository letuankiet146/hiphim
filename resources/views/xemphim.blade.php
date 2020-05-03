@extends('basic')

@section('title',$phim->tenphim)

@section('content')
<div class="khoi-trai">
   <div class="group-detail" itemscope itemtype="https://schema.org/Movie">
      <div style="display: none">
         <div itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating">
            <span itemprop="ratingValue">4.2</span>
            <meta itemprop="bestRating" content="5" />
            <meta itemprop="worstRating" content="1" />
            <span itemprop="ratingCount">110</span>
         </div>
         <img itemprop="image" src="{{asset('img/poster-sat-thu-vo-cung-cuc-2020.jpg')}}" alt="Sát Thủ Vô Cùng Cực (Hitman: Agent Jun 2020)" /> <img itemprop="thumbnailUrl" src="{{asset('img/bg-sat-thu-vo-cung-cuc-2020.jpg')}}" alt="Sát Thủ Vô Cùng Cực (Hitman: Agent Jun 2020)" />
         <meta itemprop="dateCreated" content="30-03-2020">
         <meta itemprop="director" content="<a href=" https: bongngo.tv tags choi-won-sub " rel="follow, index" title="Xem Phim CHOI Won-sub">
         CHOI Won-sub</a>, " />
         <meta itemprop="name" content="Sát Thủ Vô Cùng Cực (Hitman: Agent Jun 2020)" />
      </div>
      <!-- source film -->
      <?php
         echo "$phim->jwurl";
         ?>
      <h1 class="title-film-detail-1" itemprop="name">Sát Thủ Vô Cùng Cực </h1>
      <h2 class="title-film-detail-2">Hitman: Agent Jun (2020)</h2>
      <div class="fb-gg">
         <div class="fb-like" data-href="https://www.facebook.com/357803011234235" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>
         <div class="g-plusone" data-size="medium"></div>
      </div>
      <div class="imdb">IMDB 6.2</div>
      <ul class="rated-star"><i id="star"></i></ul>
      <span class="rated-text">(110 Voted)</span> <span class="hd">HD</span>
      <br> <a href="https://bongngo.tv/xem-phim/sat-thu-vo-cung-cuc-7944/" title="Xem phim Sát Thủ Vô Cùng Cực" class="play-film" style="background:#77c282;color:#000000;font-weight: bold;">Xem Phim<i class="fa fa-caret-right" aria-hidden="true"></i></a>
      <p class="custom-error" style="display:none;"></p>
      <ul class="infomation-film">
         <li class="title">Thông tin:</li>
         <li>Đang phát : <span>Phụ đề</span> </li>
         <li>Ngày cập nhật : <span>30-03-2020</span> </li>
         <li>Thời lượng: <span>110 phút</span></li>
         <li>Đạo diễn: <span><a href="https://bongngo.tv/tags/choi-won-sub/" rel="follow, index" title="Xem Phim CHOI Won-sub">CHOI Won-sub</a>, </span></li>
         <li>Diễn viên: <a href="https://bongngo.tv/dien-vien/kwon-sang-woo/" rel="follow, index" title="Diễn viên KWON Sang-woo">KWON Sang-woo</a>,<a href="https://bongngo.tv/dien-vien/jeoung-jun-ho/" rel="follow, index" title="Diễn viên JEOUNG Jun-ho">JEOUNG Jun-ho</a>,<a href="https://bongngo.tv/dien-vien/hwang-woo-seul-hye/" rel="follow, index" title="Diễn viên HWANG WOO Seul-hye">HWANG WOO Seul-hye</a>,<a href="https://bongngo.tv/dien-vien/lee-yi-kying/" rel="follow, index" title="Diễn viên LEE Yi-kying">LEE Yi-kying</a>, </li>
         <li>Thể loại: <a href="https://bongngo.tv/phim-le/" title="Phim lẻ mới">Phim lẻ</a>, <a href="https://bongngo.tv/phim-chieu-rap/" title="Phim chiếu rạp 2020">Chiếu rạp</a>, <a href="https://bongngo.tv/the-loai/hanh-dong/" title="Phim Hành Động">Phim Hành Động</a>, <a href="https://bongngo.tv/the-loai/hai-huoc/" title="Phim Hài Hước">Phim Hài Hước</a>, </li>
         <li>Quốc gia: <a href="https://bongngo.tv/quoc-gia/phim-han-quoc/" title="Phim Hàn Quốc">Phim Hàn Quốc</a>, </li>
         <li class="tags"><span>TAGS: </span> <a href="https://bongngo.tv/tags/sat-thu-vo-cung-cuc/" rel="follow, index" title="Xem Phim sát thủ vô cùng cực">sát thủ vô cùng cực</a>, <a href="https://bongngo.tv/tags/hitman:-agent-jun/" rel="follow, index" title="Xem Phim hitman: agent jun">hitman: agent jun</a>, </li>
      </ul>
   </div>
   <div class="group-vote-detail">
      <h2>Xếp Hạng Phim Này</h2>
      <ul>
         <li class="star" id="star-vote"></li>
      </ul>
   </div>
   <div class="group-ndfilm-detail" itemprop="description">
      <h2 class="ndf">Nội dung phim</h2>
      <p class="content-film">
         Xoay quanh Joon, ch&agrave;ng cựu điệp vi&ecirc;n của NIS, "dứt &aacute;o ra đi" khỏi tổ chức, ng&agrave;y đ&ecirc;m cống hiến với sở th&iacute;ch truyện tranh. V&ograve;ng xo&aacute;y "cơm &aacute;o gạo tiền" n&agrave;o phải dễ, truyện anh s&aacute;ng t&aacute;c, chẳng mấy ai quan t&acirc;m, cho đến khi, anh tự kể lại trải nghiệm điệp vi&ecirc;n của m&igrave;nh, kể chậm r&atilde;i, từng từ một, lượt view tăng l&ecirc;n, nhưng k&eacute;o theo đ&oacute;, l&agrave; bao rắc rối ập đến khi th&ocirc;ng tin mật đều được phơi b&agrave;y.
      </p>
   </div>
   <div class="fbchat">
      <div class="fb-comments" data-width="100%" data-include-parent="false" data-href="https://bongngo.tv/sat-thu-vo-cung-cuc-7944.html" data-numposts="10" data-order-by="reverse_time" data-colorscheme="dark"></div>
   </div>
   <div class="group-film group-film-category">
      <h2>phim cùng thể loại<i class="fa fa-caret-right" aria-hidden="true"></i></h2>
      <span class="line-ngang"></span>
      <div class="group-film-small">
         <a href="https://bongngo.tv/sat-thu-mat-danh-47-556.html" title="Sát Thủ Mật Danh 47 - Hitman Agent 47" class="film-small ">
            <div class="poster-film-small lazy" style="background-image:url('{{asset('img/poster-sat-thu-mat-danh-47.jpg')}}">
               <div class="sotap">Thuyết Minh</div>
               <ul class="tag-film">
                  <li>
                     <div class="hd">HD</div>
                  </li>
               </ul>
               <div class="play"></div>
            </div>
            <div class="title-film-small">
               <b class="title-film">Sát Thủ Mật Danh 47</b>
               <p>Hitman Agent 47 (2015)</p>
            </div>
         </a>
         <a href="https://bongngo.tv/dac-vu-bat-chap-243.html" title="Đặc Vụ Bất Chấp - Agent Mr. Chan" class="film-small ">
            <div class="poster-film-small lazy" style="background-image:url('{{asset('img/poster_dac-vu-bat-chap.jpg')}}">
               <ul class="tag-film">
                  <li>
                     <div class="hd"> HD</div>
                  </li>
               </ul>
               <div class="play"></div>
            </div>
            <div class="title-film-small">
               <b class="title-film">Đặc Vụ Bất Chấp</b>
               <p>Agent Mr. Chan ( 2018 )</p>
            </div>
         </a>
         <a href="https://bongngo.tv/ke-san-nguoi-566.html" title="Kẻ Săn Người - Hitman" class="film-small ">
            <div class="poster-film-small lazy" style="background-image:url('{{asset('img/poster_ke-san-nguoi.jpg')}}">
               <ul class="tag-film">
                  <li>
                     <div class="hd">HD</div>
                  </li>
               </ul>
               <div class="play"></div>
            </div>
            <div class="title-film-small">
               <b class="title-film">Kẻ Săn Người</b>
               <p>Hitman (2007)</p>
            </div>
         </a>
         <a href="https://bongngo.tv/ban-gai-toi-la-mot-trinh-tham-3273.html" title="Bạn Gái Tôi Là Một Trinh Thám - My Girlfriend Is An Agent" class="film-small ">
            <div class="poster-film-small lazy" style="background-image:url('{{asset('img/poster_ban-gai-toi-la-mot-trinh-tham.jpg')}}">
               <ul class="tag-film">
                  <li>
                     <div class="hd">HD</div>
                  </li>
               </ul>
               <div class="play"></div>
            </div>
            <div class="title-film-small">
               <b class="title-film">Bạn Gái Tôi Là Một Trinh Thám</b>
               <p>My Girlfriend Is An Agent (2009)</p>
            </div>
         </a>
         <a href="https://bongngo.tv/dac-cong-hoang-phi-so-kieu-truyen-5289.html" title="Đặc công Hoàng Phi Sở Kiều Truyện - Princess Agents" class="film-small ">
            <div class="poster-film-small lazy" style="background-image:url('{{asset('img/poster_dac-cong-hoang-phi-so-kieu-truyen.jpg')}}">
               <div class="sotap">67/67</div>
               <ul class="tag-film">
                  <li>
                     <div class="hd">HD</div>
                  </li>
               </ul>
               <div class="play"></div>
            </div>
            <div class="title-film-small">
               <b class="title-film">Đặc công Hoàng Phi Sở Kiều Truyện</b>
               <p>Princess Agents (2017)</p>
            </div>
         </a>
         <a href="https://bongngo.tv/yen-chi-5630.html" title="Yên Chi - Rookie Agent Rouge" class="film-small ">
            <div class="poster-film-small lazy" style="background-image:url('{{asset('img/poster_yen-chi.jpg')}}">
               <div class="sotap">45/45</div>
               <ul class="tag-film">
                  <li>
                     <div class="hd">HD</div>
                  </li>
               </ul>
               <div class="play"></div>
            </div>
            <div class="title-film-small">
               <b class="title-film">Yên Chi</b>
               <p>Rookie Agent Rouge (2016)</p>
            </div>
         </a>
      </div>
   </div>
   <div class="group-tag-detail">
      <h3> <small>Sát Thủ Vô Cùng Cực VietSub, Sát Thủ Vô Cùng Cực thuyết minh, Sát Thủ Vô Cùng Cực HD, Sát Thủ Vô Cùng Cực, Sát Thủ Vô Cùng Cực full/trọn bộ, Sát Thủ Vô Cùng Cực phụ đề, Sát Thủ Vô Cùng Cực trailer, sat thu vo cung cuc VietSub, sat thu vo cung cuc thuyet minh, Sát Thủ Vô Cùng Cực bilutv, Sát Thủ Vô Cùng Cực phimbathu, Sát Thủ Vô Cùng Cực banhtv, Sát Thủ Vô Cùng Cực phimmoi, sat thu vo cung cuc HD, sat thu vo cung cuc, sat thu vo cung cuc full/tron bo, sat thu vo cung cuc phu de, sat thu vo cung cuc trailer Xem phim Hitman: Agent Jun, Hitman: Agent Jun, Hitman: Agent JunVietSub, Hitman: Agent Jun Thuyết minh, Hitman: Agent Jun full HD, Hitman: Agent Jun bản đẹp, Hitman: Agent Jun trọn bộ, Hitman: Agent Jun phụ đề, Hitman: Agent Jun trailer</small> </h3>
   </div>
   <div id="ModalThongBao" class="modal fade" role="dialog">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Thông báo</h4>
            </div>
            <div class="modal-body" id="p_content"> </div>
         </div>
      </div>
   </div>
</div>
<div class="khoi-phai">
   <div class="topphim-doc">
      <h3>top phim lẻ</h3>
      <ul class="film">
         <li>
            <a href="https://bongngo.tv/qua-nhanh-qua-nguy-hiem-9-6954.html" title="Quá Nhanh Quá Nguy Hiểm 9 - Fast & Furious Presents: Hobbs & Shaw">
               <div class="image lazy" style="background-image:url('{{asset('img/poster-qua-nhanh-qua-nguy-hiem-9-2019.jpg')}}"></div>
               <div class="info">
                  <b class="title-film">Quá Nhanh Quá Nguy Hiểm 9</b>
                  <p>Fast & Furious Presents: Hobbs & Shaw (2019)</p>
                  <span class="luotxem">Lượt xem: 38,454</span> <span class="imdb">IMDB 7.0</span>
               </div>
            </a>
         </li>
         <li>
            <a href="https://bongngo.tv/harry-potter-va-hon-da-phu-thuy-2793.html" title="Harry Potter Và Hòn Đá Phù Thuỷ - Harry Potter And The Sorcerer's Stone">
               <div class="image lazy" style="background-image:url('{{asset('img/poster-harry-potter-va-hon-da-phu-thuy.jpg')}}"></div>
               <div class="info">
                  <b class="title-film">Harry Potter Và Hòn Đá Phù Thuỷ</b>
                  <p>Harry Potter And The Sorcerer's Stone (2001)</p>
                  <span class="luotxem">Lượt xem: 37,065</span> <span class="imdb">IMDB 7.3</span>
               </div>
            </a>
         </li>
         <li>
            <a href="https://bongngo.tv/365-ngay-yeu-anh-7987.html" title="365 Ngày Yêu Anh - 365 Days">
               <div class="image lazy" style="background-image:url('{{asset('img/poster-365-ngay-yeu-anh-2020.jpg')}}"></div>
               <div class="info">
                  <b class="title-film">365 Ngày Yêu Anh</b>
                  <p>365 Days (2020)</p>
                  <span class="luotxem">Lượt xem: 33,601</span> <span class="imdb">IMDB 2.9</span>
               </div>
            </a>
         </li>
         <li>
            <a href="https://bongngo.tv/avengers-hoi-ket-5754.html" title="Avengers: Hồi Kết - Avengers: Endgame">
               <div class="image lazy" style="background-image:url('{{asset('img/poster-avengers-hoi-ket-2-2.jpg')}}"></div>
               <div class="info">
                  <b class="title-film">Avengers: Hồi Kết</b>
                  <p>Avengers: Endgame (2019)</p>
                  <span class="luotxem">Lượt xem: 30,319</span> <span class="imdb">IMDB 9.0</span>
               </div>
            </a>
         </li>
         <li>
            <a href="https://bongngo.tv/harry-potter-va-phong-chua-bi-mat-2689.html" title="Harry Potter và Phòng Chứa Bí Mật - Harry Potter 2: Harry Potter And The Chamber Of Secrets">
               <div class="image lazy" style="background-image:url('{{asset('img/poster-harry-potter-va-phong-chua-bi-mat.jpg')}}"></div>
               <div class="info">
                  <b class="title-film">Harry Potter và Phòng Chứa Bí Mật</b>
                  <p>Harry Potter 2: Harry Potter And The Chamber Of Secrets (2002)</p>
                  <span class="luotxem">Lượt xem: 22,658</span> <span class="imdb">IMDB 7.4</span>
               </div>
            </a>
         </li>
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
         <li>
            <a href="https://bongngo.tv/bac-si-thien-tai-phan-1-5771.html" title="Bác Sĩ Thiên Tài Phần 1 - The Good Doctor Season 1">
               <div class="image lazy" style="background-image:url({{asset('img/bg_bac-si-thien-tai-phan-1-2017.jpg')}}"></div>
               <span class="imdb">IMDb <br> <b>8.5</b></span>
               <div class="info">
                  <b class="title-film">Bác Sĩ Thiên Tài Phần 1</b>
                  <p>The Good Doctor Season 1 (2017)</p>
               </div>
            </a>
         </li>
         <li>
            <a href="https://bongngo.tv/vuot-nguc-phan-1-2500.html" title="Vượt Ngục Phần 1 - Prison Break Season 1">
               <div class="image lazy" style="background-image:url({{asset('img/bg-vuot-nguc-phan-1.jpg')}}"></div>
               <span class="imdb">IMDb <br> <b>9.9</b></span>
               <div class="info">
                  <b class="title-film">Vượt Ngục Phần 1</b>
                  <p>Prison Break Season 1 (2005)</p>
               </div>
            </a>
         </li>
         <li>
            <a href="https://bongngo.tv/vuot-nguc-phan-2-2501.html" title="Vượt Ngục Phần 2 - Prison Break Season 2">
               <div class="image lazy" style="background-image:url({{asset('img/bg-vuot-nguc-phan-2.jpg')}}"></div>
               <span class="imdb">IMDb <br> <b>9.9</b></span>
               <div class="info">
                  <b class="title-film">Vượt Ngục Phần 2</b>
                  <p>Prison Break Season 2 (2006)</p>
               </div>
            </a>
         </li>
         <li>
            <a href="https://bongngo.tv/vuot-nguc-phan-4-2503.html" title="Vượt Ngục Phần 4 - Prison Break Season 4">
               <div class="image lazy" style="background-image:url({{asset('img/bg-vuot-nguc-phan-4.jpg')}}"></div>
               <span class="imdb">IMDb <br> <b>9.9</b></span>
               <div class="info">
                  <b class="title-film">Vượt Ngục Phần 4</b>
                  <p>Prison Break Season 4 (2008)</p>
               </div>
            </a>
         </li>
         <li>
            <a href="https://bongngo.tv/xac-song-phan-10-7323.html" title="Xác Sống Phần 10 - The Walking Dead Season 10">
               <div class="image lazy" style="background-image:url({{asset('img/bg-xac-song-phan-10-2019.jpg')}}"></div>
               <span class="imdb">IMDb <br> <b>8.3</b></span>
               <div class="info">
                  <b class="title-film">Xác Sống Phần 10</b>
                  <p>The Walking Dead Season 10 (2019)</p>
               </div>
            </a>
         </li>
         <li>
            <a href="https://bongngo.tv/vuot-nguc-phan-3-2502.html" title="Vượt Ngục Phần 3 - Prison Break Season 3">
               <div class="image lazy" style="background-image:url({{asset('img/bg-vuot-nguc-phan-3.jpg')}}"></div>
               <span class="imdb">IMDb <br> <b>9.9</b></span>
               <div class="info">
                  <b class="title-film">Vượt Ngục Phần 3</b>
                  <p>Prison Break Season 3 (2007)</p>
               </div>
            </a>
         </li>
         <li>
            <a href="https://bongngo.tv/bac-si-thien-tai-phan-2-5098.html" title="Bác Sĩ Thiên Tài Phần 2 - The Good Doctor Season 2">
               <div class="image lazy" style="background-image:url({{asset('img/bg_bac-si-thien-tai-phan-2.jpg')}}"></div>
               <span class="imdb">IMDb <br> <b>N/A</b></span>
               <div class="info">
                  <b class="title-film">Bác Sĩ Thiên Tài Phần 2</b>
                  <p>The Good Doctor Season 2 (Season 2)</p>
               </div>
            </a>
         </li>
         <li>
            <a href="https://bongngo.tv/giao-duc-gioi-tinh-phan-1-5345.html" title="Giáo Dục Giới Tính Phần 1 - Sex Education: Season 1">
               <div class="image lazy" style="background-image:url({{asset('img/bg_giao-duc-gioi-tinh-phan-1.jpg')}}"></div>
               <span class="imdb">IMDb <br> <b>8.4</b></span>
               <div class="info">
                  <b class="title-film">Giáo Dục Giới Tính Phần 1</b>
                  <p>Sex Education: Season 1 (2019)</p>
               </div>
            </a>
         </li>
         <li>
            <a href="https://bongngo.tv/vuot-nguc-phan-5-2504.html" title="Vượt Ngục Phần 5 - Prison Break Season 5 Sequel">
               <div class="image lazy" style="background-image:url({{asset('img/bg_vuot-nguc-phan-5.jpg')}}"></div>
               <span class="imdb">IMDb <br> <b>9.9</b></span>
               <div class="info">
                  <b class="title-film">Vượt Ngục Phần 5</b>
                  <p>Prison Break Season 5 Sequel (2017)</p>
               </div>
            </a>
         </li>
         <li>
            <a href="https://bongngo.tv/xac-song-phan-3-5759.html" title="Xác Sống Phần 3 - The Walking Dead: Season 3">
               <div class="image lazy" style="background-image:url({{asset('img/bg_xac-song-phan-3-2012.jpg')}}"></div>
               <span class="imdb">IMDb <br> <b>8.6</b></span>
               <div class="info">
                  <b class="title-film">Xác Sống Phần 3</b>
                  <p>The Walking Dead: Season 3 (2012)</p>
               </div>
            </a>
         </li>
      </ul>
   </div>
   <div class="fb">
      <div class="fb-page" data-href="https://www.facebook.com/357803011234235/" data-width="300" data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="true" data-show-posts="false">
         <blockquote cite="https://www.facebook.com/357803011234235/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/357803011234235/">BongNgoTV</a></blockquote>
      </div>
   </div>
</div>
@endsection
