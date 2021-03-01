@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">ผลการเข้าร่วมกิจกรรม{{ $dorm->name }} ปีการศึกษา {{ $year->year + 543 }}</div>
        <div class="card-body">
            <div class="container">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>รหัสนักศึกษา</th>
                                <th>ชื่อ - สกุล</th>
                                @foreach ($data[0]['activities'] as $key => $item)
                                    <th>กิจกรรมที่ {{ $item['name'] }}</th>
                                @endforeach
                                <th>คะแนนรวม</th>
                                <th>ร้อยละ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item['username'] }}</td>
                                    <td>{{ $item['prefix'] }}{{ $item['name'] }}</td>
                                    @foreach ($item['activities'] as $val)
                                        <td>{{ $val['score'] }}</td>
                                    @endforeach
                                    <td>{{ $item['sum_score'] }} / {{$sumCredit}}</td>
                                    <td>{{ $item['percent'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
