<!-- Layout -->
@extends('layouts.contentLayout')
<!-- End Layout -->
@if(isset($saller))
@section('title','Edit Sales Representive')
@else
@section('title','Create New Sales Representive')
@endif

<!-- Custom Action  -->
@section('action_menu')
<a class="btn btn-success panel-refresh" id="savfm" target="_self"><span class="fa fa-floppy-o">&nbsp;</span>Save</a>
<a class="btn btn-danger rdrct" href="{{ url('sales_team') }}" target="_self"><span class="fa fa-times">&nbsp;</span>Back To List</a>
@endsection

<!-- START PAGE CONTENT -->
@section('content')
<div class="row">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ url('saller_save') }}" method="POST" id="frmdt" class="pt-2">
        @csrf
        <input type="hidden" name="sid" id="sid" value="{{ isset($saller) ? $saller->sid : ''}}">
        <div class="col-md-12 pb-2">
                <div class="form-group col-md-12">
                    <label class="col-md-3 control-label text-left">Full Name </label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="name" name="name" autocomplete="off" value="{{ isset($saller) ? $saller->name : ''}}">
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label class="col-md-3 control-label text-left">Email Address</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="email" name="email" autocomplete="off" value="{{ isset($saller) ? $saller->email : ''}}">
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label class="col-md-3 control-label text-left">Telephone</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="telephone" name="telephone" autocomplete="off" value="{{ isset($saller) ? $saller->telephone : ''}}">
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label class="col-md-3 control-label text-left">Join Date</label>
                    <div class="col-md-6">
                    <div class="input-group date">
                        <input type="text" class="form-control datepicker" autocomplete="off" name="join_date" id="join_date" value=""/>
                        <span class="input-group-btn input-group-addon">
                                <a herf="#" style="color:aliceblue"><span class="glyphicon glyphicon-calendar"></span></a>
                            </span>
                    </div>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label class="col-md-3 control-label text-left">Current Routes</label>
                    <div class="col-md-6">
                        <select class="form-control select" name="rid" id="rid">
                            <option value="">Select Route</option>
                            @foreach ($routes as $row)
                            <option value="{{ $row['rid'] }} " @if(isset($saller) && $saller->route_id==$row['rid']) selected @endif> {{ $row['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label class="col-md-3 control-label text-left">Remark</label>
                    <div class="col-md-6">
                        <textarea class="form-control" style="resize:none" autocomplete="off" id="remark" name="remark">{{ isset($saller) ? $saller->comment : ''}}</textarea>
                    </div>
                </div>



        </div>
    </form>
</div>
@endsection

<!-- END PAGE CONTENT -->

<!-- START SCRIPT -->
@section('myscript')
<script type="text/javascript" src="{{ asset('/theme/js/plugins/bootstrap/bootstrap-select.js') }}"></script>
<script type="text/javascript" src="{{ asset('/theme/js/plugins/bootstrap/bootstrap-datepicker.js') }}"></script>

<script type="text/javascript">
    $('.date').datepicker({
    format    : "dd/mm/yyyy",
    autoclose : true,
    weekStart : [1]
});

@if(isset($saller))
let join_date = new Date('{{ $saller->join_date }}');
$('.date').datepicker("setDate", join_date);
@endif

    //Form Validation
    $(document).ready(function() {
        $("#frmdt").validate({
            onsubmit: false, //Disables form submit validation
            onkeyup: false, //Disables onkeyup validation
            onclick: false, //Disables onclick validation of checkboxes and radio buttons
            ignore: [],
            errorPlacement: function(error, element) {
                if (element.hasClass('select')) {
                    error.insertAfter(element);
                } else {
                    error.insertAfter(element);
                }
            },
            rules: {
                name: {
                    required: true,
                    chk_name: true
                }, //saller name
                email: {
                    email: true
                },
                telephone: {
                    required: true,
                    maxlength: 10,
                    minlength: 9,
                    digits: true
                },
                join_date: {
                    required: true
                },
                rid: {
                    required: true
                },
            }
        });

        //Check Existing saller name
        jQuery.validator.addMethod("chk_name", function(value, element) {
            var name = $('#name').val();
            if (name != '') {
                function valdt() {
                    var sid = 0;
                    var temp = 0;
                    $.ajax({
                        type: "POST",
                        url: "{{ url('/saller_name_validate') }}",
                        async: false,
                        data: {
                            "name": name,
                            "sid": sid
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend: function() {
                            $("body").css("cursor", "wait");
                            $('#name').addClass('data_loading');
                        },
                        success: function(msg) {
                            temp = msg;
                            $("body").css("cursor", "default");
                            $('#name').removeClass('data_loading');
                        },
                        error: function() {
                            $("body").css("cursor", "default");
                            $('#name').removeClass('data_loading');
                            console.log("Error");
                        }
                    });
                    return temp;
                }
                var vlrs = valdt();

                if (vlrs) {
                    return false;
                } else {
                    return true;
                }
            }
        }, "Already Existing Saller Name");

    });

    //Form Save
    $(document).ready(function() {
        $('#savfm').click(function(e) {
            var frmdt = $('#frmdt').valid();
            if (frmdt == true) {
                $("body").css("cursor", "wait");
                $(".loader").fadeIn('slow');
                document.forms["frmdt"].submit();
            } else {
                console.error('Validation Error');
            }
        });
    });
</script>
@endsection
<!-- END SCRIPT -->
