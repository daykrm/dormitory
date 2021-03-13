@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between">
                <div class="col-md-2"></div>
                <div class="col-md-8">ผลการเข้าร่วมกิจกรรม{{ $dorm->name }} ปีการศึกษา {{ $year->year + 543 }}</div>
                <div class="col-md-2">
                    <a target="_blank" href="{{ route('showPDFDormActivity', $dorm->id) }}"
                        class="btn btn-light">พิมพ์</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="container">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ห้องพัก</th>
                                <th>รหัสนักศึกษา</th>
                                <th>ชื่อ - สกุล</th>
                                <th>คณะ</th>
                                <th>ชั้นปี</th>
                                <th>คะแนนรวม</th>
                                <th>ร้อยละ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item['room'] }}</td>
                                    <td>{{ $item['username'] }}</td>
                                    <td>{{ $item['prefix'] }}{{ $item['name'] }}</td>
                                    <td>{{ $item['faculty'] }}</td>
                                    <td>{{ $year->year - $item['enroll'] }}</td>
                                    <td>{{ $item['sum_score'] }} / {{ $sumCredit }}</td>
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
