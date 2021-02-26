@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            จัดการข้อมูลบุคลากร
        </div>
        <div class="card-body">
            <div class="container">
                <div class="row justify-content start">
                    <a href="{{ route('admin.personel.create') }}" class="btn btn-outline-primary">เพิ่ม</a>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>รหัสบุคลากร</th>
                            <th>ชื่อ - สกุล</th>
                            <th>อีเมล</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($persons as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->prefix->name }}{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    <a href="{{ route('admin.personel.edit', $item->id) }}" class="btn btn-primary">
                                        แก้ไข
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
