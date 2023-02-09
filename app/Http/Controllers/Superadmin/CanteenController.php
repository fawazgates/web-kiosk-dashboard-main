<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


class CanteenController extends Controller
{
    public function index()
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_kantin?is_delete=0');
        $data =  json_decode($response->body(), true)['data'];
        $canteens = $this->paginate($data);
        $canteens->withPath(route('superadmin.canteen.index'));
        return view('superadmin.canteen.index', compact('canteens'));
    }

    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function create()
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_client?is_delete=0');
        $data =  json_decode($response->body(), true)['data'];

        return view('superadmin.canteen.create',  ["clients" => $data]);
    }
    public function store(Request $request)
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->post('https://gate.bisaai.id:8080/ekiosk_prod/admin/insert_kantin', [
            'id_client' => $request->id_client,
            'nama_user' => $request->seller_name,
            'username' => $request->username,
            'password' => $request->password,
            'nama_kantin' => $request->name,
            'deskripsi_kantin' => $request->description,
            'jam_buka' => $request->open_from,
            'jam_tutup' => $request->open_to,
            'foto_user' => base64_encode(file_get_contents($request->file('seller_photo')->getRealPath())),
            'foto_kantin' => base64_encode(file_get_contents($request->file('canteen_photo')->getRealPath())),
        ]);
        if ($response->status() == 200) {
            return redirect()->route('superadmin.canteen.index')->with('success', 'Data berhasil ditambahkan');
        } else {
            $error = json_decode($response->body(), true)['description'];
            return redirect()->route('superadmin.canteen.index')->with('alert', $error);
        }
    }

    public function edit($id)
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_kantin?id_kantin=' . $id);
        $data =  json_decode($response->body(), true)['data'][0];

        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_client?is_deleted=0');
        $data +=  ['clients' => json_decode($response->body(), true)['data']];

        return view('superadmin.canteen.edit', ['canteen' => $data]);
    }
    public function update(Request $request)
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_kantin?id_kantin=' . $request->id);
        $data =  json_decode($response->body(), true)['data'][0];
        $update = [
            'id_kantin' => $request->id,
            'id_client' => $request->id_client,
            'nama_user' => $request->seller_name,
            'username' => $request->username,
            'password' => $request->password ? $request->password : $data['password'],
            'nama_kantin' => $request->name,
            'deskripsi_kantin' => $request->description,
            'jam_buka' => $request->open_from,
            'jam_tutup' => $request->open_to,
        ];
        if ($request->seller_photo) $update += ['foto_user' => base64_encode(file_get_contents($request->file('seller_photo')->getRealPath()))];
        if ($request->canteen_photo) $update += ['foto_kantin' => base64_encode(file_get_contents($request->file('canteen_photo')->getRealPath()))];

        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->put('https://gate.bisaai.id:8080/ekiosk_prod/admin/update_kantin', $update);

        if ($response->status() == 200) {
            return redirect()->route('superadmin.canteen.index')->with('success', 'Data berhasil diubah');
        } else {
            $error = json_decode($response->body(), true)['description'];
            return redirect()->route('superadmin.canteen.index')->with('alert', $error);
        }
    }

    public function delete(Request $request)
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->put('https://gate.bisaai.id:8080/ekiosk_prod/admin/update_kantin', [
            'id_kantin' => $request->id,
            'is_delete' => 1,
        ]);
        if ($response->status() == 200) {
            return redirect()->route('superadmin.canteen.index')->with('success', 'Data berhasil dihapus');
        } else {
            $error = json_decode($response->body(), true)['description'];
            return redirect()->route('superadmin.canteen.index')->with('alert', $error);
        }
    }
}
