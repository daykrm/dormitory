@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">รายชื่อผู้มีสิทธิ์สอบสัมภาษณ์{{ $dorm->name }} ปีการศึกษา {{ $year->year + 543 }}</div>
        <div class="card-body">
            @if (Auth::guard('personel')->check() || Auth::user()->type_id == 3)
                <form action="{{ route('report.validate.store') }}" class="row justify-content-center" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="dorm" value="{{ $dorm->id }}">
                    <div class="col-md-4">
                        <input type="file" accept="application/pdf" required name="file" class="form-control-file" required>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary" type="submit">อัพโหลดไฟล์</button>
                    </div>
                </form>
            @endif
            @if ($file != null)
                <embed type="application/pdf" scrolling="auto"
                    src="{{ Storage::disk('s3')->url($file->path) }}" width="100%" height="800px" />
            @endif
        </div>
    </div>
@endsection
