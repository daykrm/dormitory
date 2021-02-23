@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            แก้ไขใบสมัคร
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('application.update', $app->id) }}">
                @csrf
                {{ method_field('PUT') }}
                @include('application.form')
                <div class="row justify-content-center">
                    <button class="btn btn-primary" type="submit">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
@endsection

ิ@push('scripts')
    <script>
        $(document).ready(function() {
            $('#dob').datepicker({
                format: 'yyyy-mm-dd',
                startView: "years",
                autoclose: true,
                //minViewMode: "years"
            });

            $('#occ_fa').change(function() {
                if (this.value === "1") {
                    $('#other_fa_container').css('display', 'block');
                    $("#other_fa").prop('required', true);
                } else {
                    $('#other_fa_container').css('display', 'none');
                    $("#other_fa").prop('required', false);
                }
            })

            $('#occ_mo').change(function() {
                if (this.value === "1") {
                    $('#other_mo_container').css('display', 'block');
                    $("#other_mo").prop('required', true);
                } else {
                    $('#other_mo_container').css('display', 'none');
                    $("#other_mo").prop('required', false);
                }
            })

            $('#occ_sp').change(function() {
                if (this.value === "1") {
                    $('#other_sp_container').css('display', 'block');
                    $("#other_sp").prop('required', true);
                } else {
                    $('#other_sp_container').css('display', 'none');
                    $("#other_sp").prop('required', false);
                }
            })

            $('#sp').change(function() {
                if (this.value == 1) {
                    $('#sp_container').css('display', 'none');
                    $('#monthly_income_sp').prop('required', false);
                    $('#relevance').prop('required', false);
                    $('#occ_sp').prop('required', false);
                    $('#other_sp').prop('required', false);
                    $('#age_sp').prop('required', false);
                    $('#name_sp').prop('required', false);
                } else {
                    $('#sp_container').css('display', 'block');
                    $('#monthly_income_sp').prop('required', true);
                    $('#relevance').prop('required', true);
                    $('#occ_sp').prop('required', true);
                    $('#age_sp').prop('required', true);
                    $('#name_sp').prop('required', true);
                }
            })
        })

    </script>
@endpush
