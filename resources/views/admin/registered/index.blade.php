@extends('layouts.appp')
@section('css')
    <style>
        .red{
            color:red;
        }
        .error{
            color:red;
        }
        .alert-danger {
            background-color: red !important;
        }
        .dtsb-criteria{
            width:100%;
            margin:auto;
            text-align:center;
        }
        .dtsb-inputCont{
            display: initial;
        }
        div.dtsb-searchBuilder {
            margin-bottom: -2rem;
        }
    </style>
@endsection
@section('content')
    <div id="content">
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-2">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <a class="btn" data-toggle="modal" data-target="#exampleModal" style="font-weight:bold;float:right;font-size:1.2rem">  جدول المتقدمين</a>
                    </h6>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 style="text-align:center">الاسم </h4>
                            <span id="name"></span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered yajra-datatable"  width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>رقم الاشتراك</th>
                                <th>الاسم</th>
                                <th>البريد الالكتروني</th>
                                <th>الجنس</th>
                                <th>العمر</th>
                                <th>الجنسية</th>
                                <th>الدولة </th>
                                <th>المدينة</th>
                                <th>المنطقة</th>

                                <th>الجوال</th>
                                <th>الصورة</th>
                                <th>الفيديو</th>
                                <th>القصيدة</th>
                                <th>معلومات أخرى</th>
                                <th>الفيسبوك</th>
                                <th>انستغرام</th>
                                <th>تويتر</th>
                                <th>الدراسة</th>
                                <th>العمل</th>
                                <th>الموهبة</th>
                                <th>مواهب أخرى</th>
                                <th>مشاركات سابقة</th>

                                <th>المشاركات السابقة الأخرى</th>
                                <th>تم ارسال طلب اعادة</th>
                                <th> حالة طلب الاعادة</th>
                                <th>الحالة</th>
                                <th>الإجراء</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>

    @push('style')

        <link href="{{ asset('assets/SmartWizard/bootstrap.css')}}" rel="stylesheet" type="text/css" />
        {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.css" rel="stylesheet" type="text/css" />--}}
        {{--<link href="{{ asset('assets/admin/lib/SmartWizard/dist/css/smart_wizard.css')}}" rel="stylesheet" type="text/css" />--}}
        {{--<link href="{{ asset('assets/admin/lib/SmartWizard/dist/css/smart_wizard_theme_arrows.css')}}" rel="stylesheet" type="text/css" />--}}
        {{--<link href="{{ asset('assets/SmartWizard/theme_new.css')}}" rel="stylesheet" type="text/css" />--}}
        <link href="{{ asset('assets/SmartWizard/theme-ar.css')}}" rel="stylesheet" type="text/css" />

    @endpush

    @push('script')

        <!--<script src="{{ asset('assets/SmartWizard/jquery.min.js')}}"></script>-->

        <!--<script src="{{ asset('assets/SmartWizard/bootstrap.js')}}"></script>-->
        <!--<script src="{{ asset('assets/SmartWizard/custom_js.js')}}"></script>-->

        <!--<script src="{{ asset('assets/SmartWizard/validator.min.js')}}"></script>-->
        <!--<script type="text/javascript" src="{{ asset('assets/admin/lib/SmartWizard/dist/js/jquery.smartWizard.js')}}"></script>-->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.js"></script>
        <script src="https://nightly.datatables.net/searchbuilder/js/dataTables.searchBuilder.js?_=40f0e1a3ea332af586366e40955c1713"></script>
        @can('view register')
            <script type="text/javascript">
                var serialNumber = 0;

                $(function () {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    var table = $('.yajra-datatable').DataTable({
                        'pageLength': 10,
                        'lengthMenu': [[10, 20, 25, 50, -1], [10, 20, 25, 50, 'All']],
                        dom: 'Blfrtip',
                        buttons: [
                                @can('view register')
                            {
                                extend: 'excel',
                                exportOptions: {columns: [ 0,1,2,3,4,5,6,7, 8,9,13,14,15,16,17,18,19,20,21,22,23,24,25]
                                }
                            },
                            {
                                extend: 'print',
                                exportOptions: {
                                    columns: [ 0,1,2,3,4,5,6,7, 8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25]
                                }
                            }
                            @endif
                        ],


                        ajax: "{{ route('ge tAllRegistereds',['regStatus' => 'all']) }}",
                        "initComplete": function() {
                            // Select the column whose header we need replaced using its index(0 based)
                            this.api().column(1).every(function() {
                                var column = this;
                                // Put the HTML of the <select /> filter along with any default options
                                var select = $('<select class="form-control input-sm"><option value="">All</option></select>')
                                    // remove all content from this column's header and
                                    // append the above <select /> element HTML code into it
                                    .appendTo($('#name'))
                                    // execute callback when an option is selected in our <select /> filter
                                    .on('change', function() {
                                        // escape special characters for DataTable to perform search
                                        var val = $.fn.dataTable.util.escapeRegex(
                                            $(this).val()
                                        );
                                        // Perform the search with the <select /> filter value and re-render the DataTable
                                        column
                                            .search(val ? '^' + val + '$' : '', true, false)
                                            .draw();
                                    });
                                // fill the <select /> filter with unique values from the column's data
                                column.data().unique().sort().each(function(d, j) {
                                    select.append("<option value='" + d + "'>" + d + "</option>")
                                });
                            });
                        },
                        columns: [
                            {data: 'id', name: 'id'},
                            {data: 'name', name: 'name'},


                            {data: 'email', name: 'email'},
                            {data: 'gender', name: 'gender'},
                            {data: 'age', name: 'age'},
                            {data: 'nationality', name: 'nationality'},
                            {data: 'city', name: 'city'},
                            {data: 'city1', name: 'city'},
                            {data: 'area', name: 'area'},

                            {data: 'mobile', name: 'mobile'},
                            {data: 'facebook', name: 'facebook'},
                            {data: 'instagram', name: 'instagram'},
                            {data: 'twitter', name: 'twitter'},
                            {data: 'image', name: 'image'},
                            {data: 'video', name: 'video'},
                            {data: 'poem', name: 'poem'},
                            {data: 'description', name: 'description'},
                            {data: 'job', name: 'job'},
                            {data: 'study', name: 'study'},
                            {data: 'reupload', name: 'reupload'},
                            {data: 'status', name: 'status'},

                            {data: 'anytalent', name: 'anytalent'},
                            {data: 'anytalenti', name: 'anytalenti'},
                            {data: 'anyshare', name: 'anyshare'},

                            {data: 'anysharei', name: 'anysharei'},
                            {
                                data: 'action',
                                name: 'action',
                                orderable: true,
                                searchable: true
                            },
                        ] ,
                        columnDefs: [
                            {
                                // For Responsive
                                responsivePriority: 14,
                                targets: 0
                            },
                            {
                                targets: 0,
                                render: function (data, type, full) {
                                    return full['id'] ;

                                }
                            },
                            {
                                targets: 1,
                                render: function (data, type, full) {
                                    var text = full['name'];
                                    return text;

                                }
                            },
                            {
                                targets: 2,
                                render: function (data, type, full) {
                                    var text = full['email'];
                                    return text;

                                }
                            },
                            {
                                targets: 3,
                                render: function (data, type, full) {
                                    var text = full['gender'];
                                    return text;

                                }
                            },
                            {
                                targets: 4,
                                render: function (data, type, full) {
                                    var text = full['age'];
                                    return text;
                                }
                            },
                            {
                                targets: 5,
                                render: function (data, type, full) {
                                    var text = full['nationality'];
                                    return text;
                                }
                            },
                            {
                                targets: 6,
                                render: function (data, type, full) {
                                    var text = full['city'];
                                    return text;
                                }
                            },
                            {
                                targets: 7,
                                render: function (data, type, full) {
                                    var text = full['city1'];
                                    return text;
                                }
                            },
                            {
                                targets: 8,
                                render: function (data, type, full) {
                                    var text = full['area'];
                                    return text;
                                }
                            },


                            {
                                targets: 9,
                                render: function (data, type, full) {
                                    var text = full['mobile'];
                                    return text;
                                }
                            },
                            {
                                targets: 10,
                                render: function (data, type, full) {
                                    var text = full['image'];
                                    var id=full['id']
                                    console.log(id);
                                    return '<a target="_blank" href="/download/image/'+id+'"><i class="fa fa-download"><i></a>';
                                }
                            },
                            {
                                targets: 11,
                                render: function (data, type, full) {
                                    var text = full['video'];
                                    var id=full['id']
                                    return '<a target="_blank" href="/download/video/'+id+'"><i class="fa fa-download"><i></a>';
                                }
                            },
                            {
                                targets: 12,
                                render: function (data, type, full) {
                                    var text = full['poem'];
                                    var id=full['id']
                                    return '<a target="_blank" href="/download/poem/'+id+'"><i class="fa fa-download"><i></a>';
                                }
                            },
                            {
                                targets: 13,
                                render: function (data, type, full) {
                                    var description = full['description'];
                                    var id = full['id'];
                                    var name = full['name'];
                                    return '<a data-toggle="modal" data-target="#exampleModal'+id+'"><i class="fa fa-eye"></i></a>'+ '</div>'+
                                        '<div class="modal fade" id="exampleModal'+id+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">'+
                                        '<div class="modal-dialog" role="document">'+
                                        '<div class="modal-content">'+
                                        '<div class="modal-header">'+
                                        '<h5 class="modal-title" id="exampleModalLabel"></h5>'+
                                        '</div>'+
                                        '<div class="modal-body">'+
                                        description+
                                        '</div>'+
                                        '<div class="modal-footer">'+
                                        '<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i></button>'+
                                        '</div>'+
                                        '</div>'+
                                        '</div>'+
                                        '</div>' ;
                                }
                            },
                            {
                                targets: 14,
                                render: function (data, type, full) {
                                    var text = full['facbook'];
                                    if(text != null)
                                        return text;
                                    else
                                        return '-';
                                }
                            },
                            {
                                targets: 15,
                                render: function (data, type, full) {
                                    var text = full['instagram'];
                                    if(text != null)
                                        return text;
                                    else
                                        return '-';
                                }
                            },
                            {
                                targets: 16,
                                render: function (data, type, full) {
                                    var text = full['twitter'];
                                    var rr=full[0];
                                    console.log(rr)
                                    if(text != null)
                                        return text;
                                    else
                                        return '-';
                                }
                            },

                            {
                                targets: 17,
                                render: function (data, type, full) {
                                    var text = full['study'];
                                    return text;
                                }
                            },
                            {
                                targets: 18,
                                render: function (data, type, full) {
                                    var text = full['job'];
                                    return text;
                                }
                            },
                            {
                                targets: 19,
                                render: function (data, type, full) {
                                    var text = full['anytalent'];
                                    return text;
                                }
                            },
                            {
                                targets: 20,
                                render: function (data, type, full) {
                                    var text = full['anytalenti'];
                                    return text;
                                }
                            },

                            {
                                targets: 21,
                                render: function (data, type, full) {
                                    var text = full['anyshare'];
                                    return text;
                                }
                            },
                            {
                                targets: 22,
                                render: function (data, type, full) {
                                    var text = full['anysharei'];
                                    return text;
                                }
                            },
                            {
                                targets: 23,
                                render: function (data, type, full) {
                                    var text = full['reupload'];
                                    console.log('text')
                                    if(text ==0)
                                        return 'لم يتم ارسال الطلب';
                                    else
                                        return 'تم الارسال';
                                }
                            },
                            {
                                targets: 24,
                                render: function (data, type, full) {
                                    var text = full['reupload'];
                                    if(text == 2)
                                        return'تم التعديل';
                                    if(text == 1)
                                        return' لم يتم التعديل ';

                                    if(text == 0)
                                        return' - ';

                                }
                            },
                            {
                                targets: 25,
                                render: function (data, type, full) {
                                    var text = full['status'];
                                    return text;
                                }
                            },


                            {
                                // Actions
                                targets: 26,
                                render: function (data, type, full, meta) {
                                    var userType = '{{ Auth::user()->type }}'
                                    var id = full['id'];
                                    var name = full['name'];
                                    var description = full['description'];
                                    if(1){
                                        return (
                                            '<div style="width:200px">' +
                                            @can('delete register')
                                                '<a title="حذف" class="btn btn-danger btn-sm" style="text-align:right;margin: .1rem" href="/deleteRegistered/'+ id + '" id="delete_btn" > <i class="fa fa-trash"></i></a>'+
                                            @endcan
                                                @can('update register')

                                                '<a title="طلب إعادة" class="btn btn-primary btn-sm" style="text-align:right;margin: .1rem" href="/generated_link/'+ id + '" id="resend" > طلب إعادة</a>'+
                                            @endcan
'</div>'
                                        );
                                    }else{
                                        return '';
                                    }


                                }
                            },

                        ]
                    });


                    $(document).on('click', '#delete_btn', function (e) {
                        e.preventDefault();

                        var url = $(this).attr('href');
                        bootbox.confirm('سيتم حذف بيانات العضو المسجل ,هل أنت متأكد ؟', function (res) {

                            if (res) {
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });

                                $.ajax({
                                    'url': url,
                                    'type': 'DELETE',
                                    'dataType': 'json',
                                    data: {
                                        '_token': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    success: function (response) {
                                        toastr.options = {
                                            "debug": false,
                                            position: { X: 'Left', Y: 'Top' },
                                            "fadeIn": 300,
                                            "fadeOut": 1000,
                                            "timeOut": 5000,
                                            "extendedTimeOut": 1000
                                        }
                                        table.ajax.reload();
                                    },
                                    error: function (xhr) {

                                    }
                                });
                            }

                        });
                    });

                    $(document).on('click', '#acceptReg', function (e) {
                        e.preventDefault();

                        var url = $(this).attr('href');
                        bootbox.confirm('سيتم قبول العضو المسجل ,هل أنت متأكد ؟', function (res) {

                            if (res) {
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });

                                $.ajax({
                                    'url': url,
                                    'type': 'GET',
                                    'dataType': 'json',
                                    data: {
                                        '_token': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    success: function (response) {
                                        toastr.options = {
                                            "debug": false,
                                            position: { X: 'Left', Y: 'Top' },
                                            "fadeIn": 300,
                                            "fadeOut": 1000,
                                            "timeOut": 5000,
                                            "extendedTimeOut": 1000
                                        }
                                        table.ajax.reload();
                                    },
                                    error: function (xhr) {
                                        console.log(xhr);
                                    }
                                });
                            }

                        });
                    });

                    $(document).on('click', '#refuseReg', function (e) {
                        e.preventDefault();

                        var url = $(this).attr('href');
                        bootbox.confirm('سيتم رفض العضو المسجل ,هل أنت متأكد ؟', function (res) {

                            if (res) {
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });

                                $.ajax({
                                    'url': url,
                                    'type': 'GET',
                                    'dataType': 'json',
                                    data: {
                                        '_token': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    success: function (response) {
                                        toastr.options = {
                                            "debug": false,
                                            position: { X: 'Left', Y: 'Top' },
                                            "fadeIn": 300,
                                            "fadeOut": 1000,
                                            "timeOut": 5000,
                                            "extendedTimeOut": 1000
                                        }
                                        table.ajax.reload();
                                    },
                                    error: function (xhr) {
                                        console.log(xhr);
                                    }
                                });
                            }

                        });
                    });


                });
            </script>
        @else
            <script type="text/javascript">
                var serialNumber = 0;

                $(function () {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    var table = $('.yajra-datatable').DataTable({

                        dom: 'Bfrtip',
                        buttons: [
                                @if(Auth::user()->type == 3)
                            {
                                extend: 'excel',
                                exportOptions: {
                                    columns: [ 1,2,3,4,5,6,7 ]
                                }
                            },
                            {
                                extend: 'print',
                                exportOptions: {
                                    columns: [ 1,2,3,4,5,6,7 ]
                                }
                            }
                            @endif
                        ],



                        $(document).on('click', '#acceptReg', function (e) {
                            e.preventDefault();

                            var url = $(this).attr('href');
                            bootbox.confirm('سيتم قبول العضو المسجل ,هل أنت متأكد ؟', function (res) {

                                if (res) {
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });

                                    $.ajax({
                                        'url': url,
                                        'type': 'GET',
                                        'dataType': 'json',
                                        data: {
                                            '_token': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        success: function (response) {
                                            toastr.options = {
                                                "debug": false,
                                                position: { X: 'Left', Y: 'Top' },
                                                "fadeIn": 300,
                                                "fadeOut": 1000,
                                                "timeOut": 5000,
                                                "extendedTimeOut": 1000
                                            }
                                            table.ajax.reload();
                                        },
                                        error: function (xhr) {
                                            console.log(xhr);
                                        }
                                    });
                                }

                            });
                        });

                        $(document).on('click', '#refuseReg', function (e) {
                            e.preventDefault();

                            var url = $(this).attr('href');
                            bootbox.confirm('سيتم رفض العضو المسجل ,هل أنت متأكد ؟', function (res) {

                                if (res) {
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });

                                    $.ajax({
                                        'url': url,
                                        'type': 'GET',
                                        'dataType': 'json',
                                        data: {
                                            '_token': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        success: function (response) {
                                            toastr.options = {
                                                "debug": false,
                                                position: { X: 'Left', Y: 'Top' },
                                                "fadeIn": 300,
                                                "fadeOut": 1000,
                                                "timeOut": 5000,
                                                "extendedTimeOut": 1000
                                            }
                                            table.ajax.reload();
                                        },
                                        error: function (xhr) {
                                            console.log(xhr);
                                        }
                                    });
                                }

                            });
                        });


                    });
            </script>
        @endif
    @endpush

@endsection
