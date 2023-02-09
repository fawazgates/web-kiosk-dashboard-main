<style>
    td {
        padding-right: 50px;
    }
</style>
<p>{{ session()->get('namakantin') }}</p>
<p>Pelanggan : {{ $transaction['nama_mahasiswa'] }}</p>
<p>Tanggal : {{ date('m-d-Y', strtotime($transaction['waktu_order'])) }}</p>
==========================================

<table>
    @foreach ($transaction['order_detail'] as $product)
        <tr>
            <td>{{ $product['nama_produk'] }}</td>
            <td>{{ $product['jumlah'] }}</td>
            <td>{{ $product['harga_total'] }}</td>
            <td>{{ $product['harga_total'] * $product['jumlah'] }}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="3" align="right">Total Pembelian</td>
        <td>{{ $transaction['total_transaksi'] }}</td>
    </tr>
    <tr>
        <td colspan="3" align="right">Status Pembayaran</td>
        <td>{{ ($transaction['status_pembayaran'] == 0 ? 'Process' : $transaction['status_pembayaran'] == 1) ? 'Paid' : 'Failed' }}
        </td>
    </tr>
    {{-- <tr>
        <td colspan="3" align="right">Kembalian</td>
        <td>{{ $transaction->return }}</td>
    </tr> --}}
</table>
==========================================<br><br>
Terimakasih telah berbelanja. Semoga harimu menyenangkan
