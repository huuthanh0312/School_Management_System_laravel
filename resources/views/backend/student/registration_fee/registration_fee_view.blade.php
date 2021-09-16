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
                            <h4 class="box-title">Student Resgistration<strong> Fee</strong></h4>
                        </div>

                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-5 mt-2">
                                    <div class="form-group row">
                                        <h5 class="mt-2 col-sm-2">Year: </h5>
                                        <div class="controls col-sm-10">

                                            <select name="year_id" id="year_id" class="form-control" required>
                                                <option selected disabled>Select Year</option>
                                                @foreach($student_years as $year)
                                                <option value="{{$year->id}}"
                                                    {{ (@$year_id == $year->id) ? "selected" : ""}}>{{$year->name}}
                                                </option>
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
                                                <option value="{{$class->id}}"
                                                    {{ (@$class_id == $class->id) ? "selected" : ""}}>{{$class->name}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <a id="search" class="btn btn-primary btn-rounded ">Search</a>
                                </div>
                            </div> <!-- /.row -->
                            <div class="row ">
                                <div class="col-md-12">
                                    <div id="document-results">
                                        <script id="document-template" type="text/x-handlebars-template">
                                            <table class="table table-striped table-bordered" width="100%">
                                                <thead>
                                                    <tr> @{{{thsource}}}</tr>
                                                </thead>
                                                <tbody>
                                                    @{{#each this}}
                                                    <tr>
                                                        @{{{tdsource}}}
                                                    </tr>
                                                    @{{/each}}
                                                </tbody>
                                            </table>
                                        </script>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js" ></script>
<script type="text/javascript">
$(document).on('click', '#search', function() {
    var year_id = $('#year_id').val();
    var class_id = $('#class_id').val();
    $.ajax({
        url: "{{route('registration.fee.classwise.get')}}",
        type: 'GET',
        data: {
            'class_id': class_id,
            'year_id': year_id
        },
        beforeSend: function(){},
        success: function(data) {
            var source = $("#document-template").html();
            var template = Handlebars.compile(source);
            var html = template(data);
            $('#document-results').html(html);
            $('[data-toggle="tooltip"]').tooltip();
        }
    });
});
</script>
@endsection
