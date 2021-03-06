@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">แก้ไขหอพัก</div>
        <div class="card-body">
            <div class="container">
                <form action="{{ route('dorm.update', $dorm->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <label>ชื่อหอพัก</label>
                            <input type="text" required name="name" value="{{ $dorm->name }}" class="form-control">
                        </div>
                    </div>
                    <div class="row justify-content-center mt-4">
                        <button class="btn btn-success" type="submit">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
