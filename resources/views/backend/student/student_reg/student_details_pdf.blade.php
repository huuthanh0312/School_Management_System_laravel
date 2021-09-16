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
            <td>Student Name</td>
            <td>{{ $details['student']['name'] }}</td>
        </tr>
		<tr>
            <td>2</td>
            <td>ID No</td>
            <td>{{ $details['student']['id_no'] }}</td>
        </tr>
		<tr>
            <td>3</td>
            <td>Student Role</td>
            <td>{{ $details->roll }}</td>
        </tr>
		<tr>
            <td>4</td>
            <td>Farther's Name</td>
            <td>{{ $details['student']['fname'] }}</td>
        </tr>
		<tr>
            <td>5</td>
            <td>Mother's Name</td>
            <td>{{ $details['student']['mname'] }}</td>
        </tr>
		<tr>
            <td>6</td>
            <td>Mobile Number</td>
            <td>{{ $details['student']['mobile'] }}</td>
        </tr>
		<tr>
            <td>7</td>
            <td>Address</td>
            <td>{{ $details['student']['address'] }}</td>
        </tr>
		<tr>
            <td>8</td>
            <td>Gender</td>
            <td>{{ $details['student']['gender'] }}</td>
        </tr>
		<tr>
            <td>9</td>
            <td>Religion</td>
            <td>{{ $details['student']['religion'] }}</td>
        </tr>
		<tr>
            <td>10</td>
            <td>Date Of Birth</td>
            <td>{{ $details['student']['dob'] }}</td>
        </tr>
		<tr>
            <td>11</td>
            <td>Discount</td>
            <td>{{ $details['discount']['discount'] }}%</td>
        </tr>
		<tr>
            <td>12</td>
            <td>Year</td>
            <td>{{ $details['student_year']['name'] }}</td>
        </tr>
		<tr>
            <td>13</td>
            <td>Class</td>
            <td>{{ $details['student_class']['name'] }}</td>
        </tr>
		<tr>
            <td>14</td>
            <td>Group</td>
            <td>{{ $details['student_group']['name'] }}</td>
        </tr>
		<tr>
            <td>15</td>
            <td>Shift</td>
            <td>{{ $details['student_shift']['name'] }}</td>
        </tr>
    </table>
	<br>
	<i style="font-size:10px; float:right;">Print Data: {{ date("d M Y")}}</i>
</body>

</html>