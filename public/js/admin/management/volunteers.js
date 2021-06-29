"use strict";

var KTDatatablesAdvancedColumnRendering = function() {
    var avatar;

    if(alert != '')
    {
        toastr.success(alert);
    }
	var init = function() {
        var arrows;
        avatar = new KTImageInput('kt_volunteer_image');
        if (KTUtil.isRTL()) {
            arrows = {
                leftArrow: '<i class="la la-angle-right"></i>',
                rightArrow: '<i class="la la-angle-left"></i>'
            }
        } else {
            arrows = {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        }

		var table = $('#volunteer_table');
        var validation;
        var form = KTUtil.getById('volunteer_form');

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
            form,
            {
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'Volunteer Name is required'
                            }
                        }
                    },
                    email: {
                        validators: {
							notEmpty: {
								message: 'Email address is required'
							},
                            emailAddress: {
								message: 'The value is not a valid email address'
							}
						}
					},
                    phone: {
                        validators: {
                            notEmpty: {
                                message: 'Phone number is required'
                            }
                        }
                    },
                    website: {
                        validators: {
                            notEmpty: {
                                message: 'Website is required'
                            }
                        }
                    },
                    university: {
                        validators: {
                            notEmpty: {
                                message: 'University is required'
                            }
                        }
                    },
                    faculty: {
                        validators: {
                            notEmpty: {
                                message: 'Faculty is required'
                            }
                        }
                    },
                    department: {
                        validators: {
                            notEmpty: {
                                message: 'Department is required'
                            }
                        }
                    },
                    birthday: {
                        validators: {
                            notEmpty: {
                                message: 'Birthday is required'
                            }
                        }
                    },
                    major: {
                        validators: {
                            notEmpty: {
                                message: 'Major is required'
                            }
                        }
                    },
                    description: {
                        validators: {
							notEmpty: {
								message: 'Description is required'
							}
						}
					},
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        );

        var form_submit = function()
        {
            validation.validate().then(function(status) {
                if (status == 'Valid') {
                    $('#volunteer_form').submit();
                    KTApp.block('.modal-content', {
                        opacity: 0.1,
                        state: 'primary' // a bootstrap color
                    });
                } else {
                    swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    }).then(function() {
                        KTUtil.scrollTop();
                    });
                }
            });
        }

		// begin first table
		var oTable = table.dataTable({
			responsive: true,
			paging: true,
            "order": [
                [4, "asc"]
            ]
		});

        $('#birthday').datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows
        });

        $("#phone").inputmask("mask", {
            "mask": "(999) 999-9999"
        });

        $('#university').select2({
            placeholder: 'Select a university'
        });

        $('#faculty').select2({
            placeholder: 'Select a faculty'
        });

        $('#department').select2({
            placeholder: 'Select a department'
        });

        $('#btn_new').click(function() {
            $('#volunteerModal').modal('show');
        });

        var university_change = function(university_id) {
            $.ajax({
                url : '/management/volunteer/get_faculty_department',
                method : 'post',
                data : {
                    university_id : university_id
                },
                success : function(data) {
                    $('#faculty').html('');
                    $('#department').html('');
                    var faculties = data.faculties;
                    var departments = data.departments;
                    for(var i = 0 ; i < faculties.length ; i ++)
                    {
                        $('#faculty').append(`<option value="${faculties[i].id}">${faculties[i].name}</option>`)
                    }
                    for(var i = 0 ; i < departments.length ; i ++)
                    {
                        $('#department').append(`<option value="${departments[i].id}">${departments[i].name}</option>`)
                    }
                },
                error : function() {
                    toastr.error('Happening any errors on getting faculty.');
                }
            });
        }

        $('#university').change(function() {
            var university_id = $(this).val();

            university_change(university_id);

        });

        $('#faculty').change(function() {
            var department_id = $(this).val();
            $.ajax({
                url : '/management/volunteer/get_department',
                method : 'post',
                data : {
                    department_id : department_id
                },
                success : function(data) {
                    $('#department').html('');
                    var departments = data.departments;
                    for(var i = 0 ; i < departments.length ; i ++)
                    {
                        $('#department').append(`<option value="${departments[i].id}">${departments[i].name}</option>`)
                    }
                },
                error : function() {
                    toastr.error('Happening any errors on getting department.');
                }
            });
        });

        $('#btn_save').click(function() {
            form_submit();
        });

        table.on('click', '.btn_delete', function() {
            var volunteer_id = $(this).parents('tr').eq(0).attr('volunteer_id');
            var nRow = $(this).parents('tr')[0];
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    KTApp.block('#volunteer_table', {
                        overlayColor: '#000000',
                        state: 'danger',
                        message: 'Please wait...'
                    });
                    $.ajax({
                        url : '/management/volunteer/delete',
                        method : 'post',
                        data : {
                            volunteer_id : volunteer_id
                        },
                        success : function(data) {
                            toastr.success('Successfully deleted.');
                            KTApp.unblock('#volunteer_table');
                            oTable.fnDeleteRow(nRow);
                        },
                        error : function() {
                            Swal.fire(
                                "Error",
                                "Happening any errors on deleting user",
                                "error"
                            );
                        }
                    });
                }
            });
        });

        table.on('click', '.btn_edit', function() {
            var volunteer_id = $(this).parents('tr').eq(0).attr('volunteer_id');
            $.ajax({
                url : '/management/get_volunteer',
                method : 'post',
                data : {
                    volunteer_id : volunteer_id
                },
                success : function(data) {
                    var volunteer = data.volunteer;
                    $('#name').val(volunteer.fullname);
                    $('#email').val(volunteer.email);
                    $('#phone').val(volunteer.phone);
                    $('#website').val(volunteer.website);
                    $('#university').select2('val', `${volunteer.university_id}`);
                    $.ajax({
                        url : '/management/volunteer/get_faculty_department',
                        method : 'post',
                        data : {
                            university_id : volunteer.university_id
                        },
                        success : function(data) {
                            $('#faculty').html('');
                            var faculties = data.faculties;
                            for(var i = 0 ; i < faculties.length ; i ++)
                            {
                                $('#faculty').append(`<option value="${faculties[i].id}">${faculties[i].name}</option>`)
                            }
                            $('#faculty').val(volunteer.faculty_id);

                            $.ajax({
                                url : '/management/volunteer/get_department',
                                method : 'post',
                                data : {
                                    faculty_id : volunteer.faculty_id
                                },
                                success : function(data) {
                                    $('#department').html('');
                                    var departments = data.departments;
                                    for(var i = 0 ; i < departments.length ; i ++)
                                    {
                                        $('#department').append(`<option value="${departments[i].id}">${departments[i].name}</option>`)
                                    }
                                    $('#department').val(volunteer.department_id);
                                    $('#birthday').val(volunteer.birthday);
                                    $('#major').val(volunteer.majors);
                                    $('#description').val(volunteer.description);
                                    $('#volunteer_id').val(volunteer.id);
                                },
                                error : function() {
                                    toastr.error('Happening any errors on getting faculty.');
                                }
                            });
                            $('#volunteerModal').modal('show');
                        },
                        error : function() {
                            toastr.error('Happening any errors on getting faculty.');
                        }
                    })

                },
                error : function() {
                    toastr.error('Happenning any errors on getting data.');
                }
            })
        });
	};

	return {

		//main function to initiate the module
		init: function() {
			init();
		}
	};
}();

jQuery(document).ready(function() {
	KTDatatablesAdvancedColumnRendering.init();
});
