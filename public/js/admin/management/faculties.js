"use strict";

var KTDatatablesAdvancedColumnRendering = function() {
    var avatar;
    if(alert != '')
    {
        toastr.success(alert);
    }
	var init = function() {
		var table = $('#faculty_table');
        avatar = new KTImageInput('kt_faculty_image');

        var validation;
        var form = KTUtil.getById('faculty_form');

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
			form,
			{
				fields: {
					name: {
						validators: {
							notEmpty: {
								message: 'Faculty Name is required'
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
                    departments_cnt: {
						validators: {
							notEmpty: {
								message: 'Number of Departments is required'
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
                    $('#faculty_form').submit();
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

        $('#university').select2({
            placeholder: 'Select a university'
        });

        $('#btn_new').click(function() {
            $('#name').val('');
            $('.image-input-wrapper').removeAttr("style");
            $('#university').select2('val', 0);
            $('#departments_cnt').val('');
            $('#professors_cnt').val('');
            $('#students_cnt').val('');
            $('#description').val('');
            $('#facultyModal').modal('show');
        });

        $('#btn_save').click(function() {
            form_submit();
        });

        table.on('click', '.btn_delete', function() {
            var faculty_id = $(this).attr('faculty_id');
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
                    KTApp.block('#faculty_table', {
                        overlayColor: '#000000',
                        state: 'danger',
                        message: 'Please wait...'
                    });
                    $.ajax({
                        url : '/management/faculty/delete',
                        method : 'post',
                        data : {
                            faculty_id : faculty_id
                        },
                        success : function(data) {
                            toastr.success('Successfully deleted.');
                            KTApp.unblock('#faculty_table');
                            oTable.fnDeleteRow(nRow);
                        },
                        error : function() {
                            Swal.fire(
                                "Error",
                                "Happening any errors on deleting faculty",
                                "error"
                            );
                        }
                    });
                }
            });
        });

        table.on('click', '.btn_edit', function() {
            var faculty_id = $(this).attr('faculty_id');
            $.ajax({
                url : '/management/get_faculty',
                method : 'post',
                data : {
                    faculty_id : faculty_id
                },
                success : function(data) {
                    var faculty = data.faculty;
                    $('.image-input-wrapper').attr("style", 'background-image: url("/'+faculty.photo+'")');
                    $('#name').val(faculty.name);
                    $('#university').select2('val', `${faculty.university_id}`);
                    $('#departments_cnt').val(faculty.departments_cnt);
                    $('#professors_cnt').val(faculty.professors_cnt);
                    $('#students_cnt').val(faculty.students_cnt);
                    $('#description').val(faculty.description);
                    $('#faculty_id').val(faculty.id);
                    $('#facultyModal').modal('show');
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
