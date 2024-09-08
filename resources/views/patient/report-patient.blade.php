@extends('../layouts.app')
@section('content')





    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-4 col-3">
                    <h4 class="page-title">Patients</h4>
                </div>
                <!-- <div class="col-sm-8 col-9 text-right m-b-20">
                                    <a href="add-patient.php" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Patient</a>
                                </div> -->
            </div>
            <div class="row filter-row justify-content-end">
               
                
<div class="col-md-12">
    <form action="{{route('dateSearch')}}" method="GET">
        <div class="row">
            <div class="col-sm-6 col-md-3" >
                <div class="form-group form-focus select-focus">
                    {{-- <label class="focus-label">By Department</label> --}}
                    <select class="form-select" name="department" id="department_search">
                        <option value="">Select Department</option>
                        @foreach ($departments as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                        
                    
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus  ">
                    
                        <input  class="form-control floating pb-4 " name="start" type="date">
                        @error('start')
                            <span class="text-danger ">{{$message}}</span>
                        @enderror
                
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus">
                        <input  class="form-control floating pb-4" name="end" type="date">
                        @error('end')
                        <span class="text-danger ">{{$message}}</span>
                    @enderror
                    
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
               
                <button type="submit" class="btn btn-success btn-block"> Search </button>
            </div>
          </div>
    </form>
</div>
                
            </div>
            <div class="row">
                @if (session('danger'))
                    <div class="col-md-12">
                        <span class="text-danger fs-6">{{ session('danger') }}</span>
                    </div>
                @endif
                @if (session('success'))
                    <div class="col-md-12">
                        <span class="text-danger fs-6">{{ session('success') }}</span>
                    </div>
                @endif
                <div class="col-md-12">
                    @if (count($patients) > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered custom-table datatable mb-0">
                                <thead>
                                    <tr>
                                        <th>Serial No</th>
                                        <th>Token No</th>
                                        <th>Department</th>
                                        <th>Name</th>
                                        <th>CNIC</th>
                                        <th>Age</th>
                                        <th>Phone</th>
                                        <th>Charges</th>
                                        <th>Remark</th>
                                        <th>Genger</th>
                                        <th>Date of Visit</th>
                                        <th>Slip</th>
                                        <th>View</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    @foreach ($patients as $patient)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{-- {{$patient->token->token}} --}}
                                                @foreach ($tokens as $item)
                                                    @if ($item->paitent_id == $patient->id)
                                                        {{ $item->token }}
                                                         {{-- -{{ $item->departement }}-{{ $item->date }}  --}}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{ $patient->department->name }}</td>
                                            <td>{{ $patient->name }}</td>
                                            <td>{{ $patient->cnic }}</td>
                                            <td>{{ $patient->age }}</td>
                                            <td>{{ $patient->phone }}</td>
                                            <td>{{ $patient->price }}</td>
                                            <td>{{ $patient->remark }}</td>
                                            <td>
                                                @if ($patient->gender == 1)
                                                    Male
                                                @elseif ($patient->gender == 2)
                                                    Female
                                                @elseif ($patient->gender == 3)
                                                    Transgender
                                                @endif
                                            </td>
                                            <td>{{ $patient->created_at }}</td>
                                            <td><a href="{{ route('patients.showSlip', $patient->id) }}"
                                                    class="btn btn-sm btn-outline-secondary">Slip</a></td>
                                            <td><a href="{{ route('patients.show', $patient->id) }}"
                                                    class="btn btn-sm btn-outline-info">View</a></td>

                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"><i
                                                            class="fa fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="{{route('patients.edit',$patient->id)}}"><i
                                                                class="fa fa-pencil m-r-5"></i> Edit</a>
                                                        <a class="dropdown-item" data-toggle="modal"
                                                            data-target="#delete_patient{{ $patient->id }}"><i
                                                                class="fa fa-trash-o m-r-5"></i> Delete</a>


                                                    </div>
                                                </div>
                                            </td>
                                        </tr>


                                        {{-- model --}}
                                        <div id="delete_patient{{ $patient->id }}" class="modal fade delete-modal"
                                            role="dialog">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body text-center">
                                                        <img src="assets/img/sent.png" alt="" width="50"
                                                            height="46">
                                                        <h3>Are you sure want to delete this Patient?</h3>
                                                        <div class="m-t-20 d-flex justify-content-center ">
                                                            <a href="#" class="btn btn-white"
                                                                data-dismiss="modal">Close</a>
                                                            <form action="{{ route('patients.destroy', $patient->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="ml-1 btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        {{-- end model --}}
                                    @endforeach



                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <a href="{{ route('downloadPDF') }}" class=" text-danger fa fa-file-pdf-o m-3 " style="font-size: 20px;"> PDF</a>

                            <a href="{{ route('downloadExcel') }}" class="  text-success fa fa-file-excel-o m-3" style="font-size: 20px;"> excel</a>
                            <a href="{{ route('patients.print') }}" class=" text-secondary fa fa-print m-3"style="font-size: 20px;">Print</a>
                        </div>
                        <div>
                            
                        @if (!isset($paginate))
                        <div class="container my-2 mt-5">
                            {{$patients->links()}}
                        </div>

                        </div>
                            
                        @endif
                    @else
                    @endif
                </div>
            </div>
        </div>
        </div>
    </div>

    </div>


    <script src="{{ asset('assets/jquery/jquery.js') }}"></script>
 

    <!-- patients23:19-->

@endsection
