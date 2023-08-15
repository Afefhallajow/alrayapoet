@extends('layouts.appp')

@section('title')
   safas
@endsection

@section('content')
    <div class="page-content">
        <div class="">
            <!-- page title -->
<select id="test" name="test"  >
    <option value="1">afef</option>
    <option value="2">afef2</option>
    <option value="3">afef3</option>


</select>

        <!-- Filter | Excel | Add -->
            <div class="row">
                <div class="col-lg-12">
                    <form action="" method="post" id="filter_form" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <button type="submit" id="export_excel" class="btn btn-success hr_black_back waves-effect waves-light" style="margin-bottom: 15px;">
                            <i class="bx bx-upload font-size-16 align-middle mr-1"></i>
                            إكسل
                        </button>
                        <div class="card">
                            <div class="card-body green_back">
                                <div class="form-group row mb-3">
                                    <div class="col-sm-6 col-lg-6">
                                        بحث:
                                    </div>
                                    <div class="col-sm-6 col-lg-6">
                           <span style="cursor: pointer; color: rgb(245, 150, 30);" id="reset_filter">
                              <i class="fas fa-undo font-size-20 align-middle mr-1"></i>
                              تفريغ حقول التصفية
                           </span>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <!-- name -->
                                    <div class="col-sm-4 col-lg-4">
                                        <label for="filter_name" class="col-form-label">الاسم</label>
                                        <input type="text" name="name" class="form-control" id="filter_name">
                                    </div>

                                    <!-- email -->
                                    <div class="col-sm-4 col-lg-4">
                                        <label for="filter_email" class="col-form-label">البريد الإلكتروني</label>
                                        <input type="email" name="email" class="form-control" id="filter_email">
                                    </div>

                                    <!-- mobile -->
                                    <div class="col-sm-4 col-lg-4">
                                        <label for="filter_mobile" class="col-form-label">رقم الجوال</label>
                                        <input type="text" name="mobile" class="form-control" id="filter_mobile">
                                    </div>

                                    <!-- category -->
                                    <div class="col-sm-4 col-lg-4">
                                        <label for="filter_category_id" class="col-sm-3 col-form-label">الفئة</label>
                                        <select name="category_id" class="form-control" id="filter_category_id">
                                            <option value="">الكل</option>
                                        </select>
                                    </div>

                                    <!-- invitation_status -->
                                    <div class="col-sm-4 col-lg-4">
                                        <label for="filter_invitation_status" class="col-form-label">حالة الدعوة</label>
                                        <select name="invitation_status" class="form-control" id="filter_invitation_status">
                                            <option value="">الكل</option>
                                            <option value="under_study">قيد الدراسة</option>
                                            <option value="confirmed">تم التأكيد</option>
                                            <option value="apology">تم الاعتذار</option>
                                            <option value="waiting">بانتظار إكمال البيانات</option>
                                        </select>
                                    </div>

                                    <!-- invitation_type -->
                                    <div class="col-sm-4 col-lg-4">
                                        <label for="filter_invitation_type" class="col-form-label">نوع الدعوة</label>
                                        <select name="invitation_type" class="form-control" id="filter_invitation_type">
                                            <option value="">الكل</option>
                                            <option value="registered">تسجيل</option>
                                            <option value="invited">دعوة</option>
                                        </select>
                                    </div>

                                    <!-- attendance_confirm -->
                                    <div class="col-sm-3 col-lg-3">
                                        <label for="filter_attendance_confirm" class="col-form-label">تأكيد الحضور</label>
                                        <select name="attendance_confirm" class="form-control" id="filter_attendance_confirm">
                                            <option value="">الكل</option>
                                            <option value=0>لا</option>
                                            <option value=1>نعم</option>
                                        </select>
                                    </div>

                                </div>

                                <!-- submit -->
                                <div class="form-group row justify-content-end">
                                    <div class="col-sm-12">
                                        <input type="button" id="filter_button" class="btn btn-success" value="اذهب" style="padding:8px 40px;" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            <!-- Content -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="records_table" class="table dt-responsive table-bordered table-striped table-hover nowrap text-center"
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>المعرف</th>
                                    <th>الإجراء</th>
                                    <th>تاريخ الارسال</th>
                                    <th>الاسم</th>
                                    <th>رقم الجوال</th>
                                    <th>البريد الإلكتروني</th>

                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: View -->
    <div id="viewModal" class="modal fade" role="dialog">
        <div class="modal-dialog" style="max-width: 45%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="view_info">
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Add | Edit -->
    <div id="formModal" class="modal fade" role="dialog">
        <div class="modal-dialog" style="max-width: 60%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <span id="form_result"></span>
                    <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                        <input type="hidden" name="invitation_type" id="invitation_type" value="invited">
                        <input type="hidden" name="day_id" class="form-control" value="1"/>
                        <input type="hidden" name="sent" id="sent" value=1>

                        <!-- first surname | second surname -->
                        <div class="form-group row mb-3">
                            <!-- first surname -->
                            <div class="col-sm-6">
                                <label for="first_surname_id" class="col-form-label">اللقب 1</label>
                                <select name="first_surname_id" class="form-control" id="first_surname_id">
                                    <option value="">الرجاء الاختيار</option>
                                    </select>
                            </div>

                            <!-- second surname -->
                            <div class="col-sm-6">
                                <label for="second_surname_id" class="col-form-label">اللقب 2</label>
                                <select name="second_surname_id" class="form-control" id="second_surname_id">
                                    <option value="">الرجاء الاختيار</option>

                                </select>
                            </div>
                        </div>

                        <!-- name | mobile -->
                        <div class="form-group row mb-3">
                            <!-- name -->
                            <div class="col-sm-6">
                                <label for="name" class="col-form-label">الاسم</label>
                                <input type="text" name="name" class="form-control" id="name">
                            </div>

                            <!-- mobile -->
                            <div class="col-sm-6">
                                <label for="mobile" class="col-form-label">رقم االجوال</label>
                                <input type="text" name="mobile" class="form-control" id="mobile">
                            </div>
                        </div>

                        <!-- email | organization -->
                        <div class="form-group row mb-3">
                            <!-- email -->
                            <div class="col-sm-6">
                                <label for="email" class="col-form-label">البريد الإلكتروني</label>
                                <input type="email" name="email" class="form-control" id="email">
                            </div>

                            <!-- organization -->
                            <div class="col-sm-6">
                                <label for="organization" class="col-form-label">الجهة</label>
                                <input type="text" name="organization" class="form-control" id="organization">
                            </div>
                        </div>

                        <!-- position | category-->
                        <div class="form-group row mb-3">
                            <!-- position -->
                            <div class="col-sm-6">
                                <label for="position" class="col-sm-3 col-form-label">المنصب</label>
                                <input type="text" name="position" class="form-control" id="position">
                            </div>

                            <!-- category -->
                            <div class="col-sm-6">
                                <label for="category_id" class="col-sm-3 col-form-label">الفئة</label>
                                <select name="category_id" class="form-control" id="category_id">
                                    <option value="">الرجاء الاختيار</option>
                                 </select>
                            </div>
                        </div>

                        <!-- companions | invitation_lang -->
                        <div class="form-group row mb-3">
                            <!-- companions -->
                            <div class="col-sm-6">
                                <label for="companions" class="col-form-label">عدد المرافقين</label>
                                <input type="number" min=0 name="companions" class="form-control" id="companions">
                            </div>

                            <!-- invitation_lang -->
                            <div class="col-sm-6">
                                <label for="invitation_lang" class="col-form-label">لغة الدعوة</label>
                                <div class="custome_blue_radio">
                                    <fieldset class="radio btn-radio btn-group" data-toggle="buttons">
                                        <label for="invitation_lang_ar" id="invitation_lang_for_ar" class="for_radio_1 btn-default btn active">
                                            <input type="radio" class="input_radio_1" name="invitation_lang" id="invitation_lang_ar" value="ar" checked="checked">
                                            <span>عربي</span>
                                        </label>

                                        <label for="invitation_lang_en" id="invitation_lang_for_en" class="btn-default btn">
                                            <input type="radio" name="invitation_lang" id="invitation_lang_en" value="en">
                                            <span>إنكليزي</span>
                                        </label>
                                    </fieldset>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-3" id="append_invited_inputs">

                        </div>

                        <!-- submit -->
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-9">
                                <input type="hidden" name="hidden_id" id="hidden_id" />
                                <input type="submit" name="action_button" id="action_button" class="hr_green_back btn btn-light" value="Add"
                                       style="padding:8px 40px;" />
                                <div id="action_spinner" class="spinner-grow text-secondary m-1 hr_green_back" role="status" style="display: none">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Confirm Delete -->
    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title mrAuto" align="center">تأكيد الحذف</h4>
                </div>
                <div class="modal-body">
                    <h5 align="center" style="margin:0;">هل تريد بالتأكيد حذف البيانات؟</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" name="ok_button" id="ok_button" class="btn btn-danger mrAR">نعم</button>
                    <button type="button" class="btn btn-light" data-dismiss="modal">إلغاء</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Import Excel Modal -->
    <div class="modal fade" id="exampleModalImportExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width:30%; margin-left:auto;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">إرسال الدعوات</h5>
                </div>
                <form action="" method="post" id="importExcel" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        {{-- <p>يجب أن يكون تنسيق الملف بهذا الشكل</p>

                        <table class="table table-bordered table-striped table-hover nowrap text-center" style="border-spacing: 0; width: 100%; font-size: 14px; direction: ltr">
                           <tr>
                              <td>Arabic Name</td>
                              <td>English Name</td>
                              <td>Mobile</td>
                              <td>Email</td>
                              <td>Organization</td>
                              <td>Position</td>
                              <td>Invitaion Language</td>
                           </tr>
                        </table> --}}

                        <input type="file" name="excel_file" id="excel_file" class="form-control" required />
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary closeBTN" data-dismiss="modal">إغلاق</button> --}}
                        <button type="submit" class="btn btn-success hr_green_back import_btn">استيراد </button>
                        <a href="{{ asset('templates') }}/invitations.xlsx" class="btn btn-warning hr_orange_back" download>تحميل القالب</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal: Changes History -->
    <div id="changesHistoryModel" class="modal fade" role="dialog">
        <div class="modal-dialog" style="max-width: 80%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="changes_history">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row mb-3" id="edit_invited_inputs" style="display:none">
        <!-- send_email -->
        <div class="col-sm-6">
            <label for="send_email" class="col-form-label">إرسال بريد مع تغيير حالة الطلب</label>
            <div class="custome_blue_radio">
                <fieldset class="radio btn-radio btn-group" data-toggle="buttons">
                    <label for="send_email_1" id="send_email_for_1" class="for_radio_1 btn-default btn active">
                        <input type="radio" class="input_radio_1" name="send_email" id="send_email_1" value=1 checked="checked">
                        <span>نعم</span>
                    </label>

                    <label for="send_email_0" id="send_email_for_0" class="btn-default btn">
                        <input type="radio" name="send_email" id="send_email_0" value=0>
                        <span>لا</span>
                    </label>
                </fieldset>
            </div>
        </div>

        <!-- attendance_party -->
        <div class="col-sm-6">
            <label for="attendance_party" class="col-form-label">هل حضر الحفل</label>
            <div class="custome_blue_radio">
                <fieldset class="radio btn-radio btn-group" data-toggle="buttons">
                    <label for="attendance_party_1" id="attendance_party_for_1" class="for_radio_1 btn-default btn active">
                        <input type="radio" class="input_radio_1" name="attendance_party" id="attendance_party_1" value=1 checked="checked">
                        <span>نعم</span>
                    </label>

                    <label for="attendance_party_0" id="attendance_party_for_0" class="btn-default btn">
                        <input type="radio" name="attendance_party" id="attendance_party_0" value=0>
                        <span>لا</span>
                    </label>
                </fieldset>
            </div>
        </div>

        <!-- invitation_status -->
        <div class="col-sm-6">
            <label for="invitation_status" class="col-form-label">حالة الطلب</label>
            <select name="invitation_status" class="form-control" id="invitation_status">
                <option value="">الرجاء الاختيار</option>
                <option value="under_study">قيد الدراسة</option>
                <option value="confirmed">تم التأكيد</option>
                <option value="apology">تم الاعتذار</option>
            </select>
        </div>

        {{-- <!-- whatsapp -->
        <div class="col-sm-6">
           <label for="whatsapp" class="col-form-label">إرسال Whatsapp</label>
           <div class="custome_blue_radio">
              <fieldset class="radio btn-radio btn-group" data-toggle="buttons">
                 <label for="whatsapp_1" id="whatsapp_for_1" class="for_radio_1 btn-default btn active">
                    <input type="radio" class="input_radio_1" name="whatsapp" id="whatsapp_1" value=1 checked="checked">
                    <span>نعم</span>
                 </label>

                 <label for="whatsapp_0" id="whatsapp_for_0" class="btn-default btn">
                    <input type="radio" name="whatsapp" id="whatsapp_0" value=0>
                    <span>لا</span>
                 </label>
              </fieldset>
           </div>
        </div> --}}
    </div>

