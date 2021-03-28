@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            จัดการคณะ
        </div>
        <div class="card-body">
            <div class="container">
                <div class="row justify-content-end">
                    <a href="{{ route('faculty.create') }}" class="btn btn-outline-primary">เพิ่ม</a>
                </div>
                <table class="table table-striped">
                    <thead>
                        <th>#</th>
                        <th>ชื่อคณะ</th>
                        <th>ระยะเวลาในการศึกษา (ปี)</th>
                        <th>แก้ไข</th>
                    </thead>
                    <tbody>
                        @foreach ($faculties as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->years }}</td>
                                <td>
                                    <a href="{{ route('faculty.edit', $item->id) }}"
                                        class="btn btn-warning">แก้ไข</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
