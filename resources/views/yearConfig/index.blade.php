@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            ปีการศึกษา
        </div>
        <div class="card-body">
            <div class="container">
                <form action="{{ route('yearConfig.store') }}" method="post">
                    <div class="row justify-content-center">
                        @csrf
                        <div class="col-md-2">
                            <label>ปีการศึกษา</label>
                            <input type="text" id="year" class="form-control" required name="year"
                                value="{{ $year->year }}" autocomplete="off">
                        </div>
                        <div class="col-md-3">
                            <label>วันที่เริ่ม</label>
                            <input type="text" id="startDate" class="form-control" required name="startDate"
                                value="{{ $year->startDate }}" autocomplete="off">
                        </div>
                        <div class="col-md-3">
                            <label>วันที่สิ้นสุด</label>
                            <input type="text" id="endDate" class="form-control" required name="endDate"
                                value="{{ $year->endDate }}" autocomplete="off">
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

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#year').datepicker({
                format: 'yyyy',
                startView: 'years',
                minViewMode: 'years',
                autoclose: true
            })

            $('#startDate').datepicker({
                format: 'yyyy-mm-dd',
                startView: 'years',
                autoclose: true
            })

            $('#endDate').datepicker({
                format: 'yyyy-mm-dd',
                startView: 'years',
                autoclose: true
            })
        })

    </script>
@endpush
