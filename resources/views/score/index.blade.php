@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            บันทึกการเข้าร่วมกิจกรรม
        </div>
        <div class="card-body">
            <div class="container">
                <div>
                    <select id="ac" name="ac" class="selectpicker form-control" title="เลือกกิจกรรม"
                        data-live-search="true">
                        @foreach ($activities as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <div class="row justify-content-center">
                    <form id="form-search" action="#" method="GET">
                        <button type="submit" class="btn btn-primary">ตกลง</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#ac').change(function() {
                //alert(this.value)
                $('#form-search').attr('action', '/createScore/' + this.value);
                //$('#form-search').submit();
            })
        })

    </script>

@endpush
