<?php
 namespace App\Http\ViewComposers;

 use Illuminate\View\View;
 use App\TheLoai;
 use App\QuocGia;
 use App\DanhMuc;
 use App\Phim;

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
        $topPhimChieuBo = $phimChieuBo->sortByDesc('luotxem')->slice(0,10);

         //Load phim le
         $phimChieuLe = null;
         $phimChieuLe = Phim::from('phims')
                ->where('danhmucs_id',1)
                ->orwhere('danhmucs_id',3)
                ->get();

        $topPhimChieuLe = $phimChieuLe->sortByDesc('luotxem')->slice(0,5);

        sort($nams);

        $view->with('theloais', $theloais);
        $view->with('quocgias', $quocgias);
        $view->with('nams', $nams);
        $view->with('phimsBoQuocGia', $phimsBoQuocGia);
        $view->with('topPhimChieuLe', $topPhimChieuLe);
        $view->with('topPhimChieuBo', $topPhimChieuBo);
     }
 }
