@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            กิจกรรม {{ $activity->name }} ({{ $activity->credit }} คะแนน)
        </div>
        <div class="card-body">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-2 text-right">
                        รหัสนักศึกษา :
                    </div>
                    <div class="form-group col-md-10">
                        <form method="GET" action="{{ route('findStudent') }}">
                            <div class="row">
                                <div class="form-group col-md-10">
                                    <input type="text" name="username" value="{{ old('username') }}" required
                                        class="form-control">
                                    @if (session('error'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ session('error') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-outline-primary">ค้นหา</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @if (session('user'))
                        <div class="col-md-2 text-right">
                            ชื่อ-สกุล :
                        </div>
                        <div class="col-md-10">
                            {{ session('user')->name }}
                        </div>
                        <form method="POST" action="{{ route('storeScore') }}">
                            @csrf
                            <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                            <input type="hidden" name="user_id" value="{{ session('user')->id }}">
                            <button type="submit" class="btn btn-primary">เข้าร่วม</button>
                        </form>
                    @endif
                </div>
                {{-- <form method="POST" action="{{ route('activity.store') }}">
                    @csrf
                    @include('activity.form')
                </form> --}}
            </div>
        </div>
    </div>
    <br>
    <hr>
    <div class="card">
        <div class="card-header">
            รายชื่อนักศึกษาที่เข้าร่วมกิจกรรม
        </div>
        <div class="card-body">
            <div class="container">
                <table class="table table-striped">
                    <thead>
                        <th>รหัสนักศึกษา</th>
                        <th>ชื่อ - สกุล</th>
                        <th>ชื่อเล่น</th>
                        <th>หอพัก</th>
                        <th>ห้อง</th>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->student->username }}</td>
                                <td>{{ $item->student->name }}</td>
                                <td>{{$item->student->nickname}}</td>
                                <td>{{$item->student->dorm->dormitory->name}}</td>
                                <td>{{$item->student->dorm->room->name}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
