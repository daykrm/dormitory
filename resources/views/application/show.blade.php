@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <div class="card-header">ใบสมัคร ( ปีการศึกษา {{ $app->year + 543 }} )</div>
        <div class="card-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h5>ข้อมูลส่วนตัว</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-2">รหัสนักศึกษา</div>
                            <div class="col-md-9">{{ $app->student->username }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 ">ชื่อ - สกุล</div>
                            <div class="col-md-9">{{ $app->student->prefix->name }}{{ $app->student->name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 ">ทุนการศึกษาที่เคยได้รับ</div>
                            <div class="col-md-9">{{ $app->scholarship_name ?? '-' }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 ">หอพักที่ต้องการสมัคร</div>
                            <div class="col-md-9">{{ $app->dorm->name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 ">ปีการศึกษา</div>
                            <div class="col-md-9">{{ $app->year + 543 }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 ">หน่วยกิจกรรมสะสม</div>
                            <div class="col-md-9">{{ $app->student->credit }} คะแนน</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">ค่าใช้จ่ายต่อเดือน</div>
                            <div class="col-md-9">{{ $app->monthly_expense }} บาท</div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <h5>ข้อมูลครอบครัว</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-2">ชื่อบิดา</div>
                            <div class="col-md-4">{{ $app->name_fa }}</div>
                            <div class="col-md-2">อายุ {{ $app->age_fa }} ปี</div>
                            @if ($app->occupation_fa == 1)
                                <div class="col-md-4">อาชีพ {{ $app->occ_fa->name }} ( {{ $app->other_fa }} )</div>
                            @else
                                <div class="col-md-4">อาชีพ {{ $app->occ_fa->name }}</div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-2">ชื่อมารดา</div>
                            <div class="col-md-4">{{ $app->name_mo }}</div>
                            <div class="col-md-2">อายุ {{ $app->age_mo }} ปี</div>
                            @if ($app->occupation_mo == 1)
                                <div class="col-md-4">อาชีพ {{ $app->occ_mo->name }} ( {{ $app->other_mo }} )</div>
                            @else
                                <div class="col-md-4">อาชีพ {{ $app->occ_mo->name }}</div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-2">รายได้ต่อเดือนบิดามารดา</div>
                            <div class="col-md-10">{{ $app->family_monthly_income }} บาท</div>
                            <div class="col-md-2">สถานภาพสมรสบิดามารดา </div>
                            <div class="col-md-10">{{ $app->marital() }}</div>
                            <div class="col-md-2">จำนวนพี่น้องรวมตัวนักศึกษา </div>
                            <div class="col-md-10">{{ $app->relative_number }} คน</div>
                            <div class="col-md-2">นักศึกษาเป็นบุตรคนที่ </div>
                            <div class="col-md-10">{{ $app->being_number }}</div>
                            <div class="col-md-2">จำนวนพี่น้องที่จบการศึกษาแล้ว </div>
                            <div class="col-md-10">{{ $app->graduated }} คน</div>
                            <div class="col-md-2">อยู่ในความดูแลของบิดามารดา </div>
                            <div class="col-md-10">{{ $app->in_progress }} คน</div>
                        </div>
                    </div>
                    @if ($app->name_sp != null)
                        <div class="col-md-12 mt-4">
                            <h5>ข้อมูลผู้อุปการะ</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-2">ชื่อผู้ปกครอง</div>
                                <div class="col-md-10">{{ $app->name_sp }}</div>
                                <div class="col-md-2">อายุ </div>
                                <div class="col-md-10">{{ $app->age_sp }} ปี</div>
                                @if ($app->occupation_sp == 1)
                                    <div class="col-md-2">อาชีพ </div>
                                    <div class="col-md-10">{{ $app->occ_sp->name }} ( {{ $app->other_sp }} )</div>
                                @else
                                    <div class="col-md-2">อาชีพ </div>
                                    <div class="col-md-10">{{ $app->occ_sp->name }}</div>
                                @endif
                                <div class="col-md-2">ความเกี่ยวข้อง</div>
                                <div class="col-md-10">{{ $app->relevance }}</div>
                                <div class="col-md-2">รายได้ต่อเดือน</div>
                                <div class="col-md-10">{{ $app->monthly_income_sp }} บาท</div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row justify-content-center mt-4">
                    @if ($app->status == 0)
                        <a href="{{ url('application/' . $app->id . '/edit') }}" class="btn btn-warning">แก้ไข</a>
                    @else
                        <a href="{{ url('application/' . $app->id . '/edit') }}"
                            class="btn btn-warning disabled">แก้ไข</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
