<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ParkingSpotController extends Controller
{
    public function index()
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_parkir_lokasi?is_delete=0');
        $data =  json_decode($response->body(), true)['data'];
        $parkingSpots = $this->paginate($data);
        $parkingSpots->withPath(route('superadmin.parking_spot.index'));
        return view('superadmin.parking_spot.index', compact('parkingSpots'));
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
        return view('superadmin.parking_spot.create', ["clients" => $data]);
    }
    public function store(Request $request)
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->post('https://gate.bisaai.id:8080/ekiosk_prod/admin/insert_parkir_lokasi', [
            'id_client' => $request->id_client,
            'nama_lokasi_parkir' => $request->name,
        ]);
        if ($response->status() == 200) {
            return redirect()->route('superadmin.parking_spot.index')->with('success', 'Data berhasil ditambahkan');
        } else {
            return redirect()->route('superadmin.parking_spot.index')->with('alert', 'Data gagal ditambahkan');
        }
    }

    public function edit($id)
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_parkir_lokasi?id_lokasi_parkir=' . $id);
        $data =  json_decode($response->body(), true)['data'][0];

        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_client?is_deleted=0');
        $data +=  ['client' => json_decode($response->body(), true)['data']];
        return view('superadmin.parking_spot.edit', ['parkingSpot' => $data]);
    }
    public function update(Request $request)
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->put('https://gate.bisaai.id:8080/ekiosk_prod/admin/update_parkir_lokasi', [
            'id_lokasi_parkir' => $request->id,
            'id_client' => $request->id_client,
            'nama_lokasi_parkir' => $request->name,
        ]);

        if ($response->status() == 200) {
            return redirect()->route('superadmin.parking_spot.index')->with('success', 'Data berhasil diubah');
        } else {
            return redirect()->route('superadmin.parking_spot.index')->with('alert', 'Data gagal diubah');
        }
    }

    public function delete(Request $request)
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->put('https://gate.bisaai.id:8080/ekiosk_prod/admin/update_parkir_lokasi', [
            'id_lokasi_parkir' => $request->id,
            'is_delete' => 1,
        ]);
        if ($response->status() == 200) {
            return redirect()->route('superadmin.parking_spot.index')->with('success', 'Data berhasil dihapus');
        } else {
            $error = json_decode($response->body(), true)['description'];
            return redirect()->route('superadmin.parking_spot.index')->with('alert', $error);
        }
    }
}
