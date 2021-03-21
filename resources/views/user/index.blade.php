@extends('layouts.app')

@php
if (session('user')) {
    $users = session('user');
}
@endphp

@section('content')
    <div class="card">
        <div class="card-header">
            ข้อมูลนักศึกษา ประจำ{{ $dorm->name ?? '' }}
        </div>
        <div class="card-body">
            <div class="container mb-2">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <select name="dorm" id="dorm" class="form-control" required>
                            <option value="">เลือกหอพัก</option>
                            @if (Auth::guard('personel')->check())
                                @foreach (Auth::guard('personel')->user()->dorms as $item)
                                    <option value="{{ $item->id }}" @if ($dormId == $item->id) selected @endif>{{ $item->name }}</option>
                                @endforeach
                            @else
                                @foreach ($dorms as $item)
                                    <option value="{{ $item->id }}" @if ($dormId == $item->id) selected @endif>{{ $item->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="row justify-content-center mt-4">
                    <button id="submit" class="btn btn-outline-primary">ค้นหา</button>
                </div>
                <form action="#" id="form-search" method="get"></form>
            </div>
            <div class="container-fluid mt-4">
                <div class="row justify-content-end mb-2">
                    <div class="col-md-4">
                        <input type="text" id="filter" class="form-control" placeholder="รหัสนักศึกษา">
                    </div>
                </div>
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
                    <tbody id="table">
                        @foreach ($users as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->prefix->name }}{{ $item->name }}</td>
                                <td>{{ $item->dorm->room->name }}</td>
                                <td>{{ $item->type->name }}</td>
                                <td>
                                    <div class="row justify-content center">
                                        <a href="#" class="btn btn-primary disabled">แก้ไข</a>
                                        <form action="{{ route('changeStatus', $item->id) }}" class="ml-2" method="post">
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
                {{-- {{ $users->links() }} --}}
            </div>
        </div>
    </div>
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

            $('#filter').on('keyup', function() {
                var value = $(this).val();
                $('#table tr').filter(function() {
                    $(this).toggle($(this).text().indexOf(value) > -1)
                })
            });
        })

    </script>
@endpush
