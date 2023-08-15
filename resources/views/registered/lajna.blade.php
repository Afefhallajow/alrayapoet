@extends('layouts.appp')
@push('css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic&display=swap" rel="stylesheet">
    <style>
        h4{
            color: white;
        }
        h2{
            color: white;
        }
        #myChartGender{
            width:8rem !important;
            height:8rem !important;
            margin:auto;
        }
    </style>
@endpush


@section('content')
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-2">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                </h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" style="float: right" class="table table-bordered yajra-datatable"  width="100%" cellspacing="0">
                        <thead>
                        <tr>

                            <th>التسلسل</th>
                            <th>رقم التسجيل</th>
                            @foreach($evas as $ev)
                                <th>{{$ev->name}} </th>


                            @endforeach

                            <th>عرض الصورة و الفيديو</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php $i1 = 0; ?>
                        @foreach ($Grades as $Grade)
                            <tr>
                                <?php $i1++; ?>
                                <td>{{ $i1 }}</td>
                                <td>{{$Grade->id }}</td>


                                @if($Grade->evas != null)
                                    @for($i=0;$i<count($evas);$i++)
                                        <?php
                                        $temp=0
                                        ?>

                                        @foreach($Grade->evas as $ev1)
                                            @if($ev1->user_id==$evas[$i]->id)
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
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"

                                            title="عرض صورة والفيديو"><a style="color: white" target="_blank" href="{{route('showphoto',$Grade->id)}}">عرض</a></button>
                                </td>



                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div></div>
    @push('script')
        <script>
            $(document).ready(function() {
                $('#datatable').DataTable();
            } );
        </script>



        <script src="{{ URL::asset('public/assets/js/bootstrap-datatables/ar/jquery.dataTables.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/js/bootstrap-datatables/ar/dataTables.bootstrap4.min.js') }}"></script>


    @endpush
@endsection
