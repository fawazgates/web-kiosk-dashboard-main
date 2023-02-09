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
                        <form action="{{ route('superadmin.parking_spot.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group ">
                                <label for="client" class="form-label">Client</label>
                                <select name="id_client" id="client" class="form-control" required>
                                    <option value="">~ Pilih ~</option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client['id_client'] }}">{{ $client['nama_client'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group ">
                                <label for="name" class="form-label">Parking Spot Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <button type="submit" class="btn btn-orange-manual">Add</button>
                        </form>
                    </div>
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
