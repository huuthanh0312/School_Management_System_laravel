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
                            <h3 class="box-title">Assign Subject Details</h3>
                            <a href="{{route('assign.subject.view')}}" class="btn btn-round btn-warning mb-10 float-right">Assign Subject View</a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <h4>Class Name: <strong>{{$detailsData['0']['student_class']['name'] }}</strong></h4>
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="10%">SL</th>
                                            <th>Subject Name</th>
                                            <th width="20%">Full Mark</th>
                                            <th width="20%">Pass Mark</th>
                                            <th width="20%">Subjective Mark</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($detailsData as $key => $assign_subject)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{$assign_subject['school_subject']['name'] }}</td>
                                            <td>{{$assign_subject->full_mark}}</td>
                                            <td>{{$assign_subject->pass_mark}}</td>
                                            <td>{{$assign_subject->subjective_mark}}</td>
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