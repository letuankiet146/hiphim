<!DOCTYPE html>
<html lang="vi" dir="LTR"
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-173249012-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-173249012-1');
    </script>

    <title>@yield("title")</title>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta http-equiv="Content-Language" content="vi-VN" />

    <meta name="robots" content="noarchive,noodp,index,follow" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes" />
    <meta name="referrer" content="always" />
    @yield("add-meta-data")

    <meta property="og:type" content="video.movie"/>
    <meta property="og:url" content="http://hiphim.org" />
    <meta property="og:locale" content="vi_VN"/>
    @yield("add-og-data")




    <link rel="canonical" href="http://hiphim.org/" />
    <link rel="icon" href="{{asset('img/favicon.png')}}">
    <link rel="alternate" href="http://hiphim.org/" hreflang="vi" />
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/v3_v3.min.css?v=5.0')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css?v=1.0')}}">
    <link rel="stylesheet" href="{{asset('css/plyr_v2.css')}}" />
    @yield("add-css")
	<script>
		var isRealUser=!1;setTimeout(function(){isRealUser=!0},1e4);var async=async||[];function loadScript(i){var e=btoa(i);if(document.getElementById(e)||document.write('<script id="'.concat(e,'"><\/script>')),!isRealUser)return setTimeout(function(){loadScript(i)},100),!0;console.log(i),setTimeout(function(){!function(e,t){var n,r=e.getElementById(t);if(r&&r.src)return;(n=e.createElement("script")).id=t,n.src=i,n.setAttribute("defer","defer"),n.setAttribute("async","async"),r.parentNode.replaceChild(n,r)}(document,e)},0)}async.push(["ready",function(){$(document).on("scroll mousemove",function(){if(isRealUser)return!0;setTimeout(function(){isRealUser=!0},500)})}]);
	</script>
	<script type="text/javascript" src="{{asset('js/v.min.js')}}"></script>
    <script>loadScript("{{asset('js/main-header.js')}}")</script>
    @yield("add-js")

