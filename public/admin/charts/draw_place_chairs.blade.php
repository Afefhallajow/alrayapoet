<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images') }}/fav.png">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>توزع الكراسي</title>

    <!-- Bootstrap Css -->
    <link href="{{ asset('admin/css') }}/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />

    <!-- ColorPicker -->
    <link href="{{ asset('admin') }}/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css" />

    <!-- Icons Css -->
    <link href="{{ asset('admin/css') }}/icons.min.css" rel="stylesheet" type="text/css" />

    <!-- App Css-->
    <link href="{{ asset('admin/css') }}/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <style>
        .container{
            margin: 1rem auto;
            text-align: center;
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #b0bacb;
            width: 30px;
            max-width: 30px;
            height: 170px;
            text-align: center; 
            vertical-align: middle;
        }
        
        table td,table th{
            width: 30px;
            height: 170px;
        }
        .container_table{
            border: 1px solid #ccc6c6;
            overflow: auto;
            height: 400px;
            border-radius: 10px;
            margin: 20px auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .table_ch {
            position: relative;
            background-color: #fff;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .table_number{
            font-size: 24px;
            margin: auto
        }

        .chair {
            position: absolute;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column
        }
        .m10{
            margin: 5px auto;
        }
        #chair_name{
            direction: rtl;
        }
        #invited_info, .invited_info{
            font-weight: bold;
            background-color: #eee;
            /* padding: 4px; */
            border-radius: 4px;
        }
        .reserved{
            filter: drop-shadow(2px 4px 6px black);
        }
        .hide{
            display: none
        }
        .blured{
            filter: blur(3px);
            pointer-events: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="rw" id="chart">
            @include('admin.charts.charts')
        </div>
    </div>

    @role('Admin|Employee'))
        <span id="current_role" data="admin"></span>
    @else
        <span id="current_role" data="party"></span>
    @endrole

    <div id="formModal" class="modal fade" role="dialog">
        <div class="modal-dialog" style="max-width: 40%;">
            <div class="modal-content">
                <div class="modal-body">
                    <div id="chair_info" style="display: flex; justify-content: center; align-items: center; flex-direction: column">
                        <span id="chair_number" class="m10"></span>
                        <span id="chair_code" class="m10"></span>
                        <span id="chair_name" class="m10"></span>
                        <span id="chair_image"></span>
                        @role('Admin|Employee')
                            <span id="empty_place" class="empty_place btn btn-danger m10 hide">تفريغ المكان</span>
                        @endrole
                        <span id="invited_info" class="m10"></span>
                        <span id="unreserve_chair" class="unreserve_chair btn btn-danger m10 hide">تحرير الكرسي</span>
                    </div>
    
                    <span id="form_result" class="text-center"></span>
    
                    <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
        
                    @role('Admin|Employee')
                        <div class="form-group row mb-3">
                            <div class="col-sm-12">
                                <select class="form-control text-center" name="new_chair" id="chair">
                                    <option value="" selected disabled>اختر كرسي</option>
                                    @foreach($not_placed_chairs as $ch)
                                        <option value="{{$ch->id}}">{{$ch->code}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endrole
    
                    @if($day_id)
                        <div class="form-group row mb-3">
                            <div class="col-sm-12">
                                <select class="form-control text-center" name="invited_id" id="invited_id">
                                    <option value="" selected disabled>اختر مدعو</option>
                                    @foreach($inviteds as $invited)
                                        <option value="{{$invited->id}}">{{$invited->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
        
                    <!-- submit -->
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-12 text-center">
                            <input type="hidden" name="index_i" id="index_i" />
                            <input type="hidden" name="index_j" id="index_j" />
    
                            <input type="hidden" name="chair_id" id="chair_id" />
    
                            <input type="submit" name="action_button" id="action_button" class="blueColor btn btn-light" value="Add"
                                style="padding:8px 40px;" />
                            <div class="spinner-grow text-secondary m-1 blueColor" role="status" style="display: none">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

<script src="{{ asset('admin') }}/libs/jquery/jquery.min.js"></script>
<script src="{{ asset('admin') }}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

<script> 
    var role = $('#current_role').attr('data');

    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

    $(document).ready(function () {
        var url_load_chart = "{{ route('load_place_chart', ['id'=>$place->id, 'page'=>'ajax']) }}";
        
        // open modal
        $(document).on("click",'.chair, .chair-td' ,function() {
            var id = $(this).attr('data-id');
            var code = $(this).attr('data-code');
            var name = $(this).attr('data-name');
            var image = $(this).attr('data-image');
            var invited = $(this).attr('data-invited');
            var i = $(this).attr('data-i');
            var j = $(this).attr('data-j');
        
            $('#sample_form')[0].reset();
        
            $('#form_result').html('');
            $('#index_i').val(i);
            $('#index_j').val(j);
        
            if(id){
                $('#chair_number').html(`رقم الكرسي: ${j}-${i}`);
                $('#chair_code').html(code);
                $('#chair_name').html(`فئة الكرسي: ${name}`);
                $('#chair_image').html(`<img src="{{ asset('images') }}/${image}" width='70' class='img-thumbnail' style="width: 150px; height: 150px; border-radius: 20px; margin-bottom: 10px;"/>`);
                $('#invited_info').html(`${invited}`);
        
                if(role == 'admin'){
                    $('#empty_place').removeClass('hide');
                    $('#empty_place').attr('data', id);
                }
                else{
                    $('#empty_place').addClass('hide');
                    $('#empty_place').attr('data', null);
                }
        
                if(invited) {
                    $('#unreserve_chair').removeClass('hide');
                    $('#unreserve_chair').attr('data', id);
                }
                else{
                    $('#unreserve_chair').addClass('hide');
                    $('#unreserve_chair').attr('data', null);  
                }
                
                $('#chair_id').val(id);
            }
            else{
                if(role == 'admin') var empty_place_btn = '<span id="empty_place" class="empty_place btn btn-danger m10 hide">تفريغ المكان</span>';
                else var empty_place_btn = '';
                $('#chair_info').html(`
                    <span id="chair_number" class="m10">رقم الكرسي: ${j}-${i}</span>
                    <span id="chair_code" class="m10"></span>
                    <span id="chair_name" class="m10"></span>
                    <span id="chair_image"></span>
                    ${empty_place_btn}
                    <span id="invited_info" class="m10"></span>
                    <span id="unreserve_chair" class="unreserve_chair btn btn-danger m10 hide">تحرير الكرسي</span>
                `);
        
                $('#chair_id').val('');
            }
        
            $('#formModal').modal('show');
        });
        
        // unreserve chair
        $(document).on("click",'.unreserve_chair' ,function() {
            var btn = $(this)
            var chair_id = btn.attr('data');
            var text_btn = btn.html();
        
            $.ajax({
                url: "{{ route('unreserve_chair') }}",
                beforeSend: function () {
                    $('.container_chart').addClass('blured');
                    btn.html('<i class="fa fa-circle-o-notch fa-spin"></i>');
                },
                method: "POST",
                data: {chair_id: chair_id},
                success: function (data) {
                    $('#chart').load(url_load_chart, function(){
                        reload_empty_chairs();
                        reload_invited();
                        btn.html(text_btn);
                        $('#formModal').modal('hide');
                    })
                }
            });
        });
    
        // empty chair
        $(document).on("click",'.empty_place' ,function() {
            var btn = $(this)
            var chair_id = btn.attr('data');
            var text_btn = btn.html();
    
            $.ajax({
                url: "{{ route('empty_place') }}",
                beforeSend: function () {
                    $('.container_chart').addClass('blured');
                    btn.html('<i class="fa fa-circle-o-notch fa-spin"></i>');
                },
                method: "POST",
                data: {chair_id: chair_id},
                success: function (data) {
                    $('#chart').load(url_load_chart, function(){
                        reload_empty_chairs();
                        reload_invited();
                        btn.html(text_btn);
                        $('#formModal').modal('hide');
                    })
                }
            });
        });
    
        // submit form
        $('#sample_form').on('submit', function (event) {
            event.preventDefault();
            $.ajax({
                url: "{{ route('addChairPlace') }}",
                beforeSend: function () {
                    $('.container_chart').addClass('blured');
                    $('#action_button').hide();
                    $('.spinner-grow').show();
                },
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    var html = '';
                    if (data.errors) {
                        html = '<div class="alert alert-danger">';
                        for (var count = 0; count < data.errors.length; count++) {
                            html += '<p><i class="bx bx-error font-size-16 align-middle mr-1"></i>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                        $('.container_chart').removeClass('blured');
                        $('#form_result').html(html);
                        $('#action_button').show();
                        $('.spinner-grow').hide();
                    }
                    if (data.success) {
                        html = '<div class="alert alert-success"><i class="bx bx-check-double font-size-16 align-middle mr-1"></i>' + data.success +
                            '</div>';
                        $('#sample_form')[0].reset();

                        $('#chart').load(url_load_chart, function(){
                            reload_empty_chairs();
                            reload_invited();
                            $('#form_result').html(html);
                            $('#action_button').show();
                            $('.spinner-grow').hide();
                            $('#formModal').modal('hide');
                        })
                    }
                }
            });
        });
    });

    function reload_empty_chairs() {
        $.ajax({
            url: "{{ route('chairs_notplaced', ['place_id'=>$place->id]) }}",
            method: "GET",
            success: function (data) {
                var options = `<option value="" selected disabled>اختر كرسي</option>`;
                data.forEach(element => {
                    options += `<option value="${element.id}">${element.code}</option>`;
                });
                $('#chair').html(options);
            }
        });
    }
    function reload_invited() {
        $.ajax({
            url: "{{ route('invited_notplaced', $day_id) }}",
            method: "GET",
            success: function (data) {
                var options_in = `<option value="" selected disabled>اختر مدعو</option>`;
                data.forEach(element => {
                    options_in += `<option value="${element.id}">${element.name}</option>`;
                });
                $('#invited_id').html(options_in);
                $('.container_chart').removeClass('blured');
            }
        });
    }
</script>

@include('admin.charts.script_chart')

</body>
</html>