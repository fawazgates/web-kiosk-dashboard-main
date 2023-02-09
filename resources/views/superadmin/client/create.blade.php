@extends('layouts.template')
@section('content')

    <div class="container-fluid">
        {{-- @include('component._dashboard_superadmin') --}}
        <!-- DataTales Example -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 justify-content-between d-flex d-inline">
                <h6 class="m-0 font-weight-bold text-dark"><span class="text-orange-tagar-manual">|</span> Add New Client</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <img src="{{ asset('template/img/add_new_client.png') }}" style="height:100%;width:100%">
                    </div>
                    <div class="col-lg-6 col-sm-12 my-auto align-items-center">
                        <form action="{{ route('superadmin.client.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group ">
                                <label for="name" class="form-label">Client Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}" required>
                            </div>
                            <div class="form-group ">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="{{ old('address') }}" required>
                            </div>
                            <div class="form-group ">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" class="form-control" id="description" name="description"
                                    value="{{ old('description') }}" required>
                            </div>
                            <div class="form-group ">
                                <label for="service" class="form-label">Service</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="checkbox" id="smart_parking" name="smart_parking">
                                        <label for="smart_parking">Smart Parking</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="checkbox" id="smart_canteen" name="smart_canteen">
                                        <label for="smart_canteen">Smart Canteen</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="checkbox" id="perpus_peminjaman" name="perpus_peminjaman">
                                        <label for="perpus_peminjaman">Perpus Peminjam</label>
                                    </div>
                                </div>
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
        $('#delete').on('show.bs.modal', (e) => {
            var id = $(e.relatedTarget).data('id');
            console.log(id);
            $('#delete').find('input[name="id"]').val(id);
        });
    </script>
@endpush
