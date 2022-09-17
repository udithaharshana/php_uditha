<!-- Layout -->
@extends('layouts.homeContent_layout')
<!-- End Layout -->
@section('title','Sales Team')

@section('action_menu')
<li><a class="rdrct" href="{{ url('/saller_new') }}" target="_self" title="Create New"><span class="fa fa-file"></span></a></li>
@endsection
<!-- START PAGE CONTENT -->
@section('content')
<div class="col-md-12">
    <div>
        <table class="table" id="dttbl">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phones</th>
                    <th>Current Route</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="body"></tbody>
        </table>
    </div>
</div>
<!-- view class Model -->
<div class="modal animated fadeIn" id="modalview" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="mdpnl_c">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="my_modal_label"></h4>
            </div>
            <div class="modal-body">
                <div class="form-group col-md-12" id="modal_body">
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-danger" id="modal_close"><span class="fa fa-times">&nbsp;</span>Close</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('myscript')
<script type="text/javascript" src="{{ URL::asset('theme/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script type="text/javascript">
    let sales_team = [];
    //function for load datatable data
    $(document).ready(function() {
        data_load();
    })

    function data_load() {
        var table_1 = $('#dttbl').DataTable({
            "searching": false,
            'columns': [{
                    data: "sid"
                },
                {
                    data: "name"
                },
                {
                    data: "email"
                },
                {
                    data: "telephone"
                },
                {
                    data: "route.name"
                },
                {
                    data: "sid"
                }
            ],
            'ordering': false,
            'ajax': {
                "url": "{{ url('/saller_home_data') }}",
                "dataSrc": "data",
                "data": function(data) {},
                "type": "GET",
                "deferRender": true,
                "error": function(e) {
                    console.log("error");
                }
            },
            'columnDefs': [

                {
                    "targets": 0,
                    "className": "col text-left"
                }, {
                    "targets": 1,
                    "className": "col text-left"
                }, {
                    "targets": 2,
                    "className": "col text-left"
                }, {
                    "targets": 3,
                    "className": "col text-left"
                }, {
                    "targets": 4,
                    "className": "col text-left"
                }, {
                    "targets": 5,
                    "className": "col text-right",
                    render: function(data, type, row, meta) {
                        var actvbtn = "";
                        var btnlist = "";
                        return '<a id="modalview_btn" class="prvw btn" saller_id="' + row.sid + '">View</a><a class="edit btn" id="' + row.sid + '">Edit</a><a class="delete btn" id="' + row.sid + '">Delete</a>';
                    }
                }
            ]
        });
    }
    //send prvw id to edit page
    $('#dttbl').on('click', '.edit', function(e) {
        e.preventDefault();
        var sid = $(this).attr('id');
        $.redirect('{{ url("/saller_edit") }}', {
            "sid": sid
        }, "GET", "_self");
    });

    //delete saler
    $('#dttbl').on('click', '.delete', function(e) {
        e.preventDefault();
        var sid = $(this).attr('id');

        $.ajax({
                        type: "POST",
                        url: "{{ url('/saller_delete') }}",
                        async: false,
                        data: {
                            "sid": sid
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend: function() {
                            $("body").css("cursor", "wait");
                        },
                        success: function(msg) {
                            $("body").css("cursor", "default");
                            location.reload();
                        },
                        error: function() {
                            $("body").css("cursor", "default");
                            console.log("Error");
                        }
                    });
    });


    //send prvw id to prvw page
    $('#dttbl').on('click', '.prvw', function(e) {
        e.preventDefault();
        var sid = $(this).attr('saller_id');
        console.log(sid);
        $.ajax({
            type: "POST",
            url: "{{ url('/saller_details') }}",
            async: false,
            data: {
                "sid": sid
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $("body").css("cursor", "wait");
            },
            success: function(data) {
                $("body").css("cursor", "default");
                $('#my_modal_label').html(data.name);
                var content = '<div class="row pt-2" ><div class="col-md-12"><table class="table table-striped"><tbody><tr><th>Id</th><td>' + data.sid + '</td></tr><tr><th>Name</th>  <td>' + data.name + '</td></tr><tr><th>Telephone</th><td>' + data.telephone + '</td></tr><tr><th>Email Address</th><td>' + data.email + '</td></tr><tr><th>Join Date</th><td>' + data.join_date + '</td></tr><tr><th>Current Route</th><td>' + data.route.name + '</td></tr><tr><th>Comment</th><td>' + data.comment + '</td></tr></tbody></table></div></div></div></div>';
                $('#modal_body').html(content);
                $('#modalview').fadeIn();
            },
            error: function() {
                $("body").css("cursor", "default");
                console.log("Error");
            }
        });
    });

    //send prvw id to edit page
    $('#modal_close').click(function() {
        $('#modalview').fadeOut();
    });
</script>
@endsection
<!-- END PAGE CONTENT -->
