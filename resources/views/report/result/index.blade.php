@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            สรุปผลการคัดกรองนักศึกษาที่มีสิทธิ์เข้าในหอพักส่วนกลาง มหาวิทยาลัยขอนแก่น
            {{ Auth::user()->dorm->dormitory->name }} ประจำปีการศึกษา
            {{ $year->year + 543 }}
        </div>
        <div class="card-body">
            <div class="container">
                @if ($file != null)
                    <embed type="application/pdf" scrolling="auto" src="{{ asset('storage/' . $file->path) }}"
                        width="100%" height="800px" />
                @endif
            </div>
        </div>
    </div>
@endsection
