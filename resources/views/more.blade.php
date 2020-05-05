@extends('basic')

@section('title',$title)

@section('content')
<div class="khoi-trai">
   <div class="group-film group-film-category">
      <h1>{{$title}}<i class="fa fa-caret-right" aria-hidden="true"></i></h1>
      <span class="line-ngang"></span>

      <div class="group-film-small">
            @if(isset($phims))
                    @foreach($phims as $item)
                    <a title="{{$item->tenphim}}" href="../../detail/{{$item->id}}" class="film-small  1">
                        <div class="poster-film-small" style="background-image:url({{asset('img/'.$item->poster.'')}})">
                        <ul class="tag-film">
                            <li>
                                <div class="hd">HD</div>
                            </li>
                        </ul>
                        <div class="play"></div>
                        </div>
                        <div class="title-film-small">
                        <b class="title-film">{{$item->tenphim}}</b>
                        <p>{{$item->tenphim_en}}</p>
                        </div>
                    </a>
                    @endforeach
            @endif
      </div>
      @if(isset($pageLink))
      <ul class='page-category'>
        <!-- <li><a class='actived'>1</a></li> -->
        @for($i=1 ; $i<=count($pageLink) ; $i++)
            @if(isset($currentPageNumber) && $i == $currentPageNumber)
                <li><a class="actived" title="Trang {{$i}}" href="{{$pageLink[$i]}}" data="2">{{$i+1}}</a></li>
            @else
                <li><a class="next page-numbers" title="Trang {{$i}}" href="{{$pageLink[$i]}}" data="2">{{$i+1}}</a></li>
            @endif
        @endfor
       </ul>
      @endif

   </div>
</div>

</div>
@endsection
