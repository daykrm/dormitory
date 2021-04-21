@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            แก้ไขใบสมัคร
        </div>
        <div class="card-body">
            {{ $app->sub_dist_fa->district->province->id }}
            <form method="POST" action="{{ route('application.update', $app->id) }}">
                @csrf
                {{ method_field('PUT') }}
                @include('application.form')
                <div class="row justify-content-center">
                    <button class="btn btn-success" type="submit">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            function getSelectOption(id, type, district = '#district_fa', subdistrict = '#subdistrict_fa') {
                var option = ""
                var url = ""
                if (type === 1) {
                    option += ""
                    url += "/getDistrict/" + id
                } else {
                    option += ""
                    url += "/getSubDistrict/" + id
                }
                $.ajax({
                    type: 'get',
                    url: url,
                    success: function(data) {
                        var select
                        if (type === 1) {
                            select = $(district)
                            select.html('')
                            $(subdistrict).html('')
                        } else {
                            select = $(subdistrict)
                            select.html('')
                        }
                        for (let i = 0; i < data.length; i++) {
                            option += "<option value='" + data[i].id + "'>" + data[i].name_th +
                                "</option>"
                        }
                        select.append(option)
                        select.selectpicker('refresh');
                            $(subdistrict).selectpicker('refresh');
                    }
                })
            }

            $('#province_fa').change(function(){
                getSelectOption($(this).val(),1)
            })

            $('#district_fa').change(function(){
                getSelectOption($(this).val(),2)
            })

            $('#province_mo').change(function(){
                getSelectOption($(this).val(),1,'#district_mo','#subdistrict_mo')
            })

            $('#district_mo').change(function(){
                getSelectOption($(this).val(),2,'#district_mo','#subdistrict_mo')
            })

            $('#province_sp').change(function(){
                getSelectOption($(this).val(),1,'#district_sp','#subdistrict_sp')
            })

            $('#district_sp').change(function(){
                getSelectOption($(this).val(),2,'#district_sp','#subdistrict_sp')
            })

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
