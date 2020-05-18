@extends('basic')

@section('title',$phim->tenphim)

@section('content')
<div class="khoi-trai">
   <div class="group-detail" itemscope itemtype="https://schema.org/Movie">
      @yield("detail")
      <h1 class="title-film-detail-1" itemprop="name">{{$phim->tenphim}}</h1>
      <h2 class="title-film-detail-2">{{$phim->tenphim_en}}({{$phim->nam}})</h2>
      <div class="imdb">IMDB {{$phim->imdb}}</div>
      <span class="rated-text">{{$phim->luotxem}} lượt xem</span> <span class="hd">HD</span>
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
            <p>{{$phimlq->tenphim_en}}({{$phimlq->nam}})</p>
            </div>
        </a>
        @endforeach
      </div>
   </div>
</div>
</div>
@endsection
