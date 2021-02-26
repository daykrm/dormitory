@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            แก้ไขข้อมูลบุคลากร
        </div>
        <div class="card-body">
            <form action="{{route('admin.personel.update',$person)}}" method="post">
                @csrf
                @method('PUT')
                @include('admin.personel.form')
                <div class="row justify-content-center mt-2">
                    <button class="btn btn-outline-primary">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            var dorm = $('#dorm').val();
            var room = JSON.parse('<?php echo $person->dorm->room->id; ?>');
            $("#room").empty();
            var option = '';
            $.ajax({
                /* the route pointing to the post function */
                url: '/getRoom/' + dorm,
                type: 'GET',
                success: function(data) {
                    console.log(data.rooms[0].name)
                    var data = data.rooms;
                    data.forEach(e => {
                        option += '<option value="' + e.id + '">' + e.name +
                            '</option>';
                    });
                    $('#room').append(option);
                    $('#room').val(room);
                    $('#room').selectpicker('refresh');
                }
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
