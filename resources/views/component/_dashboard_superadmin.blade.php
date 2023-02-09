@php
$token = session()->get('tokenlogin');
$response = Http::withHeaders([
    'Authorization' => 'JWT ' . $token['access_token'],
])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_kantin?is_delete=0');
$totalCanteens = json_decode($response->body(), true)['row_count'];

$response = Http::withHeaders([
    'Authorization' => 'JWT ' . $token['access_token'],
])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_order?is_delete=0');
$totalTransactionCanteen = json_decode($response->body(), true)['row_count'];

$response = Http::withHeaders([
    'Authorization' => 'JWT ' . $token['access_token'],
])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_transaksi_parkir?is_delete=0');
$totalTransactionParking = json_decode($response->body(), true)['row_count'];

// $response = Http::withHeaders([
//     'Authorization' => 'JWT ' . $token['access_token'],
// ])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_order?is_delete=0&is_status=0');
// $totalTransactionsFailed = json_decode($response->body(), true)['row_count'];
$url = '';
@endphp

@if (request()->is('superadmin/canteen*') || request()->is('superadmin/smart-canteen*'))
    @php
        $url = 'https://gate.bisaai.id:8080/ekiosk_prod/admin/get_kantin?is_delete=0';
    @endphp
@elseif(request()->is('superadmin/parking-spot*') || request()->is('superadmin/smart-parking*'))
    @php
        $url = 'https://gate.bisaai.id:8080/ekiosk_prod/admin/get_parkir_lokasi?is_delete=0';
    @endphp
@elseif(request()->is('superadmin/category*'))
    @php
        $url = 'https://gate.bisaai.id:8080/ekiosk_prod/kantin/list_kategori?is_delete=0';
    @endphp
@elseif(request()->is('superadmin/admin*'))
    @php
        $url = 'https://gate.bisaai.id:8080/ekiosk_prod/admin/get_user?is_delete=0';
    @endphp
@elseif(request()->is('superadmin/user*'))
    @php
        $url = 'https://gate.bisaai.id:8080/ekiosk_prod/admin/get_mahasiswa?is_delete=0';
    @endphp
@endif

@if ($url != null || $url != '')
    @php
        $token = session()->get('tokenlogin');
        $response = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->get($url);
        $totalData = json_decode($response->body(), true)['row_count'];
    @endphp
