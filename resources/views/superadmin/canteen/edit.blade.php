@extends('layouts.template')
@section('content')

    <div class="container-fluid">
        @include('component._dashboard_superadmin')
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
        <div class="card shadow mb-4">
            <div class="card-header py-3 justify-content-between d-flex d-inline">
                <h6 class="m-0 font-weight-bold text-dark"><span class="text-orange-tagar-manual">|</span> Edit Canteen</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('superadmin.canteen.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $canteen['id_kantin'] }}"
                        value="{{ $canteen['id_kantin'] }}">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <img src="{{ asset('template/img/parking_spot_add.png') }}" style="height:60%;width:100%">
                            <hr>
                            <div class="form-group ">
                                <label for="seller_photo" class="form-label">Seller Photo <small>*optional ( isi jika ingin
                                        diubah )</small></label>
                                <input type="file" class="form-control" id="seller_photo" name="seller_photo">
                            </div>
                            <div class="form-group ">
                                <label for="canteen_photo" class="form-label">Canteen Photo <small>*optional ( isi jika
                                        ingin diubah )</small></label>
                                <input type="file" class="form-control" id="canteen_photo" name="canteen_photo">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 my-auto align-items-center">
                            <div class="form-group ">
                                <label for="name" class="form-label">Canteen Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $canteen['nama_kantin'] }}" required>
                            </div>
                            <div class="form-group ">
                                <label for="client" class="form-label">Client Name</label>
                                <select name="id_client" id="client" class="form-control" required>
                                    <option value="">~ Pilih ~</option>
                                    @foreach ($canteen['clients'] as $client)
                                        <option value="{{ $client['id_client'] }}"
                                            {{ $client['id_client'] == $canteen['id_client'] ? 'selected' : '' }}>
                                            {{ $client['nama_client'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group ">
                                <label for="location" class="form-label">Open Hours</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="time" class="form-control" id="open_from" name="open_from"
                                            value="{{ $canteen['jam_buka'] }}" required>
                                    </div>
                                    <div class="col-6">
                                        <input type="time" class="form-control" id="open_to" name="open_to"
                                            value="{{ $canteen['jam_tutup'] }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" class="form-control" id="description" name="description"
                                    value="{{ $canteen['deskripsi_kantin'] }}" required>
                            </div>
                            <div class="form-group ">
                                <label for="seller_name" class="form-label">Seller Name</label>
                                <input type="text" class="form-control" id="seller_name" name="seller_name"
                                    value="{{ $canteen['nama_penjual'] }}" required>
                            </div>
                            <div class="form-group ">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    value="{{ $canteen['username'] }}" required>
                            </div>
                            <div class="form-group ">
                                <label for="password" class="form-label">Password <small>*optional ( isi jika ingin diubah
                                        )</small></label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <button type="submit" class="btn btn-orange-manual">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#delete').on('show.bs.modal', (e) => {
            var id = $(e.relatedTarget).data('id');
            console.log(id);
            $('#delete').find('input[name="id"]').value = "{{ $canteen['id_kantin'] }}"
            val(id);
        });
    </script>
@endpush
