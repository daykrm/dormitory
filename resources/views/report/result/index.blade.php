@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            สรุปผลการคัดกรองนักศึกษาที่มีสิทธิ์เข้าในหอพักส่วนกลาง มหาวิทยาลัยขอนแก่น
            {{ $dorm ?? Auth::user()->dorm->dormitory->name }} ประจำปีการศึกษา
            {{ $year->year + 543 }}
        </div>
        <div class="card-body">
            <div class="container">
                @if (Auth::guard('personel')->check() || Auth::user()->type_id == 3)
                    <form action="{{ route('report.result.store') }}" class="row justify-content-center" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="dorm" value="{{ $id }}">
                        <div class="col-md-4">
                            <input type="file" accept="application/pdf" name="file" class="form-control-file" required>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary" type="submit">อัพโหลดไฟล์</button>
                        </div>
                    </form>
                @endif
                @if ($file != null)
                    <embed type="application/pdf" scrolling="auto" src="{{ Storage::disk('s3')->url($file->path) }}"
                        width="100%" height="800px" />
                @endif
            </div>
        </div>
    </div>
@endsection
