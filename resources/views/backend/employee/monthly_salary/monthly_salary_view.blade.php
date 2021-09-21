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
                            <h4 class="box-title">Student Monthly<strong> Fee</strong></h4>
                        </div>
                        <div class="box-body">
                            <div class="row text-center">
                                <div class="col-md-8 mt-2">
                                    <div class="form-group row">
                                        <h5 class="mt-2 col-sm-4">Attendance Date: <span class="text-danger">*</span></h5>
                                        <div class="controls col-sm-8">
                                            <input type="date" name="date" id="date" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2">
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
    var date = $('#date').val();

    $.ajax({
        url: "{{route('employee.monthly.salary.get')}}",
        type: 'GET',
        data: {
            'date': date,
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
