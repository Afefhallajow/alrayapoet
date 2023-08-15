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
                        <a class="btn" data-toggle="modal" data-target="#exampleModal" style="font-weight:bold;float:right;font-size:1.2rem"> المشاركين </a>
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
                                <!--<th>التسلسل</th>-->
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
                                @if($evas != null)
                                    @for($i=0;$i<count($evas);$i++)
                                        <th>تقييم {{$evas[$i]->name}} </th>

                                    @endfor
                                @endif
                                <th>المتوسط</th>

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
        <script type="text/javascript">
            var serialNumber = 36;
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
                            @can('view final')                        {
                            extend: 'excel',
                            exportOptions: {
                                columns: [ 1,2,3,4,5,6,7,8,9,13,14,15,16,17,18,19,20,21,22,23,
                                    @if($evas != null)
                                    @for($t=0;$t< count($evas);$t++ )
                                    {{24+$t}}
                                    ,
                                    @endfor
                                    @endif
                                ]
                            }
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: [ 1,2,3,4,5,6,7,8,9,13,14,15,16,17,18,19,20,21,22,23,
                                    @if($evas != null)
                                    @for($t=0;$t< count($evas);$t++ )
                                    {{24+$t}}
                                    ,
                                    @endfor
                                    @endif
                                ]
                            }
                        }
                        @endif
                    ],

                    "order": [[ 2, "desc" ]],
                    "lengthMenu": [1, 2,3,10,36],
                    "pageLength": 36,
                    ajax: "{{ route('all-participants') }}",
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
                        {data: 'status', name: 'status'},
                        {data: 'job', name: 'job'},

                        {data: 'anytalent', name: 'anytalent'},
                        {data: 'anytalenti', name: 'anytalenti'},
                        {data: 'anyshare', name: 'anyshare'},

                        {data: 'anysharei', name: 'anysharei'},
                            @if($evas != null)
                            @for($i=0;$i<count($evas);$i++)
                        {data: {{$i}}, name: {{$i}}},

                        @endfor
                        @endif
                    ] ,
                    columnDefs: [
                        {
                            // For Responsive
                            responsivePriority: 14,
                            targets: 0
                        },
                        // {
                        //     targets: 0,
                        //     render: function (data, type, full) {
                        //         return --serialNumber;

                        //     }
                        // },
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
                                var id = full['id'];
                                var text = full['description'];
                                // return text;
                                return '<a data-toggle="modal" data-target="#exampleModal'+id+'"><i class="fa fa-eye"></i></a>';
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
                                if(text != null)
                                    return text;
                                else
                                    return '-';
                            }
                        },                            {
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
                        },                           {
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
                        },                           @if($evas!=null)
                            @for($aa=0;$aa<count($evas);$aa++)

                        {
                            targets: {{$aa+23}} ,
                            render: function (data, type, full) {
                                var text = full[{{$aa}}];
                                console.log('text')
                                return text;
                            }
                        },

                            @endfor
                            @endif

                        {
                            targets: {{($evas!=null) ? 23+count($evas):23}},
                            render: function (data, type, full) {
                                let first = (full['ev1_percent'] != null) ? full['ev1_percent'] : 0;
                                let second = (full['ev2_percent'] != null) ? full['ev2_percent'] : 0;
                                let third = (full['ev3_percent'] != null) ? full['ev3_percent'] : 0;
                                let avg = (parseFloat(first));
                                return avg.toFixed(2);


                            }
                        },





                        @if(Auth::user()->type == 1 || \Illuminate\Support\Facades\Auth::user()->type ==5)
                        {
                            targets: {{($evas!=null) ? 24+count($evas):24}},
                            render: function (data, type, full) {
                                var id = full["id"];
                                return (
                                    '<div>' +
                                    @can('delete final')
                                        '<a style="text-align:center" href="/final-del/'+id+'" class="btn btn-primary btn-sm btn-del"> حذف </a>'+
                                    @endif
                                        '</div>');

                            }
                        }
                        @endif
                    ]
                });

                $(document).on('click', '.btn-del', function (e) {
                    e.preventDefault();

                    var url = $(this).attr('href');
                    var data = null;
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        'url': url,
                        'type': 'post',
                        'dataType': 'json',
                        data: data,
                        success: function (response) {
                            toastr.success('تمت العملية بنجاح');
                            table.ajax.reload();
                            $(".closeModal").click();
                            // location.reload();
                        },
                        error: function (xhr) {
                            toastr.error('حدث خطأ ما');
                            $(".closeModal").click();
                        }
                    });

                });

            });
        </script>
    @endpush

@endsection
