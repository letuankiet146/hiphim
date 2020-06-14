<?php
 namespace App\Http\ViewComposers;

 use Illuminate\View\View;
 use App\TheLoai;
 use App\QuocGia;
 use App\DanhMuc;

 class BasicComposer
 {
     /**
      * Create a movie composer.
      *
      * @return void
      */
     public function __construct()
     {
     }

     /**
      * Bind data to the view.
      *
      * @param  View  $view
      * @return void
      */
     public function compose(View $view)
     {
        define('PHIM_LE',1);
        define('PHIM_BO',2);
        $theloais = TheLoai::all();
        $quocgias = QuocGia::all();
        $danhMucPhimLe = DanhMuc::find(PHIM_LE);
        $danhMucPhimBo = Danhmuc::find(PHIM_BO);

        $phimsLe = $danhMucPhimLe->phims;
        $nams = [];
        foreach($phimsLe as $phimLe){
            if(!in_array($phimLe->nam, $nams)){
                array_push($nams,$phimLe->nam);
            }
        }

        $phimsBo = $danhMucPhimBo->phims;
        $phimsBoQuocGia = [];
        foreach($phimsBo as $phimBo){;
            if(!in_array($phimBo->quocgia,$phimsBoQuocGia)){
                array_push($phimsBoQuocGia,$phimBo->quocgia);
            }
        }

        //Load phim bo
        $phimChieuBo = null;
        $bo = DanhMuc::from('danh_mucs')
                ->where('tendanhmuc','LIKE',"%Phim Bộ%");
        if($bo->exists()){
            $phimChieuBo = $bo->first()->phims()->get();
        }

         //Load phim le
         $phimChieuLe = null;
         $le = DanhMuc::from('danh_mucs')
                 ->where('tendanhmuc','LIKE',"%Phim Lẻ%");
         if($le->exists()){
             $phimChieuLe = $le->first()->phims()->get();
         }
        $topPhimChieuLe = $phimChieuLe->sortByDesc('luotxem')->slice(0,5);
        $topPhimChieuBo = $phimChieuBo->sortByDesc('luotxem')->slice(0,10);

        $view->with('theloais', $theloais);
        $view->with('quocgias', $quocgias);
        $view->with('nams', $nams);
        $view->with('phimsBoQuocGia', $phimsBoQuocGia);
        $view->with('topPhimChieuLe', $topPhimChieuLe);
        $view->with('topPhimChieuBo', $topPhimChieuBo);
     }
 }
