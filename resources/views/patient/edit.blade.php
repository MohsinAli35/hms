@extends('../layouts.app')
@section('content')

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title">Edit Patient</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form action="{{ route('patients.update', $patients->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label>Token Number</label>
                                <input class="form-control" type="text" value="APT-0001" readonly="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Serial No.</label>
                                <input class="form-control" type="text" value="APT-0001" readonly="">
                            </div>
                        </div> --}}
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Department</label> <br>
                                <select name="department_id" class="form-control">
                                    @foreach($department as $dept)
                                        <option value="{{ $dept->id }}" {{ $dept->id == $patients->department_id ? 'selected' : '' }}>
                                            {{ $dept->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <span class="text-danger fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="name" value="{{ $patients->name }}">
                                @error('name')
                                    <span class="text-danger fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>CNIC</label>
                                <input class="form-control" type="number" name="cnic" value="{{ $patients->cnic }}">
                                @error('cnic')
                                    <span class="text-danger fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Age <span class="text-danger">*</span></label>
                                <input class="form-control" type="number" name="age" value="{{ $patients->age }}">
                                @error('age')
                                    <span class="text-danger fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input class="form-control" type="number" name="phone" value="{{ $patients->phone }}">
                                @error('phone')
                                    <span class="text-danger fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group gender-select">
                                <label class="gen-label">Gender:</label>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" name="gender" class="form-check-input" value="1" {{ $patients->gender == '1' ? 'checked' : '' }}>Male
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" name="gender" class="form-check-input" value="2" {{ $patients->gender == '2' ? 'checked' : '' }}>Female
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" name="gender" class="form-check-input" value="3" {{ $patients->gender == '3' ? 'checked' : '' }}>Transgender
                                    </label>
                                </div>
                                @error('gender')
                                    <span class="text-danger fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Charges <span class="text-danger"></span></label>
                                <input class="form-control" type="number" name="price" value="{{ $patients->price }}">
                                @error('price')
                                    <span class="text-danger fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Remark <span class="text-danger"></span></label>
                                <input class="form-control" type="text" name="remark" value="{{ $patients->remark }}">
                                @error('remark')
                                    <span class="text-danger fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div> <!-- Close row div here -->
                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
