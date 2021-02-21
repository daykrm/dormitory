@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            กิจกรรม
        </div>
        <div class="card-body">
            <div class="container table-responsive">
                <div class="row justify-content-end">
                    <a href="{{ route('activity.create') }}" class="btn btn-primary">ADD</a>
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
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->detail }}</td>
                                <td>{{ $item->budget }}</td>
                                <td>{{ $item->year + 543 }}</td>
                                <td>{{ $item->activity_date }}</td>
                                <td>{{ $item->credit }}</td>
                                <td>
                                    <div class="row">
                                        <a href="{{route('createScore',$item->id)}}" class="btn btn-outline-primary">บันทึกการเข้าร่วมกิจกรรม</a>
                                        <a href="{{ url('activity/' . $item->id . '/edit') }}" class="btn btn-primary ml-2">แก้ไข</a>
                                    </div>
                                </td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
