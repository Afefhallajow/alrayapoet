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
                        <a class="btn" data-toggle="modal" data-target="#exampleModal" style="font-weight:bold;float:right;font-size:1.2rem">  جدول المتقدمين الذين بحاجة إلى تقييم</a>
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
                                <th>التسلسل</th>
                                <th>الاسم</th>

                                <th>الصورة</th>
                                <th>الفيديو</th>
                                <th>القصيدة</th>
                                <th>الإجراء</th>
                            </tr>
                            </thead>
                            <tbody>
@foreach($regs as $reg)
<tr>
    <td>{{$reg->id}}</td>
    <td>{{$reg->name}}</td>
<td>
    <a target="_blank" href="/download/image/{{$reg->id}}">
        <i class="fa fa-download"><i>
    </a></td>
<td><a target="_blank" href="/download/video/{{$reg->id}}"><i class="fa fa-download"><i></a></td>
<td><a target="_blank" href="/download/poem/{{$reg->id}}"><i class="fa fa-download"><i></a></td>
<td>
    <div>
        <a style="text-align:center" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"> <i class="fa fa-edit"></i></a>
        </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{$reg->name}}</h5>
                    </div>
                <form action="/evulate-user" method="post" id="updateUser{{$reg->id}}" class="updateUser">
@csrf
                    <div class="modal-body">
                        <input type="hidden" name="reg_id" value="{{$reg->id}}">
                        <label for="name">النسبة المئوية</label>
                        <input type="number"  max="100"  dir="trl" class="form-control percent" name="percent1" placeholder="بناء القصيدة والوزن" required/>
                        <input type="number" max="100" dir="trl" class="form-control percent"  name="percent2" placeholder="ابداع الشاعر وتميزه  " required/>
                        <input type="number" max="100" dir="trl" class="form-control percent" name="percent3" placeholder="لغة وسلاسة المفردة" required/>
                        <input type="number" max="100" dir="trl" class="form-control percent" name="percent4" placeholder="الكاريزما وقوة الحضور" required/>
                        <input type="number" max="100" dir="trl" class="form-control percent" name="percent5" placeholder="حسن الصوت والالقاء وسلامة النطق" required/>

                        <label for="speaker">ملاحظات </label>
                        <textarea class="form-control" required name="notes">
                                  </textarea>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btnClose" data-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary">حفظ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <div class="modal fade" id="exampleOtherModal'+id+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{$reg->name}}</h5>
                    </div>
                <div class="modal-body">
                    {{$reg->description}}
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

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
            $(document).ready(function() {
                $('#datatable').DataTable();
            } );
        </script>




    @endpush
@endsection
