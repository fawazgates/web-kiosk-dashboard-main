@extends('layouts.template')
@section('content')
    <div class="container-fluid">
        @include('component._dashboard_superadmin')
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 justify-content-between d-flex d-inline">
                <h6 class="m-0 font-weight-bold text-dark"><span class="text-orange-tagar-manual">|</span> Add New Admin</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <img src="{{ asset('template/img/add_new_admin.png') }}" style="height:100%;width:100%">
                    </div>
                    <div class="col-lg-6 col-sm-12 my-auto align-items-center">
                        <form action="{{ route('superadmin.admin.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $user['id_user'] }}">
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $user['nama_user'] }}" required>
                            </div>
                            <div class="form-group">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    value="{{ $user['username'] }}" required>
                            </div>
                            <div class="form-group">
                                <label for="id_password" class="form-label">Password <small>*Optional ( isi jika ingin
                                        diubah )</small></label><br>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" id="id_password" name="password">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2"><i class="far fa-eye-slash"
                                                id="togglePassword" style="cursor: pointer;"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                            </div>
                            <div class="form-group ">
                                <label for="password" class="form-label">Role</label>
                                <select name="role" id="role" class="form-control" required>
                                    <option value="">~ Pilih ~</option>
                                    <option value="1" {{ $user['role'] == 1 ? 'selected' : '' }}>Superadmin</option>
                                    <option value="2" {{ $user['role'] == 2 ? 'selected' : '' }}>Admin</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-orange-manual">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#id_password');

        togglePassword.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'text' ? 'password' : 'text';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye');
        });
    </script>
@endpush
