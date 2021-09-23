<!DOCTYPE html>
<html>

<head>
    <style>
    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td,
    #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #customers tr:hover {
        background-color: #ddd;
    }

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
    }
    </style>
</head>
<body>

    <table id="customers">
        <tr>
            <td style="text-align: center;">
                <h2>Thanh Learning</h2>
            </td>
            <td>
                <h2>Thanh School ERP</h2>
                <p>School Address : Phu Loc, Thua Thien, Hue</p>
                <p>Phone: 1111111111</p>
                <p>Email:thanhleaning@gmail.com</p>
                <p> <b>Attendance Report</b></p>
            </td>
        </tr>

    </table>
    <br>
    <br>

    <strong>Employee Name : </strong> {{$allData['0']['user']['name']}},
    <strong>ID No :</strong> {{$allData['0']['user']['id_no']}},
    <strong>Month :</strong> {{$month}}
    <br>
    <br>
    <table id="customers">
        <tr>
            <td width="50%"> Date </td>
            <td width="50%"> Attendance Status </td>
        </tr>
        <tr>
            @foreach($allData as $value)
            <td>{{date('d-m-Y', strtotime($value->date))}}</td>
            <td>{{ $value->attend_status }}</td>
            @endforeach
        </tr>
        <tr>
            <td colspan="2">
                <strong>Total Absent: </strong> {{$absents}} ,
                <strong>Total Leave: </strong> {{$leaves}}
            </td>
        </tr>

    </table>
    <br>
    <br>
    <i style="font-size:10px; float:right;">Print Data: {{ date("d M Y")}}</i>
    <hr style="border:dashed ; width: 95%; color: #000000; margin-bottom: 50px;">

</body>

</html>