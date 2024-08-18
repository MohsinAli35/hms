@extends('../layouts.app')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <a href="{{route('patients.index')}}" class="btn btn-sm btn-danger float-right">Back</a>
        <div style="height: 100vh" class="container d-flex justify-content-center align-items-center">
            <div class="container-fluid p-0 rounded shadow" style="height: 400px; width:300px;" >
                <div class="d-flex justify-content-center align-items-center py-2" style="height: 200px;">
                    <div>

                    
                        <div class="d-flex justify-content-center w-100">
                            <img src="{{asset('assets/img/logo1.png')}}" class="img-fluid rounded-circle " width="120px" alt="">
                        </div>
                            <h4 class="py-2 text-center">GOVT. AL-AZIZ HOSPITAL</h4>
                    </div>

                </div>
                <div class="d-flex justify-content-center align-items-center  py-2" style="height: 200px; background-color: lightblue">
                    <div>
                        <h4><strong>{{$token->token}} - {{$token->departement}} - {{$token->date}}</strong></h4>
                        <h6 class="py-1 text-uppercase">Name : <strong>{{$patient->name}}</strong></h6>
                        <h6 class="py-1 text-uppercase">Department : {{$patient->department->name}}</h6>
                        <h6 class="py-1 text-uppercase">Age : {{$patient->age}}</h6>
                        <h6 class="py-1 text-uppercase">Gender :
                            @switch($patient->gender)
                                @case(1)
                                    MALE
                                    @break
                                @case(2)
                                    FEMALE
                                    @break
                                @case(3)
                                    TRANSGENDER
                                    @break
                                @default
                                    
                            @endswitch
                        </h6>

                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection