@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between">
                <div class="col-md-2"></div>
                <div class="col-md-8">ผลการเข้าร่วมกิจกรรม{{ $dorm->name }} ปีการศึกษา {{ $year->year + 543 }}</div>
                <div class="col-md-2">
                    <a target="_blank" href="{{ route('showPDFDormActivity', $dorm->id) }}"
                        class="btn btn-light">พิมพ์</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="container">
                <div class="table-responsive">
                    <table class="table table-striped" id="table">
                        <tr>
                            <th onclick="sortTable(0)" style="cursor: pointer">#</th>
                            <th onclick="sortTable(1)" style="cursor: pointer">ห้องพัก</th>
                            <th onclick="sortTable(2)" style="cursor: pointer">รหัสนักศึกษา</th>
                            <th onclick="sortTable(3)" style="cursor: pointer">ชื่อ - สกุล</th>
                            <th onclick="sortTable(4)" style="cursor: pointer">คณะ</th>
                            <th onclick="sortTable(5)" style="cursor: pointer">ชั้นปี</th>
                            <th onclick="sortTable(6)" style="cursor: pointer">คะแนนรวม</th>
                            <th onclick="sortTable(7)" style="cursor: pointer">ร้อยละ</th>
                        </tr>
                        @foreach ($data as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item['room'] }}</td>
                                <td>{{ $item['username'] }}</td>
                                <td>{{ $item['prefix'] }}{{ $item['name'] }}</td>
                                <td>{{ $item['faculty'] }}</td>
                                <td>{{ $year->year - $item['enroll'] }}</td>
                                <td>{{ $item['sum_score'] }} / {{ $sumCredit }}</td>
                                <td>{{ $item['percent'] }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function sortTable(n) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("table");
            switching = true;
            //Set the sorting direction to ascending:
            dir = "asc";
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
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    /*check if the two rows should switch place,
                    based on the direction, asc or desc:*/
                    if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            //if so, mark as a switch and break the loop:
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            //if so, mark as a switch and break the loop:
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    /*If a switch has been marked, make the switch
                    and mark that a switch has been done:*/
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    //Each time a switch is done, increase this count by 1:
                    switchcount++;
                } else {
                    /*If no switching has been done AND the direction is "asc",
                    set the direction to "desc" and run the while loop again.*/
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        }

    </script>
@endpush
