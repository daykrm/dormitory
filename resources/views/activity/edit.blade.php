@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            แก้ไขกิจกรรม
        </div>
        <div class="card-body">
            <div class="container">
                <form method="POST" action="{{ route('activity.update', $activity->id) }}">
                    @csrf
                    {{ method_field('PUT') }}
                    @include('activity.form')
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
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
