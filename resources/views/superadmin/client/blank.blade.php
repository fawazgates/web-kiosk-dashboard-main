@extends('layouts.template')
@section('content')

<div class="container-fluid">
    {{-- @include('component._dashboard_superadmin') --}}
    <!-- DataTales Example -->
    <div class="card shadow mb-4" style="min-height: 800px !important;">
        <div class="card-header py-3 justify-content-between d-flex d-inline">
            <h6 class="m-0 font-weight-bold text-dark"><span class="text-orange-tagar-manual">|</span> Add New Client</h6>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-sm-12 my-auto align-items-center mt-5">
                    <img src="{{ asset('template/img/add_new_client.png') }}" style="height:80%;width:80%">
                    <br>
                    <br>
                    <br>
                    <center>
                        <a href="{{ route('superadmin.client.create') }}" class="btn btn-orange-manual">Add New Client</a>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $("#edit").on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        var name = $(e.relatedTarget).data('name');
        var location = $(e.relatedTarget).data('location');
        var total_transaction = $(e.relatedTarget).data('total_transaction');
        $('#edit').find('input[name="id"]').val(id);
        $('#edit').find('input[name="name"]').val(name);
        $('#edit').find('input[name="location"]').val(location);
        $('#edit').find('input[name="total_transaction"]').val(total_transaction);
    });
    
    $('#delete').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        console.log(id);
        $('#delete').find('input[name="id"]').val(id);
    });
</script>
@endpush