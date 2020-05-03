@extends('master')

@section('title','Homepage')

@section('content')
<div class="container">
    <div class="form">
        <form  action="/insertFilm" id="insertFilmFrom" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
            <input class="form-control" type="text" name="tenphim"  placeholder="Tên Phim"/>
            </div>
            <div class="form-group">
            <input class="form-control" type="text" name="tenphim_en"  placeholder="Tên Phim ENG"/>
            </div>
            <div class="form-group">
            <textarea class="form-control"  name="mota" form="insertFilmFrom" rows=4 cols=50  placeholder="Mô tả"></textarea>
            </div>
            <div class="form-group">
            <textarea class="form-control"  name="jwurl" form="insertFilmFrom" rows=4 cols=50  placeholder="JW Player link"></textarea>
            </div>
            <div class="form-group">
            <textarea class="form-control"  name="url" form="insertFilmFrom" rows=4 cols=50  placeholder="Movie link"></textarea>
            </div>
            <div class="form-group">
            <textarea class="form-control"  name="fb" form="insertFilmFrom" rows=4 cols=50  placeholder="FB link"></textarea>
            </div>
            <div class="form-group">
            <select id="danhmuc" name="danhmucId"  form="insertFilmFrom" class="form-control">
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
            <script>
                $("#danhmuc").select2({
                placeholder: "Chọn danh mục…",
                });
            </script>

            <div class="form-group">
            <select id="quocgia" name="quocgiaId"  form="insertFilmFrom" class="form-control">
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
            <select name="theloais[]" id="theloai" form="insertFilmFrom"  multiple="multiple" style="width:100%" class="select2-multi-col">
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
            <input class="form-control" type="number" name="thoiluong"  placeholder="Thời lượng" min="0" />
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
            <select name="dienviens[]" id="dienvien" form="insertFilmFrom"  multiple="multiple" style="width:100%" class="select2-multi-col">

                    @foreach ($dienvienKeys as $key)
                        <option value={{$key}}>{{$dienvienArray[$key]}}</option>
                    @endforeach
            </select>
            </div>

            <script>
                $("#dienvien").select2({
                placeholder: "Chọn diễn viên…",
                });
            </script>

            <div class="form-group">
            <label for="poster">Poster img:</label>
            <input class="custom-file-input" id="poster" type="file" name="poster" />
            </div>
            <div class="form-group">
            <label for="bg">Background img:</label>
            <input class="custom-file-input" id="bg" type="file" name="bg" />
            </div>
            <button class="btn btn-danger"  type="submit">Save</button>
        </form>
    </div>


    <hr>
    <a class="btn btn-primary"  href="/testlink">Test link</a>

    <a class="btn btn-primary" href="/live">Review all</a>


    <form  action="/searchFilm" id="searchFilmFrom" method="post">
        {{csrf_field()}}
        <input  class="form-control" type="text" name="title"  placeholder="Search film name"/>
        <button class="btn btn-success" type="submit">Search</button>
    </form>

    <?php

        if(isset($films)){
            foreach($films as $film){
                echo "<p><a href='/delete/{$film->id}'>Delete</a> <a href='/update/{$film->id}'>Update</a> # $film->tenphim </p>";
            };
        };
    ?>
</div>
@endsection
