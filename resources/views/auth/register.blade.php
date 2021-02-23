@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            @include('auth.form')
                            <div class="row justify-content-center">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $('#dob').datepicker({
                format: 'yyyy-mm-dd',
                startView: "years",
                autoclose: true,
                //minViewMode: "years"
            });

            $('#enroll').datepicker({
                format: 'yyyy',
                startView: "years",
                autoclose: true,
                minViewMode: "years"
            });

            $('#dorm').change(function() {
                var dormId = this.value;
                $("#room").empty();
                var option = '';
                $.ajax({
                    /* the route pointing to the post function */
                    url: '/getRoom/' + dormId,
                    type: 'GET',
                    success: function(data) {
                        console.log(data.rooms[0].name)
                        var data = data.rooms;
                        data.forEach(e => {
                            option += '<option value="' + e.id + '">' + e.name +
                                '</option>';
                        });
                        $('#room').append(option);
                        $('#room').selectpicker('refresh');
                    }
                });
            })
        })

    </script>
@endpush
