@extends('layouts.app')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title">Edit Employee</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form action="{{route('employees.update',$employee->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Employee ID <span class="text-danger"><small></small></span></label>
                                <input class="form-control" placeholder="GAH-123" type="text" name="employee_id" value="{{$employee->employee_id}}">
                                @error('employee_id')
                                            <span class="text-danger fs-6">{{$message}}</span>
                                        @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label> Name</label>
                                <input class="form-control" type="text" name="name" value="{{$employee->name}}">
                                @error('name')
                                <span class="text-danger fs-6">{{$message}}</span>
                            @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>DOB <span class="text-danger">*</span></label>
                                <input class="form-control" type="date" name="dob" value="{{$employee->dob}}">
                                @error('dob')
                                <span class="text-danger fs-6">{{$message}}</span>
                            @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label>Designation</label> <br>
                                <select name="role_id" class="form-control">
                                    @foreach($roles as $role)
                                   
                                    <option value="{{ $role->id }}" {{ $employee->role_id == $role->id ? 'selected' : '' }}>
                                        {{ $role->name }}</option>    
                                    @endforeach
                                </select>
                                @error('role_id')
                                <span class="text-danger fs-6">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>CNIC</label>
                                <input class="form-control" type="number" name="cnic" value="{{$employee->cnic}}">
                                @error('cnic')
                                <span class="text-danger fs-6">{{$message}}</span>
                            @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Date of Issue <span class="text-danger">*</span></label>
                                <input class="form-control" type="date" name="d_i"value="{{$employee->d_i}}">
                                @error('d_i')
                                <span class="text-danger fs-6">{{$message}}</span>
                            @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Date of Expiry <span class="text-danger">*</span></label>
                                <input class="form-control" type="date" name="d_e"value="{{$employee->d_e}}">
                                @error('d_e')
                                <span class="text-danger fs-6">{{$message}}</span>
                            @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Blood Group</label>
                                <input class="form-control" type="text" name="blood"value="{{$employee->blood}}">
                                @error('blood')
                                <span class="text-danger fs-6">{{$message}}</span>
                            @enderror
                            </div>
                        </div>
                        
                        <!-- <div class="col-sm-6">
                            <div class="form-group gender-select">
                                <label class="gen-label">Gender:</label>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" name="gender" class="form-check-input">Male
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" name="gender" class="form-check-input">Female
                                    </label>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Office Phone</label>
                                        <input type="number" class="form-control " name="office_no"value="{{$employee->office_no}}" >
                                        @error('office_no')
                                        <span class="text-danger fs-6">{{$message}}</span>
                                    @enderror
                                    </div>
                                </div>
                                <!-- <div class="col-sm-6 col-md-6 col-lg-3">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <select class="form-control select">
                                            <option>USA</option>
                                            <option>United Kingdom</option>
                                        </select>
                                    </div>
                                </div> -->
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Contact No.</label>
                                        <input type="number" class="form-control" name="contact_no" value="{{$employee->contact_no}}">
                                        @error('contact_no')
                                        <span class="text-danger fs-6">{{$message}}</span>
                                    @enderror
                                    </div>
                                </div>
                                <!-- <div class="col-sm-6 col-md-6 col-lg-3">
                                    <div class="form-group">
                                        <label>State/Province</label>
                                        <select class="form-control select">
                                            <option>California</option>
                                            <option>Alaska</option>
                                            <option>Alabama</option>
                                        </select>
                                    </div>
                                </div> -->
                                <div class="col-sm-6 col-md-6 col-lg-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" name="address" value="{{$employee->address}}">
                                        @error('address')
                                        <span class="text-danger fs-6">{{$message}}</span>
                                    @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Account Number</label>
                                        <input type="number" class="form-control " name="account_no" value="{{$employee->account_no}}">
                                        @error('account_no')
                                        <span class="text-danger fs-6">{{$message}}</span>
                                    @enderror
                                    </div>
                                </div>
                       
                        <div class="form-group">
<label for="exampleFormControlFile1">Document file input</label>
<input type="file"  name="image" class="form-control-file" id="docsFormControlFile1" value="{{$employee->image}}">
</div>
                    </div>
                    <!-- <div class="form-group">
                        <label>Short Biography</label>
                        <textarea class="form-control" rows="3" cols="30"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="display-block">Status</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="doctor_active" value="option1" checked>
                            <label class="form-check-label" for="doctor_active">
                            Active
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="doctor_inactive" value="option2">
                            <label class="form-check-label" for="doctor_inactive">
                            Inactive
                            </label>
                        </div>
                    </div> -->
                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn" type="submit">Add Employee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection