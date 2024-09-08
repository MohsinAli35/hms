
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
                        <h4 class="page-title"> Patients List </h4>
                    </div>
                    <div class="no-print">
                        <button class="btn btn-primary mb-3" onclick="window.print();">Print</button>
                    </div>
  <table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Serial No</th>
            <th>Token No</th>
            <th>Department</th>
            <th>Name</th>
            <th>CNIC</th>
            <th>Age</th>
            <th>Phone</th>
            <th>Gender</th>
            <th>Date of Visit</th>
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
            <td>{{ $patient->department->name }}</td>
            <td>{{ $patient->name }}</td>
            <td>{{ $patient->cnic }}</td>
            <td>{{ $patient->age }}</td>
            <td>{{ $patient->phone }}</td>
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