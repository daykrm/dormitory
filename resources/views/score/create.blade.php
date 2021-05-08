@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            กิจกรรม {{ $activity->name }} ({{ $activity->credit }} คะแนน)
        </div>
        <div class="card-body">
            <div class="container">
                <div class="row justify-content-between mb-2">
                    <button id="select-all" class="btn button-default">เลือกทั้งหมด/ยกเลิก</button>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="search" placeholder="ระบุคำค้นหา">
                    </div>
                </div>
                <form action="{{ route('storeScore') }}" method="post">
                    @csrf
                    <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                    <table class="table table-sm table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>
                                    <input type="checkbox" class="select-all checkbox" name="select-all" />
                                </th>
                                <th>รหัสนักศึกษา</th>
                                <th>ชื่อ - สกุล</th>
                                <th>ชื่อเล่น</th>
                                <th>หอพัก</th>
                                <th>ห้องพัก</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @foreach ($users as $item)
                                <tr class="text-center">
                                    <td>
                                        <input type="checkbox" name="user_id[]" class="select-item checkbox"
                                            value="{{ $item->id }}" @if ($item)  @endif>
                                    </td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->nickname }}</td>
                                    <td>{{ $item->dorm->dormitory->name }}</td>
                                    <td>{{ $item->dorm->room->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <center><button type="submit" class="btn btn-primary">บันทึกการเข้าร่วม</button></center>
                </form>
            </div>
        </div>
    </div>
    <br>
@endsection

@push('scripts')
    <script>
        $(function() {
            var user_activity = JSON.parse('<?php echo $activity->users; ?>');
            // console.log(user_activity);
            // console.log(user_activity[1].id);
            $('input.select-item').each(function(index, item) {
                var val = $(this).val();
                var findIndex = user_activity.findIndex(user => user.id == val);
                if (findIndex != -1) {
                    $(this).prop('checked', true);
                }
            })

            $('#search').on('keyup', function() {
                var val = $(this).val();
                $('#myTable tr').filter(function() {
                    $(this).toggle($(this).text().indexOf(val) > -1)
                })
            })

            // console.log(user_activity);
            //button select all or cancel
            $("#select-all").click(function() {
                var all = $("input.select-all")[0];
                all.checked = !all.checked
                var checked = all.checked;
                $("input.select-item").each(function(index, item) {
                    item.checked = checked;
                });
            });
            //column checkbox select all or cancel
            $("input.select-all").click(function() {
                var checked = this.checked;
                $("input.select-item").each(function(index, item) {
                    item.checked = checked;
                });
            });
            //check selected items
            $("input.select-item").click(function() {
                var checked = this.checked;
                var all = $("input.select-all")[0];
                var total = $("input.select-item").length;
                var len = $("input.select-item:checked:checked").length;
                all.checked = len === total;
            });
        })

    </script>
@endpush
