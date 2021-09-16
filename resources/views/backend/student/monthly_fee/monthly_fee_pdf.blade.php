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
$monthlyfee = App\Models\FeeCategoryAmount::where('fee_category_id','2')->where('class_id',$details->class_id)->first();
$originalfee = $monthlyfee->amount;
$discount = $details['discount']['discount'];
$discounttablefee = $discount/100*$originalfee;
$finalfee = (float)$originalfee - (float)$discounttablefee;
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
                <p> <b>Student Monthly Fee</b></p>
            </td>
        </tr>

    </table>
	<table id="customers">
        <tr>
            <th width="10%"> SL</th>
            <th width="45%"> Student Details</th>
            <th width="45%"> Student Data</th>
        </tr>
        <tr>
            <td>1</td>
            <td>ID No</td>
            <td>{{ $details['student']['id_no'] }}</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Roll No</td>
            <td>{{ $details->roll }}</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Student Name</td>
            <td>{{ $details['student']['name'] }}</td>
        </tr>
		<tr>
            <td>4</td>
            <td>Farther's Name</td>
            <td>{{ $details['student']['fname'] }}</td>
        </tr>
		<tr>
            <td>5</td>
            <td>Session</td>
            <td>{{ $details['student_year']['name'] }}</td>
        </tr>
		<tr>
            <td>6</td>
            <td>Class</td>
            <td>{{ $details['student_class']['name'] }}</td>
        </tr>
		<tr>
            <td>7</td>
            <td>Monthly Fee </td>
            <td>{{ $originalfee }} $</td>
        </tr>
		<tr>
            <td>8</td>
            <td>Discount Fee</td>
            <td>{{ $details['discount']['discount'] }}%</td>
        </tr>
		<tr>
            <td>9</td>
            <td>Fee For The Student Of {{$month}}</td>
            <td><b>{{ $finalfee }}</b> $</td>
        </tr>

    </table>
	<br>
    <br>
	<i style="font-size:10px; float:right;">Print Data: {{ date("d M Y")}}</i>
    <hr style="border:dashed ; width: 95%; color: #000000; margin-bottom: 50px;">
    <table id="customers">
        <tr>
            <th width="10%"> SL</th>
            <th width="45%"> Student Details</th>
            <th width="45%"> Student Data</th>
        </tr>
        <tr>
            <td>1</td>
            <td>ID No</td>
            <td>{{ $details['student']['id_no'] }}</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Roll No</td>
            <td>{{ $details->roll }}</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Student Name</td>
            <td>{{ $details['student']['name'] }}</td>
        </tr>
		<tr>
            <td>4</td>
            <td>Farther's Name</td>
            <td>{{ $details['student']['fname'] }}</td>
        </tr>
		<tr>
            <td>5</td>
            <td>Session</td>
            <td>{{ $details['student_year']['name'] }}</td>
        </tr>
		<tr>
            <td>6</td>
            <td>Class</td>
            <td>{{ $details['student_class']['name'] }}</td>
        </tr>
		<tr>
            <td>7</td>
            <td>Monthly Fee </td>
            <td>{{ $originalfee }} $</td>
        </tr>
		<tr>
            <td>8</td>
            <td>Discount Fee</td>
            <td>{{ $details['discount']['discount'] }}%</td>
        </tr>
		<tr>
            <td>9</td>
            <td>Fee For The Student Of {{$month}}</td>
            <td><b>{{ $finalfee }}</b> $</td>
        </tr>

    </table>
    <br>
    <br>
	<i style="font-size:10px; float:right;">Print Data: {{ date("d M Y")}}</i>
</body>

</html>