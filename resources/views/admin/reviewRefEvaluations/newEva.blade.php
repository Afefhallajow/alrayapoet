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
                        <a class="btn" data-toggle="modal" data-target="#exampleModal" style="font-weight:bold;float:right;font-size:1.2rem">  جدول التقييمات</a>
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
                        <table id="datatable" class="table table-bordered yajra-datatable"  width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>رقم التسجيل</th>
                                <th>الاسم</th>
                                <th>البريد الالكتروني</th>
                                @foreach($evas as $ev)
                                    <th>{{$ev->name}} </th>


                                @endforeach
                                <th>الاجراء</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($regs as $re )
                                <tr>
                                    <td>
                                        <label>
                                            {{$re->id}}
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            {{$re->name}}
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            {{$re->email}}
                                        </label>
                                    </td>
                                    @if($re->refrees != null)
                                        @for($i=0;$i<count($evas);$i++)
                                            <?php
                                            $temp=0
                                            ?>

                                            @foreach($re->refrees as $ev1)
                                                @if($ev1->ref_id==$evas[$i]->id)
                                                    <?php
                                                    $temp=1;

                                                    ?>

                                                    <td>
                                                        <label>
                                                            <i class="fa fa-check"></i>    </label>
                                                    </td>

                                                @endif
                                            @endforeach
                                            @if($temp==0)
                                                <td></td>
                                            @endif

                                        @endfor

                                    @endif
                                    <td>
                                        @if (App\Models\FinalResult::where('registered_id',$re->id)->first()==null )
@if( \Illuminate\Support\Facades\Auth::user()->type !=5)
                                            <a style="text-align:center" href="/final/{{$re->id}}" class="btn btn-primary btn-sm btn-final"> تأهيل نهائي </a>
                                        @endif
                                        @endif
                                    </td>

                                </tr>


                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>

    @push('script')
        <script>


            $(document).on('click', '.btn-final', function (e) {
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

                        location.reload();

                        table.ajax.reload();

                        $(".closeModal").click();
                        // location.reload();
                    },
                    error: function (xhr) {
                        toastr.error('حدث خطأ ما');

                        console.log(xhr);
                    }
                });


            });

        </script>
        <script>
            $(document).ready(function() {
                $('#datatable').DataTable();
            } );
        </script>



        <script src="{{ URL::asset('public/assets/js/bootstrap-datatables/ar/jquery.dataTables.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/js/bootstrap-datatables/ar/dataTables.bootstrap4.min.js') }}"></script>



    @endpush

@endsection
