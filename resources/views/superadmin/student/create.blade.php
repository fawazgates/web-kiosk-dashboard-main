@extends('layouts.template')
@section('content')

    <div class="container-fluid">
        @include('component._dashboard_superadmin')
        <!-- DataTales Example -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3 justify-content-between d-flex d-inline">
                <h6 class="m-0 font-weight-bold text-dark"><span class="text-orange-tagar-manual">|</span> Add New User</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('superadmin.student.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <img src="{{ asset('template/img/user.png') }}" style="height:60%;width:100%">
                            <hr>
                            <div class="form-group ">
                                <label for="birth_place" class="form-label">Birth Place</label>
                                <input type="text" class="form-control" id="birth_place" name="birth_place"
                                    value="{{ old('birth_place') }}" required>
                            </div>
                            <div class="form-group ">
                                <label for="birth_date" class="form-label">Birth Date</label>
                                <input type="date" class="form-control" id="birth_date" name="birth_date"
                                    value="{{ old('birth_date') }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 my-auto align-items-center">
                            <div class="form-group ">
                                <label for="client" class="form-label">Client</label>
                                <select name="id_client" id="client" class="form-control" required>
                                    @forelse($clients as $client)
                                        <option value="{{ $client['id_client'] }}">{{ $client['nama_client'] }}</option>
                                    @empty
                                        <option value="">Client Data Ditemukan</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group ">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}" required>
                            </div>
                            <div class="form-group ">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    value="{{ old('email') }}" required>
                            </div>
                            <div class="form-group ">
                                <label for="major" class="form-label">Major</label>
                                <input type="text" class="form-control" id="major" name="major"
                                    value="{{ old('major') }}" required>
                            </div>
                            <div class="form-group ">
                                <label for="student_id" class="form-label">Student ID</label>
                                <input type="text" class="form-control" id="student_id" name="student_id"
                                    value="{{ old('student_id') }}" required>
                            </div>
                            <div class="form-group ">
                                <label for="location" class="form-label">Gender</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="radio" id="gender_0" name="gender" value="LK"
                                            {{ old('gender') == 'L' ? 'checked' : '' }} required>
                                        <label for="gender_0">Male</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="radio" id="gender_1" name="gender" value="P"
                                            {{ old('gender') == 'P' ? 'checked' : '' }} required>
                                        <label for="gender_1">Female</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number"
                                    value="{{ old('phone_number') }}" required>
                            </div>
                            <div class="form-group ">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    value="{{ old('username') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="id_password" class="form-label">Password</label><br>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" id="id_password" name="password"
                                        required>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2"><i class="far fa-eye-slash"
                                                id="togglePassword" style="cursor: pointer;"></i></span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-orange-manual">Add</button>
                        </div>
                    </div>
                </form>
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
