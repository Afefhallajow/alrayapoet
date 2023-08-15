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
                                <a class="btn" data-toggle="modal" data-target="#exampleModal" style="font-weight:bold;float:right;font-size:1.2rem">  المرشحين   </a>
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
                                            <th>التسلسل</th>
                                            <th>رقم الاشتراك</th>
                                            <th>الصورة</th>
                                            <th>الفيديو</th>
                                            <th>القصيدة</th>
                                            <th>الكل</th>
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
                @if(Auth::user()->type == 1)
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [1,2,3,4,5,6,7,12,13,14 ]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [1,2,3,4,5,6,7,12,13,14 ]
                    }
                }
                @endif
            ],


            ajax: "{{ route('getAllRefereeRegistereds',['regStatus' => 'needEvulator']) }}",
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
                {data: 'image', name: 'image'},
                {data: 'video', name: 'video'},
                {data: 'poem', name: 'poem'},
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
                        return ++serialNumber;

                    }
                },{
                    targets: 1,
                    render: function (data, type, full) {
                        var text = full['id'];
                        return text;

                    }
                },

                {
                    targets: 2,
                    render: function (data, type, full) {
                        var text = full['image'];
                        var id=full['id']
                        console.log(id);

                        return '<a target="_blank"href="/download/image/'+id+'"><i class="fa fa-download"><i></a>';
                    }
                },
                {
                    targets: 3,
                    render: function (data, type, full) {
                        var text = full['video'];
                        var id=full['id']
                        console.log(id);

                        return '<a target="_blank" href="/download/video/'+id+'"><i class="fa fa-download"><i></a>';
                    }
                },
                {
                    targets: 4,
                    render: function (data, type, full) {
                        var text = full['poem'];
                        var id=full['id']
                        console.log(id);

                        return '<a target="_blank" href="/download/poem/'+id+'"><i class="fa fa-download"><i></a>';
                    }
                },

                {
                    targets: 5,
                    render: function (data, type, full) {
                        var id=full['id']
                        console.log(id);

                        return '<a target="_blank" href="/download/all/'+id+'"><i class="fa fa-download"><i></a>';
                    }
                },

                {
                    // Actions
                    targets: 6,
                    render: function (data, type, full, meta) {
                        var id = full['id'];
                        var name = full['name'];
                        var description = full['description'];
                        return (
                            '<div>' +
                            '<a style="text-align:center" href="/referee-user/'+id+'" class="btn btn-primary btn-sm btn-done"> تأهيل</a>'+
                            '</div>'+
                            '<div class="modal fade" id="exampleOtherModal'+id+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">'+
                              '<div class="modal-dialog" role="document">'+
                                '<div class="modal-content">'+
                                  '<div class="modal-header">'+
                                    '<h5 class="modal-title" id="exampleModalLabel">'+name+'</h5>'+
                                  '</div>'+
                                  '<div class="modal-body">'+
                                    description+
                                  '</div>'+
                                  '<div class="modal-footer">'+
                                    '<button type="button" class="btn btn-secondary closeModal" data-dismiss="modal">Close</button>'+
                                  '</div>'+
                                '</div>'+
                              '</div>'+
                            '</div>'

                        );

                    }
                }
            ]
        });

        $(document).on('click', '.btn-done', function (e) {
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

        $(document).on('change', '.percent', function (e) {
            if ($(this).val() > 100) {
               e.preventDefault();
               $(this).val(100);
            }
        });

        $(document).on('keyup', '.percent', function (e) {
            if ($(this).val() > 100) {
               e.preventDefault();
               $(this).val(100);
            }
        });




    });
    </script>
    @endpush

@endsection
