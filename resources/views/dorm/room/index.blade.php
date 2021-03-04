@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">จัดการห้องพัก {{ $dorm->name }}</div>
        <div class="card-body">
            <div class="container">
                <form action="#" method="post">
                    @csrf
                    <button class="btn btn-primary">เพิ่ม</button>
                </form>
                <select name="rooms" id="rooms" class="selectpicker form-control @error('rooms') is-invalid @enderror"
                    title="เลือกห้องพัก" data-live-search="true" multiple data-actions-box="true">
                    @foreach ($availableRoom as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
@endsection

