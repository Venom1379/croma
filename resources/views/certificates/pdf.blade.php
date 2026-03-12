<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td,
        th {
            border: 1px solid #444;
            padding: 6px;
        }

        .section {
            background: #eee;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>

<body>

    <h2 style="text-align:center">
        CROYANCE QUALITY SERVICES PVT LTD
    </h2>

    <h3 style="text-align:center">
        SURAKSHA CERTIFICATE
    </h3>


    <table>

        <tr>
            <th colspan="2" class="section">Vehicle Details</th>
        </tr>

        <tr>
            <td>Registration No</td>
            <td>{{ $certificate->vehicle_registration_no }}</td>
        </tr>

        <tr>
            <td>Vehicle Make</td>
            <td>{{ $certificate->vehicle_make }}</td>
        </tr>

        <tr>
            <td>Vehicle Model</td>
            <td>{{ $certificate->vehicle_model }}</td>
        </tr>

        <tr>
            <td>Chassis No</td>
            <td>{{ $certificate->chassis_no }}</td>
        </tr>

        <tr>
            <td>Engine No</td>
            <td>{{ $certificate->engine_no }}</td>
        </tr>

        <tr>
            <td>Emission Norm</td>
            <td>{{ $certificate->vehicle_emission_norm }}</td>
        </tr>

        <tr>
            <td>Date of Registration</td>
            <td>{{ $certificate->date_of_registration }}</td>
        </tr>

    </table>


    <br>

    <table>

        <tr>
            <th colspan="2" class="section">Transporter Details</th>
        </tr>

        <tr>
            <td>Transporter Name</td>
            <td>{{ $certificate->transporter_name }}</td>
        </tr>

        <tr>
            <td>Driver</td>
            <td>{{ $certificate->driver_name }}</td>
        </tr>

        <tr>
            <td>Driver Mobile</td>
            <td>{{ $certificate->driver_mobile }}</td>
        </tr>

    </table>


    <br>

    <table>

        <tr>
            <th colspan="2" class="section">Certification</th>
        </tr>

        <tr>
            <td>Certificate No</td>
            <td>{{ $certificate->certificate_no }}</td>
        </tr>

        <tr>
            <td>Certificate Date</td>
            <td>{{ $certificate->certificate_date }}</td>
        </tr>

        <tr>
            <td>Valid To</td>
            <td>{{ $certificate->certificate_valid_to }}</td>
        </tr>

        <tr>
            <td>Inspector</td>
            <td>{{ $certificate->inspector_name }}</td>
        </tr>

        <tr>
            <td>Result</td>
            <td>{{ $certificate->inspection_result }}</td>
        </tr>

    </table>

</body>

</html>
