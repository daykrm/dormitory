@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between">
                <div class="col-md-2"></div>
                <div class="col-md-8">รายชื่อผู้กรอกใบสมัคร{{ $dorm->name }}</div>
                <div class="col-md-2">
                    <a target="_blank" href="{{ route('showValidate', $dorm->id) }}" class="btn btn-light">พิมพ์</a>
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
                                <th>รหัสนักศึกษา</th>
                                <th>ชื่อ - สกุล</th>
                                <th>คณะ</th>
                                <th>ชั้นปี</th>
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
