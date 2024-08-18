@extends('../layouts.app')
@section('content')

        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Employee</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label> Name</label>
                                            <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Employee ID <span class="text-danger">*</span></label>
                                            <input class="form-control" name="employee_id" type="text" value="{{ old('employee_id') }}">
                                            <span><small>Employee ID can't be update</small></span>
                                            @error('employee_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-12">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Designation</label> <br>
                                                    {{-- @if (count($roles) > 0) --}}
                                                        <select name="role_id" class="form-control">
                                                            <option value="" s
                                                            >Select Role</option>
                                                            @foreach ($roles as $role)
                                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                                                
                                                            @endforeach
                                                        </select>
                                                        @error('role_id')
                                                            <span class="text-danger fs-6">{{$message}}</span>
                                                        @enderror
                                                    {{-- @else
                                                    <span class="text-danger fs-6">No Role availabale.</span>
                                                    @endif --}}
                                                </div>
                                            </div>
                        
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>CNIC</label>
                                                    <input class="form-control" name="cnic" type="number" value="{{ old('cnic') }}">
                                                    @error('cnic')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Date of Issue <span class="text-danger">*</span></label>
                                                    <input class="form-control" name="d_i" type="date" value="{{ old('d_i') }}">
                                                    @error('d_i')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                        
                                            <div class="col-sm-6">
                                                {{-- <div class="form-group">
                                                    <label>Date of Expiry <span class="text-danger">*</span></label>
                                                    <input class="form-control" name="d_e" type="date" value="{{ old('d_e') }}">
                                                    @error('d_e')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="row">
                                            
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Blood Group</label>
                                            <input class="form-control" name="blood" type="text" value="{{ old('blood') }}">
                                            @error('blood')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                   <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>DOB <span class="text-danger">*</span></label>
                                        <input class="form-control" name="dob" type="date" value="{{ old('dob') }}">
                                        @error('dob')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                   </div>
                                        </div>
                                    </div>
                        
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Office Phone</label>
                                                    <input type="number" name="office_no" class="form-control" value="{{ old('office_no') }}">
                                                    @error('office_no')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                        
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label>Contact No.</label>
                                                    <input type="number" name="contact_no" class="form-control" value="{{ old('contact_no') }}">
                                                    @error('contact_no')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                        
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Account Number</label>
                                            <input type="number" name="account_no" class="form-control" value="{{ old('account_no') }}">
                                            @error('account_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                        
                                    <div class="form-group">
                                        <label for="docsFormControlFile1">Document file input</label>
                                        <input type="file" name="image" class="form-control-file" id="docsFormControlFile1">
                                        @error('file')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                        
                                <div class="m-t-20 text-center">
                                    <button class="btn btn-primary submit-btn" type="submit">Add Employee</button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
			
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
	<script src="assets/js/moment.min.js"></script>
	<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>


@endsection
