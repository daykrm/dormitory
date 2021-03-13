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
                    @if (Auth::guard('personel')->user()->dorms != null)
                        <div class="col-md-2 text-right">
                            หอพัก :
                        </div>
                        <div class="col-md-10">
                            @foreach (Auth::guard('personel')->user()->dorms as $key => $item)
                                {{ $item->name }}
                                @if ($key != count(Auth::guard('personel')->user()->dorms) - 1)
                                    ,
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="row justify-content-center mt-2">
                    <a class="btn btn-outline-primary"
                        href="{{ route('personel.edit', Auth::guard('personel')->user()->id) }}">แก้ไข</a>
                </div>
            </div>
        </div>
    </div>
@endsection
