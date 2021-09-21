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
                            <h4 class="box-title">Edit<strong>  Marks Entry</strong></h4>
                        </div>

                        <div class="box-body">
                        <form action="{{route('marks.entry.update')}}" method="post" class="form-group" >
                                @csrf
                                <div class="row">        
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group ">
                                            <h5 class="mt-2 ">Year: </h5>
                                            <div class="controls">                                              
                                                <select name="year_id" id="year_id" class="form-control" required>
                                                    <option selected disabled>Select Year</option>
                                                    @foreach($student_years as $year)
                                                    <option value="{{$year->id}}" >{{$year->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group ">
                                            <h5 class="mt-2 ">Class: </h5>
                                            <div class="controls ">
                                                
                                                <select name="class_id" id="class_id" class="form-control" required>
                                                    <option selected disabled>Select Class</option>
                                                    @foreach($student_classes as $class)
                                                    <option value="{{$class->id}}" >{{$class->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group ">
                                            <h5 class="mt-2 ">Subject </h5>
                                            <div class="controls ">
                                                <select name="assign_subject_id" id="assign_subject_id" class="form-control" required>
                                                    <option selected disabled>Select Exam Type</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group ">
                                            <h5 class="mt-2 ">Exam Type: </h5>
                                            <div class="controls ">
                                                <select name="exam_type_id" id="exam_type_id" class="form-control" required>
                                                    <option selected disabled>Select Subject</option>
                                                    @foreach($exam_type as $exam)
                                                    <option value="{{$exam->id}}" >{{$exam->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                    <a id="search" class="btn btn-primary btn-rounded ">Search</a>
                                    </div>
                                </div> <!-- /.row -->
                                <br>
                                <!-- Marks Entry Table -->
                                <div class="row d-none" id="marks-entry">
                                    <div class="col-md-12">
                                        <table class="table table-striped table-bordered" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>ID No</th>
                                                    <th>Student Name</th>
                                                    <th>Father Name</th>
                                                    <th>Gender</th>
                                                    <th>Marks</th>
                                                </tr>
                                            </thead>
                                            <tbody id="marks-entry-tr">
                                                
                                            </tbody>
                                        </table>
                                        <br>
                                        <button type="submit" class="btn btn-rounded btn-success">Update</button>
                                    </div>
                                </div>
                                
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
        var assign_subject_id = $('#assign_subject_id').val();
        var exam_type_id = $('#exam_type_id').val();
        $.ajax({
            url: "{{route('student.marks.edit.getstudents')}}",
            type: 'GET',
            data: {
                'year_id': year_id,
                'class_id': class_id,
                'assign_subject_id': assign_subject_id,
                'exam_type_id': exam_type_id
            },
            success: function(data){
                $('#marks-entry').removeClass('d-none');
                var html = '';
                $.each(data, function(key, value){
                    html += '<tr>' + 
                        '<td>'+value.student.id_no + '<input type="hidden" name="student_id[]" value="'
                              + value.student_id +'"><input type="hidden" name="id_no[]" value="' + value.student.id_no +'"></td>' 
                        + '<td>' + value.student.name +'</td>'
                        + '<td>' + value.student.fname +'</td>'
                        + '<td>' + value.student.gender +'</td>'
                        + '<td> <input type="text" name="marks[]" class="form-control form-control-sm" required value="'+
                        value.marks+'"></td>'
                        + '</tr>';
                });
                html = $('#marks-entry-tr').html(html);
            }
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        $(document).on('change','#class_id', function() {
            var class_id = $('#class_id').val();
            $.ajax({
                url: "{{route('marks.getsubject')}}",
                type: 'get',
                data: {'class_id':class_id},
                success: function(data) {
                    var html = '<option value="">Select Subject </option>'
                    $.each(data, function(key, value) {
                        html += '<option value="'+value.id+'">'+value.school_subject.name+'</option>'
                    });
                    $('#assign_subject_id').html(html);
                }
            });
        });
    });
</script>
@endsection