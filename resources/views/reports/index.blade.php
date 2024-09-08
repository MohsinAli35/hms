@php
 $setting = App\Models\Setting::first();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Title and Favicon -->
    <title>{{ $setting->name ?? 'Govt.Al-Aziz Hospital' }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ public_path('storage/' . $setting->favicon) }}">

    <!-- Custom Styles -->
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px auto; /* Center table horizontally */
            table-layout: fixed; /* Fix the table layout */
        }

        th, td {
            border: 1px solid #dee2e6; 
            padding: 0.5rem; 
            word-wrap: break-word; /* Ensure content wraps properly */
            text-align: left; /* Align text to the left */
            overflow: hidden; /* Hide overflow text */
        }

        .container {
            width: 100%;
            margin: 0 auto;
            text-align: center; /* Center the content */
        }

        .page-title {
            font-size: 24px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .content {
            margin-top: 30px;
        }

        .logo {
            margin-bottom: 10px; /* Add some space below the logo */
        }

        .setting-name {
            font-weight: bold;
            margin-bottom: 20px; /* Add space below the setting name */
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="content">
            <!-- Logo Section -->
            <div class="logo">
                <img class="circle-rounded" width="70" src="{{ public_path('storage/' . $setting->logo) }}" alt="Company logo">
            </div>
            
            <div class="setting-name">{{ $setting->name }}</div>

            <div class="page-title">Patients</div>
            
            <table class="table custom-table datatable mb-0">
                <thead>
                    <tr>
                        <th style="width: 15%;">Serial No</th>
                        <th style="width: 15%;">Token No</th>
                        <th style="width: 15%;">Department</th>
                        <th style="width: 15%;">Name</th>
                        <th style="width: 15%;">CNIC</th>
                        <th style="width: 10%;">Age</th>
                        <th style="width: 10%;">Phone</th>
                        <th style="width: 10%;">Charges</th>
                        <th style="width: 10%;">Remark</th>
                        <th style="width: 10%;">Gender</th>
                        <th style="width: 10%;">Date of Visit</th>
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
