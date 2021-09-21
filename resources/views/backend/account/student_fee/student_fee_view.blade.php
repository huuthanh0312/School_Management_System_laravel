@extends('admin.admin_master')

@section('admin_content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
 
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Student Fee List</h3>
                            <a href="{{route('student.fee.add')}}" class="btn btn-round btn-success mb-10 float-right">Add / Edit Student Fee</a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5%">SL</th>
                                            <th>ID No</th>
                                            <th>Name</th>
                                            <th>Year</th>
                                            <th>Class</th>
                                            <th>Fee Type</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($allData as $key => $student_fee)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{$student_fee['student']['id_no']}}</td>
                                            <td>{{$student_fee['student']['name']}}</td>
                                            <td>{{$student_fee['student_year']['name']}}</td>
                                            <td>{{$student_fee['student_class']['name']}}</td>
                                            <td>{{$student_fee['fee_category']['name']}}</td>
                                            <td>{{$student_fee->amount}}$</td>
                                            <td>{{date('m-Y', strtotime($student_fee->date))}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
</div>

@endsection