@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">ข้อมูลส่วนตัว</div>
        <div class="card-body">
            <div class="row">
                @if (Auth::user()->type->id == 3)
                    <div class="col-md-2 text-right">
                        Name :
                    </div>
                    <div class="col-md-10">
                        {{ Auth::guard('web')->user()->name }}
                    </div>
                @else
                    <div class="col-md-2 text-right">
                        รหัสนักศึกษา :
                    </div>
                    <div class="col-md-10">
                        {{ Auth::guard('web')->user()->username }}
                    </div>
                    <div class="col-md-2 text-right">
                        ชื่อ - สกุล :
                    </div>
                    <div class="col-md-10">
                        {{ Auth::guard('web')->user()->name }}
                    </div>
                    <div class="col-md-2 text-right">
                        ชั้นปี :
                    </div>
                    <div class="col-md-10">
                        {{ $year->year - Auth::guard('web')->user()->enrolled_year }}
                    </div>
                    @if (Auth::guard('web')->user()->faculty != null)
                        <div class="col-md-2 text-right">
                            คณะ :
                        </div>
                        <div class="col-md-10">
                            {{ Auth::guard('web')->user()->faculty->name }}
                        </div>
                    @endif
                    @if (Auth::guard('web')->user()->dorm != null)
                        <div class="col-md-2 text-right">
                            หอพัก :
                        </div>
                        <div class="col-md-10">
                            {{ Auth::guard('web')->user()->dorm->dormitory->name }} ห้อง
                            {{ Auth::guard('web')->user()->dorm->room->name }}
                        </div>
                    @endif
                @endif
            </div>
            @if (Auth::user()->type_id != 3)
                <div class="row justify-content-center mt-4">
                    <a class="btn btn-outline-primary" href="{{ route('student.edit', Auth::user()->id) }}">แก้ไข</a>
                </div>
            @endif
        </div>
    </div>
@endsection
