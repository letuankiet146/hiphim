<!DOCTYPE html>
<html lang="vi" dir="LTR"
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes" />
	<meta http-equiv="Content-Language" content="vi-VN" />
	<title>@yield("title")</title>
	<meta name="keywords" content="Phim, xem phim, xem phim online, phim online, xem phim hd, phim hd, hiphim, hi phim, hiphim.org" />
	<meta name="description" content="Xem phim hay online miễn phí, Tuyển tập những bộ phim online mới chất lượng cao, HiPhim.org cập nhật liên tục các bộ phim hành động thuyết minh, hàn quốc lồng tiếng, võ thuật đang HOT nhất, xem phim chất lượng HD miễn phí" />
	<link rel="canonical" href="http://hiphim.org/" />
	<meta property="og:url" content="http://hiphim.org" />
	<meta property="og:title" content="Xem phim online, xem phim VietSub, phim thuyết minh lồng tiếng mới nhất - HiPhim.org" />
	<meta property="og:description" content="Xem phim hay online miễn phí, Tuyển tập những bộ phim online mới chất lượng cao, HiPhim.org cập nhật liên tục các bộ phim hành động thuyết minh, hàn quốc lồng tiếng, võ thuật đang HOT nhất, xem phim chất lượng HD miễn phí" />
	<meta property="og:image" content="{{asset('img/homepage-bn.jpg')}}" />
	<meta property="og:type" content="website" />
	<meta name="referrer" content="always" />
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/v3.min.css?v=5.0')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css?v=1.0')}}">
    <link rel="stylesheet" href="{{asset('css/plyr.css')}}" />
	<script>
		var isRealUser=!1;setTimeout(function(){isRealUser=!0},1e4);var async=async||[];function loadScript(i){var e=btoa(i);if(document.getElementById(e)||document.write('<script id="'.concat(e,'"><\/script>')),!isRealUser)return setTimeout(function(){loadScript(i)},100),!0;console.log(i),setTimeout(function(){!function(e,t){var n,r=e.getElementById(t);if(r&&r.src)return;(n=e.createElement("script")).id=t,n.src=i,n.setAttribute("defer","defer"),n.setAttribute("async","async"),r.parentNode.replaceChild(n,r)}(document,e)},0)}async.push(["ready",function(){$(document).on("scroll mousemove",function(){if(isRealUser)return!0;setTimeout(function(){isRealUser=!0},500)})}]);
	</script>
	<script type="text/javascript" src="{{asset('js/v.min.js')}}"></script>
	<script>loadScript("{{asset('js/main-header.js')}}")</script>

</head>
<body class="body-page ">
	<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid navbar-top">

			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only"> Toggle navigation </span> <span class="icon-bar"> </span> <span class="icon-bar"> </span> <span class="icon-bar"> </span> </button>
				<a title="Phim Mới, Phim Hay, Phim HD, Phim Rạp, Phim Miễn Phí" class="navbar-brand" href="/"><img src="{{asset('img/logo.png')}}" alt="HiPhim"> </a>
			</div>

			<div class="collapse navbar-collapse col-md-9" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Thể Loại <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
                            @if(count($theloais)==0)
                                <li><i>Hiện tại đang cập nhật</i></li>
                            @endif
                            @foreach($theloais as $theloai )
							    <li><a href="/more/the-loai/{{$theloai->tentheloai}}">Phim {{$theloai->tentheloai}}</a></li>
                            @endforeach

						</ul>
					</li>
					<li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Quốc Gia <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
                            @if(count($quocgias)==0)
                                <li><i>Hiện tại đang cập nhật</i></li>
                            @endif
							@foreach($quocgias as $quocgia )
							    <li><a href="/more/quoc-gia/{{$quocgia->tenquocgia}}">Phim {{$quocgia->tenquocgia}}</a></li>
                            @endforeach
						</ul>
					</li>
					<li class="dropdown"> <a title="Phim Lẻ" href="#" class="dropdown-toggle" role="button" aria-expanded="false">Phim Lẻ <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
                            @if(count($nams)==0)
                                <li><i>Hiện tại đang cập nhật</i></li>
                            @endif
							@foreach($nams as $nam )
							    <li><a href="/more/phim-le/{{$nam}}">{{$nam}}</a></li>
                            @endforeach
						</ul>
					</li>
					<li class="dropdown"> <a title="Phim Bộ" href="#" class="dropdown-toggle" role="button" aria-expanded="false">Phim Bộ<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
                            @if(count($phimsBoQuocGia)==0)
                                <li><i>Hiện tại đang cập nhật</i></li>
                            @endif
							@foreach($phimsBoQuocGia as $phimsBoQuocGia )
							    <li><a href="/more/phim-bo/{{$phimsBoQuocGia->tenquocgia}}">Phim {{$phimsBoQuocGia->tenquocgia}}</a></li>
                            @endforeach
						</ul>
					</li>
					<li> <a href="/more/phim-moi/{{date('Y')}}" title="Phim mới">Phim mới</a></li>
					<li> <a href="/more/danh-muc/Phim Chiếu Rạp" title="Phim Chiếu Rạp">Phim Chiếu Rạp</a></li>
					<li> <a href="/more/top-imdb/top" title="Phim TOP IMDb" class="napvip">TOP IMDb</a> </li>
				</ul>
			</div>

			<ul class="nav navbar-nav navbar-right custom-search">
				<li>
					<form class="navbar-form" enctype="application/x-www-form-urlencoded" role="search" id="search-block" method="get" onsubmit="makeUrl()">
						<div class="form-group search-form-group">
							<input type="text" class="form-control" id="query_search" placeholder="Tìm kiếm có dấu" maxlength="100" autocomplete="off" />
							<button type="submit" class="btn btn-default" id="btn-search"> <span class="glyphicon glyphicon-search"> </span> </button>
						</div>
						<div class="search-hint" id="search-hint"> </div>
					</form>
                    <script>
                    function makeUrl(){
                        var action_src = "/more/tim-tat-ca/" + document.getElementById("query_search").value;
                        var your_form = document.getElementById('search-block');
                        your_form.action = action_src ;
                    }
                    </script>

                    <button type="button" class="nut-dangnhap" onclick="xinloi()"> Đăng nhập </button>
                    <script>
                        function xinloi(){
                            alert("Xin lỗi! Chức năng này đang được phát triển");
                        }
                    </script>
				</li>
			</ul>
		</div>

	</nav>
	<div class="container khoi-body">
        @yield('content')
        <footer>
            <div class="footer1">
                <a title="Phim Mới, Phim Hay, Phim HD, Phim Rạp, Phim Miễn Phí" href="/" style="background-image:url({{asset('img/hiphim-bottom.png')}}"></a>
                <ul>
                    <li><a href="/lien-he-quang-cao">Liên hệ Quảng Cáo</a></li>
                </ul>
                <div>Copyright ©2020 HiPhim. All Rights Reserved.</div>
            </div>
        </footer>

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
</body>
</html>