@endsection

@push('script')

    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $('#records_table').DataTable({
                processing: true,
                serverSide: true,
                retrieve: true,
                "order": [[ 0, "asc" ]],
                ajax: {
                    url: '/gettest',
                },
                columns: [
                    {
                        data: 'id',
                        render: function (data, type, full, meta) {
                            return `<strong>${data}</strong>`;
                        },
                    },
                    {data: 'name'},
                    {data: 'email'},
                    {data: 'sent_at'},
                    {data: 'season'},

                    {data: 'action', orderable: false, searchable: false}
                ]
            });
            $(document).on('click', '.view', function () {
                var id = $(this).attr('data');
                var url = "/gettest/p/:id";
                url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    success: function (json) {
                        $('#view_info').html(json);
                    }
                })
                $('#viewModal').modal('show');
            });

            $('#sample_form').on('submit', function (event) {
console.log('asdsad');
                event.preventDefault();
                $.ajax({
                    url: "/store",
                    beforeSend: function () {
                        $('#action_button').hide();
                        $('#action_spinner').show();
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
                        }
                        if (data.success) {
                            html = '<div class="alert alert-success"><i class="bx bx-check-double font-size-16 align-middle mr-1"></i>' + data.success +
                                '</div>';
                            $('#sample_form')[0].reset();
                            $('#records_table').DataTable().ajax.reload();
                            setTimeout(function(){$('#formModal').modal('hide');}, 1000);
                        }
                        ClearAlert();
                        $('#form_result').html(html);
                    },
                    error: function(errors){
                        ClearAlert();
                        errors_list = print_errors(errors.responseJSON.errors);
                        // ResultAlert(errors_list);
                    }
                });
            });

            // Show tabel
            // Add Button
            $('#test').val(2);
            $(document).on('click', '.edit', function () {
                var id = $(this).attr('data');
                $.ajax({
                    url: "gettest" + '/' + id  ,
                    dataType: "json",
                    success: function (json) {
                        console.log(json);
                        $('#name').val(json.data.name);
                        $('#email').val(json.data.email);
                        $('#hidden_id').val(json.data.id);

                        $('.custome_blue_radio label').removeClass('active');
                        $('#attendance_party_for_' + json.data.attendance_party).addClass('active');
                        $('#send_email_for_' + json.data.send_email).addClass('active');

                        $('#attendance_party_' + json.data.attendance_party).prop('checked', true);
                        $('#send_email_' + json.data.send_email).prop('checked', true);
                    }
                })
                $('#action_button').val("تعديل");
                $('#formModal').modal('show');
                ClearAlert();
            });

            $('#create_record').click(function () {
                FormReset();
                $('#action_button').val("إضافة");
                $('#formModal').modal('show');
                $('#append_invited_inputs').html('');
            });

            // View Changes History
            $(document).on('click', '.changes_history', function () {
                var invited_id = $(this).attr('data');
                var url = "/";

                var load_url = "{{ route('deleteseason', [':id', ':model']) }}";
                load_url = load_url.replace(':id', invited_id);
                load_url = load_url.replace(':model', 'invited_id');

                $.ajax({
                    url: url,
                    success: function (json) {
                        $('#changes_history').html(json);
                        load_changes_history(load_url);
                    }
                })
                $('#changesHistoryModel').modal('show');
            });
        });
    </script>

@endpush

