@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            บันทึกใบสมัคร
        </div>
        <div class="card-body">
            <div class="container">
                <form method="POST" action="#">
                    @csrf
                    @include('application.form')
                    <div class="row justify-content-center">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            var userId = JSON.parse('<?php echo Auth::user()->id; ?>');

            $('#dob').datepicker({
                format: 'yyyy-mm-dd',
                startView: "years",
                autoclose: true,
                //minViewMode: "years"
            });

            $.ajax({
                /* the route pointing to the post function */
                url: '/user/' + userId,
                type: 'GET',
                success: function(data) {
                    var user = data.user;
                    $('#name').val(user.name);
                    $('#nickname').val(user.nickname);
                    $('#phone').val(user.phone);
                    $('#dob').val(user.dob);
                }
            });
        })

    </script>
@endpush
