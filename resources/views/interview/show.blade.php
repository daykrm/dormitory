@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            สรุปคะแนนการสัมภาษณ์หอพักที่ {{ $dorm->name ?? '' }} ประจำปีการศึกษา {{ $year->year ?? ''}}
        </div>
    </div>
@endsection