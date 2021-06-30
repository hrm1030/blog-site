"use strict";

var KTDatatablesAdvancedColumnRendering = function() {
    var arrows;
    var avatar;

    if(alert != '')
    {
        toastr.success(alert);
    }

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

	var init = function() {
		var table = $('#university_table');
        avatar = new KTImageInput('kt_university_image');

        var validation;
        var form = KTUtil.getById('university_form');

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
			form,
			{
				fields: {
                    university_image: {
						validators: {
							notEmpty: {
								message: 'University Image is required'
							}
						}
					},
					name: {
						validators: {
							notEmpty: {
								message: 'University Name is required'
							}
						}
					},
                    location: {
						validators: {
							notEmpty: {
								message: 'Location of university is required'
							}
						}
					},
                    founded_date: {
						validators: {
							notEmpty: {
								message: 'Founded date is required'
							}
						}
					},
                    faculties_cnt: {
						validators: {
							notEmpty: {
								message: 'Number of faculties is required'
							}
						}
					},
                    professors_cnt: {
						validators: {
							notEmpty: {
								message: 'Number of professors is required'
							}
						}
					},
                    students_cnt: {
						validators: {
							notEmpty: {
								message: 'Number of students is required'
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
                    // console.log($('#description').val());
                    $('#university_form').submit();
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
                [5, "asc"]
            ]
		});

        $('#btn_new').click(function() {
            $('#name').val('');
            $('.image-input-wrapper').removeAttr("style");
            $('#location').val('');
            $('#founded_date').val('');
            $('#faculties_cnt').val('');
            $('#professors_cnt').val('');
            $('#students_cnt').val('');
            $('#description').val('');
            $('#universityModal').modal('show');
        });

        $('#founded_date').datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows
        });

        $('#btn_save').click(function() {
            form_submit();
        });

        table.on('click', '.btn_delete', function() {
            var university_id = $(this).attr('university_id');
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
                    KTApp.block('#user_table', {
                        overlayColor: '#000000',
                        state: 'danger',
                        message: 'Please wait...'
                    });
                    $.ajax({
                        url : '/management/university/delete',
                        method : 'post',
                        data : {
                            university_id : university_id
                        },
                        success : function(data) {
                            toastr.success('Successfully deleted.');
                            KTApp.unblock('#university_table');
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
            var university_id = $(this).attr('university_id');
            $.ajax({
                url : '/management/get_university',
                method : 'post',
                data : {
                    university_id : university_id
                },
                success : function(data) {
                    var university = data.university;
                    $('.image-input-wrapper').attr("style", 'background-image: url("/'+university.photo+'")');
                    $('#name').val(university.name);
                    $('#location').val(university.location);
                    $('#founded_date').val(university.founded_date);
                    $('#faculties_cnt').val(university.faculties_cnt);
                    $('#professors_cnt').val(university.professors_cnt);
                    $('#students_cnt').val(university.students_cnt);
                    $('#description').val(university.description);
                    $('#university_id').val(university.id);
                    $('#universityModal').modal('show');
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
