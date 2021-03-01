@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">ช่วงเวลาการรับสมัคร</div>
        <div class="card-body">
            <div class="container">
                <form action="{{ route('registerRange.store') }}" method="post">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-3">
                            <label>วันที่เริ่มต้น</label>
                            <input type="text" id="startDate" required name="startDate"
                                value="{{ $range->startDate ?? '' }}" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>วันที่สิ้นสุด</label>
                            <input type="text" id="endDate" required name="endDate" value="{{ $range->endDate ?? '' }}"
                                class="form-control">
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

@push('scripts')
    <script>
        $(document).ready(function() {
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
