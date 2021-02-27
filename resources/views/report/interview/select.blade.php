@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">การจัดการคะแนนสัมภาษณ์</div>
        <div class="card-body">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <select name="dorm" id="dorm" class="form-control" required>
                            <option value="">เลือกหอพัก</option>
                            @foreach ($dorms as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row justify-content-center mt-2">
                    <button type="button" id="submit" class="btn btn-outline-primary">เลือก</button>
                </div>
            </div>
            <form action="#" id="form-search" method="GET"></form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#submit').click(function() {
                console.log('test');
                var dormId = $('#dorm').val();
                if (dormId === "") {
                    alert('กรุณาเลือกหอพัก')
                    return false;
                }
                console.log(dormId);
                $('#form-search').attr('action', '/report/interview/' + dormId)
                console.log($('#form-search').attr('action'));
                $('#form-search').submit()
            })
        })

    </script>
@endpush
