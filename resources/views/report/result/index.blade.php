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
                    <form action="{{ route('report.result.store') }}" class="row justify-content-center" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-4">
                            <input type="file" accept="application/pdf" name="file" class="form-control-file" required>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary" type="submit">อัพโหลดไฟล์</button>
                        </div>
                    </form>
                    <div class="progress mt-5">
                        <div class="bar"></div>
                        <div class="percent">0%</div>
                    </div>
                @endif
                <br>
                @if ($file != null)
                    <embed type="application/pdf" scrolling="auto" src="{{ Storage::disk('s3')->url($file->path) }}"
                        width="100%" height="800px" />
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
    <style>
        .progress {
            position: relative;
            width: 100%;
            border: 1px solid #7F98B2;
            padding: 1px;
            border-radius: 3px;
        }

        .bar {
            background-color: #B4F5B4;
            width: 0%;
            height: 25px;
            border-radius: 3px;
        }


        .percent {
            position: absolute;
            display: inline-block;
            top: 3px;
            left: 48%;
            color: #7F98B2;
        }

    </style>

    <script type="text/javascript">
        var SITEURL = "{{ URL('/') }}";
        $(function() {
            $(document).ready(function() {
                var bar = $('.bar');
                var percent = $('.percent');
                $('form').ajaxForm({
                    beforeSend: function() {
                        var percentVal = '0%';
                        bar.width(percentVal)
                        percent.html(percentVal);
                    },
                    uploadProgress: function(event, position, total, percentComplete) {
                        var percentVal = percentComplete + '%';
                        bar.width(percentVal)
                        percent.html(percentVal);
                    },
                    success: function(res) {
                        alert('File Has Been Uploaded Successfully');
                        window.location.href = SITEURL + "/" + "report/result";
                    },
                    error : function(data){
                        alert('Error : ' + data);
                    }

                    // complete: function(xhr) {
                    //     alert('File Has Been Uploaded Successfully');
                    //     window.location.href = SITEURL + "/" + "report/result";
                    // }
                });
            });
        });

    </script>
@endpush
