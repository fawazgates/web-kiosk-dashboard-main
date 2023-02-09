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
                <h6 class="m-0 font-weight-bold text-dark"><span class="text-orange-tagar-manual">|</span> Add New Canteen
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('superadmin.canteen.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <img src="{{ asset('template/img/canteen.png') }}" style="height:60%;width:100%">
                            <hr>
                            <div class="form-group ">
                                <label for="seller_photo" class="form-label">Seller Photo</label>
                                <input type="file" class="form-control" id="seller_photo" name="seller_photo" required>
                            </div>
                            <div class="form-group ">
                                <label for="canteen_photo" class="form-label">Canteen Photo</label>
                                <input type="file" class="form-control" id="canteen_photo" name="canteen_photo" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 my-auto align-items-center">
                            @csrf
                            <div class="form-group ">
                                <label for="name" class="form-label">Canteen Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}" required>
                            </div>
                            <div class="form-group ">
                                <label for="client" class="form-label">Client Name</label>
                                <select name="id_client" id="client" class="form-control" required>
                                    <option value="">~ Pilih ~</option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client['id_client'] }}">{{ $client['nama_client'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group ">
                                <label for="location" class="form-label">Open Hours</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="time" class="form-control" id="open_from" name="open_from"
                                            value="{{ old('open_from') }}" required>
                                    </div>
                                    <div class="col-6">
                                        <input type="time" class="form-control" id="open_to" name="open_to"
                                            value="{{ old('open_to') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" class="form-control" id="description" name="description"
                                    value="{{ old('description') }}" required>
                            </div>
                            <div class="form-group ">
                                <label for="seller_name" class="form-label">Seller Name</label>
                                <input type="text" class="form-control" id="seller_name" name="seller_name"
                                    value="{{ old('seller_name') }}" required>
                            </div>
                            <div class="form-group ">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    value="{{ old('username') }}" required>
                            </div>
                            <div class="form-group ">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-orange-manual">Add</button>
                        </div>
                    </div>
                </form>
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