</head>
<body class="body-page ">
    <nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid navbar-top">

			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only"> Toggle navigation </span> <span class="icon-bar"> </span> <span class="icon-bar"> </span> <span class="icon-bar"> </span> </button>
				<a hreflang="vi" title="Phim Mới, Phim Hay, Phim HD, Phim Rạp, Phim Miễn Phí" class="navbar-brand" href="/"><img src="{{asset('img/logo.png')}}" alt="HiPhim"> </a>
			</div>

			<div class="collapse navbar-collapse col-md-9" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="dropdown"> <a hreflang="vi" href="#" class="dropdown-toggle" data-toggle="dropdown">Thể Loại <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
                            @if(count($theloais)==0)
                                <li><i>Hiện tại đang cập nhật</i></li>
                            @endif
                            @foreach($theloais as $theloai )
							    <li><a hreflang="vi" href="/more/the-loai/{{$theloai->tentheloai}}">Phim {{$theloai->tentheloai}}</a></li>
                            @endforeach

						</ul>
					</li>
					<li class="dropdown"> <a hreflang="vi" href="#" class="dropdown-toggle" data-toggle="dropdown">Quốc Gia <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
                            @if(count($quocgias)==0)
                                <li><i>Hiện tại đang cập nhật</i></li>
                            @endif
							@foreach($quocgias as $quocgia )
							    <li><a hreflang="vi"href="/more/quoc-gia/{{$quocgia->tenquocgia}}">Phim {{$quocgia->tenquocgia}}</a></li>
                            @endforeach
						</ul>
					</li>
					<li class="dropdown"> <a hreflang="vi" title="Phim Lẻ" href="#" class="dropdown-toggle" role="button" aria-expanded="false">Phim Lẻ <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
                            @if(count($nams)==0)
                                <li><i>Hiện tại đang cập nhật</i></li>
                            @endif
							@foreach($nams as $nam )
							    <li><a hreflang="vi" href="/more/phim-le/{{$nam}}">{{$nam}}</a></li>
                            @endforeach
						</ul>
					</li>
					<li class="dropdown"> <a hreflang="vi" title="Phim Bộ" href="#" class="dropdown-toggle" role="button" aria-expanded="false">Phim Bộ<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
                            @if(count($phimsBoQuocGia)==0)
                                <li><i>Hiện tại đang cập nhật</i></li>
                            @endif
							@foreach($phimsBoQuocGia as $phimsBoQuocGia )
							    <li><a hreflang="vi" href="/more/phim-bo/{{$phimsBoQuocGia->tenquocgia}}">Phim {{$phimsBoQuocGia->tenquocgia}}</a></li>
                            @endforeach
						</ul>
					</li>
					<li> <a hreflang="vi" href="/more/phim-moi/{{date('Y')}}" title="Phim mới">Phim mới</a></li>
					<li> <a hreflang="vi" href="/more/danh-muc/Phim Chiếu Rạp" title="Phim Chiếu Rạp">Phim Chiếu Rạp</a></li>
					<li> <a hreflang="vi" href="/more/top-imdb/top" title="Phim TOP IMDb" class="napvip">TOP IMDb</a> </li>
				</ul>
			</div>

			<ul class="nav navbar-nav navbar-right custom-search">
				<li>
					<form class="navbar-form" enctype="application/x-www-form-urlencoded" role="search" id="search-block" method="get" onsubmit="makeUrl()">
						<div class="form-group search-form-group">
							<input type="text" class="form-control" id="query_search" placeholder="Tìm kiếm có dấu" maxlength="100" autocomplete="off" />
							<button type="submit" class="btn btn-default" id="btn-search"> <span class="glyphicon glyphicon-search"> </span> </button>
						</div>
						<div class="search-hint" id="search-hint">
                            <ul id="live-search"></ul>
                        </div>
					</form>
                    <script>
                    function makeUrl(){
                        var action_src = "/more/tim-tat-ca/" + document.getElementById("query_search").value;
                        var your_form = document.getElementById('search-block');
                        your_form.action = action_src ;
                    }
                    </script>
                    <script type="text/javascript">
                        $('#query_search').on('keyup',function(){
                            $value = $(this).val();
                            if($value){
                                $.ajax({
                                    type: 'get',
                                    url: '/search/'+$value,
                                    success:function(data){
                                        $("#live-search").empty();
                                        var length = data.liveSearchResult.length;
                                        for (var key in data.liveSearchResult) {
                                            var phim = data.liveSearchResult[key];
                                            $("#live-search").append("<li><a href='/phim/"+phim['link_id']+".html'><div class='image' style='background-image:url(/img/"+phim['poster']+"'></div><div class='content'><b class='title-film'>"+phim['tenphim']+"</b><p>"+phim['tenphim_en']+" ("+phim['nam']+")</p></div></a></li>");
                                        }
                                    }
                                });
                            }else{
                                $("#live-search").empty();
                            }
                        })
                    </script>
                    <script>
                        $('#query_search').focusout(function() {
                            setTimeout(function(){
                                    $("#live-search").empty();
                                }, 500);
                        })
                    </script>
				</li>
			</ul>
		</div>

	</nav>
	<div class="container khoi-body">

        <div class="khoi-trai">
            @yield('content')
        </div>
        <div class="khoi-phai">
            <!-- <div class="chudehot">
                <h4>Quảng cáo</h4>
                <ul>
                    <li>
                        <a title="Quảng cáo" href="/lien-he-quang-cao" style="background-image: url({{asset('img/ads.jpg')}}); background-size: cover;"></a>
                    </li>
                </ul>
            </div> -->
            <div class="topphim-doc">
                <h3>Ngẫu nhiên</h3>
                <ul class="film mCustomScrollbar _mCS_1 ">
                    <div id="mCSB_1" class="mCustomScrollBox mCS-inset-2-dark mCSB_vertical mCSB_inside" style="max-height: none;" tabindex="0">
                        <div id="mCSB_1_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y " style="position: relative; top: 0; left: 0;" dir="ltr">
                            <li>
                                @foreach($phimNgauNhien as $phim)
                                <a href='/phim/{{$phim->link_id}}.html' title='{{$phim->tenphim}}'>
                                    <div class="image lazy" style='background-image:url(/img/{{$phim->poster}}'></div>
                                    <div class="info">
                                        <b class="title-film">{{$phim->tenphim}}</b>
                                        <p>{{$phim->tenphim_en}} ({{$phim->nam}})</p>
                                        @if($phim->luotxem > 1000)
                                            <span class="luotxem">Lượt xem: {{bcdiv($phim->luotxem, 1000, 1)}}K</span>
                                        @else
                                            <span class="luotxem">Lượt xem: {{$phim->luotxem}}</span>
                                        @endif

                                        <span class="imdb">{{$phim->imdb}}</span>
                                    </div>
                                </a>
                                @endforeach
                            </li>
                        </div>

                    </div>
                </ul>
            </div>
            <div id="widget_top_film_country_by_type_phim-bo" class="topphim-ngang">
                <h3>Top phim bộ</h3>

                <ul id="blog1" class="film active mCustomScrollbar _mCS_2">
                    <div id="mCSB_2" class="mCustomScrollBox mCS-inset-2-dark mCSB_vertical mCSB_inside" tabindex="0" style="max-height: none;">
                        <div id="mCSB_2_container" class="mCSB_container" style="position: relative; top: 0; left: 0;" dir="ltr">
                            @foreach($topPhimChieuBo as $phim)
                            <li>
                                <a href='/phim/{{$phim->link_id}}.html' title='{{$phim->tenphim}}'>
                                    <div class="image lazy" style='background-image:url(/img/{{$phim->background}});'></div>
                                    <span class="imdb">
                                        IMDb <br />
                                        <b>{{$phim->imdb}}</b>
                                    </span>
                                    <div class="info">
                                        <b class="title-film">{{$phim->tenphim}}</b>
                                        <p>{{$phim->tenphim_en}} ({{$phim->nam}})</p>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </div>
                    </div>
                </ul>
            </div>

        </div>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js" defer></script>
        <script>
            var async = async || [];
            async.push(["ready", function () {
                $(function() {
                    $('.lazy').Lazy({
                        effect: 'fadeIn'
                    });
                });
            }]);
        </script>
    </div>
    <footer>
        <div class="footer1">
            <a hreflang="vi" title="Phim Mới, Phim Hay, Phim HD, Phim Rạp, Phim Miễn Phí" href="/" style="background-image:url({{asset('img/hiphim-bottom.png')}}"></a>
            <ul>
                <li><a hreflang="vi" href="/lien-he-quang-cao">Liên hệ Quảng Cáo</a>
                <li><a hreflang="vi" href="/dmca-report">Policy & DMCA</a></li>
            </ul>
            <div>No Copyright. HiPhim không giữ bản quyền nội dung trên website này. Mọi VIDEO đều được tải về từ nhiều nguồn public và các site chia sẻ video khác... <br>Vấn đề báo cáo bản quyền vui lòng xem thêm tại <a hreflang="vi" href="/dmca-report">Policy & DMCA</a></div>
        </div>
    </footer>
</body>
</html>
