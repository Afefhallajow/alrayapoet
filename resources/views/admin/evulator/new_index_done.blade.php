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
                        <a class="btn" data-toggle="modal" data-target="#exampleModal" style="font-weight:bold;float:right;font-size:1.2rem">  جدول المتقدمين  المقيمين</a>

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
                                <th>رقم الإشتراك</th>
                                <th>الصورة</th>
                                <th>الفيديو</th>
                                <th>القصيدة</th>
                                <th>الكل</th>
                                <th>ابداع الشاعر وتمييزه %10</th>
                                <th>حسن الصوت وسلامة الالقاء %10 </th>
                                <th>لغة وسلاسة المفردة %10 </th>
                                <th>الكاريزما وقوة الحضور %20 </th>
                                <th>بناء القصيدة والوزن %50  </th>

                                <th>تقييم </th>
                                <th>ملاحظات </th>


                                <th>الإجراء</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($regs as $reg)
                                <tr>
                                    <td>{{$reg->id}}</td>
                                    <td>
                                        <a style="color:white;"  class="btn btn-sm btn-primary" target="_blank" href="/storage/images/{{$reg->image}}">
                                            عرض           </a></td>
                                    <td><a target="_blank" style="color:white;"  class="btn btn-sm btn-primary" href="/storage/videos/{{$reg->video}}">عرض</a></td>
                                    <td><a target="_blank" style="color:white;"  class="btn btn-sm btn-primary" href="/storage/poems/{{$reg->poem}}">عرض</a></td>
                                    <td><a id="all" style="color:white;"  class="btn btn-sm btn-primary" target="_blank" href="/showphoto/{{$reg->id}}"> عرض</a></td>
                                    @foreach($reg->evas as $ev1 )
                                        @if($ev1->user_id ==\Illuminate\Support\Facades\Auth::user()->id && $ev1->registered_id ==$reg->id )

                                            <td>
                                                <label>
                                                    {{$ev1->creative}}    </label>
                                            </td>
                                            <td>
                                                <label>
                                                    {{$ev1->sound}}    </label>
                                            </td>
                                            <td>
                                                <label>
                                                    {{$ev1->word}}    </label>
                                            </td>
                                            <td>
                                                <label>
                                                    {{$ev1->view}}    </label>
                                            </td>

                                            <td>
                                                <label>
                                                    {{$ev1->build}}    </label>
                                            </td>

                                            <td>
                                                <label>
                                                    {{$ev1->percent}}    </label>
                                            </td>
                                            <td>
                                                <label>
                                                    {{$ev1->notes}}    </label>
                                            </td>
                                        @endif
                                    @endforeach
                                    <td>
                                        <div>
                                            <a style="text-align:center" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal{{$reg->id}}"> <i class="fa fa-edit"></i></a>
                                        </div>

                                    </td>
                                    <div class="modal fade" id="exampleModal{{$reg->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{$reg->id}}</h5>
                                                </div>
                                                <form action="/evulate-user" method="post" id="updateUser{{$reg->id}}" class="updateUser">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <input type="hidden" name="reg_id" value="{{$reg->id}}">
                                                        @foreach($reg->evas as $ev2 )
                                                            @if($ev2->user_id ==\Illuminate\Support\Facades\Auth::user()->id && $ev2->registered_id ==$reg->id )

                                                                <label for="name">ابداع الشاعر وتميزه10%</label>

                                                                <input type="number" value="{{$ev2->creative}}" max="100" dir="trl" class="form-control percent"  name="percent2" placeholder="ابداع الشاعر وتميزه  " required/>
                                                                <label for="name">لغة وسلاسة المفردة  10%</label>

                                                                <input type="number" value="{{$ev2->word}}" max="100" dir="trl" class="form-control percent" name="percent3" placeholder="لغة وسلاسة المفردة" required/>
                                                                <label for="name"> الكاريزما وقوة الحضور20%</label>

                                                                <input type="number" value="{{$ev2->view}}" max="100" dir="trl" class="form-control percent" name="percent4" placeholder="الكاريزما وقوة الحضور" required/>
                                                                <label for="name"> حسن الصوت والالقاء وسلامة النطق 10%</label>

                                                                <input type="number" value="{{$ev2->sound}}" max="100" dir="trl" class="form-control percent" name="percent5" placeholder="حسن الصوت والالقاء وسلامة النطق" required/>
                                                                <label for="name">  بناء القصيدة والوزن 50%</label>

                                                                <input type="number" value="{{$ev2->build}}" max="100"  dir="trl" class="form-control percent" name="percent1" placeholder="بناء القصيدة والوزن" required/>

                                                                <label for="speaker">ملاحظات </label>
                                                                <input value="{{$ev2->notes}}" class="form-control" required name="notes">
                                                                </textarea>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btnClose" data-dismiss="modal">إغلاق</button>
                                                        <button type="submit" class="btn btn-primary">حفظ</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

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
                    $('#datatable').DataTable(
                        {
                            dom: 'Blfrtip',
                            buttons: [
                                {
                                    extend: 'excel',
                                    exportOptions: {
                                        columns: [ 0,4,5,6,7,8,9,10,11,12,
                                        ]
                                    }
                                }
                            ]});
                }
            );


        </script>




    @endpush
@endsection
