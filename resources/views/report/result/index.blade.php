@extends('layouts.app')

@section('content')
    @php
    $s3 = new Aws\S3\S3Client([
        'version' => 'latest',
        'region' => 'ap-southeast-1',
    ]);

    $bucket = getenv('AWS_BUCKET') ?: die('No "S3_BUCKET" config var');

    // dd($bucket);

    @endphp
    <div class="card">
        <div class="card-header">
            สรุปผลการคัดกรองนักศึกษาที่มีสิทธิ์เข้าในหอพักส่วนกลาง มหาวิทยาลัยขอนแก่น ประจำปีการศึกษา
            {{ $year->year + 543 }}
        </div>
        <div class="card-body">
            <div class="container">
                @if (Auth::user() && Auth::user()->type_id == 3)
                    <form action="{{ route('report.result.store') }}" class="row justify-content-center" method="post">
                        @csrf
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
