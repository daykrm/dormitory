@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            สรุปผลการคัดกรองนักศึกษาที่มีสิทธิ์เข้าในหอพักส่วนกลาง มหาวิทยาลัยขอนแก่น ประจำปีการศึกษา
            {{ $year->year + 543 }}
        </div>
        <div class="card-body">
            <div class="container">
                <form action="{{route('report.result.find')}}" method="POST">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <select name="dorm" id="dorm" class="form-control" required>
                                <option value="">เลือกหอพัก</option>
                                @foreach ($dorm as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-4">
                        <button type="submit" class="btn btn-outline-primary">ค้นหา</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
