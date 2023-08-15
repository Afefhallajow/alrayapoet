    @extends('layouts.appp')
    @push('css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic&display=swap" rel="stylesheet">
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

    <div id="content">
    <button type="button" style="float: right" class="button btn-flat-primary x-small" data-toggle="modal" data-target="#exampleModal">
    اضافة
    </button>

    <br>

        <div class="card-body">

        <div class="table-responsive">



    <table style="float: right" class="table table-bordered yajra-datatable"  width="100%" cellspacing="0">
    <thead>
    <tr>

    <th>التسلسل</th>
    <th>الاسم</th>
        <th></th>
        <th>X</th>



    </tr>
    </thead>
    <tbody>
    <?php $i = 0; ?>
    @foreach ($Grades as $Grade)
    <tr>
    <?php $i++; ?>
    <td>{{$Grade->id }}</td>
    <td>{{$Grade->name}}</td>

    <td>
    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
    data-target="#Update"
    title="edit"><i
    class="fa fa-edit"></i></button>


    </td>
    <td>
    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
    data-target="#delete{{ $Grade->id }}"
    title="delete"><i
    class="fa fa-trash">delete</i></button>


    </td>

    </tr>





    <!-- update -->
    <div class="modal fade" id="Update" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

    <div class="modal-content">

    <div class="modal-header">
    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
    id="exampleModalLabel">
    update form
    </h5>
    <button type="button" class="close" data-dismiss="modal"
    aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
    <form action="{{route('perupdate')}}" method="post">
    @csrf
    are you sure do want to update the information
    <input id="id" type="hidden" name="id" class="form-control"
    value="{{ $Grade->id }}">
    <div class="row">
    <div class="col-md-12">
        <input class="form-control" type="text" name="name" value="{{$Grade->name}}">
    </div>

        <div class="col-md-4">
    <br>
    @if($Grade->registered)
        <input  id="registered" type="checkbox" value="1" checked name="registered" >عرض المشاركين</input>
    @else
        <input  id="registered" type="checkbox" value="1"  name="registered" >عرض المشاركين</input>
    @endif
    <br>


    @error('registered')

    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    </div>
    <div class="col-md-4">
    <br>
    @if($Grade->qualified)
        <input  id="qualified" type="checkbox" value="1" checked name="qualified" >عرض المتأهلين</input>
    @else
        <input  id="qualified" type="checkbox" value="1"  name="qualified" >عرض المتأهلين</input>
    @endif
    <br>


    @error('qualified')

    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    </div>
    <div class="col-md-4">
    <br>
    @if($Grade->sort)
        <input  id="sort" type="checkbox" value="1" checked name="sort" >تقييم الفرز ولجنة الفرز</input>
    @else
        <input  id="sort" type="checkbox" value="1"  name="sort" >تقييم الفرز ولجنة الفرز</input>
    @endif
    <br>


    @error('registered')

    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    </div>

    </div>


    <div class="row">
        <div class="col-md-4">
            <br>
            @if($Grade->permission)
                <input  id="permission" type="checkbox" value="1" checked name="permission" >العمليات على الصلاحيات</input>
            @else
                <input  id="permission" type="checkbox" value="1"  name="permission" >العمليات على الصلاحيات</input>
            @endif
            <br>


            @error('registered')

            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

        </div>
        <div class="col-md-4">
            <br>
            @if($Grade->user)
                <input  id="user" type="checkbox" value="1" checked name="user" >لعمليات على المستخدمين</input>
            @else
                <input  id="user" type="checkbox" value="1"  name="user" >لعمليات على المستخدمين</input>
            @endif
            <br>


            @error('qualified')

            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

        </div>
        <div class="col-md-4">
            <br>
                <select value="{{$Grade->season}}" class="custom-select my-1 mr-sm-2" name="season">

                    @if($Grade->season ==0)
                    <option  selected>
                        كل المواسم المتاحة
                    </option>
    @else           <option  selected>
                    {{$Grade->season}}
                    </option>
                    @endif
                        <option  value="0">
                            كل المواسم المتاحة
                        </option>
                    @foreach($seasons as $s)
                        <option value={{$s->id}}>{{$s->name}}</option>
                        @endforeach
                </select>


            @error('season')

            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

        </div>


    </div>



    <div class="modal-footer">
    <button type="button" class="btn btn-secondary"
        data-dismiss="modal">close</button>
    <button type="submit"
        class="btn btn-danger">submit</button>
    </div>
    </form>
    </div>
    </div>
    </div>
    </div>
    <!-- delete-->
    <div class="modal fade" id="delete{{ $Grade->id }}" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                        id="exampleModalLabel">
                        are you sure to delete
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('perdel')}}" method="post">
                        {{method_field('Delete')}}
                        @csrf

                        <input id="id" type="hidden" name="id" class="form-control"
                               value="{{ $Grade->id }}">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">Close</button>
                            <button type="submit"
                                    class="btn btn-danger">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>






    @endforeach
    </tbody>
    </table>

        </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">

                <div class="modal-content">

                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                            id="exampleModalLabel">
                            add form
                        </h5>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('addper')}}" method="post">
                            @csrf
                            <div class="row">


                                <div class="col-md-12">
                                    <br>
                                    <input  id="name" type="text"   name="name" >الاسم</input>
                                    <br>


                                    @error('name')

                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="col-md-4">
                                    <br>
                                        <input  id="registered" type="checkbox" value="1"  name="registered" >عرض المشاركين</input>
                                    <br>


                                    @error('registered')

                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="col-md-4">
                                    <br>

                                        <input  id="qualified" type="checkbox" value="1"  name="qualified" >عرض المتأهلين</input>
                                    <br>


                                    @error('qualified')

                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="col-md-4">
                                    <br>
                                        <input  id="sort" type="checkbox" value="1"  name="sort" >نقييم الفرز ولجنة الفرز</input>
                                    <br>


                                    @error('registered')

                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>

                            </div>


                            <div class="row">
                                <div class="col-md-4">
                                    <br>
                                        <input  id="permission" type="checkbox" value="1"  name="permission" >العمليات على الصلاحيات</input>
                                    <br>


                                    @error('registered')

                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="col-md-4">
                                    <br>
                                        <input  id="user" type="checkbox" value="1"  name="user" >العمليات على المستخدمين</input>
                                    <br>


                                    @error('qualified')

                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="col-md-4">
                                    <br>
                                    <select  class="custom-select my-1 mr-sm-2" name="season">

                                        <option  value="0">
                                            كل المواسم المتاحة
                                        </option>
                                        @foreach($seasons as $s)
                                            <option value={{$s->id}}>{{$s->name}}</option>
                                        @endforeach
                                    </select>


                                    @error('season')

                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>


                            </div>



                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">close</button>
                                <button type="submit"
                                        class="btn btn-danger">submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>

    </div>
    @endsection
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
            @endpush
