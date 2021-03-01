@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">บุคลากร</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2 text-right">
                        รหัสบุคลากร :
                    </div>
                    <div class="col-md-10">
                        {{ Auth::guard('personel')->user()->username }}
                    </div>
                    <div class="col-md-2 text-right">
                        ชื่อ - สกุล :
                    </div>
                    <div class="col-md-10">
                        {{ Auth::guard('personel')->user()->prefix->name }}{{ Auth::guard('personel')->user()->name }}
                    </div>
                    @if (Auth::guard('personel')->user()->dorm != null)
                        <div class="col-md-2 text-right">
                            หอพัก :
                        </div>
                        <div class="col-md-10">
                            {{ Auth::guard('personel')->user()->dorm->name }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
