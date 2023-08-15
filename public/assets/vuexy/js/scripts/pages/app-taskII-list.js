/*=========================================================================================
 File Name: app-user-list.js
 Description: User List page
 --------------------------------------------------------------------------------------
 Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
 Author: PIXINVENT
 Author URL: http://www.themeforest.net/user/pixinvent

 ==========================================================================================*/
$(function () {
    'use strict';

    var dtUserTable = $('.user-list-table3'),
        newUserSidebar = $('.new-user-modal'),
        newUserForm = $('.add-new-user'),
        updateUserForm = $('.update-useri'),
        oTable,
        statusObj = {
            2: {title: 'Inactive', class: 'badge-light-warning'},
            1: {title: 'Active', class: 'badge-light-success'},
        };

    var assetPath = 'admin';
    var mar='';
    if(routee=='') {
        assetPath = 'admin';
        mar="?";
    }else{
        assetPath = '../../../admin';
        mar=routee+"&";
    }
        var userView = 'app-user-view.html',
        userEdit = 'app-user-edit.html';
    // Users List datatable
    if (dtUserTable.length) {
        oTable = dtUserTable.DataTable({
            // ajax: assetPath + 'data/user-list.json', // JSON file to add data
            ajax: assetPath + '/tasks/sent/all'+routee+mar+"sent=0", // JSON file to add data
            "columns": [
                {
                    orderable: false,
                    'searchable': false,
                    'render': function () {
                        return '';
                    }
                },
                {'data': 'id', 'name': 'id'},
                {'data': 'title', 'name': 'title'},
                {'data': 'user_action', 'name': 'user_action'},
                {'data': 'user', 'name': 'user'},
                {'data': 'to', 'name': 'to'},
                {'data': 'start_date', 'name': 'start_date'},
                {'data': 'end_date', 'name': 'end_date'},
                {'data': 'action', 'name': 'action', 'orderable': false, 'searchable': false}
            ],
            columnDefs: [
                {
                    // For Responsive
                    className: 'control',
                    orderable: false,
                    responsivePriority: 2,
                    targets: 0,
                    visible:false

                },
                {
                    // User full name and username
                    targets: 2,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var $title = full['title'],
                            $start_date = full['start_date'],
                            $end_date = full['end_date'];

                        var $output = '';
                        var $row_output =
                            '<div class="d-flex justify-content-left align-items-center">' +
                            '<div class="d-flex flex-column">' +
                            '<span href="' +
                            userView +
                            '" class="user_name text-truncate"><span class="font-weight-bold">' +
                            $title +
                            '</span></span>' +
                            '</div>' +
                            '</div>';
                        return $row_output;
                    },

                    'createdCell':  function (td, cellData, rowData, row, col) {
                        $(td).on('click',function () {
                            console.log('cllick');
                            window.location.href=assetPath+'/tasks/'+rowData.id;
                        })
                    }
                },
                {
                    // User full name and username
                    targets: 3,
                    'createdCell':  function (td, cellData, rowData, row, col) {
                        $(td).on('click',function () {
                            console.log('cllick');
                            window.location.href=assetPath+'/tasks/'+rowData.id;
                        })
                    }
                },
                {
                    // User full name and username
                    targets: 4,
                    'createdCell':  function (td, cellData, rowData, row, col) {
                        $(td).on('click',function () {
                            console.log('cllick');
                            window.location.href=assetPath+'/tasks/'+rowData.id;
                        })
                    }
                },
                {
                    // Actions
                    targets: -1,
                    title: 'الاجراء',
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var $id = full['id'];
                        if(full['user_id']===user_id||is_admin==1)
                        return (
                            '<div class="btn-group">' +
                            '<a class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">' +
                            feather.icons['more-vertical'].toSvg({class: 'font-small-4'}) +
                            '</a>' +
                            '<div class="dropdown-menu dropdown-menu-right">' +

                            '<a href="#editModali" data-toggle="modal" pull-link="' +
                            assetPath+'/tasks/'+ $id + '/edit' +
                            '" class="dropdown-item" id="edit_btni">' +
                            feather.icons['archive'].toSvg({class: 'font-small-4 mr-50'}) +
                            'تعديل</a>' +
                            '<a href="'+ assetPath+'/tasks/'+$id+'"  pull-link="' +
                            assetPath+'/tasks/'+ $id +
                            '" class="dropdown-item" id="show_btn">' +
                            feather.icons['eye'].toSvg({class: 'font-small-4 mr-50'}) +
                            'عرض</a>' +
                            '<a href="' +assetPath+'/tasks/'+ $id + '" class="dropdown-item delete-record" id="delete_btns"> ' +
                            feather.icons['trash-2'].toSvg({class: 'font-small-4 mr-50'}) +
                            'حذف</a></div>' +
                            '</div>' +
                            '</div>'
                        );
                        else  return '';
                    }
                }
            ],
            order: [[5, 'desc']],
            dom: '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
            '<"col-lg-12 col-xl-6" l>' +
            '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
            '>t' +
            '<"d-flex justify-content-between mx-2 row mb-1"' +
            '<"col-sm-12 col-md-6"i>' +
            '<"col-sm-12 col-md-6"p>' +
            '>',
            language: {
                sLengthMenu: 'عرض _MENU_',
                search: 'البحث',
                searchPlaceholder: 'البحث..',
                zeroRecords: 'لايوجد نتائج',
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            },
            // Buttons with Dropdown
            buttons: [
                {
                    text: 'انشاء جديد',
                    className: 'add-new btn btn-primary mt-50',
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }
                },
                {
                    extend: 'excel',
                    text: 'تصدير اكسل',
                    className: 'add-new btn btn-primary mt-50',
                    exportOptions: {
                        modifier: {
                            // DataTables core
                            order: 'index',  // 'current', 'applied', 'index',  'original'
                            page: 'all',      // 'all',     'current'
                            search: 'none'     // 'none',    'applied', 'removed'
                        },
                        columns: 'th:not(:last-child)'
                    }
                }
            ],
            // For responsive popup
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return 'Details of ' + data['full_name'];
                        }
                    }),
                    type: 'column',
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                        tableClass: 'table',
                        columnDefs: [
                            {
                                targets: 3,
                                visible: false
                            },
                            {
                                targets: 4,
                                visible: false
                            }
                        ]
                    })
                }
            },

            initComplete: function () {
                // Adding role filter once table initialized
                // this.api()
                //     .columns(3)
                //     .every(function () {
                //         var column = this;
                //         var select = $(
                //             '<select id="UserDept" class="form-control text-capitalize mb-md-0 mb-2"><option value="">  </option></select>'
                //         )
                //             .appendTo('.user_jeha')
                //             .on('change', function () {
                //                 var val = $.fn.dataTable.util.escapeRegex($(this).val());
                //                 column.search(val ? '^' + val + '$' : '', true, false).draw();
                //             });
                //
                //         column
                //             .data()
                //             .unique()
                //             .sort()
                //             .each(function (d, j) {
                //                 select.append('<option value="' + d + '" class="text-capitalize">' + d + '</option>');
                //             });
                //     });
                $('#sender3').html('مرسلة الى');
                $('#to2').show();
                // Adding plan filter once table initialized

            }

        });
    }

    // Check Validity
    function checkValidity(el) {
        if (el.validate().checkForm()) {
            submitBtn.attr('disabled', false);
        } else {
            submitBtn.attr('disabled', true);
        }
    }

    // Form Validation
    if (newUserForm.length) {
        newUserForm.validate({
            errorClass: 'error',
            rules: {
                'title': {
                    required: true
                },
                'description': {
                    required: true
                },
                'start_date': {
                    required: true
                },
                'staffs': {
                    required: true
                }
            }
        });

        newUserForm.on('submit', function (e) {
            var isValid = newUserForm.valid();
            e.preventDefault();
            var form = document.getElementById('addFormi'); // You need to use standard javascript object here
            var formData = new FormData(form);
            $('#titleError').text('');
            $('#descriptionError').text('');
            $('#endDateError').text('');
            $('#startDateError').text('');
            $('#staffsError').text('');
            $('#attachsError').text('');
            if (isValid) {
                $.ajax({

                    url: $(this).attr("action"),
                    type: 'post',
                    datatype: 'json',
                    processData: false,
                    contentType: false,
                    data: formData
                }).done(function (response) {
                    oTable.ajax.reload();
                    newUserSidebar.modal('hide');

                }).fail(function (response) {
                    $('#titleError').text(response.responseJSON.errors.title);
                    $('#descriptionError').text(response.responseJSON.errors.description);
                    $('#startDateError').text(response.responseJSON.errors.start_date);
                    $('#endDateError').text(response.responseJSON.errors.end_date);
                    $('#staffsError').text(response.responseJSON.errors.staffs);
                    $('#attachsError').text(response.responseJSON.errors.attachs);
                    // $.each(data.responseJSON.errors, function(index, val) {
                    // toastr.error(val);
                    // });
                })
            }
        });
    }
    // Update Form
    if (updateUserForm.length) {
        if(!detectMob()) {
            updateUserForm.validate({
                errorClass: 'error',
                rules: {
                    'title': {
                        required: true
                    },
                    'description': {
                        required: true
                    },
                    'end_date': {
                        required: true,
                        step: false
                    },
                    'staffs': {
                        required: true
                    }
                }
            });
        }

        updateUserForm.on('submit', function (e) {
            var isValid=true;
            if(!detectMob()) {
                isValid = updateUserForm.valid();
            }
            e.preventDefault();


            $('#titleErrorUpi').text('');
            $('#descriptionErrorUpi').text('');
            $('#endDateErrorUpi').text('');
            $('#startDateErrorUpi').text('');
            $('#staffsErrorUpi').text('');
            $('#attachsErrorUpi').text('');
            $('#update-btni').html('الرجاء الانتظار');
            $('#update-btni').disabled=true;

            var form = document.getElementById('editFormi'); // You need to use standard javascript object here
            var formData = new FormData(form);
            if (isValid) {
                $.ajax({
                    url: $(this).attr('action') + '/' + document.getElementById('id_upi').value,
                    type: 'post',
                    datatype: 'json',
                    processData: false,
                    contentType: false,
                    'data': formData

                }).done(function (response) {
                    oTable.ajax.reload();
                    newUserSidebar.modal('hide');
                    $('#update-btni').html('حفظ');
                    $('#update-btni').disabled=false;
                    $('.formbody').hide();
                    $('.wait').show();
                }).fail(function (response) {
                    $('#titleErrorUp').text(response.responseJSON.errors.title);
                    $('#descriptionErrorUp').text(response.responseJSON.errors.description);
                    $('#startDateErrorUp').text(response.responseJSON.errors.start_date);
                    $('#endDateErrorUp').text(response.responseJSON.errors.end_date);
                    $('#staffsErrorUp').text(response.responseJSON.errors.staffs);
                    $('#attachsErrorUp').text(response.responseJSON.errors.attachs);
                    $('#update-btni').html('حفظ');
                    $('#update-btni').disabled=false;
                    // $.each(data.responseJSON.errors, function(index, val) {
                    // toastr.error(val);
                    // });
                })
            }
        });
    }

    // To initialize tooltip with body container
    $('body').tooltip({
        selector: '[data-toggle="tooltip"]',
        container: 'body'
    });

    $(document).on('click', '#delete_btns', function (e) {
        e.preventDefault();

        var url = $(this).attr('href');
        bootbox.confirm('تأكيد عملية الحذف !', function (res) {

            if (res) {

                $.ajax({
                    'url': url,
                    'type': 'DELETE',
                    'dataType': 'json',
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        oTable.ajax.reload();
//                                toastr.success(response.message);
                    },
                    error: function (xhr) {
                        toastr['error'](xhr.responseJSON.message, '!!نأسف ', {
                            closeButton: true,
                            tapToDismiss: false
                        });
                    }
                });
            }

        });
    });

});
