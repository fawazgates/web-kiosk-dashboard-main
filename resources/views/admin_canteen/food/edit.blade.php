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
                <h6 class="m-0 font-weight-bold text-dark"><span class="text-orange-tagar-manual">|</span> Edit Product</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin_canteen.product.update') }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $food['id_produk'] }}">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <img src="{{ $food['foto_produk'] ? url('https://gate.bisaai.id:8080/ekiosk_prod/kantin/media/foto_produk/' . $food['foto_produk']) : asset('template/img/default.png') }}"
                                style="height:60%;width:100%">
                            <hr>
                            @if (!request()->type)
                                <div class="form-group ">
                                    <label for="image" class="form-label">Product Image (optional)</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-6 col-sm-12 my-auto align-items-center">
                            @csrf
                            <div class="form-group ">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $food['nama_produk'] }}" required>
                            </div>
                            <div class="form-group ">
                                <label for="category_id" class="form-label">Category Name</label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="">~ Pilih ~</option>
                                    @foreach ($food['categories'] as $category)
                                        <option value="{{ $category['id_kategori'] }}"
                                            {{ $food['id_kategori'] == $category['id_kategori'] ? 'selected' : '' }}>
                                            {{ $category['nama_kategori'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group ">
                                <label for="price" class="form-label">Harga</label>
                                <input type="text" class="form-control" id="price" name="price"
                                    value="{{ $food['harga'] }}" required>
                            </div>
                            <div class="form-group ">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="text" class="form-control" id="quantity" name="quantity"
                                    value="{{ $food['jumlah_stok'] }}" required>
                            </div>
                            <div class="form-group ">
                                <label for="discount" class="form-label">Discount Price (optional)</label>
                                <input type="text" class="form-control" id="discount" name="discount"
                                    value="{{ $food['harga_diskon'] }}">
                            </div>
                            <div class="form-group ">
                                <label for="description" class="form-label">Product Description</label>
                                <input type="text" class="form-control" id="description" name="description"
                                    value="{{ $food['deskripsi_produk'] }}" required>
                            </div>
                            @if (!request()->type)
                                <button type="submit" class="btn btn-orange-manual">Update</button>
                            @endif
                            <a href="#" data-id="{{ $food['id_produk'] }}" data-toggle="modal"
                                data-target="#delete" class="btn btn-danger btn-sm">Delete</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span class="text-orange-tagar-manual">|</span> Delete
                        Product</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus Data Produk ini?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('admin_canteen.product.delete') }}" method="POST"
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
