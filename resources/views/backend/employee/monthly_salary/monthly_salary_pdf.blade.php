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

$date = date('Y-m-d',strtotime($details['0']['date']));
if($date != ''){
    $where[] = ['date', 'like', $date.'%'];
}

$total_attend = \App\Models\EmployeeAttendance::with(['user'])->where($where)->where('employee_id',$details['0']->employee_id)->get();
$count_absent = count($total_attend->where('attend_status', 'Absent'));

$salary = (float)$details['0']['user']['salary'];
$salary_perday = (float)$salary/30;
$total_salary_minus = (float)$count_absent * (float)$salary_perday;
$total_salary = (float)$salary - (float)$total_salary_minus;
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
                <p> <b>Employee Monthly Salary</b></p>
            </td>
        </tr>

    </table>
	<table id="customers">
        <tr>
            <th width="10%"> SL</th>
            <th width="45%"> Employee Details</th>
            <th width="45%"> Employee Data</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Employee Name</td>
            <td>{{ $details['0']['user']['name'] }}</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Basic Salary</td>
            <td>{{ $details['0']['user']['salary'] }}$</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Total Absent For This Month</td>
            <td>{{ $count_absent }}</td>
        </tr>
		<tr>
            <td>4</td>
            <td>Month</td>
            <td>{{ date('d-m-Y', strtotime($details['0']['date'])) }}</td>
        </tr>
		<tr>
            <td>5</td>
            <td>Salary This Month</td>
            <td>{{ $total_salary }} $</td>
        </tr>
		<tr>
            <td>6</td>
            <td>Salary This Month</td>
            <td>{{ $total_salary }} $ </td>
        </tr>
    </table>
	<br>
    <br>
	<i style="font-size:10px; float:right;">Print Data: {{ date("d M Y")}}</i>
    <hr style="border:dashed ; width: 95%; color: #000000; margin-bottom: 50px;">
    <table id="customers">
        <tr>
            <th width="10%"> SL</th>
            <th width="45%"> Employee Details</th>
            <th width="45%"> Employee Data</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Employee Name</td>
            <td>{{ $details['0']['user']['name'] }}</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Basic Salary</td>
            <td>{{ $details['0']['user']['salary'] }} $</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Total Absent For This Month</td>
            <td>{{ $count_absent }}</td>
        </tr>
		<tr>
            <td>4</td>
            <td>Month</td>
            <td>{{ date('d-m-Y', strtotime($details['0']['date'])) }}</td>
        </tr>
		<tr>
            <td>5</td>
            <td>Salary This Month</td>
            <td>{{ $total_salary }} $</td>
        </tr>
		<tr>
            <td>6</td>
            <td>Salary This Month</td>
            <td>{{ $total_salary }} $</td>
        </tr>
    </table>
	<br>
    <br>
	<i style="font-size:10px; float:right;">Print Data: {{ date("d-M-Y")}}</i>
</body>

</html>