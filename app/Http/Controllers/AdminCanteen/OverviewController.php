<?php

namespace App\Http\Controllers\AdminCanteen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class OverviewController extends Controller
{
    public function index(Request $request)
    {
        $token = session()->get('tokenlogin');
        $id_kantin = session()->get('idkantin');
        $order_by = $request->order_by;
        if ($order_by == 'name') {
            $url = 'https://gate.bisaai.id:8080/ekiosk_prod/kantin/list_filter_produk?abjad=1&id_kantin=' . $id_kantin;
        } else if ($order_by == 'price') {
            $url = 'https://gate.bisaai.id:8080/ekiosk_prod/kantin/list_filter_produk?harga_tinggi=1&id_kantin=' . $id_kantin;
        } else if ($order_by == 'rating') {
            $url = 'https://gate.bisaai.id:8080/ekiosk_prod/kantin/list_filter_produk?rating=1&id_kantin=' . $id_kantin;
        } else {
            $url = 'https://gate.bisaai.id:8080/ekiosk_prod/kantin/list_produk?is_delete=0&id_kantin=' . $id_kantin;
        }
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->get($url);
        $data =  json_decode($response->body(), true)['data'];

        $foods = $this->paginate($data, 6);
        $foods->withPath(route('admin_canteen.overview.index'));
        return view('admin_canteen.overview.index', compact('foods'));
    }

    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function show($productId)
    {
        $token = session()->get('tokenlogin');
        $id_kantin = session()->get('idkantin');

        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->get('https://gate.bisaai.id:8080/ekiosk_prod/kantin/list_produk?is_delete=0&id_kantin=' . $id_kantin . '&id_produk=' . $productId);
        $data =  json_decode($response->body(), true)['data'];
        return view('admin_canteen.overview.show', ['food' => $data]);
    }

    public function statusCanteen(Request $request)
    {
        $token = session()->get('tokenlogin');
        $id_kantin = session()->get('idkantin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->put('https://gate.bisaai.id:8080/ekiosk_prod/admin/update_kantin', [
            'id_kantin' => $id_kantin,
            'is_aktif' => $request->status == "open" ? 1 : 0
        ]);
        return response()->json([
            'message' => json_decode($response->body(), true)['description'],
        ], 200);
    }
}