@endif
<!-- Content Row -->
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-md font-weight-bold mb-1"><span class="text-orange-tagar-manual">|</span>
                            Total Transaction Parking</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalTransactionParking ?? '0' }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-orange-manual"></i>
                    </div>
                </div>
                <small>Number of Total Transaction Parking</small>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">

                    <div class="col mr-2">
                        <div class="text-md font-weight-bold mb-1"><span class="text-orange-tagar-manual">|</span> Total
                            Transaction Canteen</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalTransactionCanteen ?? '0' }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-orange-manual"></i>
                    </div>
                </div>
                <small>Number of Total Transaction Canteen</small>
            </div>
        </div>
    </div>

    @if (request()->is('superadmin/canteen*') ? 'active' : '')
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold mb-1"><span class="text-orange-tagar-manual">|</span>
                                Total
                                Canteen</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCanteens }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-orange-manual"></i>
                        </div>
                    </div>
                    <small>Number of Canteen Registered</small>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold mb-1"><span class="text-orange-tagar-manual">|</span>
                                Add New Store</div>
                            <div class="row">
                                <div class="col-6">
                                    <i class="fas fa-home fa-2x text-orange-manual"></i>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('superadmin.canteen.create') }}"
                                        style="border: 1px solid blue;padding:5px;">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <small>Register a new store</small>
                </div>
            </div>
        </div>
    @elseif(request()->is('superadmin/parking-spot*') ? 'active' : '')
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold mb-1"><span class="text-orange-tagar-manual">|</span>
                                Total
                                Parking</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalData }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-orange-manual"></i>
                        </div>
                    </div>
                    <small>Number of Parking Registered</small>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold mb-1"><span class="text-orange-tagar-manual">|</span>
                                Add New Parking Spot</div>
                            <div class="row">
                                <div class="col-6">
                                    <i class="fas fa-home fa-2x text-orange-manual"></i>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('superadmin.parking_spot.create') }}"
                                        style="border: 1px solid blue;padding:5px;">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <small>Register a new parking spot</small>
                </div>
            </div>
        </div>
    @elseif(request()->is('superadmin/smart-parking*') ? 'active' : '')
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold mb-1"><span class="text-orange-tagar-manual">|</span>
                                Total
                                Parking</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalData }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-orange-manual"></i>
                        </div>
                    </div>
                    <small>Number of Parking Registered</small>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold mb-1"><span class="text-orange-tagar-manual">|</span>
                                Smart Parking Data</div>
                            <div class="row">
                                <div class="col-6">
                                    <div><a href="https://datastudio.google.com/reporting/5533607e-8539-4ecc-bcc4-a085e12ebabe"
                                            class="btn btn-primary btn-sm">Details</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <small>Smart Parking Data Recapitulation Dashboard</small>
                </div>
            </div>
        </div>
    @elseif(request()->is('superadmin/smart-canteen*') ? 'active' : '')
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold mb-1"><span class="text-orange-tagar-manual">|</span>
                                Total
                                Canteen</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalData }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-orange-manual"></i>
                        </div>
                    </div>
                    <small>Number of Canteen Registered</small>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold mb-1"><span class="text-orange-tagar-manual">|</span>
                                Smart Canteen Data</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><a
                                    href="https://datastudio.google.com/u/0/reporting/eedc4b91-d1e4-4e2c-ac30-e688ab9d55e8/page/HnEoC"
                                    class="btn btn-primary btn-sm">Details</a></div>
                        </div>
                    </div>
                    <small>Smart Canteen Data Recapitulation Dashboard</small>
                </div>
            </div>
        </div>
    @elseif(request()->is('superadmin/category*') ? 'active' : '')
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold mb-1"><span class="text-orange-tagar-manual">|</span>
                                Total
                                Canteen</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalData }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-orange-manual"></i>
                        </div>
                    </div>
                    <small>Number of Canteen Registered</small>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold mb-1"><span class="text-orange-tagar-manual">|</span>
                                Add New Store</div>
                            <div class="row">
                                <div class="col-6">
                                    <i class="fas fa-home fa-2x text-orange-manual"></i>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('superadmin.canteen.create') }}"
                                        style="border: 1px solid blue;padding:5px;">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <small>Register a new store</small>
                </div>
            </div>
        </div>
    @elseif(request()->is('superadmin/admin*') ? 'active' : '')
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold mb-1"><span class="text-orange-tagar-manual">|</span>
                                Total
                                Admin</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalData }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-orange-manual"></i>
                        </div>
                    </div>
                    <small>Number of Admin Registered</small>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold mb-1"><span class="text-orange-tagar-manual">|</span>
                                Add New Admin</div>
                            <div class="row">
                                <div class="col-6">
                                    <i class="fas fa-home fa-2x text-orange-manual"></i>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('superadmin.admin.create') }}"
                                        style="border: 1px solid blue;padding:5px;">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <small>Register a new admin</small>
                </div>
            </div>
        </div>
    @elseif(request()->is('superadmin/user*') ? 'active' : '')
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold mb-1"><span class="text-orange-tagar-manual">|</span>
                                Total
                                User</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalData }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-orange-manual"></i>
                        </div>
                    </div>
                    <small>Number of User Registered</small>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold mb-1"><span class="text-orange-tagar-manual">|</span>
                                Add New User</div>
                            <div class="row">
                                <div class="col-6">
                                    <i class="fas fa-home fa-2x text-orange-manual"></i>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('superadmin.student.create') }}"
                                        style="border: 1px solid blue;padding:5px;">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <small>Register a new user</small>
                </div>
            </div>
        </div>
    @endif
</div>
