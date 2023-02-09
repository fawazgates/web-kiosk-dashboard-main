<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class AdminController extends Controller
{
    public function index()
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_user?is_delete=0');
        $data =  json_decode($response->body(), true)['data'];
        $admins = $this->paginate($data);
        $admins->withPath(route('superadmin.admin.index'));
        return view('superadmin.admin.index', compact('admins'));
    }

    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function create()
    {
        return view('superadmin.admin.create');
    }
    public function store(Request $request)
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->post('https://gate.bisaai.id:8080/ekiosk_prod/admin/insert_user', [
            'nama_user' => $request->name,
            'username' => $request->username,
            'password' => $request->password,
            'role' => $request->role,
        ]);
        if ($response->status() == 200) {
            return redirect()->route('superadmin.admin.index')->with('success', 'Data berhasil ditambahkan');
        } else {
            return redirect()->route('superadmin.admin.index')->with('alert', 'Data gagal ditambahkan');
        }
    }

    public function edit($id)
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_user?id_user=' . $id);
        $data =  json_decode($response->body(), true)['data'][0];
        return view('superadmin.admin.edit', ["user" => $data]);
    }
    public function update(Request $request)
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_user?id_user=' . $request->id);
        $data =  json_decode($response->body(), true)['data'][0];

        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->put('https://gate.bisaai.id:8080/ekiosk_prod/admin/update_user', [
            'id_user' => $request->id,
            'username' => $request->username,
            'password' => $request->password ? $request->password : $data['password'],
            'role' => $request->role,
        ]);

        if ($response->status() == 200) {
            return redirect()->route('superadmin.admin.index')->with('success', 'Data berhasil diubah');
        } else {
            return redirect()->route('superadmin.admin.index')->with('alert', 'Data gagal diubah');
        }
    }

    public function delete(Request $request)
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->put('https://gate.bisaai.id:8080/ekiosk_prod/admin/update_user', [
            'id_user' => $request->id,
            'is_delete' => 1,
        ]);
        if ($response->status() == 200) {
            return redirect()->route('superadmin.admin.index')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->route('superadmin.admin.index')->with('alert', 'Data gagal dihapus');
        }
    }
}
