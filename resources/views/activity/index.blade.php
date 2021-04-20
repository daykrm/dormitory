@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            เพิ่มกิจกรรม
        </div>
        <div class="card-body">
            <div class="container">
                <form method="POST" action="{{ route('activity.store') }}">
                    @csrf
                    @include('activity.form')
                </form>
            </div>
        </div>
    </div>
    <hr>
    <div class="container">
        <div class="row justify-content-end">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <th>ชื่อกิจกรรม</th>
                        <th>รายละเอียด</th>
                        <th>งบประมาณ</th>
                        <th>ปีการศึกษา</th>
                        <th>วันที่จัดกิจกรรม</th>
                        <th>คะแนน</th>
                        <th>จัดการ</th>
                    </thead>
                    <tbody>
                        @foreach ($activities as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->detail }}</td>
                                <td>{{ $item->budget }}</td>
                                <td>{{ $item->year + 543 }}</td>
                                <td>{{ $item->activity_date }}</td>
                                <td>{{ $item->credit }}</td>
                                <td>
                                    <div class="row">
                                        {{-- <a href="{{ route('createScore', $item->id) }}"
                                        class="btn btn-outline-primary">บันทึกการเข้าร่วมกิจกรรม</a> --}}
                                        <a href="{{ url('activity/' . $item->id . '/edit') }}"
                                            class="btn btn-warning ml-2">แก้ไข</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- <div class="card">
        <div class="card-header">
            กิจกรรม
        </div>
        <div class="card-body">
            <div class="container table-responsive">
                
            </div>
        </div>
    </div> --}}
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {

            var path = window.location.pathname;
            $('#dorm_id').val(path.split('/')[2])
            // console.log($('#dorm_id').val());

            $('#date').datepicker({
                format: 'yyyy-mm-dd',
                startView: 'years',
                autoclose: true
            });

            $('#year').datepicker({
                format: 'yyyy',
                startView: 'years',
                minViewMode: 'years',
                autoclose: true
            });
        })

    </script>
@endpush
