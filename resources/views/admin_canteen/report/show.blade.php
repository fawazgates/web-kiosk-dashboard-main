@extends('layouts.template')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="container-fluid">
                            <div class="row justify-content-between d-flex d-inline">
                                <h5 class="m-0 font-weight-bold text-dark"><span class="text-orange-tagar-manual">|</span>
                                    Order Detail</h6>
                                    <hr>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-between d-inline d-flex">
                            <div class="col-6">
                                <table>
                                    <tr>
                                        <td>Student Name</td>
                                        <td>:</td>
                                        <td>{{ $transaction['nama_mahasiswa'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Invoice Number</td>
                                        <td>:</td>
                                        <td>{{ $transaction['nomor_invoice'] }}</td>
                                    </tr>

                                    <tr>
                                        <td>Order Number</td>
                                        <td> : </td>
                                        <td> {{ $transaction['nomor_order'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Kantin</td>
                                        <td>:</td>
                                        <td>{{ session()->get('namakantin') }}</td>
                                    <tr>
                                    <tr>
                                        <td>Order Item</td>
                                        <td>:</td>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Total</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($transaction['order_detail'] as $key => $product)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $product['nama_produk'] }}</td>
                                                <td>{{ $product['jumlah'] }}</td>
                                                <td>@currency($product['harga_total'])</td>
                                                <td>@currency($product['harga_total'] * $product['jumlah'])</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="4" align="right"><b>Total Pembelian</b></td>
                                            <td>@currency($transaction['total_transaksi'])</td>
                                        </tr>
                                        {{-- <tr>
                                            <td colspan="4" align="right"><b>Total</b></td>
                                            <td>@currency($transaction->pay)</td>
                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div>
                            <div class="row justify-content-between d-inline d-flex">
                                <div class="col-6">
                                    <table>
                                        <td>Payment Method</td>
                                        <td>:</td>
                                        <td>{{ $transaction['metode_pembayaran'] }}</td>
                                        </tr>

                                        <td>Payment Status</td>
                                        <td>:</td>
                                        <td>{{ ($transaction['status_pembayaran'] == 0 ? 'Process' : $transaction['status_pembayaran'] == 1) ? 'Paid' : 'Failed' }}
                                        </td>
                                        </tr>

                                        <td>Date Order</td>
                                        <td> : </td>
                                        <td>{{ date('m-d-Y', strtotime($transaction['waktu_order'])) }}</td>
                                        </tr>
                                    </table>
                                    <br>

                                    <a style="background-color: orange;color: white"
                                        href="{{ route('admin_canteen.report.index') }}" class="btn">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
