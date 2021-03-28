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
                    <button class="btn btn-success">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

        })

    </script>
@endpush
