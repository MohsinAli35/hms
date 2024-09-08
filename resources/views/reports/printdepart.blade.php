
@php
    $setting = App\Models\Setting::first();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('public/storage/'.$setting->favicon)}}">
    <title>{{$setting->name ??'Gov.AL AZIZ'}}</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <style>
  @media print {
            .no-print {
                display: none !important; 
            }
        }

    </style>
</head>
<body>

    
    
        <div class="container ">
            <div class="content">
                <div class="text-center" > <img class="circle-rounded "  width="70" src="{{asset('public/storage/'.$setting->logo)}}" alt="Company logo"> </div>
                <div class="text-center">{{$setting->name}}</div>
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title"> Deparment-Wise Record </h4>
                    </div>
                    <div>
                        @foreach ($patients as $patient)
                            
                        @endforeach
                        <h2>{{$patient->department->name}}</h2>
                    </div>
                    <div>
                        <h5><p>{{ \Carbon\Carbon::now()->format('l, F j, Y') }}</p></h5>

                    </div>
                    <div class="no-print">
                        <button class=" mb-3 btn btn-primary" onclick="window.print();">Print</button>
                    </div>
  <table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Serial No</th>
            <th>Token No</th>
            <th>Patient Name</th>
            <th>Phone</th>
            <th>Rate</th>
            <th>Age</th>
             </tr>
    </thead>
    <tbody>
        @foreach ($patients as $patient)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                @foreach ($tokens as $item)
                @if ($item->paitent_id == $patient->id)
                {{ $item->token }}
                @endif
                @endforeach
            </td>
            <td>{{ $patient->name }}</td>
            <td>{{ $patient->phone }}</td>
            <td>{{ $patient->price }}</td>
            <td>{{ $patient->age }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
            </div></div>
        <!-- patients23:19-->
    
    <script src="{{asset('assets/js/jquery-3.2.1.min.js')}}"></script>
	<script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('assets/js/select2.min.js')}}"></script>
	<script src="{{asset('assets/js/moment.min.js')}}"></script>
	<script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('assets/js/app.js')}}"></script>
</body>
</html>