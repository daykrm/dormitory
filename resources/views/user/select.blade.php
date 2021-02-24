@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            ข้อมูลนักศึกษา
        </div>
        <div class="card-body">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <select name="dorm" id="dorm" class="form-control" required>
                            <option value="">เลือกหอพัก</option>
                            @foreach ($dorm as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row justify-content-center mt-4">
                    <button id="submit" class="btn btn-outline-primary">ค้นหา</button>
                </div>
                <form action="#" id="form-search" method="get"></form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#submit').click(function() {
                var dormId = $('#dorm').val();
                if (dormId === "") {
                    alert('กรุณาเลือกหอพัก')
                    return false;
                }
                $('#form-search').attr('action', '/user/all/' + dormId)
                $('#form-search').submit()
            })
        })

    </script>
@endpush
