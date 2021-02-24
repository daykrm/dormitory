@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            รายการกิจกรรมประจำปี {{ $year->year + 543 }}
        </div>
        <div class="card-body">
            <div class="container">
                @if (Auth::user()->type_id == 2)
                    <div class="form-inline mt-2">
                        <div class="form-group">
                            <label class="mr-2">เริ่มต้น</label>
                            <input type="text" name="start" id="start" autocomplete="off" class="form-control">
                            <label class="ml-2 mr-2">สิ้นสุด</label>
                            <input type="text" name="end" id="end" autocomplete="off" class="form-control">
                            <button type="submit" id="search" class="btn btn-outline-primary ml-2">ค้นหา</button>
                        </div>
                        <form id="search-form" action="#" method="get"></form>
                    </div>
                @endif
                <table class="table table-striped mt-4">
                    <thead>
                        <th>#</th>
                        <th>ชื่อกิจกรรม</th>
                        <th>รายละเอียด</th>
                        @if (Auth::user()->type_id == 2)
                            <th>งบประมาณ</th>
                        @endif
                        <th>วันที่จัดกิจกรรม</th>
                        <th>คะแนน</th>
                    </thead>
                    <tbody>
                        @foreach ($activities as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->detail }}</td>
                                @if (Auth::user()->type_id == 2)
                                    <td>{{ $item->budget }}</td>
                                @endif
                                <td>{{ $item->activity_date }}</td>
                                <td>{{ $item->credit }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#start').datepicker({
                format: 'yyyy',
                startView: 'years',
                minViewMode: 'years',
                autoclose: true
            });

            $('#end').datepicker({
                format: 'yyyy',
                startView: 'years',
                minViewMode: 'years',
                autoclose: true
            });

            $('#search').click(function() {
                var start = $('#start').val();
                var end = $('#end').val();
                if (start != '' && end != '') {
                    $('#search-form').attr('action', '/report/activity/' + start + '/' + end);
                    $('#search-form').submit();
                } else {
                    alert('กรุณาเลือกช่วงปี')
                }
            })
        })

    </script>
@endpush
