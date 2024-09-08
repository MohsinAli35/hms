@extends('../layouts.app')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Daily Record Patients</h4>
            </div>
            <div class="col-sm-6 col-3">
                <span>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Get Department wise report</label> 
                            @if ($departments->count() > 0)
                                <select name="department_id" class="form-control" id="department-select">
                                    <option value="" selected disabled>Select Department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
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
                </span>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                @if ($recordPatient->count() > 0) 
                    <div class="table-responsive">
                        <table class="table table-bordered custom-table datatable mb-0">
                            <thead>
                                <tr>
                                    <th>Serial No</th>
                                    <th>Token No</th>
                                    <th>Department</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Charges</th>
                                    <th>Gender</th>
                                    
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
                                        <td>{{ $patient->department->name }}</td>
                                        <td>{{ $patient->name }}</td>
                                        <td>{{ $patient->phone }}</td>
                                        <td>{{ $patient->price }}</td>
                                        <td>
                                            @if ($patient->gender == 1)
                                                Male
                                            @elseif ($patient->gender == 2)
                                                Female
                                            @elseif ($patient->gender == 3)
                                                Transgender
                                            @endif
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <a href="{{ route('daily.pdf') }}" class="text-danger fa fa-file-pdf-o m-3" style="font-size: 20px;"> PDF</a>
                        <a href="{{ route('daily.excel') }}" class="text-success fa fa-file-excel-o m-3" style="font-size: 20px;"> Excel</a>
                        <a href="{{ route('daily.print') }}" class="text-secondary fa fa-print m-3" style="font-size: 20px;">Print</a>
                    </div>
                    <div>
                        @if (!isset($paginate))
                            <div class="container my-2 mt-5">
                                {{ $recordPatient->links() }} <!-- Corrected to use the singular variable -->
                            </div>
                        @endif
                    </div>
                @else
                    <p>No patients found for today.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('department-select').addEventListener('change', function() {
        var departmentId = this.value;
        if (departmentId) {
            // Redirect to the route with the selected department ID
            window.location.href = "{{ route('dailydepart.report') }}?department_id=" + departmentId;
        }
    });
</script>
@endsection
        
