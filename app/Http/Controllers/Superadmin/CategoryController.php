<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryController extends Controller
{
    public function index()
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->get('https://gate.bisaai.id:8080/ekiosk_prod/kantin/list_kategori?is_delete=0');
        $data =  json_decode($response->body(), true)['data'];
        $categories = $this->paginate($data);
        $categories->withPath(route('superadmin.category.index'));
        return view('superadmin.category.index', compact('categories'));
    }

    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function create()
    {
        return view('superadmin.category.create');
    }
    public function store(Request $request)
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->post('https://gate.bisaai.id:8080/ekiosk_prod/admin/insert_kategori', [
            'nama_kategori' => $request->name,
            'deskripsi_kategori' => $request->description,
            'foto_kategori' => base64_encode(file_get_contents($request->file('image')->getRealPath())),
        ]);
        if ($response->status() == 200) {
            return redirect()->route('superadmin.category.index')->with('success', 'Data berhasil ditambahkan');
        } else {
            $error = json_decode($response->body(), true)['description'];
            return redirect()->route('superadmin.category.index')->with('alert', $error);
        }
    }

    public function edit($id)
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/list_kategori?id_kategori=' . $id);
        $data =  json_decode($response->body(), true)['data'][0];
        return view('superadmin.category.edit', ['category' => $data]);
    }
    public function update(Request $request)
    {
        $update = [
            'id_kategori' => $request->id,
            'nama_kategori' => $request->name,
            'deskripsi_kategori' => $request->description,
        ];
        if ($request->image) $update += ['foto_kategori' => base64_encode(file_get_contents($request->file('image')->getRealPath()))];
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->put('https://gate.bisaai.id:8080/ekiosk_prod/admin/update_kategori', $update);

        if ($response->status() == 200) {
            return redirect()->route('superadmin.category.index')->with('success', 'Data berhasil diubah');
        } else {
            $error = json_decode($response->body(), true)['description'];
            return redirect()->route('superadmin.category.index')->with('alert', $error);
        }
    }

    public function delete(Request $request)
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->put('https://gate.bisaai.id:8080/ekiosk_prod/admin/update_kategori', [
            'id_kategori' => $request->id,
            'is_delete' => 1,
        ]);
        if ($response->status() == 200) {
            return redirect()->route('superadmin.category.index')->with('success', 'Data berhasil dihapus');
        } else {
            $error = json_decode($response->body(), true)['description'];
            return redirect()->route('superadmin.category.index')->with('alert', $error);
        }
    }
}
