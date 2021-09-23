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
                <p> <b>Student ID Card Report</b></p>
            </td>
        </tr>

    </table>
    <br>
    <br>
    @foreach($allData as $data)
    <table id="customers">
        <tr>
            <td>IMAGE</td>
            <td>Thanh School</td>
            <td>Student ID Card</td>
        </tr>
        <tr>
            <td>Name : {{$data['student']['name']}}</td>
            <td>Session : {{$data['student_year']['name']}}</td>
            <td>Class : {{$data['student_class']['name']}}</td>
        </tr>
        <tr>
            <td>Roll : {{$data->roll}}</td>
            <td>ID No : {{$data['student']['id_no']}}</td>
            <td>Mobile : {{$data['student']['mobile']}}</td>
        </tr>
    </table>
    @endforeach
    <br>
    <br>
    <i style="font-size:10px; float:right;">Print Data: {{ date("d M Y")}}</i>
    <hr style="border:dashed ; width: 95%; color: #000000; margin-bottom: 50px;">

</body>

</html>