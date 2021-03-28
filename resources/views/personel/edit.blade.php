@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">แก้ไขข้อมูลส่วนตัว</div>
        <div class="card-body">
            <form action="{{ route('personel.update', $id) }}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.personel.form')
                <div class="row justify-content-center mt-2">
                    <button type="submit" class="btn btn-success">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
@endsection
