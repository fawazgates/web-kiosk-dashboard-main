@extends('layouts.template')
@section('content')
    <div class="container-fluid">
        @include('component._dashboard_admin_canteen')

        <div class="row">
            <div class="col-12 col-md-10 mh-100">
                <div class="card shadow h-100">
                    <div class="card-header justify-content-between d-flex d-inline  my-auto align-items-center">
                        <span>
                            <h5 class="m-0 font-weight-bold text-dark"><span class="text-orange-tagar-manual">|</span>
                                Products of Kantin</h5>
                        </span>
                        <span>
                            <form action="{{ route('admin_canteen.overview.index') }}" method="get">
                                <select name="order_by" id="order_by" class="form-control">
                                    <option value="name" {{ request()->get('order_by') == 'name' ? 'selected' : '' }}>
                                        Nama</option>
                                    <option value="price" {{ request()->get('order_by') == 'price' ? 'selected' : '' }}>
                                        Harga</option>
                                    <option value="rating" {{ request()->get('order_by') == 'rating' ? 'selected' : '' }}>
                                        Rating</option>
                                </select>
                            </form>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3 mb-3">
            @foreach ($foods as $food)
                <div class="col-lg-4 col-sm-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="m-0 font-weight-bold text-dark"><span class="text-orange-tagar-manual">|</span>
                                {{ $food['nama_produk'] }}</h5>
                        </div>
                        <img class="card-img-top"
                            src="{{ $food['foto_produk'] ? url('https://gate.bisaai.id:8080/ekiosk_prod/kantin/media/foto_produk/' . $food['foto_produk']) : asset('template/img/default.png') }}"
                            style="height: 200px;">
                        <div class="card-body">
                            <p class="card-text">{{ $food['deskripsi_produk'] }}</p>
                            <h5 class="card-title text-primary font-weight-bold">Rp. @currency($food['harga'])</h5>
                            <a href="{{ route('admin_canteen.product.edit', [$food['id_produk'], 'type=show']) }}"
                                class="btn btn-primary btn-sm">Detail</a>
                            <a href="{{ route('admin_canteen.product.edit', $food['id_produk']) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <br>
        {{ $foods->links('pagination::bootstrap-4') }}
    </div>
@endsection

@push('scripts')
    <script>
        $('#order_by').on('change', function() {
            $(this).closest('form').submit();

        });
    </script>
@endpush
