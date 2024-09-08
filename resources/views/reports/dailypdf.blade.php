@php
    $setting = App\Models\Setting::first();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    
    <link rel="shortcut icon" type="image/x-icon" href="{{ public_path('storage/' . $setting->favicon) }}">
    <title>{{ $setting->name ?? 'Gov.AL AZIZ' }}</title>
    
    
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            text-align: center; /* Center the contents */
        }
        .content {
            margin-top: 20px;
        }
        .logo {
            margin-bottom: 10px;
        }
        .setting-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px auto; /* Center the table horizontally */
        }
        th, td {
            border: 1px solid #dee2e6;
            padding: 0.75rem;
            word-wrap: break-word;
            text-align: left; /* Align text to the left in table cells */
        }
        .page-title {
            font-size: 18px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <!-- Centering the logo -->
            <div class="logo">
                <img class="circle-rounded" width="70" src="{{ public_path('storage/' . $setting->logo) }}" alt="Company logo">
            </div>
            
            <!-- Centering the setting name -->
            <div class="setting-name">{{ $setting->name }}</div>

            <!-- Centering the page title -->
            <div class="page-title">Daily Record</div>

            <!-- Table for displaying data -->
            <table border="1" cellpadding="10">
                <thead>
                    <tr>
                        <th>Serial No</th>
                        <th>Token No</th>
                        <th>Department</th>
                        <th>Patient Name</th>
                        <th>Phone</th>
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
                            <td>{{ $patient->department->name }}</td>
                            <td>{{ $patient->phone }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Optional JavaScript (Commented out for PDF generation) --}}
    {{-- 
    <script src="{{asset('assets/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('assets/js/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('assets/js/app.js')}}"></script> 
    --}}
</body>
</html>
