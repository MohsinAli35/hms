@extends('../layouts.app')
@section('content')

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title">Add User</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form method="post" action="{{ route('users.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <input class="form-control" name="f_name" type="text" value="{{ old('f_name') }}">
                                @error('f_name')
                                    <span class="d-block text-danger fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input class="form-control" name="l_name" type="text" value="{{ old('l_name') }}">
                                @error('l_name')
                                    <span class="d-block text-danger fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Username</label>
                                <input class="form-control" name="username" type="text" value="{{ old('username') }}">
                                @error('username')
                                    <span class="d-block text-danger fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" type="email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="d-block text-danger fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" name="password" type="password">
                                @error('password')
                                    <span class="d-block text-danger fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input class="form-control" name="confirmed_password" type="password">
                                @error('confirmed_password')
                                    <span class="d-block text-danger fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>User ID</label>
                                <input type="text" name="userid" placeholder="eg. 01" class="form-control" value="{{ old('userid') }}">
                                @error('userid')
                                    <span class="d-block text-danger fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Joining Date</label>
                                <div class="">
                                    <input class="form-control" name="dateofjoining" type="date" value="{{ old('dateofjoining') }}">
                                    @error('dateofjoining')
                                        <span class="d-block text-danger fs-6">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Phone</label>
                                <input class="form-control" name="phone" type="text" value="{{ old('phone') }}">
                                @error('phone')
                                    <span class="d-block text-danger fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Role</label>
                                <select class="select" name="role">
                                    <option value="1" {{ old('role') == 1 ? 'selected' : '' }}>Admin</option>
                                    <option value="2" {{ old('role') == 2 ? 'selected' : '' }}>Receptionist</option>
                                </select>
                                @error('role')
                                    <span class="d-block text-danger fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="display-block">Status</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="User_active" value="1" {{ old('status', '1') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="User_active">
                                Active
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="User_inactive" value="0" {{ old('status') == '0' ? 'checked' : '' }}>
                            <label class="form-check-label" for="User_inactive">
                                Inactive
                            </label>
                        </div>
                        @error('status')
                            <span class="d-block text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn">Create User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="notification-box">
        <!-- Notification content here -->
    </div>
</div>
@endsection
