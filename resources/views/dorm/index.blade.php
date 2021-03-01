@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">จัดการหอพัก</div>
        <div class="card-body">
            <div class="container">
                <div class="row justify-content-end">
                    <a href="{{ route('dorm.create') }}" class="btn btn-primary">เพิ่ม</a>
                </div>
                <div class="row">
                    <table class="table striped">
                        <thead>
                            <th>#</th>
                            <th>ชื่อหอพัก</th>
                            <th>จำนวนห้องพัก</th>
                            <th>จัดการ</th>
                        </thead>
                        <tbody>
                            @foreach ($dorms as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->rooms->count('id') }}</td>
                                    <td>
                                        <a href="{{ route('dorm.edit', $item) }}" class="btn btn-outline-primary">แก้ไข</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
