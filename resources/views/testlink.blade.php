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
  <table class="table"  id="myTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Tên phim</th>
        <th>Số người báo lỗi</th>
      </tr>
    </thead>
    <tbody>
        @foreach($groupPhimKeys as $key)
        <tr>
            <td>{{$key}}</td>
            <td><a href="/detail/{{$key}}">{{$groupPhim[$key]}}</a></td>
            <td>{{$counts[$key]}}</td>
            <td><a title="Go to Fix" data-toggle="modal" data-target="#myModal" class="btn btn-danger " href="/updatelink/{{$key}}">Go to fix</a></td>
            <td><a title="Go to Fix" class="btn btn-success " href="/fixed/{{$key}}">Fixed</a></td>
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
