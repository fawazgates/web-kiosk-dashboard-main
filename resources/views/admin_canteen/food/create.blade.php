@extends('layouts.template')
@section('content')

    <div class="container-fluid">

        @include('component._dashboard_admin_canteen')
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
                <h6 class="m-0 font-weight-bold text-dark"><span class="text-orange-tagar-manual">|</span> Add New Product
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin_canteen.product.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <img src="{{ asset('template/img/default.png') }}" style="height:60%;width:100%">
                            <hr>
                            <div class="form-group ">
                                <label for="image" class="form-label">Product Image</label>
                                <input type="file" class="form-control" id="image" name="image" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 my-auto align-items-center">
                            @csrf
                            <div class="form-group ">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}" required>
                            </div>
                            <div class="form-group ">
                                <label for="category_id" class="form-label">Category Name</label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="">~ Pilih ~</option>
                                    @foreach ($categories as $categorie)
                                        <option value="{{ $categorie['id_kategori'] }}">
                                            {{ $categorie['nama_kategori'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group ">
                                <label for="price" class="form-label">Harga</label>
                                <input type="text" class="form-control" id="price" name="price"
                                    value="{{ old('price') }}" required>
                            </div>
                            <div class="form-group ">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="text" class="form-control" id="quantity" name="quantity"
                                    value="{{ old('quantity') }}" required>
                            </div>
                            <div class="form-group ">
                                <label for="discount" class="form-label">Discount Price (optional)</label>
                                <input type="text" class="form-control" id="discount" name="discount"
                                    value="{{ old('discount') }}">
                            </div>
                            <div class="form-group ">
                                <label for="description" class="form-label">Product Description</label>
                                <input type="text" class="form-control" id="description" name="description" required>
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
