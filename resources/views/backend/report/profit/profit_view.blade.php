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
                            <h4 class="box-title">Manage<strong> Monthly- Yearly Profite</strong></h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-5 mt-2">
                                    <div class="form-group">
                                        <h5 class="mt-2">Start Date: <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" name="start_date" id="start_date" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 mt-2">
                                    <div class="form-group">
                                        <h5 class="mt-2">End Date: <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" name="end_date" id="end_date" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-4">
                                    <br>
                                    <a name="search" id="search" class="btn btn-primary btn-rounded">Search</a>
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
                                                    <tr>
                                                        @{{{tdsource}}}
                                                    </tr>
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
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
    $.ajax({
        url: "{{route('report.profit.datewise.get')}}",
        type: 'GET',
        data: {
            'start_date': start_date,
            'end_date' : end_date,
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
