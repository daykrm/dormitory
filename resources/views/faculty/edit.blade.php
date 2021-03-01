@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            แก้ไขคณะ
        </div>
        <div class="card-body">
            <div class="container">
                <form action="{{ route('faculty.update', $faculty->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    @include('faculty.form')
                    <div class="row justify-content-center mt-4">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
