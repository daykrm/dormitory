@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">เลือกหอพัก</div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <select name="dorm" id="dorm" class="form-control">
                        @if (Auth::guard('personel')->check())
                            @foreach (Auth::guard('personel')->user()->dorms as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        @else
                            @foreach ($dorms as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <form action="#" id="form-search" method="get"></form>
            <div class="row justify-content-center mt-2">
                <button class="btn btn-primary" type="button" id="submit">ค้นหา</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#submit').click(function() {
                var dormId = $('#dorm').val();
                if (dormId === "") {
                    alert('กรุณาเลือกหอพัก')
                    return false;
                }
                $('#form-search').attr('action', '/application/showall/' + dormId)
                $('#form-search').submit()
            })
        })

    </script>
@endpush
