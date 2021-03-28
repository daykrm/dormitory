@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between">
                <div class="col-md-2"></div>
                <div class="col-md-8">รายชื่อผู้กรอกใบสมัคร{{ $dorm->name }}</div>
                <div class="col-md-2">
                    <a target="_blank" href="{{ route('showValidate', $dorm->id) }}" class="btn btn-light">พิมพ์</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="container">
                <div class="row justify-content-end mb-2">
                    <div class="col-md-4">
                        <input type="text" id="filter" class="form-control" placeholder="รหัสนักศึกษา">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>รหัสนักศึกษา</th>
                                <th>ชื่อ - สกุล</th>
                                <th>คณะ</th>
                                <th>ชั้นปี</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="table">
                            @foreach ($apps as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->student->username }}</td>
                                    <td>{{ $item->student->prefix->name }}{{ $item->student->name }}</td>
                                    <td>{{ $item->student->faculty->name }}</td>
                                    <td>{{ $item->student->year() }}</td>
                                    <td class="text-right">
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#confirmDelete"
                                            data-id="{{ $item->id }}">ลบ</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- <div class="row justify-content-end mt-4">
                    {{ $apps->links() }}
                </div> --}}
            </div>
        </div>
    </div>
@endsection

<div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel">ยืนยันการลบ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="delete-form" action="{{ url('/') }}" method="POST">
                    @method('delete')
                    @csrf
                    <input type="hidden" class="form-control" id="app_id">
                    <div class="row justify-content-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success ml-2">ตกลง</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- <div id="confirmDelete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirmDelete"
    style="display: block; padding-right: 16px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    <h5 class="modal-title">ยืนยันการลบ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <h5>ยืนยันการลบข้อมูล ?</h5>
                </div>
                <form action="#" method="post">
                    <input type="text" name="id" id="app_id">
                    <div class="row justify-content-center">
                        <button type="button" data-dismiss="modal" class="btn btn-primary">ตกลง</button>
                        <button type="button" data-dismiss="modal" class="btn ml-2">ยกเลิก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#confirmDelete').on('show.bs.modal', function(e) {
                var btn = $(e.relatedTarget)
                var id = btn.data('id')
                $('#app_id').val(id)
                var action = $('#delete-form').attr('action');
                console.log(action);
                $('#delete-form').attr('action', action + '/application/' + id)
            })

            $('#filter').on('keyup', function() {
                var value = $(this).val();
                $('#table tr').filter(function() {
                    $(this).toggle($(this).text().indexOf(value) > -1)
                })
            })
        })

    </script>
@endpush
