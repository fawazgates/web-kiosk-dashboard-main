<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->get('https://gate.bisaai.id:8080/ekiosk_prod/kantin/list_kategori?is_delete=0');
        $categories =  json_decode($response->body(), true)['row_count'];

        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_client?is_delete=0');
        $clients =  json_decode($response->body(), true)['row_count'];

        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_parkir_lokasi?is_delete=0');
        $parkingSpots =  json_decode($response->body(), true)['row_count'];

        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_kantin?is_delete=0');
        $canteens =  json_decode($response->body(), true)['row_count'];
        // $categories = Category::where('is_deleted', '0')->count();
        // $clients = Client::where('is_deleted', '0')->count();
        // $parkingSpots = ParkingSpot::where('is_deleted', '0')->count();
        // $foods = Food::where('is_deleted', '0')->count();
        // $canteens = Canteen::where('is_deleted', '0')->count();
        return view('superadmin.dashboard.index', compact('categories', 'clients', 'parkingSpots', 'canteens'));
    }
}
