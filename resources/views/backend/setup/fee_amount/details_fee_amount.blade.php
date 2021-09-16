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
                            <h3 class="box-title">Student Fee Amount Details</h3>
                            <a href="{{route('fee.amount.view')}}" class="btn btn-round btn-warning mb-10 float-right">Fee Amount View</a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <h4>Fee Category: <strong>{{$detailsData['0']['fee_category']['name'] }}</strong></h4>
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="10%">SL</th>
                                            <th>Class Name</th>
                                            <th width="45%">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($detailsData as $key => $fee_amount)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{$fee_amount['student_class']['name'] }}</td>
                                            <td>{{$fee_amount->amount}}</td>
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