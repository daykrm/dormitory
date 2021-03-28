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
                            <th class="text-right"></th>
                        </thead>
                        <tbody>
                            @foreach ($dorms as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->rooms->count('id') }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('dorm.edit', $item) }}"
                                            class="btn btn-warning">แก้ไข</a>
                                        <a href="{{ route('room.show', $item->id) }}"
                                            class="btn btn-primary ml-2">จัดการห้องพัก
                                        </a>
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
