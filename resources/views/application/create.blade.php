@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            บันทึกใบสมัคร
        </div>
        <div class="card-body">
            <div class="container">
                <form method="POST" action="{{route('application.store')}}">
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

            $('#occ_fa').change(function(){
                if(this.value === "1"){
                    $('#other_fa_container').css('display','block');
                    $("#other_fa").prop('required',true);
                }else{
                    $('#other_fa_container').css('display','none');
                    $("#other_fa").prop('required',false);
                    $("#other_fa").val("");
                }
            })

            $('#occ_mo').change(function(){
                if(this.value === "1"){
                    $('#other_mo_container').css('display','block');
                    $("#other_mo").prop('required',true);
                }else{
                    $('#other_mo_container').css('display','none');
                    $("#other_mo").prop('required',false);
                    $("#other_mo").val("");
                }
            })

            $('#occ_sp').change(function(){
                if(this.value === "1"){
                    $('#other_sp_container').css('display','block');
                    $("#other_sp").prop('required',true);
                }else{
                    $('#other_sp_container').css('display','none');
                    $("#other_sp").prop('required',false);
                    $("#other_sp").val("");
                }
            })

            $('#sp').change(function(){
                if(this.value == 1){
                    $('#sp_container').css('display','none');
                    $('#monthly_income_sp').prop('required',false);
                    $('#relevance').prop('required',false);
                    $('#occ_sp').prop('required',false);
                    $('#age_sp').prop('required',false);
                    $('#name_sp').prop('required',false);
                    $('#other_sp').prop('required', false);
                }else{
                    $('#sp_container').css('display','block');
                    $('#monthly_income_sp').prop('required',true);
                    $('#relevance').prop('required',true);
                    $('#occ_sp').prop('required',true);
                    $('#age_sp').prop('required',true);
                    $('#name_sp').prop('required',true);
                }
            })

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
                    console.log(user.province_id);
                    $('#province').selectpicker('val',user.province_id);
                }
            });
        })

    </script>
@endpush
