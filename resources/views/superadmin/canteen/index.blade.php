@extends('layouts.template')
@section('content')
    <div class="container-fluid">
        @include('component._dashboard_superadmin')
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 justify-content-between d-flex d-inline">
                <h6 class="m-0 font-weight-bold text-dark"><span class="text-orange-tagar-manual">|</span> Canteen List</h6>
                <span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID Canteen</th>
                                <th>Username</th>
                                <th>Client Name</th>
                                <th>Canteen Name</th>
                                <th>Seller Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($canteens as $canteen)
                                <tr>
                                    <th>{{ $canteen['id_kantin'] }}</th>
                                    <th>{{ $canteen['username'] }}</th>
                                    <th>{{ $canteen['nama_client'] }}</th>
                                    <th>{{ $canteen['nama_kantin'] }}</th>
                                    <th>{{ $canteen['nama_penjual'] }}</th>
                                    <th>{{ $canteen['is_aktif'] == 1 ? 'Open' : 'Close' }}
                                    </th>
                                    <th>
                                        <a href="{{ route('superadmin.canteen.edit', $canteen['id_kantin']) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <a href="#" data-id="{{ $canteen['id_kantin'] }}" data-toggle="modal"
                                            data-target="#delete" class="btn btn-danger btn-sm">Delete</a>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br>
                {{ $canteens->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span class="text-orange-tagar-manual">|</span> Delete
                        canteens</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus Data Kantin ini?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('superadmin.canteen.delete') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id">
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $("#edit").on('show.bs.modal', (e) => {
            var id = $(e.relatedTarget).data('id');
            var name = $(e.relatedTarget).data('name');
            var location = $(e.relatedTarget).data('location');
            var total_transaction = $(e.relatedTarget).data('total_transaction');
            $('#edit').find('input[name="id"]').val(id);
            $('#edit').find('input[name="name"]').val(name);
            $('#edit').find('input[name="location"]').val(location);
            $('#edit').find('input[name="total_transaction"]').val(total_transaction);
        });

        $('#delete').on('show.bs.modal', (e) => {
            var id = $(e.relatedTarget).data('id');
            console.log(id);
            $('#delete').find('input[name="id"]').val(id);
        });
    </script>
@endpush
