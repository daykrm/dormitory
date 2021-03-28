@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            ข้อมูลนักศึกษา
        </div>
        <div class="card-body">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <select name="dorm" id="dorm" class="form-control" required>
                            <option value="">เลือกหอพัก</option>
                            @foreach ($dorm as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row justify-content-center mt-4">
                    <button id="submit" class="btn btn-outline-primary">ค้นหา</button>
                </div>
                <form action="#" id="form-search" method="get"></form>
            </div>
        </div>
    </div>
    @if (session('users'))
        @php
            $users = session('users');
        @endphp
        <div class="container-fluid mt-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>รหัสนักศึกษา</th>
                        <th>ชื่อ - สกุล</th>
                        <th>ห้องพัก</th>
                        <th>สถานะ</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->prefix->name }}{{ $item->name }}</td>
                            <td>{{ $item->dorm->room->name }}</td>
                            <td>{{ $item->type->name }}</td>
                            <td>
                                <div class="row justify-content center">
                                    <a href="#" class="btn btn-warning">แก้ไข</a>
                                    <form action="{{route('changeStatus', $item->id)}}" class="ml-2" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-outline-primary">สลับสถานะ</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#submit').click(function() {
                var dormId = $('#dorm').val();
                if (dormId === "") {
                    alert('กรุณาเลือกหอพัก')
                    return false;
                }
                $('#form-search').attr('action', '/user/all/' + dormId)
                $('#form-search').submit()
            })
        })

    </script>
@endpush
