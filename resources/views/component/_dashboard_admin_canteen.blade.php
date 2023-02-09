@php
$token = session()->get('tokenlogin');
$id_kantin = session()->get('idkantin');

$response = Http::withHeaders([
    'Authorization' => 'JWT ' . $token['access_token'],
])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_order?is_delete=0&id_kantin=' . $id_kantin);
$totalOrders = json_decode($response->body(), true)['row_count'];

$response = Http::withHeaders([
    'Authorization' => 'JWT ' . $token['access_token'],
])->get('https://gate.bisaai.id:8080/ekiosk_prod/kantin/list_produk?is_delete=0&id_kantin=' . $id_kantin);
$totalFoods = json_decode($response->body(), true)['row_count'];

$response = Http::withHeaders([
    'Authorization' => 'JWT ' . $token['access_token'],
])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_kantin?id_kantin=' . $id_kantin);
$status = json_decode($response->body(), true)['data'][0]['is_aktif'];

$response = Http::withHeaders([
    'Authorization' => 'JWT ' . $token['access_token'],
])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_order?is_delete=0&is_rating=1&id_kantin=' . $id_kantin);
$ratings = json_decode($response->body(), true)['data'];

$totalRatings = 0;
for ($i = 0; $i < count($ratings); $i++) {
    $totalRatings += $ratings[$i]['rating'];
}
$totalRatings = $totalRatings / count($ratings);

// $response = Http::withHeaders([
//     'Authorization' => 'JWT ' . $token['access_token'],
// ])->get('https://gate.bisaai.id:8080/ekiosk_prod/admin/get_order?is_delete=0&is_status=0');
// $totalTransactionsFailed = json_decode($response->body(), true)['row_count'];

@endphp
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<meta name="csrf-token" content="{{ csrf_token() }}" />

<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-md font-weight-bold mb-1"><span class="text-orange-tagar-manual">|</span>
                            Total Order</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalOrders ?? '0' }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chart-line fa-2x text-orange-manual"></i>
                    </div>
                </div>
                <small>Number of Total Order</small>
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
                            Total Product</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalFoods ?? '0' }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chart-line fa-2x text-orange-manual"></i>
                    </div>
                </div>
                <small>Number of Total Product</small>
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
                            Ratings</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalRatings ?? '' }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chart-line fa-2x text-orange-manual"></i>
                    </div>
                </div>
                <small>Number of Average Ratings</small>
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
                            Canteen Status</div>
                        <select name="status" id="status" class="form-control">
                            <option value="open" {{ $status == 1 ? 'selected' : '' }}>Open</option>
                            <option value="close" {{ $status == 0 ? 'selected' : '' }}>Close</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chart-line fa-2x text-orange-manual"></i>
                    </div>
                </div>
                <small>Status Canteen Open/Closed</small>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#status').on('change', function(e) {
                $value = $(e.currentTarget).val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'PUT',
                    url: '{{ route('admin_canteen.overview.status_canteen') }}',
                    dataType: 'json',
                    data: {
                        'status': $value
                    },
                    success: function(data) {
                        alert(data.message);
                    },
                    error: function(data) {
                        alert(data.message);
                    }
                });
            })
        })
    </script>
@endpush
