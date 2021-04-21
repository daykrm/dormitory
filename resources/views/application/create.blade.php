@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            บันทึกใบสมัคร
        </div>
        <div class="card-body">
            <div class="container">
                <form method="POST" action="{{ route('application.store') }}" enctype="multipart/form-data">
                    @csrf
                    @include('application.form')
                    <div class="row justify-content-center">
                        <button type="submit" class="btn btn-success">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
    <style type="text/css">
        img {
            display: block;
            max-width: 100%;
        }

        .preview {
            overflow: hidden;
            width: 160px;
            height: 160px;
            margin: 10px;
            border: 1px solid red;
        }

        .modal-lg {
            max-width: 1000px !important;
        }

    </style>
    <script>
        $(document).ready(function() {

            var $modal = $('#modal');
            var image = document.getElementById('image');
            var cropper;
            $("body").on("change", ".image", function(e) {
                var files = e.target.files;
                var done = function(url) {
                    image.src = url;
                    $modal.modal('show');
                };
                var reader;
                var file;
                var url;
                if (files && files.length > 0) {
                    file = files[0];
                    if (URL) {
                        done(URL.createObjectURL(file));
                    } else if (FileReader) {
                        reader = new FileReader();
                        reader.onload = function(e) {
                            done(reader.result);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });
            $modal.on('shown.bs.modal', function() {
                cropper = new Cropper(image, {
                    // aspectRatio: 1,
                    viewMode: 3,
                    preview: '.preview'
                });
            }).on('hidden.bs.modal', function() {
                cropper.destroy();
                cropper = null;
                // $('#selectFile').val('')
            });
            $("#crop").click(function() {
                canvas = cropper.getCroppedCanvas({
                    width: 700,
                    height: 700,
                });

                // console.log($('meta[name="_token"]').attr('content'));
                canvas.toBlob(function(blob) {
                    url = URL.createObjectURL(blob);
                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function() {
                        var base64data = reader.result;
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "/crop-image-upload",
                            data: {
                                '_token': "{{ csrf_token() }}",
                                'image': base64data
                            },
                            success: function(data) {
                                console.log(data);
                                $modal.modal('hide');
                                $('#image_path').val(data);
                                alert("Upload ไฟล์สำเร็จ");
                            }
                        });
                    }
                });
            })


            var userId = JSON.parse('<?php echo Auth::user()->id; ?>');

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

            $('#province_fa').change(function() {
                getSelectOption($(this).val(), 1)
            })

            $('#district_fa').change(function() {
                getSelectOption($(this).val(), 2)
            })

            $('#province_mo').change(function() {
                getSelectOption($(this).val(), 1, '#district_mo', '#subdistrict_mo')
            })

            $('#district_mo').change(function() {
                getSelectOption($(this).val(), 2, '#district_mo', '#subdistrict_mo')
            })

            $('#province_sp').change(function() {
                getSelectOption($(this).val(), 1, '#district_sp', '#subdistrict_sp')
            })

            $('#district_sp').change(function() {
                getSelectOption($(this).val(), 2, '#district_sp', '#subdistrict_sp')
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
                    $("#other_fa").val("");
                }
            })

            $('#occ_mo').change(function() {
                if (this.value === "1") {
                    $('#other_mo_container').css('display', 'block');
                    $("#other_mo").prop('required', true);
                } else {
                    $('#other_mo_container').css('display', 'none');
                    $("#other_mo").prop('required', false);
                    $("#other_mo").val("");
                }
            })

            $('#occ_sp').change(function() {
                if (this.value === "1") {
                    $('#other_sp_container').css('display', 'block');
                    $("#other_sp").prop('required', true);
                } else {
                    $('#other_sp_container').css('display', 'none');
                    $("#other_sp").prop('required', false);
                    $("#other_sp").val("");
                }
            })

            $('#sp').change(function() {
                if (this.value == 1) {
                    $('#sp_container').css('display', 'none');
                    $('#monthly_income_sp').prop('required', false);
                    $('#relevance').prop('required', false);
                    $('#occ_sp').prop('required', false);
                    $('#age_sp').prop('required', false);
                    $('#name_sp').prop('required', false);
                    $('#other_sp').prop('required', false);
                } else {
                    $('#sp_container').css('display', 'block');
                    $('#monthly_income_sp').prop('required', true);
                    $('#relevance').prop('required', true);
                    $('#occ_sp').prop('required', true);
                    $('#age_sp').prop('required', true);
                    $('#name_sp').prop('required', true);
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
                    $('#province').selectpicker('val', user.province_id);
                }
            });
        })

    </script>
@endpush
