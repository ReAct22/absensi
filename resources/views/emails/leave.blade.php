<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Izin Cuti Karyawan</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333;">

    <h2 style="text-align: center;">Izin Cuti Karyawan</h2>

    <p>
        Berikut informasi pengajuan cuti oleh <strong>{{ $employee_name }}</strong>:
    </p>

    <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th style="border: 1px solid #000; padding: 8px;">No Employee</th>
                <th style="border: 1px solid #000; padding: 8px;">Name Employee</th>
                <th style="border: 1px solid #000; padding: 8px;">Start Date</th>
                <th style="border: 1px solid #000; padding: 8px;">End Date</th>
                <th style="border: 1px solid #000; padding: 8px;">Total Day</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border: 1px solid #000; padding: 8px;">{{ $employee_code }}</td>
                <td style="border: 1px solid #000; padding: 8px;">{{ $employee_name }}</td>
                <td style="border: 1px solid #000; padding: 8px;">{{ $start_date }}</td>
                <td style="border: 1px solid #000; padding: 8px;">{{ $end_date }}</td>
                <td style="border: 1px solid #000; padding: 8px;">{{ $total_days }}</td>
            </tr>
        </tbody>
    </table>

    <div style="text-align: center; margin-top: 20px;">
        <form action="{{url('/leave-request/approve')}}" method="POST">
            @csrf
            <input type="hidden" name="name_bos" value="{{$name_bos}}">
            <input type="hidden" name="status" value="{{$status}}">
            <input type="hidden" name="date_approve" value="{{now()}}">
            <input type="hidden" name="employee_id" value="{{$employee_id}}">
            <button type="submit""
           style="
               display: inline-block;
               padding: 10px 20px;
               background-color: #4CAF50;
               color: white;
               text-decoration: none;
               border-radius: 5px;
           ">
            Approve Request
        </button>
        </form>
    </div>
    <div style="text-align: center; margin-top: 20px">
        <a href="" style="display: inline-block; padding: 10px 20px; background-color: red; color: white; text-decoration: none; border-radius: 5px">
            Reject Request
        </a>
    </div>

</body>
</html>
