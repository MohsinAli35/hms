<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Govt.Al-Aziz Hospital</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <style>
        table {
  border-collapse: collapse;
  width: 100%;
  table-layout: fixed;
}
th, td {
  
  width: 30%;
  border: 1px solid #dee2e6; 
  padding: 0.75rem; 
  word-wrap: break-word;
}


    </style>
</head>
<body>

    
    
        <div class="container ">
            <div class="content">
                
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Patients</h4>
                    </div>
                
    
  <table class=" custom-table datatable mb-0">
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