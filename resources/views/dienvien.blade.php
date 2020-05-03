<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <title>Diễn Viên</title>
</head>
<body>
    <div class="container">
        <div class="form-group">
            <form  action="/themdienvien"  method="post">
                {{csrf_field()}}
                <input  class="form-control" type="text" name="tendienvien"  placeholder="Tên diễn viên"/>
                <button class="btn btn-success" type="submit">Thêm vào</button>
            </form>
        </div>
    </div>
    <div class="form-group">
        @if(isset($dienviens))
            <ul>
                @foreach($dienviens as $dienvien)
                <li>{{$dienvien->tendienvien}}</li>
                @endforeach
            </ul>
        @endif
    </div>
</body>
</html>
