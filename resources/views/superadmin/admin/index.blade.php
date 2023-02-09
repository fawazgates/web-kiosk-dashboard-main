@extends('layouts.template')
@section('content')
    <div class="container-fluid">
        @include('component._dashboard_superadmin')
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 justify-content-between d-flex d-inline">
                <h6 class="m-0 font-weight-bold text-dark"><span class="text-orange-tagar-manual">|</span> Admin List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0" id="table-ku">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($admins as $admin)
                                <tr>
                                    <th>{{ $admin['username'] }}</th>
                                    <th>
                                        <div class="container-fluid">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <input type="password" class="form-control" id="id_password"
                                                        name="password" value="{{ $admin['password'] }}" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon2"><i
                                                                class="far fa-eye-slash password" id="togglePassword"
                                                                style="cursor: pointer;"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                    <th>{{ $admin['role'] == 1 ? 'Admin' : 'Super Admin' }}</th>
                                    <th>
                                        <a href="{{ route('superadmin.admin.edit', $admin['id_user']) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <a href="#" data-id="{{ $admin['id_user'] }}" data-toggle="modal"
                                            data-target="#delete" class="btn btn-danger btn-sm">Delete</a>
                                    </th>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <br>
                {{ $admins->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span class="text-orange-tagar-manual">|</span> Delete
                        admins</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus Data Admin ini?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('superadmin.admin.delete') }}" method="POST" enctype="multipart/form-data">
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
        const wrapper = $('#table-ku');
        $(wrapper).on('click', '.password', function(e) {

            const togglePassword = $(this);
            const password = $(this).parent().parent().prev();

            togglePassword.on('click', function(e) {
                // toggle the type attribute
                const type = password.attr('type') === 'text' ? 'password' : 'text';
                password.attr('type', type);
                // toggle the eye slash icon
                $(this).toggleClass('fa-eye');
            });

        })
    </script>
@endpush
