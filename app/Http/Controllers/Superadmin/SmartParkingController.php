<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class SmartParkingController extends Controller
{
    public function index()
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_parkir_lokasi?is_delete=0');
        $data =  json_decode($response->body(), true)['data'];
        $parkingSpots = $this->paginate($data);
        $parkingSpots->withPath(route('superadmin.smart_parking.index'));
        return view('superadmin.smart_parking.index', compact('parkingSpots'));
    }

    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
