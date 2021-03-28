@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            เพิ่มคณะ
        </div>
        <div class="card-body">
            <form action="{{ route('faculty.store') }}" method="post">
                @csrf
                @include('faculty.form')
                <div class="row justify-content-center mt-4">
                    <button class="btn btn-success" type="submit">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
@endsection
