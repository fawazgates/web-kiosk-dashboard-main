@if (request()->is('superadmin/client*'))
    @php
        $url = 'https://gate.bisaai.id:8080/ekiosk_prod/admin/get_client?is_delete=0';
    @endphp
@elseif(request()->is('superadmin/parking-spot*'))
    @php
        $url = 'https://gate.bisaai.id:8080/ekiosk_prod/admin/get_user?is_delete=0';
    @endphp
@else
    @php
        $url = 'https://gate.bisaai.id:8080/ekiosk_prod/admin/get_mahasiswa?is_delete=0';
    @endphp
@endif
@php
$token = session()->get('tokenlogin');
$response = Http::withHeaders([
    'Authorization' => 'JWT ' . $token['access_token'],
])->get($url);
$totalUser = json_decode($response->body(), true)['row_count'];
@endphp
<!-- Content Row -->
<div class="row">


    @if (request()->is('superadmin/client*') ? 'active' : '')
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold mb-1"><span class="text-orange-tagar-manual">|</span>
                                Total Client</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUser ?? '0' }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-orange-manual"></i>
                        </div>
                    </div>
                    <small>Number of Client Registered</small>
                </div>
            </div>
        </div>


        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold mb-1"><span class="text-orange-tagar-manual">|</span>
                                Add New Client</div>
                            <div class="row">
                                <div class="col-6">
                                    <i class="fas fa-calendar fa-2x text-orange-manual"></i>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('superadmin.client.blank') }}"
                                        style="border: 1px solid blue;padding:8px;">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <small>Register a new client</small>
                </div>
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
                    <div class="text-md font-weight-bold mb-1"><span class="text-orange-tagar-manual">|</span> Total
                        Admin</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUser ?? '0' }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-orange-manual"></i>
                </div>
            </div>
            <small>Number of Admin Registered</small>
        </div>
    </div>
</div>


<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-md font-weight-bold mb-1"><span class="text-orange-tagar-manual">|</span> Add New
                        Admin</div>
                    <div class="row">
                        <div class="col-6">
                            <i class="fas fa-calendar fa-2x text-orange-manual"></i>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('superadmin.admin.blank') }}"
                                style="border: 1px solid blue;padding:8px;">
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
</div>
@else
<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-md font-weight-bold mb-1"><span class="text-orange-tagar-manual">|</span> Total
                        User</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUser ?? '0' }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-orange-manual"></i>
                </div>
            </div>
            <small>Number of User Registered</small>
        </div>
    </div>
</div>


<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-md font-weight-bold mb-1"><span class="text-orange-tagar-manual">|</span> Add New
                        User</div>
                    <div class="row">
                        <div class="col-6">
                            <i class="fas fa-calendar fa-2x text-orange-manual"></i>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('superadmin.user.blank') }}"
                                style="border: 1px solid blue;padding:8px;">
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
</div>
@endif
