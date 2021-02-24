@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            รายชื่อนักศึกษา {{ Auth::user()->dorm->dormitory->name }} ประจำปีการศึกษา {{ $year->year }}
        </div>
        <div class="card-body">
            <div class="container">
                <table class="table table-striped">
                    <thead>
                        <th>#</th>
                        <th>ห้องพัก</th>
                        <th>รหัสนักศึกษา</th>
                        <th>ชื่อ - สกุล</th>
                        <th>ชื่อเล่น</th>
                        <th>คณะ</th>
                        <th>อีเมล</th>
                        <th>เบอร์โทร</th>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->room }}</td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->nickname }}</td>
                                <td>{{ $item->faculty->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
