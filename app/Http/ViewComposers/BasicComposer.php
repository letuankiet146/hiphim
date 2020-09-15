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
        define('PHIM_RAP',3);

        $theloais = TheLoai::all();
        $quocgias = QuocGia::all();

        $danhMucPhimLe = DanhMuc::find(PHIM_LE);
        $phimsLe = $danhMucPhimLe->phims;
        $nams = [];
        array_push($nams,'Trước năm 2014');
        foreach($phimsLe as $phimLe){
            if(($phimLe->nam >= 2014) &&!in_array($phimLe->nam, $nams)){
                array_push($nams,$phimLe->nam);
            }
        }
        sort($nams);

        $danhMucPhimBo = Danhmuc::find(PHIM_BO);
        $phimsBo = $danhMucPhimBo->phims;
        $phimsBoQuocGia = [];
        foreach($phimsBo as $phimBo){;
            if(!in_array($phimBo->quocgia,$phimsBoQuocGia)){
                array_push($phimsBoQuocGia,$phimBo->quocgia);
            }
        }

        //Load phim bo
        $topPhimChieuBo =  Phim::from('phims')
                        ->where('danhmucs_id',PHIM_BO)
                        ->orderBy('luotxem','desc')
                        ->limit(10)
                        ->get();

        $phimNgauNhien =  Phim::from('phims')
                        ->where('danhmucs_id',PHIM_LE)
                        ->orwhere('danhmucs_id',PHIM_RAP)
                        ->inRandomOrder()
                        ->limit(5)
                        ->get();



        $view->with('theloais', $theloais);
        $view->with('quocgias', $quocgias);
        $view->with('nams', $nams);
        $view->with('phimsBoQuocGia', $phimsBoQuocGia);
        $view->with('phimNgauNhien', $phimNgauNhien);
        $view->with('topPhimChieuBo', $topPhimChieuBo);
     }
 }
