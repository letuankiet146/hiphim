<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="form-group">
                <label for="users">Select user</label>
                <select name="user_id" id="users" class="form-control" multiple="multiple">
                        <option value="1">Ho Chi Minh</option>
                        <option value="2">Ha noi</option>
                        <option value="3">Buon me thuoc</option>
                        <option value="4">Quang Ninh</option>
                        <option value="5">Tay bac</option>
                        <option value="6">Dong Nai</option>
                </select>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#users').select2({
                placeholder: "Select a state or many…",
            });
        });
    </script>
   </body>
</html>
