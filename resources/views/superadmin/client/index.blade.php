@extends('layouts.template')
@section('content')
    <div class="container-fluid">
        @include('component._dashboard_client')
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 justify-content-between d-flex d-inline">
                <h6 class="m-0 font-weight-bold text-dark"><span class="text-orange-tagar-manual">|</span> Client List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Smart Parking</th>
                                <th>Smart Canteen</th>
                                <th>Perpus Peminjam</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                                <tr>
                                    <th>{{ $client['id_client'] }}</th>
                                    <th>{{ $client['nama_client'] }}</th>
                                    <th><input type="checkbox" disabled
                                            {{ $client['is_smart_parking'] ? 'checked' : '' }}></th>
                                    <th><input type="checkbox" disabled
                                            {{ $client['is_smart_canteen'] ? 'checked' : '' }}></th>
                                    <th><input type="checkbox" disabled
                                            {{ $client['is_perpus_peminjaman'] ? 'checked' : '' }}></th>
                                    <th>
                                        <a href="{{ route('superadmin.client.edit', $client['id_client']) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <a href="#" data-id="{{ $client['id_client'] }}" data-toggle="modal"
                                            data-target="#delete" class="btn btn-danger btn-sm">Delete</a>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br>
                {{ $clients->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span class="text-orange-tagar-manual">|</span> Delete
                        clients</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus Data Klien ini?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('superadmin.client.delete') }}" method="POST" enctype="multipart/form-data">
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
        $('#delete').on('show.bs.modal', (e) => {
            var id = $(e.relatedTarget).data('id');
            console.log(id);
            $('#delete').find('input[name="id"]').val(id);
        });
    </script>
@endpush
