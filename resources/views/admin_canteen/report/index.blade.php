@extends('layouts.template')
@section('content')
    @php
    $id_mahasiswa = [];
    $id_pager = [];
    $id_order = [];
    $notif = [];
    $is_pengambilan = [];
    $status_pembayaran = [];
    $index = -1;
    @endphp
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        */
    </style>
    <div class="container-fluid">
        @include('component._dashboard_admin_canteen')
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between d-flex d-inline">
                        <h6 class="m-0 font-weight-bold text-dark"><span class="text-orange-tagar-manual">|</span> Orders
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable">
                                <thead>
                                    <th>ID Order</th>
                                    <th>Order Number</th>
                                    <th>Order Date</th>
                                    <th>Quantity</th>
                                    <th>Select Pager</th>
                                    <th>Status</th>
                                    <th>Notification</th>
                                    <th>Grand Total</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @forelse($transactions as $key => $transaction)
                                        @php
                                            $id_mahasiswa[] = $transaction['id_mahasiswa'];
                                            $id_pager[] = $transaction['id_pager'];
                                            $id_order[] = $transaction['id_order'];
                                            $notif[] = $transaction['notif'];
                                            $status_pembayaran[] = $transaction['status_pembayaran'];
                                            $is_pengambilan[] = $transaction['is_pengambilan'];
                                        @endphp

                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $transaction['nomor_order'] }}</td>
                                            <td>{{ date('m-d-Y', strtotime($transaction['waktu_order'])) }}</td>
                                            @php
                                                $i = 0;
                                                foreach ($transaction['order_detail'] as $order_detail) {
                                                    $i++;
                                                }
                                            @endphp
                                            <td>{{ $i }}</td>
                                            <td>
                                                <select name="pager" class="form-control pager"
                                                    data-id="{{ $index = $index + 1 }}">
                                                </select>
                                            </td>
                                            <td>
                                                <select name="status" class="form-control status"
                                                    {{ $transaction['is_pengambilan'] == 1 || $transaction['id_pager'] == null ? 'disabled' : '' }}
                                                    data-id="{{ $index }}">
                                                    <option value="1"
                                                        {{ $transaction['is_pengambilan'] == 1 ? 'selected' : '' }}>
                                                        Taken
                                                    </option>
                                                    <option value="0"
                                                        {{ $transaction['is_pengambilan'] == 0 ? 'selected' : '' }}>
                                                        Not Taken</option>
                                                </select>
                                            </td>
                                            <td>
                                                <label class="switch">
                                                    <input type="checkbox"
                                                        {{ $transaction['notif'] == 'ON' ? 'checked' : '' }}
                                                        class="notif" data-id="{{ $index }}"
                                                        value="{{ $transaction['notif'] == 'ON' ? 'OFF' : 'ON' }}"
                                                        {{ $transaction['is_pengambilan'] == 1 || $transaction['id_pager'] == null ? 'disabled' : '' }}>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>@currency($transaction['total_transaksi'])</td>
                                            <td>
                                                <a
                                                    href="{{ route('admin_canteen.report.show', $transaction['id_invoice']) }}"><i
                                                        class="fas fa-eye"></i></a>
                                                <a href="#" data-id="{{ $transaction['id_order'] }}"
                                                    data-toggle="modal" data-target="#delete"><i
                                                        class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <br>
                        {{ $transactions->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span class="text-orange-tagar-manual">|</span> Delete
                        Order</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus Data Order ini?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('admin_canteen.report.delete') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id">
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let notif = {!! json_encode($notif) !!}
        let id_mahasiswa = {{ json_encode($id_mahasiswa) }}
        let id_pager = {{ json_encode($id_pager) }}
        let id_order = {{ json_encode($id_order) }}
        let is_pengambilan = {{ json_encode($is_pengambilan) }}
        let status_pembayaran = {{ json_encode($status_pembayaran) }}

        $(document).ready(function() {
            let pager = $('.pager');
            let notifList = $('.notif');
            let statusList = $('.status');

            function getPager(index) {
                if (id_mahasiswa[index] !== null) {
                    $.ajax({
                        type: "GET",
                        data: {
                            'id': id_mahasiswa[index]
                        },
                        url: '{{ route('admin_canteen.report.get_pager') }}',
                        dataType: "json",
                        success: function(response) {
                            if (response.data[0] != null) {
                                $(pager[index]).html("");
                                let content = '';
                                if (id_pager[index] !== null) {
                                    $(pager[index]).prop('disabled', true);
                                    content = `<option value=''>Sudah Digunakan</option>`;
                                    $(pager[index]).append(content);
                                } else if (status_pembayaran[index] != 1 || is_pengambilan == 1) {
                                    $(pager[index]).prop('disabled', true);
                                    content = `<option value=''>Tidak Bisa Digunakan</option>`;
                                    $(pager[index]).append(content);
                                } else {
                                    content = `<option value=''>~Pilih Pager~</option>`;
                                    $(pager[index]).append(content);
                                    $.each(response.data, function(key, item) {
                                        content =
                                            `<option value='${item.id_pager}'>${item.nama_pager}</option>`
                                        $(pager[index]).append(content);
                                    });
                                }
                            }
                        }
                    });
                }
            }

            function callPager() {
                for (let i = 0; i < pager.length; i++) {
                    getPager(i);
                }
            }
            callPager();

            $('.pager').on('change', function(e) {
                let index = $(e.currentTarget).data("id")
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'PUT',
                    url: '{{ route('admin_canteen.report.update_pager') }}',
                    dataType: 'json',
                    data: {
                        'id_order': id_order[index],
                        'id_pager': $(e.currentTarget).val()
                    },
                    success: function(data) {
                        // let index_pager = id_pager.findIndex(function(id_pager) {
                        //     return id_pager == $(e.currentTarget).val()
                        // });
                        // console.log(index_pager);
                        id_pager[index] = $(e.currentTarget).val();
                        $(statusList[index]).prop('disabled', false);
                        $(notifList[index]).prop('disabled', false);

                        // statusList[index].removeAttribute('disabled');
                        // notif[index].removeAttribute('disabled');
                        // temp = id_pager[index_pager];
                        callPager();
                        alert(data.message);
                    },
                    error: function(data) {
                        alert(data.message);
                    }
                });
            })

            $('.notif').on('change', function(e) {
                let index = $(e.currentTarget).data("id");
                let notif = $(e.currentTarget).val()
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'PUT',
                    url: '{{ route('admin_canteen.report.update_notif') }}',
                    dataType: 'json',
                    data: {
                        'id_order': id_order[index],
                        'notif': notif
                    },
                    success: function(response) {
                        if (response.status == false) {
                            if (notif == 'ON') {
                                $(e.currentTarget).prop("checked", false);
                            } else {
                                $(e.currentTarget).prop("checked", true);
                            }
                        } else {
                            if (notif == 'ON') {
                                notif[index] = "OFF";
                                $(e.currentTarget).val('OFF')
                            } else {
                                notif[index] = "ON";
                                $(e.currentTarget).val('ON')
                            }
                            callPager();
                        }
                        alert(response.message);
                    },
                    error: function(response) {
                        if (notif == 'on') {
                            $(e.currentTarget).prop("checked", false);
                        } else {
                            $(e.currentTarget).prop("checked", true);
                        }
                        alert(response.responseText);
                    }
                });
            })

            $('.status').on('change', function(e) {
                let index = $(e.currentTarget).data('id')
                let isPengambilan = $(e.currentTarget).val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'PUT',
                    url: '{{ route('admin_canteen.report.update_taken') }}',
                    dataType: 'json',
                    data: {
                        'id_order': id_order[index],
                        'is_pengambilan': isPengambilan
                    },
                    success: function(response) {
                        if (response.status == false) {
                            if (isPengambilan == 1) {
                                is_pengambilan[index] = "0";
                                $(e.currentTarget).val('0');
                            } else {
                                is_pengambilan[index] = "1";
                                $(e.currentTarget).val('1');
                            }
                        }
                        $(notifList[index]).prop("checked", false);
                        $(notifList[index]).attr("disabled", true);
                        $(notifList[index]).val("OFF");
                        callPager();
                        alert(response.message);
                    },
                    error: function(response) {
                        if (isPengambilan == 1) {
                            $(e.currentTarget).val('0').change();
                        } else {
                            $(e.currentTarget).val('1').change();
                        }
                        alert(response.responseText);
                    }
                });
            })
        })

        $('#delete').on('show.bs.modal', (e) => {
            var id = $(e.relatedTarget).data('id');
            $('#delete').find('input[name="id"]').val(id);
        });
    </script>
@endpush
