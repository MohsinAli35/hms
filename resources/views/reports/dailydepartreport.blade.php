@extends('../layouts.app')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-12 col-12">
                <h4 class="page-title text-center">Department wise Record</h4>
                
            </div>
            
        </div>
        <h3>
        @if ($department)
            {{$department->name}}
        @endif

        </h3>
        <div class="row">
            <div class="col-md-12">
               
                    <div class="table-responsive">
                        <table class="table table-bordered custom-table datatable mb-0">
                            <thead>
                                <tr>
                                    <th>Serial No</th>
                                    <th>Token No</th>
                                    {{-- <th>Department</th> --}}
                                    <th> Patient Name</th>
                                    <th>Phone</th>
                                    <th>Charges</th>
                                    <th>Age</th>
                                    <th>Address</th>
                                    
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @foreach ($recordPatient as $patient) <!-- Corrected to use the singular variable -->
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @foreach ($tokens as $item)
                                                @if ($item->paitent_id == $patient->id)
                                                    {{ $item->token }}
                                                @endif
                                            @endforeach
                                        </td>
                                        {{-- <td>{{ $patient->department->name }}</td> --}}
                                        <td>{{ $patient->name }}</td>
                                        <td>{{ $patient->phone }}</td>
                                        <td>{{ $patient->price }}</td>
                                        <td>{{ $patient->age }}</td>
                                        
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <a href="{{ route('dailydepart.pdf') }}" class="text-danger fa fa-file-pdf-o m-3" style="font-size: 20px;"> PDF</a>
                        <a href="{{ route('dailydepart.excel') }}" class="text-success fa fa-file-excel-o m-3" style="font-size: 20px;"> Excel</a>
                        <a href="{{ route('dailydepart.print') }}" class="text-secondary fa fa-print m-3" style="font-size: 20px;">Print</a>
                    </div>
                    <div>
                        @if (!isset($paginate))
                            <div class="container my-2 mt-5">
                                {{ $recordPatient->links() }} <!-- Corrected to use the singular variable -->
                            </div>
                        @endif
                    </div>
               
            </div>
        </div>
    </div>
</div>

@endsection
        
