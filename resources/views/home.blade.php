@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">ข้อมูลส่วนตัว</div>
        <div class="card-body">
            <div class="row">
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
                <div class="col-md-2 text-right">
                    คณะ :
                </div>
                <div class="col-md-10">
                    {{ Auth::guard('web')->user()->faculty->name }}
                </div>
                <div class="col-md-2 text-right">
                    หอพัก :
                </div>
                <div class="col-md-10">
                    {{ Auth::guard('web')->user()->dorm->dormitory->name }} ห้อง
                    {{ Auth::guard('web')->user()->dorm->room->name }}
                </div>
            </div>
        </div>
    </div>
@endsection
