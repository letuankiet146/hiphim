@extends('master')

@section('title','Thêm phim bộ')

@section('content')
<div class="container">
    <div class="form">
        <form  action="/insertphimbo" id="insertFilmFrom" method="post" enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="form-group" id="bo-phim">
            <label for="phimbo">Chọn bộ phim</label>
            <select name="phimbo" id="phimbo" form="insertFilmFrom"  style="width:100%" class="select2-multi-col" required>
                @if(isset($phimKeys))
                    @foreach ($phimKeys as $key)
                        <option value={{$key}}>{{$phimArray[$key]}}</option>
                    @endforeach
                @endif
            </select>
            <a href="/admin" class="btn btn-success">Thêm phim</a>
            </div>

            <div class="form-group">
            <script>
                $("#phimbo").select2({
                placeholder: "Chọn Phim…",
                });
            </script>
            <textarea class="form-control"  name="url" form="insertFilmFrom" rows=4 cols=50  placeholder="CODE ID (e.g: A5731D3943FE39D3!....)" required></textarea>
            </div>
            <div class="form-group">
            <input class="form-control" type="number" step="1" name="tap"  placeholder="Tập" min="2" required/>
            </div>
            <button class="btn btn-danger"  type="submit">Save</button>
        </form>
    </div>
</div>
@endsection
