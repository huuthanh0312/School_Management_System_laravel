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
                            <h4 class="box-title">Add<strong> Student Fee</strong></h4>
                        </div>

                        <div class="box-body">
                            <form action="{{route('account.fee.store')}}" method="post" class="form-group">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group ">
                                            <h5 class="mt-2 ">Year: </h5>
                                            <div class="controls">
                                                <select name="year_id" id="year_id" class="form-control" required>
                                                    <option selected disabled>Select Year</option>
                                                    @foreach($student_years as $year)
                                                    <option value="{{$year->id}}">{{$year->name}}</option>
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
                                                    <option value="{{$class->id}}">{{$class->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group ">
                                            <h5 class="mt-2 ">Fee Category </h5>
                                            <div class="controls ">
                                                <select name="fee_category_id" id="fee_category_id" class="form-control"
                                                    required>
                                                    <option selected disabled>Select Exam Type</option>
                                                    @foreach($fee_categories as $fee_cat)
                                                    <option value="{{$fee_cat->id}}">{{$fee_cat->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group ">
                                            <h5 class="mt-2 ">Date </h5>
                                            <div class="controls ">
                                                <input type="date" name="date" id="date" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <a id="search" class="btn btn-primary btn-rounded ">Search</a>
                                    </div>
                                </div> <!-- /.row -->
                                <br>
                                <!-- Marks Entry Table -->
                                <div class="row">
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
                                                <button type="Submit" class="btn btn-rounded btn-primary">Submit</button>
                                            </script>
                                        </div>
                                        <br>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $(document).on('click', '#search', function() {
        var year_id = $('#year_id').val();
        var class_id = $('#class_id').val();
        var fee_category_id = $('#fee_category_id').val();
        var date = $('#date').val();
        $.ajax({
            url: "{{route('account.fee.getstudent')}}",
            type: 'GET',
            data: {
                'class_id': class_id,
                'year_id': year_id,
                'fee_category_id': fee_category_id,
                'date': date,
            },
            beforeSend: function() {},
            success: function(data) {
                var source = $("#document-template").html();
                var template = Handlebars.compile(source);
                var html = template(data);
                $('#document-results').html(html);
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    });
});
</script>
@endsection
@section('script')

@endsection