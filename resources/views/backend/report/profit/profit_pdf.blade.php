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
@php
$student_fee = \App\Models\AccountStudentFee::whereBetween('date', [$start_date, $end_date])->sum('amount');

$other_cost = \App\Models\AccountOtherCost::whereBetween('date', [$sdate, $edate])->sum('amount');

$employee_salary = \App\Models\AccountEmployeeSalary::whereBetween('date', [$start_date, $end_date])->sum('amount');

$total_cost = $other_cost + $employee_salary;
$profit = $student_fee - $total_cost;
@endphp

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
                <p> <b>Monthly - Yearly Profit</b></p>
            </td>
        </tr>

    </table>
    <table id="customers">
        <tr >
            <td colspan="2">
                <h4>Reporting Date: {{date('m-d-Y', strtotime($start_date))}} - {{date('m-d-Y', strtotime($end_date))}}</h4>
            </td>
        </tr>
        <tr>
            <th width="50%">Purpose</th>
            <th width="50%"> Amount</th>
        </tr>
        <tr>
            <td>Student Fee</td>
            <td>{{ $student_fee }}</td>
        </tr>
        <tr>
            <td>Other Cost</td>
            <td>{{ $other_cost }}</td>
        </tr>
        <tr>
            <td>Employee Salary</td>
            <td>{{ $employee_salary }}</td>
        </tr>
        <tr>
            <td>Total Cost</td>
            <td>{{ $total_cost }}</td>
        </tr>
        <tr>
            <td>Profit</td>
            <td>{{ $profit }}</td>
        </tr>
    </table>
    <br>
    <br>
    <i style="font-size:10px; float:right;">Print Data: {{ date("d M Y")}}</i>
    <hr style="border:dashed ; width: 95%; color: #000000; margin-bottom: 50px;">
    <table id="customers">
        <tr>
            <th width="50%">Purpose</th>
            <th width="50%"> Amount</th>
        </tr>
        <tr>
            <td>Student Fee</td>
            <td>{{ $student_fee }}</td>
        </tr>
        <tr>
            <td>Other Cost</td>
            <td>{{ $other_cost }}</td>
        </tr>
        <tr>
            <td>Employee Salary</td>
            <td>{{ $employee_salary }}</td>
        </tr>
        <tr>
            <td>Total Cost</td>
            <td>{{ $total_cost }}</td>
        </tr>
        <tr>
            <td>Profit</td>
            <td>{{ $profit }}</td>
        </tr>
    </table>
    <br>
    <br>
    <i style="font-size:10px; float:right;">Print Data: {{ date("d M Y")}}</i>
</body>

</html>