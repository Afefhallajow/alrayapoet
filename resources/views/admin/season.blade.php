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
    </style>
@endsection
@section('content')
    <div id="content">
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-2">
                <div class="card-header py-3">
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>

    <!-- Modal -->

    @push('style')

        <link href="{{ asset('assets/SmartWizard/bootstrap.css')}}" rel="stylesheet" type="text/css" />
        {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.css" rel="stylesheet" type="text/css" />--}}
        {{--<link href="{{ asset('assets/admin/lib/SmartWizard/dist/css/smart_wizard.css')}}" rel="stylesheet" type="text/css" />--}}
        {{--<link href="{{ asset('assets/admin/lib/SmartWizard/dist/css/smart_wizard_theme_arrows.css')}}" rel="stylesheet" type="text/css" />--}}
        {{--<link href="{{ asset('assets/SmartWizard/theme_new.css')}}" rel="stylesheet" type="text/css" />--}}
        <link href="{{ asset('assets/SmartWizard/theme-ar.css')}}" rel="stylesheet" type="text/css" />

    @endpush

    @push('script')

        <script src="{{ asset('assets/SmartWizard/jquery.min.js')}}"></script>

        <script src="{{ asset('assets/SmartWizard/bootstrap.js')}}"></script>
        <script src="{{ asset('assets/SmartWizard/custom_js.js')}}"></script>

        <script src="{{ asset('assets/SmartWizard/validator.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('assets/admin/lib/SmartWizard/dist/js/jquery.smartWizard.js')}}"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.js"></script>
        <script type="text/javascript">

        </script>
    @endpush

@endsection
