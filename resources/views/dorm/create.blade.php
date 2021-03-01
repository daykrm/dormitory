@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">เพิ่มหอพัก</div>
        <div class="card-body">
            <div class="container">
                <form action="{{ route('dorm.store') }}" method="post">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <label>ชื่อหอพัก</label>
                            <input type="text" required name="name" class="form-control">
                        </div>
                    </div>
                    <div class="row justify-content-center mt-4">
                        <button class="btn btn-primary" type="submit">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
