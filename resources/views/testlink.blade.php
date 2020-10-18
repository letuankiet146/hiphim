@extends('master')

@section('title','Homepage')

@section('content')
 <!-- Modal -->
 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>

<div class="container">
  <h2>Danh sách các phim bị lỗi</h2>
  <a class="btn btn-success" href="/isAvailable">Run checker</a>
  <a class="btn btn-info" href="/admin">Back to ADMIN</a>
  <table class="table"  id="myTable">
    <thead>
      <tr>
        <th>Original Link</th>
        <th>Tên phim</th>
        <th>Tập</th>
      </tr>
    </thead>
    <tbody>
        @foreach($phims as $phim)
        <tr>
            @if(isset($phim->original_url) && strcasecmp($phim->original_url,'')!==0)
            <td><a href="{{$phim->original_url}}">original</a></td>
            @else
            <td></td>
            @endif
            @if($phim->danhmucs_id == 2)
            <td><a href="/phim/{{$phim->link_id}}/tap-{{$phim->ghichu}}.html">{{$phim->tenphim}}</a></td>
            <td>{{$phim->ghichu}}</td>
            <td><a title="Go to Fix" data-toggle="modal" data-target="#myModal" class="btn btn-danger " href="/updatelink/{{$phim->id}}/{{$phim->ghichu}}">Go to fix</a></td>
            <td><a title="Go to Fix" class="btn btn-success " href="/fixed/{{$phim->id}}/{{$phim->ghichu}}">Fixed</a></td>
            @else
            <td><a href="/detail/{{$phim->id}}">{{$phim->tenphim}}</a></td>
            <td></td>
            <td><a title="Go to Fix" data-toggle="modal" data-target="#myModal" class="btn btn-danger " href="/updatelink/{{$phim->id}}">Go to fix</a></td>
            <td><a title="Fix" class="btn btn-success " href="/fixed/{{$phim->id}}">Fixed</a></td>
            <td><a title="Add server" data-toggle="modal" data-target="#myModal" class="btn btn-info " href="/addserver/{{$phim->id}}">Servers</a></td>
            @endif
        </tr>
        @endforeach
    </tbody>
  </table>
  <script>
function sortTable() {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("myTable");
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[2];
      y = rows[i + 1].getElementsByTagName("TD")[2];
      //check if the two rows should switch place:
      if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}
sortTable();
</script>
</div>
@endsection
