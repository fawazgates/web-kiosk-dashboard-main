<?php

namespace App\Http\Controllers\AdminCanteen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ReportController extends Controller
{
    public function index()
    {
        $token = session()->get('tokenlogin');
        $id_kantin = session()->get('idkantin');

        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_order?is_delete=0&id_kantin=' . $id_kantin);
        $data =  json_decode($response->body(), true)['data'];

        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_order?is_delete=0&id_kantin=' . $id_kantin);
        $data =  json_decode($response->body(), true)['data'];

        $transactions = $this->paginate($data);
        $transactions->withPath(route('admin_canteen.report.index'));
        return view('admin_canteen.report.index', compact('transactions'));
    }

    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function show($id)
    {
        $token = session()->get('tokenlogin');
        $id_kantin = session()->get('idkantin');

        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_order?is_delete=0&id_kantin=' . $id_kantin . '&id_invoice=' . $id);
        $transaction =  json_decode($response->body(), true)['data'][0];
        return view('admin_canteen.report.show', compact('transaction'));
    }

    // public function print($id)
    // {
    //     $token = session()->get('tokenlogin');
    //     $id_kantin = session()->get('idkantin');
    //     $response = Http::withHeaders([
    //         'Authorization' => 'JWT ' . $token['access_token'],
    //     ])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_order?is_delete=0&id_kantin=' . $id_kantin . '&id_invoice=' . $id);
    //     $transaction =  json_decode($response->body(), true)['data'][0];

    //     return view('admin_canteen.report.print', compact('transaction'));
    // }

    public function getPager(Request $request)
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_pager?is_delete=0&is_pakai=0&id_client=' . $request->id);
        $data = json_decode($response->body(), true)['data'];
        return response()->json([
            'message' => 'Success',
            'data' => $data
        ], 200);
    }

    public function updatePager(Request $request)
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->put('https://gate.bisaai.id:8080/ekiosk_prod/admin/update_order', [
            'id_order' => $request->id_order,
            'id_pager' => $request->id_pager
        ]);
        return response()->json([
            'message' => json_decode($response->body(), true)['description'],
        ], 200);
    }

    public function updateTaken(Request $request)
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->put('https://gate.bisaai.id:8080/ekiosk_prod/admin/update_order', [
            'id_order' => $request->id_order,
            'is_pengambilan' => $request->is_pengambilan
        ]);
        $message = json_decode($response->body(), true)['description'];
        if ($response->status() == 200) {
            return response()->json([
                'status' => true,
                'message' => $message,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => $message,
            ]);
        }
    }

    public function updateNotif(Request $request)
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->put('https://gate.bisaai.id:8080/ekiosk_prod/admin/update_order', [
            'id_order' => $request->id_order,
            'notif' => $request->notif
        ]);
        $message = json_decode($response->body(), true)['description'];
        if ($response->status() == 200) {
            return response()->json([
                'status' => true,
                'message' => $message,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => $message,
            ]);
        }
    }
    public function delete(Request $request)
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->put('https://gate.bisaai.id:8080/ekiosk_prod/admin/update_order', [
            'id_order' => $request->id,
            'is_delete' => 1,
        ]);
        if ($response->status() == 200) {
            return redirect()->route('admin_canteen.report.index')->with('success', 'Data berhasil dihapus');
        } else {
            $error = json_decode($response->body(), true)['description'];
            return redirect()->route('admin_canteen.report.index')->with('alert', $error);
        }
    }
}
