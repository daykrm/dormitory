@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            เพิ่มบุคลากร
        </div>
        <div class="card-body">
            <form action="{{ route('admin.personel.store') }}" method="post">
                <div class="container">
                    @csrf
                    @include('admin.personel.form')
                    <div class="row justify-content-center mt-2">
                        <button type="submit" class="btn btn-outline-primary">บันทึก</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
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
