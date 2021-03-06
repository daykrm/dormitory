@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">จัดการห้องพัก {{ $dorm->name }}</div>
        <div class="card-body">
            <div class="container">
                <div class="row justify-content-start">
                    <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary">เพิ่ม</button>
                </div>
                <form action="{{ route('dormRoomStore') }}" method="post">
                    @csrf
                    <input type="hidden" name="dorm" value="{{ $dorm->id }}">
                    <div class="row justify-content-start mt-4">
                        <label for="">รายการหอพัก</label>
                        <div class="col-md-12">
                            <div class="row">
                                <select name="rooms[]" id="rooms"
                                    class="selectpicker form-control @error('rooms') is-invalid @enderror"
                                    title="เลือกห้องพัก" data-live-search="true" required multiple data-actions-box="true">
                                    @foreach ($availableRoom as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-2">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <form action="{{ route('room.store') }}" method="post">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มห้องใหม่</h5>
                    <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" name="name" id="new_teacher" placeholder="หมายเลขห้อง เช่น 101"
                        class="form-control" autofocus>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">ปิด</button>
                    <button type="submit" id="add-teacher" class="btn btn-primary">บันทึก</button>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#exampleModal').on('hidden.bs.modal', function() {
                $('#new_teacher').val("");
            })
        })

    </script>
@endpush
