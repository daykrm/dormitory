@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <select name="province" id="province" class="selectpicker form-control" data-live-search="true">
                <option value="">เลือกจังหวัด</option>
                @foreach ($provinces as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            <select name="district" id="district" title="เลือกอำเภอ" class="selectpicker form-control my-2"
                data-live-search="true">
                <option value="">เลือกอำเภอ</option>
            </select>
            <select name="subdistrict" id="subdistrict" title="เลือกตำบล" class="selectpicker form-control my-2"
                data-live-search="true">
                <option value="">เลือกตำบล</option>
            </select>
            <br>
            <hr>
            <br>
            <select name="province2" id="province2" class="form-control">
                <option value="">เลือกจังหวัด</option>
                @foreach ($provinces as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            <select name="district2" id="district2" class="form-control my-2">
                <option value="">เลือกอำเภอ</option>
            </select>
            <select name="subdistrict2" id="subdistrict2" class="form-control my-2">
                <option value="">เลือกตำบล</option>
            </select>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            function getSelectOption(id, type, district = '#district', subdistrict = '#subdistrict') {
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

            $('#province').change(function() {
                getSelectOption($(this).val(), 1)
            })

            $('#district').change(function() {
                getSelectOption($(this).val(), 2)
            })

            $('#province2').change(function() {
                getSelectOption($(this).val(), 1, '#district2', '#subdistrict2')
            })

            $('#district2').change(function() {
                getSelectOption($(this).val(), 2, '#district2', '#subdistrict2')
            })
        })

    </script>
@endpush
