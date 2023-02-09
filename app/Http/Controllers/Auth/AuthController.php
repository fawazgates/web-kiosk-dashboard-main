<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function index()
    {
        if (session()->exists('tokenlogin')) {
            $token = session()->get('tokenlogin');
            $credential = Http::withHeaders([
                'Authorization' => 'JWT ' . $token['access_token'],
            ])->get('https://gate.bisaai.id:8080/ekiosk_prod/check_credential');
            if ($credential->status() == 200) {
                $role = json_decode($credential->body(), true)[0];
                if ($role['role'] == 1) {
                    return redirect()->route('superadmin.dashboard.index');
                } elseif ($role['role'] == 2) {
                    return redirect()->route('admin_canteen.overview.index');
                }
            } else {
                return view('auth.login');
            }
        }
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('alert', 'Masukan Username & Password!');
        }

        $key = "lfcVEQJtSWwrHLYBI5@NqIgAIhKTvlTV";
        $option = 0;
        $cipher = "AES-256-CBC";
        $plaintext = $request->password;
        $iv = "BWlPi/tWl6rh#vRx";
        $password = openssl_encrypt($plaintext, $cipher, $key, $option, $iv);

        $response = Http::post('https://gate.bisaai.id:8080/ekiosk_prod/login_admin', [
            'username' => $request->username,
            'password' => $password,
        ]);
        if ($response->status() == 200) {
            $token = json_decode($response->body(), true);
            $credential = Http::withHeaders([
                'Authorization' => 'JWT ' . $token['access_token'],
            ])->get('https://gate.bisaai.id:8080/ekiosk_prod/check_credential');
            $credential = json_decode($credential->body(), true)[0];

            session()->put('tokenlogin', $token);
            session()->put('namauser', $credential['nama_user']);
            if ($credential['role'] == 1) {
                return redirect()->route('superadmin.dashboard.index')->with('success', 'Login Berhasil');
            } elseif ($credential['role'] == 2) {
                $id_user = $credential['id_user'];
                $response = Http::withHeaders([
                    'Authorization' => 'JWT ' . $token['access_token'],
                ])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_penjual?is_delete=0&id_user=' . $id_user);

                $id_penjual = json_decode($response->body(), true)['data'][0]['id_penjual'];
                $response = Http::withHeaders([
                    'Authorization' => 'JWT ' . $token['access_token'],
                ])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_kantin?is_delete=0&id_penjual=' . $id_penjual);

                session()->put('idkantin', json_decode($response->body(), true)['data'][0]['id_kantin']);
                session()->put('namakantin', json_decode($response->body(), true)['data'][0]['nama_kantin']);

                return redirect()->route('admin_canteen.overview.index')->with('success', 'Login Berhasil');
                // return redirect()->route('superadmin.admin.index')->with('success', 'Data berhasil dihapus');
            }
            return redirect()->intended('/');
        } else {
            return redirect('login')->with('alert', 'Username/Password Salah');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login')->with('success', 'Logout Berhasil');
    }
}
