<?php

namespace App\Http\Controllers\AdminCanteen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin_canteen.food.add');
    }
    public function create()
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->get('https://gate.bisaai.id:8080/ekiosk_prod/kantin/list_kategori?is_delete=0');
        $data =  json_decode($response->body(), true)['data'];

        return view('admin_canteen.food.create', ['categories' => $data]);
    }
    public function edit($id)
    {
        $token = session()->get('tokenlogin');
        $id_kantin = session()->get('idkantin');

        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->get('https://gate.bisaai.id:8080/ekiosk_prod/kantin/list_produk?is_deleted=0&id_kantin=' . $id_kantin . '&id_produk=' . $id);
        $data =  json_decode($response->body(), true)['data'][0];

        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->get('https://gate.bisaai.id:8080/ekiosk_prod/kantin/list_kategori?is_deleted=0');
        $data +=  ['categories' => json_decode($response->body(), true)['data']];

        return view('admin_canteen.food.edit', ['food' => $data]);
    }
    public function store(Request $request)
    {
        $token = session()->get('tokenlogin');
        $id_kantin = session()->get('idkantin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->post('https://gate.bisaai.id:8080/ekiosk_prod/admin/insert_produk', [
            "id_kantin" =>  $id_kantin,
            "id_kategori" => $request->category_id,
            "nama_produk" => $request->name,
            "deskripsi_produk" => $request->description,
            "harga" => $request->price,
            "harga_diskon" => $request->discount,
            "jumlah_stok" => $request->quantity,
            "foto_produk" => base64_encode(file_get_contents($request->file('image')->getRealPath())),
            "is_diskon" => $request->discount > 0 ? 1 : 0
        ]);
        if ($response->status() == 200) {
            return redirect()->route('admin_canteen.overview.index')->with('success', 'Data berhasil ditambahkan');
        } else {
            $error = json_decode($response->body(), true)['description'];
            return redirect()->route('admin_canteen.overview.index')->with('alert', $error);
        }
    }

    public function update(Request $request)
    {
        $id_kantin = session()->get('idkantin');
        $update = [
            "id_produk" => $request->id,
            "id_kantin" =>  $id_kantin,
            "id_kategori" => $request->category_id,
            "nama_produk" => $request->name,
            "deskripsi_produk" => $request->description,
            "harga" => $request->price,
            "harga_diskon" => $request->discount,
            "jumlah_stok" => $request->quantity,
            "is_diskon" => $request->discount > 0 ? 1 : 0
        ];
        if ($request->image) $update += ['foto_produk' => base64_encode(file_get_contents($request->file('image')->getRealPath()))];
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->put('https://gate.bisaai.id:8080/ekiosk_prod/admin/update_produk', $update);
        if ($response->status() == 200) {
            return redirect()->route('admin_canteen.overview.index')->with('success', 'Data berhasil diubah');
        } else {
            $error = json_decode($response->body(), true)['description'];
            return redirect()->route('admin_canteen.overview.index')->with('alert', $error);
        }
    }
    public function delete(Request $request)
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->put('https://gate.bisaai.id:8080/ekiosk_prod/admin/update_produk', [
            'id_produk' => $request->id,
            'is_delete' => 1,
        ]);
        if ($response->status() == 200) {
            return redirect()->route('admin_canteen.overview.index')->with('success', 'Data berhasil dihapus');
        } else {
            $error = json_decode($response->body(), true)['description'];
            return redirect()->route('admin_canteen.overview.index')->with('alert', $error);
        }
    }
}
