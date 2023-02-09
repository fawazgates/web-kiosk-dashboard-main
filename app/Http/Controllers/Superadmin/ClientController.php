<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ClientController extends Controller
{
    public function index()
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_client?is_delete=0');
        $data =  json_decode($response->body(), true)['data'];
        $clients = $this->paginate($data);
        $clients->withPath(route('superadmin.client.index'));

        return view('superadmin.client.index', compact('clients'));
    }

    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function blank()
    {
        return view('superadmin.client.blank');
    }
    public function create()
    {
        return view('superadmin.client.create');
    }
    public function store(Request $request)
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->post('https://gate.bisaai.id:8080/ekiosk_prod/admin/insert_client', [
            'nama_client' => $request->name,
            'deskripsi_client' => $request->description,
            'is_smart_canteen' => $request->smart_canteen ? '1' : '0',
            'is_smart_parking' => $request->smart_parking ? '1' : '0',
            'is_perpus_peminjaman' => $request->perpus_peminjaman ? '1' : '0',
        ]);
        if ($response->status() == 200) {
            return redirect()->route('superadmin.client.index')->with('success', 'Data berhasil ditambahkan');
        } else {
            $error = json_decode($response->body(), true)['description'];
            return redirect()->route('superadmin.client.index')->with('alert', $error);
        }
    }

    public function edit($id)
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_client?id_client=' . $id);
        $data =  json_decode($response->body(), true)['data'][0];
        return view('superadmin.client.edit', ["client" => $data]);
    }
    public function update(Request $request)
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->put('https://gate.bisaai.id:8080/ekiosk_prod/admin/update_client', [
            'id_client' => $request->id,
            'nama_client' => $request->name,
            'deskripsi_client' => $request->description,
            'is_smart_canteen' => $request->smart_canteen ? '1' : '0',
            'is_smart_parking' => $request->smart_parking ? '1' : '0',
            'is_perpus_peminjaman' => $request->perpus_peminjaman ? '1' : '0',
        ]);
        if ($response->status() == 200) {
            return redirect()->route('superadmin.client.index')->with('success', 'Data berhasil diubah');
        } else {
            $error = json_decode($response->body(), true)['description'];
            return redirect()->route('superadmin.client.index')->with('alert', $error);
        }
    }

    public function delete(Request $request)
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->put('https://gate.bisaai.id:8080/ekiosk_prod/admin/update_client', [
            'id_client' => $request->id,
            'is_delete' => 1,
        ]);
        if ($response->status() == 200) {
            return redirect()->route('superadmin.client.index')->with('success', 'Data berhasil dihapus');
        } else {
            $error = json_decode($response->body(), true)['description'];
            return redirect()->route('superadmin.client.index')->with('alert', $error);
        }
    }
}
