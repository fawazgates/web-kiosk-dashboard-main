<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class StudentController extends Controller
{
    public function index()
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_mahasiswa?is_delete=0');
        $data =  json_decode($response->body(), true)['data'];
        $students = $this->paginate($data);
        $students->withPath(route('superadmin.student.index'));
        return view('superadmin.student.index', compact('students'));
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

        return view('superadmin.student.create', ["clients" => $data]);
    }
    public function store(Request $request)
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->post('https://gate.bisaai.id:8080/ekiosk_prod/admin/insert_mahasiswa', [
            "id_client" => $request->id_client,
            "email" => $request->email,
            "password" => $request->password,
            "nim" => $request->student_id,
            "nama_mahasiswa" => $request->name,
            "jurusan" => $request->major,
            "jenis_kelamin" => $request->gender,
            "tempat_lahir" => $request->birth_place,
            "tanggal_lahir" => $request->birth_date,
            "username" => $request->username,
            "no_hp" => $request->phone_number,
        ]);
        if ($response->status() == 200) {
            return redirect()->route('superadmin.student.index')->with('success', 'Data berhasil ditambahkan');
        } else {
            $error = json_decode($response->body(), true)['description'];
            return redirect()->route('superadmin.student.index')->with('alert', $error);
        }
    }

    public function edit($id)
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_mahasiswa?id_mahasiswa=' . $id);
        $data =  json_decode($response->body(), true)['data'][0];
        return view('superadmin.student.edit', ["student" => $data]);
    }
    public function update(Request $request)
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_mahasiswa?id_mahasiswa=' . $request->id);
        $data =  json_decode($response->body(), true)['data'][0];

        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->put('https://gate.bisaai.id:8080/ekiosk_prod/admin/update_mahasiswa', [
            "id_mahasiswa" => $request->id,
            "id_client" => $request->id_client,
            "email" => $request->email,
            'password' => $request->password ? $request->password : $data['password'],
            "nim" => $request->student_id,
            "nama_mahasiswa" => $request->name,
            "jurusan" => $request->major,
            "jenis_kelamin" => $request->gender,
            "tempat_lahir" => $request->birth_place,
            "tanggal_lahir" => $request->birth_date,
            "username" => $request->username,
            "no_hp" => $request->phone_number,
        ]);

        if ($response->status() == 200) {
            return redirect()->route('superadmin.student.index')->with('success', 'Data berhasil diubah');
        } else {
            $error = json_decode($response->body(), true)['description'];
            return redirect()->route('superadmin.student.index')->with('alert', $error);
        }
    }

    public function delete(Request $request)
    {
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->put('https://gate.bisaai.id:8080/ekiosk_prod/admin/update_mahasiswa', [
            'id_mahasiswa' => $request->id,
            'is_delete' => 1,
        ]);
        if ($response->status() == 200) {
            return redirect()->route('superadmin.student.index')->with('success', 'Data berhasil dihapus');
        } else {
            $error = json_decode($response->body(), true)['description'];
            return redirect()->route('superadmin.student.index')->with('alert', $error);
        }
    }
}
