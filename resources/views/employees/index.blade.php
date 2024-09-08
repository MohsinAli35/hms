@extends('layouts.app') 
@section('content')

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Employee</h4>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="{{ route('employees.create') }}" class="btn btn-primary float-right btn-rounded"><i class="fa fa-plus"></i> Add Employee</a>
                <a href="{{ route('employees.index') }}" class="btn btn-danger mr-5 float-right btn-rounded"><i class="fa fa-arrow-left"></i> Back</a>
                
            </div>
        </div>
        <div class="row filter-row">
           <form action="{{route('employees.index')}}" method="GET" class="row filter-row">
           {{-- @csrf
           @method('GET') --}}
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus">
                    <label class="focus-label">Employee ID</label>
                    <input type="text" name="employee_id" class="form-control floating">
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus">
                    <label class="focus-label">Employee Name</label>
                    <input type="text" name="name" class="form-control floating">
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus select-focus">
                    <label class="focus-label">Designation</label>
                    <select class="form-control" name="role_id">
                        <option value="" selected disabled>Select Desination</option>
                        @foreach ( $roles as $role )
                            <option value="{{$role->name}}" >{{$role->name}}</option>
                        @endforeach
                        
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <button type="submit"  class="btn btn-success btn-block">Search</button>
            </div>
        </div>
    </form>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table">
                        <thead>
                            <tr>
                                <th>Serial #</th>
                                <th style="min-width:200px;">Name</th>
                                <th>DOB</th>
                                <th>Employee ID</th>
                                <th>Designation</th>
                                <th>CNIC</th>
                                <th style="min-width: 110px;">Issue Date</th>
                                <th style="min-width: 110px;">Expiry Date</th>
                                <th>Blood Group</th>
                                <th>Office Phone</th>
                                <th>Contact No.</th>
                                <th>Address</th>
                                <th>Account No.</th>
                                <th>Documents</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->dob }}</td>
                                <td>{{ $employee->employee_id }}</td>
                                <td><span class="custom-badge status-blue">{{ $employee->role ? $employee->role->name : 'No Role Assigned' }}</span></td>
                                <td>{{ $employee->cnic }}</td>
                                <td>{{ $employee->d_i }}</td>
                                <td>{{ $employee->d_e }}</td>
                                <td>{{ $employee->blood }}</td>
                                <td>{{ $employee->office_no }}</td>
                                <td>{{ $employee->contact_no }}</td>
                                <td>{{ $employee->address }}</td>
                                <td>{{ $employee->account_no }}</td>
                                <td>
                                    @if ($employee->image)
                                    <a href="{{ asset('storage/pdfs/' . $employee->image) }}" target="_blank">
                                        {{ $employee->image }}
                                    </a>    
                                        @endif 
                                    </td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{ route('employees.edit', $employee->id) }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_employee_{{ $employee->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                                       
                            </tr>

                            <!-- Delete Confirmation Modal -->
                            <div id="delete_employee_{{ $employee->id }}" class="modal fade delete-modal" role="dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body text-center">
                                            <img src="assets/img/sent.png" alt="" width="50" height="46">
                                            <h3>Are you sure want to delete this Employee?</h3>
                                            <div class="m-t-20">
                                                <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="col-sm-6 col-md-3">
                        <button class="btn btn-primary"> <a class=" text-white text-decoration-none" href="{{route('empexcel')}}">Download</a></button>
                    </div>
                    <div class="mt-5">
                        {{ $employees->links() }}
                    </div>
                  
                       
                    </div>
                </div>
            </div>
        </div>

    </div>
    
</div>

@endsection
