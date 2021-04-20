@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            เพิ่มกิจกรรม
        </div>
        <div class="card-body">
            <div class="container">
                <form method="POST" action="{{ route('activity.store') }}">
                    @csrf
                    @include('activity.form')
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            var path = window.location.pathname;
            console.log(path);

            $('#date').datepicker({
                format: 'yyyy-mm-dd',
                startView: 'years',
                autoclose: true
            });

            $('#year').datepicker({
                format: 'yyyy',
                startView: 'years',
                minViewMode: 'years',
                autoclose: true
            });
        })

    </script>
@endpush
