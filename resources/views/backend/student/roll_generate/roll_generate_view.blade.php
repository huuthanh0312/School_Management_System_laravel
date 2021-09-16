@extends('admin.admin_master')

@section('admin_content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-full">
        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-md-12">
                    <div class="box bb-3 border-warning">
                        <div class="box-header">
                            <h4 class="box-title">Student Roll<strong> Generator</strong></h4>
                        </div>

                        <div class="box-body">
                        <form action="{{route('roll.generate.store')}}" method="post" class="form-group" >
                                @csrf
                                <div class="row">        
                                    <div class="col-md-5 mt-2">
                                        <div class="form-group row">
                                            <h5 class="mt-2 col-sm-2">Year: </h5>
                                            <div class="controls col-sm-10">
                                                
                                                <select name="year_id" id="year_id" class="form-control" required>
                                                    <option selected disabled>Select Year</option>
                                                    @foreach($student_years as $year)
                                                    <option value="{{$year->id}}" {{ (@$year_id == $year->id) ? "selected" : ""}}>{{$year->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 mt-2">
                                        <div class="form-group row">
                                            <h5 class="mt-2 col-sm-2">Class: </h5>
                                            <div class="controls col-sm-10">
                                                
                                                <select name="class_id" id="class_id" class="form-control" required>
                                                    <option selected disabled>Select Class</option>
                                                    @foreach($student_classes as $class)
                                                    <option value="{{$class->id}}" {{ (@$class_id == $class->id) ? "selected" : ""}}>{{$class->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                    <a id="search" class="btn btn-primary btn-rounded ">Search</a>
                                    </div>
                                </div> <!-- /.row -->
                                <div class="row d-none" id="roll-generate">
                                    <div class="col-md-12">
                                        <table class="table table-striped table-bordered" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>ID No</th>
                                                    <th>Student Name</th>
                                                    <th>Father Name</th>
                                                    <th>Gender</th>
                                                    <th>Roll</th>
                                                </tr>
                                            </thead>
                                            <tbody id="roll-generate-tr">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-info" value="Rolll Generator">
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
    $(document).on('click','#search', function(){
        var year_id = $('#year_id').val();
        var class_id = $('#class_id').val();
        $.ajax({
            url: "{{route('student.registration.getstudents')}}",
            type: 'GET',
            data: {'class_id': class_id, 'year_id': year_id},
            success: function(data){
                $('#roll-generate').removeClass('d-none');
                var html = '';
                $.each(data, function(key, value){
                    html += '<tr>' + 
                        '<td>' +value.student.id_no + '<input type="hidden" name="student_id[]" value="' + value.student_id +'"></td>' 
                        + '<td>' + value.student.name +'</td>'
                        + '<td>' + value.student.fname +'</td>'
                        + '<td>' + value.student.gender +'</td>'
                        + '<td> <input type="text" name="roll[]" class="form-control form-control-sm" value="' + value.roll +'"></td>'
                        + '</tr>';
                });
                html = $('#roll-generate-tr').html(html);
            }
        });
    });
</script>

@endsection