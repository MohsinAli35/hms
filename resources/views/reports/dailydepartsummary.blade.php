@extends('../layouts.app')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Department-wise Summary</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="row filter-row ">
               
                
                    <div class="col-md-12">
                        <form action="{{route('dailydepartsummary.report')}}" method="GET">
                            <div class="row">
                               
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
                                <div class="col-sm-6 col-md-3 ">
                                   
                                    {{-- <button type="submit" class="btn btn-success btn-block"> Search </button> --}}
                                </div>
                                <div class="col-sm-6 col-md-3 ">
                                   
                                    <button type="submit" class="btn btn-success btn-block"> Search </button>
                                </div>
                              </div>
                        </form>
                    </div>
                                    
                                </div>
                <div class="table-responsive">
                    <table class="table table-bordered custom-table datatable mb-0">
                        <thead>
                            <tr>
                                <th>Serial #</th>
                                <th>Department Name</th>
                                <th>Total Tokens</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            
                            @foreach ($departmentSummaries as $summary)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                    <td>{{ $summary['department_name'] }}</td>
                                    <td>{{ $summary['total_tokens'] }}</td>
                                    <td>{{ $summary['total_price'] }}</td>
                                </tr>
                                    @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <a href="{{ route('summary.pdf') }}" class="text-danger fa fa-file-pdf-o m-3" style="font-size: 20px;"> PDF</a>
                    <a href="{{ route('summary.excel') }}" class="text-success fa fa-file-excel-o m-3" style="font-size: 20px;"> Excel</a>
                    <a href="{{ route('summary.print') }}" class="text-secondary fa fa-print m-3" style="font-size: 20px;">Print</a>
               
                </div>
                <div>
                    @if (!isset($paginate))
                        <div class="container my-2 mt-5">
                            {{$departments->links() }} <!-- Corrected to use the singular variable -->
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
