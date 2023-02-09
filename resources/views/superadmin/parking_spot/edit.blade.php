@extends('layouts.template')
@section('content')
    <div class="container-fluid">
        @include('component._dashboard_superadmin')
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 justify-content-between d-flex d-inline">
                <h6 class="m-0 font-weight-bold text-dark"><span class="text-orange-tagar-manual">|</span> Add New Parking
                    Spot</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <img src="{{ asset('template/img/parking_spot_add.png') }}" style="height:100%;width:100%">
                    </div>
                    <div class="col-lg-6 col-sm-12 my-auto align-items-center">
                        <form action="{{ route('superadmin.parking_spot.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $parkingSpot['id_lokasi_parkir'] }}">
                            <div class="form-group ">
                                <label for="client" class="form-label">Client</label>
                                <select name="id_client" id="client" class="form-control" required>
                                    @forelse($parkingSpot['client'] as $client)
                                        <option value="{{ $client['id_client'] }}"
                                            {{ $client['id_client'] == $parkingSpot['id_client'] ? 'selected' : '' }}>
                                            {{ $client['nama_client'] }}</option>
                                    @empty
                                        <option value="">Client Data Ditemukan</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group ">
                                <label for="name" class="form-label">Parking Spot Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $parkingSpot['nama_lokasi_parkir'] }}" required>
                            </div>
                            <button type="submit" class="btn btn-orange-manual">Update</button>

                            <a href="#" data-id="{{ $parkingSpot['id_lokasi_parkir'] }}" data-toggle="modal"
                                data-target="#delete" class="btn btn-danger btn-sm">Delete</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span class="text-orange-tagar-manual">|</span> Delete
                        Parking Spot</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus Data Parking Spot ini?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('superadmin.parking_spot.delete') }}" method="POST"
                        enctype="multipart/form-data">
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
