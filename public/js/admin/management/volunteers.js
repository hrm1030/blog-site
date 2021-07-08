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
            "mask": "9999999999"
        });

        $('#btn_new').click(function() {
            $('#name').val('');
            $('.image-input-wrapper').removeAttr("style");
            $('#email').val('');
            $('#phone').val('');
            $('#website').val('');
            $('#birthday').val('');
            $('#university').val('');
            $('#faculty').val('');
            $('#department').val('');
            $('#major').val('');
            $('#description').val('');
            $('#volunteerModal').modal('show');
        });

        $('#btn_save').click(function() {
            form_submit();
        });

        table.on('click', '.btn_delete', function() {
            var volunteer_id = $(this).attr('volunteer_id');
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
            var volunteer_id = $(this).attr('volunteer_id');
            // console.log(volunteer_id)
            $.ajax({
                url : '/management/get_volunteer',
                method : 'post',
                data : {
                    volunteer_id : volunteer_id
                },
                success : function(data) {
                    var volunteer = data.volunteer;
                    if(volunteer.photo != '')
                    {
                        $('.image-input-wrapper').attr("style", 'background-image: url("/'+volunteer.photo+'")');
                    }

                    $('#name').val(volunteer.fullname);
                    $('#email').val(volunteer.email);
                    $('#phone').val(volunteer.phone);
                    $('#website').val(volunteer.website);
                    $('#university').val(volunteer.university);
                    $('#faculty').val(volunteer.faculty);
                    $('#department').val(volunteer.department);
                    $('#birthday').val(volunteer.birthday);
                    $('#major').val(volunteer.majors);
                    $('#description').val(volunteer.description);
                    $('#volunteer_id').val(volunteer.id);
                    $('#volunteerModal').modal('show');
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
