@extends('../layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h4 class="page-title">{{ isset($patient) ? 'Edit Patient' : 'Add Patient' }}</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form action="{{ isset($patient) ? route('patients.update', $patient->id) : route('patients.store') }}" method="post" id="patient-form">
                        @csrf
                        @if(isset($patient))
                            @method('PUT')
                        @else
                            @method('POST')
                        @endif
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Department</label> <br>
                                    @if (count($departments) > 0)
                                        <select name="department_id" class="form-control">
                                            <option value="" disabled {{ !isset($patient) ? 'selected' : '' }}>Select Department</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}" {{ isset($patient) && $patient->department_id == $department->id ? 'selected' : '' }}>
                                                    {{ $department->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('department_id')
                                            <span class="text-danger fs-6">{{ $message }}</span>
                                        @enderror
                                    @else
                                        <span class="text-danger fs-6">No department available.</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Charges</label>
                                    <input class="form-control" name="price" type="number" value="{{ old('price', $patient->price ?? '') }}">
                                    @error('price')
                                        <span class="text-danger fs-6">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Name <span class="text-danger">*</span></label>
                                    <input class="form-control" required name="name" type="text" value="{{ old('name', $patient->name ?? '') }}">
                                    @error('name')
                                        <span class="text-danger fs-6">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Age <span class="text-danger">*</span></label>
                                    <input class="form-control" name="age" required type="number" value="{{ old('age', $patient->age ?? '') }}">
                                    @error('age')
                                        <span class="text-danger fs-6">{{ $message }}</span>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group gender-select">
                                    <label class="gen-label">Gender: <span class="text-danger">*</span></label>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" value="1" name="gender" class="form-check-input" {{ old('gender', $patient->gender ?? '') == '1' ? 'checked' : '' }}>Male
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" value="2" name="gender" class="form-check-input" {{ old('gender', $patient->gender ?? '') == '2' ? 'checked' : '' }}>Female
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" value="3" name="gender" class="form-check-input" {{ old('gender', $patient->gender ?? '') == '3' ? 'checked' : '' }}>Transgender
                                        </label>
                                    </div>
                                    @error('gender')
                                        <span class="text-danger fs-6">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>CNIC <span class="text-danger">*</span></label>
                                    <input class="form-control" name="cnic" type="number" value="{{ old('cnic', $patient->cnic ?? '') }}">
                                    @error('cnic')
                                        <span class="text-danger fs-6">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Phone Number <span class="text-danger">*</span></label>
                                    <input class="form-control" name="phone" type="number" value="{{ old('phone', $patient->phone ?? '') }}">
                                    @error('phone')
                                        <span class="text-danger fs-6">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Remarks</label>
                                    <input class="form-control" name="remark" type="text" value="{{ old('remark', $patient->remark ?? '') }}">
                                    @error('remark')
                                        <span class="text-danger fs-6">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn">{{ isset($patient) ? 'Update' : 'Submit' }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
