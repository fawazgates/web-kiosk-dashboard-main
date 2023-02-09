@extends('layouts.template')
@section('content')
    <div class="container-fluid">
        @include('component._dashboard_superadmin')
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 justify-content-between d-flex d-inline">
                <h6 class="m-0 font-weight-bold text-dark"><span class="text-orange-tagar-manual">|</span> Canteen List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID Canteen</th>
                                <th>Client Name</th>
                                <th>Canteen Name</th>
                                <th>Seller Name</th>
                                <th>Total Transaction</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($canteens as $canteen)
                                <tr>
                                    <th>{{ $canteen['id_kantin'] }}</th>
                                    <th>{{ $canteen['nama_client'] }}</th>
                                    <th>{{ $canteen['nama_kantin'] }}</th>
                                    <th>{{ $canteen['nama_penjual'] }}</th>
                                    <th>{{ $canteen['total_transaksi'] }}</th>
                                    <th>
                                        <a href="{{ route('superadmin.canteen.edit', $canteen['id_kantin']) }}"
                                            class="btn btn-primary btn-sm">Details</a>
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
@endsection
@push('scripts')
    {{-- <script>
        var select = document.getElementById('q');
        select.addEventListener('change', function() {
            this.form.submit();
        }, false);
    </script> --}}
@endpush
