@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            รายชื่อผู้กรอกใบสมัคร{{ $dorm->name }}
        </div>
        <div class="card-body">
            <div class="container">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>รหัสนักศึกษา</th>
                                <th>ชื่อ - สกุล</th>
                                <th>คณะ</th>
                                <th>ชั้นปี</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($apps as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->student->username }}</td>
                                    <td>{{ $item->student->prefix->name }}{{ $item->student->name }}</td>
                                    <td>{{ $item->student->faculty->name }}</td>
                                    <td>{{ $item->student->year() }}</td>
                                    <td class="text-right"><a href="{{ url('application/detail/' . $item->id) }}">พิมพ์</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row justify-content-end mt-4">
                    {{ $apps->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
