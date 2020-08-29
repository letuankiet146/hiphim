@extends('master')

@section('title','Thêm phim')

@section('content')
<div class="container">
    <hr>
    <a class="btn btn-success"  href="/testlink"><b>Danh sách link chết</b></a>
    <a class="btn btn-success" href="/live"><b>Update SiteMap</b></a>
    <hr>
    <div class="form">
        <h1>Thêm phim mới</h1>
        <form  action="/insertFilm" id="insertFilmFrom" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
            <input class="form-control" type="text" name="tenphim"  placeholder="Tên Phim" required/>
            </div>
            <div class="form-group">
            <input class="form-control" type="text" name="tenphim_en"  placeholder="Tên Phim ENG" required/>
            </div>
            <div class="form-group">
            <input class="form-control" type="text" name="link_id"  placeholder="URL name" required/>
            </div>
            <div class="form-group">
            <input class="form-control" type="number" step="1" min="0" name="nam"  placeholder="Năm phát hành"/>
            </div>

            <div class="form-group">
            <textarea class="form-control"  name="meta_desc" form="insertFilmFrom" rows=4 cols=50  placeholder="Meta data description" required></textarea>
            </div>

            <div class="form-group">
            <!-- editor -->
            <textarea class="form-control"  name="mota" form="insertFilmFrom" rows=4 cols=50  placeholder="Mô tả" required></textarea>
            <script>CKEDITOR.replace( 'mota' );</script>
            </div>

            <div class="form-group">
            <textarea class="form-control"  name="url" form="insertFilmFrom" rows=4 cols=50  placeholder="CODE ID (e.g: A5731D3943FE39D3!....)" required></textarea>
            </div>

            <div class="form-group">
            <textarea class="form-control"  name="fb_url" form="insertFilmFrom" rows=4 cols=50  placeholder="FacebookURL" required></textarea>
            </div>
            <div class="form-group">
            <input class="form-control" type="text" name="trailer"  placeholder="Trailer-youtube-ID" required/>
            </div>
            <div class="form-group">
            <script>
                function displayBoPhim(){
                    var x = document.getElementById("tap-1");
                    if(document.getElementById('danhmuc').value == "2")
                    {
                        x.style.display = "block";
                    }else {
                        x.style.display = "none";
                    }
                }
            </script>
            <select id="danhmuc" name="danhmucId" onchange="displayBoPhim()" form="insertFilmFrom" class="form-control">
                <?php
                if(isset($danhmucKeys)){
                    foreach ($danhmucKeys as $key) {
                        $tendanhmuc = $danhmucArray[$key];
                        echo "<option value=$key>$tendanhmuc</option>";
                    }
                }
                ?>

            </select>
            </div>
            <div class="form-group" id="tap-1" style="display:none">
            <input class="form-control" type="number" step="1" name="tongsotap"  placeholder="Tổng số tập" min="1"/>
            <label for="danhmuc" class="btn btn-success disabled">Tập 1</label>
            <a href="/themphimbo/0" class="btn btn-success">Tập khác</a>
            </div>


            <div class="form-group">
            <input class="form-check-input" type="checkbox" id="phude" name="phude" value="1">
            <label class="form-check-label" for="phude">Phụ đề</label>
            </div>
            <script>
                $("#danhmuc").select2({
                placeholder: "Chọn danh mục…",
                });
            </script>

            <div class="form-group">
            <select id="quocgia" name="quocgiaId"  form="insertFilmFrom" class="form-control" required>
                    @if(isset($quocgiaKeys))
                        @foreach ($quocgiaKeys as $key)
                            <option value={{$key}}>{{$quocgiaArray[$key]}}</option>
                        @endforeach
                    @endif
            </select>
            </div>
            <script>
                $("#quocgia").select2({
                placeholder: "Chọn quốc gia…",
                });
            </script>

            <div class="form-group">
            <select name="theloais[]" id="theloai" form="insertFilmFrom"  multiple="multiple" style="width:100%" class="select2-multi-col" required>
                    @if(isset($theloaiKeys))
                        @foreach ($theloaiKeys as $key)
                            <option value={{$key}}>{{$theloaiArray[$key]}}</option>
                        @endforeach
                    @endif
            </select>
            </div>
            <script>
                $("#theloai").select2({
                placeholder: "Chọn thể loại…",
                });
            </script>

            <div class="form-group">
            <input class="form-control" type="number" step="0.01" name="imdb"  placeholder="IMDB" min="0" max="9.9"/>
            <input class="form-control" type="number" name="thoiluong"  placeholder="Thời lượng" min="0" required/>
            </div>

            <div class="form-group">
            <a class="btn btn-primary" onclick="themdienvien()">Thêm diễn viên</a>
            <a class="btn btn-primary" onclick="resetDienVien()">Refesh</a>
            <script>
               function themdienvien(){
                window.open("/dienvien","targetWindow",
                                   "toolbar=no",
                                    "location=no",
                                    "status=no",
                                    "menubar=no",
                                    "scrollbars=yes",
                                    "resizable=yes",
                                    "width=SomeSize",
                                    "height=SomeSize");
               }
            </script>
            <script>
               function resetDienVien() {
                    $.ajax({
                    type:'GET',
                    url:'/reload-dien-vien',
                    data:'_token = <?php echo csrf_token() ?>',
                    success:function(data) {
                        var dienvien = document.getElementById('dienvien');

                        var length = dienvien.options.length;
                        var newlength = data.dienvienKeys.length;
                        var dienvienKeys = data.dienvienKeys;
                        var dienvienArray = data.dienvienArray;
                        if(length !== data.dienvienKeys.length){
                            for (i = length-1; i >= 0; i--) {
                                dienvien.remove(i);
                            }
                            for (i = 0 ; i<newlength ; i++) {
                                var objOption = document.createElement("option");
                                objOption.value = dienvienKeys[i];
                                objOption.text = dienvienArray[dienvienKeys[i]];
                                dienvien.options.add(objOption);
                            }
                        }
                    },
                    async: false
                    });
                }
            </script>
            <select name="dienviens[]" id="dienvien" form="insertFilmFrom"  multiple="multiple" style="width:100%" class="select2-multi-col" required>
                @if(isset($dienvienKeys ))
                    @foreach ($dienvienKeys as $key)
                        <option value={{$key}}>{{$dienvienArray[$key]}}</option>
                    @endforeach
                @endif
            </select>
            </div>

            <script>
                $("#dienvien").select2({
                placeholder: "Chọn diễn viên…",
                });
            </script>

            <div class="form-group">
            <label for="sub">Viet sub:</label>
            <input class="custom-file-input" id="sub" type="file" name="sub"/>
            </div>
            <div class="form-group">
            <label for="poster">Poster img:</label>
            <input class="custom-file-input" id="poster" type="file" name="poster" required/>
            </div>
            <div class="form-group">
            <label for="bg">Background img:</label>
            <input class="custom-file-input" id="bg" type="file" name="bg" required/>
            </div>
            <button class="btn btn-danger"  type="submit">Save</button>
            <hr>
        </form>
    </div>
</div>
@endsection
