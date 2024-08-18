@extends('../layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="container ">
                <a href="{{ route('patients.index') }}" class="btn btn-sm btn-danger float-right mb-2">Back</a>
                <div class="container border py-3 shadow">

               
                <h3 class="text-center">GOVT.Al-AZIZ HOSPITAL PATIENT DETAIL</h3>
                <div class="row my-2">
                    <div class="col-md-6 my-2">
                        <h4 class="text-uppercase">Name : <strong>{{ $patient->name }}</strong></h4>
                        <h4 class="text-uppercase">Age : <strong>{{ $patient->name }}</strong></h4>
                        <h4 class="text-uppercase">Gender : <strong>
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
                            </strong></h4>
                        <h4 class="text-uppercase">Cnic : <strong>{{ $patient->cnic }}</strong></h4>
                        <h4 class="text-uppercase">Phone Number : <strong>{{ $patient->phone }}</strong></h4>
                    </div>
                    <div class="col-md-6">
                        <h4 class="text-uppercase">Department : <strong>{{ $patient->department->name }}</strong></h4>
                        <h4 class="text-uppercase">Token : <strong>{{ $token->token }} - {{ $token->departement }} -
                                {{ $token->date }}</strong></h4>

                    </div>
                </div>
            </div>

            </div>
        </div>
    </div>
@endsection
