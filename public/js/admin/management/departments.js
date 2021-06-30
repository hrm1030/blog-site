"use strict";

var KTDatatablesAdvancedColumnRendering = function() {
    if(alert != '')
    {
        toastr.success(alert);
    }

	var init = function() {
        var course_table = $('#course_table');
        var cTable = course_table.dataTable({searching: false, paging: false, info: false});

		var table = $('#department_table');
        var validation;
        var form = KTUtil.getById('department_form');

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
			form,
			{
				fields: {
					name: {
						validators: {
							notEmpty: {
								message: 'Department Name is required'
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

        var validation_course;
        validation_course = FormValidation.formValidation(
			form,
			{
				fields: {
					course_name: {
						validators: {
							notEmpty: {
								message: 'Course Name is required'
							}
						}
					},
                    course_content: {
						validators: {
							notEmpty: {
								message: 'Course content is required'
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
                    $('#department_form').submit();
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

        $('#university').select2({
            placeholder: 'Select a university'
        });

        $('#faculty').select2({
            placeholder: 'Select a faculty'
        });

        $('#btn_new').click(function() {
            $('#name').val('');
            $('.image-input-wrapper').removeAttr("style");
            $('#university').select2('val', 0);
            $('#faculty').select2('val', 0);
            $('#professors_cnt').val('');
            $('#students_cnt').val('');
            $('#description').val('');
            cTable.fnClearTable();
            $('#departmentModal').modal('show');
        });

        var university_change = function(university_id) {
            $.ajax({
                url : '/management/department/get_faculty',
                method : 'post',
                data : {
                    university_id : university_id
                },
                success : function(data) {
                    $('#faculty').html('');
                    var faculties = data.faculties;
                    console.log(faculties)
                    for(var i = 0 ; i < faculties.length ; i ++)
                    {
                        $('#faculty').append(`<option value="${faculties[i].id}">${faculties[i].name}</option>`)
                    }
                },
                error : function() {
                    toastr.error('Happening any errors on getting faculty.');
                }
            })
        }

        $('#university').change(function() {
            var university_id = $(this).val();

            university_change(university_id);

        })

        $('#btn_save').click(function() {
            form_submit();
        });

        table.on('click', '.btn_delete', function() {
            var department_id = $(this).attr('department_id');
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
                    KTApp.block('#department_table', {
                        overlayColor: '#000000',
                        state: 'danger',
                        message: 'Please wait...'
                    });
                    $.ajax({
                        url : '/management/department/delete',
                        method : 'post',
                        data : {
                            department_id : department_id
                        },
                        success : function(data) {
                            toastr.success('Successfully deleted.');
                            KTApp.unblock('#department_table');
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
            var department_id = $(this).attr('department_id');
            $.ajax({
                url : '/management/get_department',
                method : 'post',
                data : {
                    department_id : department_id
                },
                success : function(data) {
                    var department = data.department;
                    $('#name').val(department.name);
                    $('#university').select2('val', `${department.university_id}`);
                    var courses = data.courses;
                    console.log(courses)
                    for(var i=0 ; i < courses.length; i ++)
                    {
                        cTable.fnAddData([courses[i].name, courses[i].content, `<button type="button" course_id="${courses[i].id}" class="btn btn-sm btn-danger btn-icon btn_cancel"><i class="far fa-trash-alt"></i></button>`])
                    }
                    $.ajax({
                        url : '/management/department/get_faculty',
                        method : 'post',
                        data : {
                            university_id : department.university_id
                        },
                        success : function(data) {
                            $('#faculty').html('');
                            var faculties = data.faculties;
                            console.log(faculties)
                            for(var i = 0 ; i < faculties.length ; i ++)
                            {
                                $('#faculty').append(`<option value="${faculties[i].id}">${faculties[i].name}</option>`)
                            }
                            $('#faculty').val(department.faculty_id);
                            $('#professors_cnt').val(department.professors_cnt);
                            $('#students_cnt').val(department.students_cnt);
                            $('#description').val(department.description);
                            $('#department_id').val(department.id);

                            $('#departmentModal').modal('show');
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



        $('#btn_course_add').click(function() {
            validation_course.validate().then(function(status) {
		        if (status == 'Valid') {
                    var course_name = $('#course_name').val();
                    var course_content = $('#course_content').val();
                    $.ajax({
                        url : '/management/department/add_course',
                        method : 'post',
                        data : {
                            course_name : course_name,
                            course_content : course_content,
                            department_id : $('#department_id').val()
                        },
                        success : function(data) {

                            cTable.fnAddData([`${course_name}`, `${course_content.slice(0, 30)}`, `<button type="button" course_id="${data.course.id}" class="btn btn-sm btn-danger btn-icon btn_cancel"><i class="far fa-trash-alt"></i></button>`])

                            $('#course_name').val('');
                            $('#course_content').val('');
                        },
                        error : function() {
                            toastr.error('Happening any errors on adding course.');
                        }
                    })

				}
            });
        });



        cTable.on('click', '.btn_cancel', function() {
            var course_id = $(this).attr('course_id');
            var nRow = $(this).parents('tr')[0];
            $.ajax({
                url : '/management/department/delete_course',
                method : 'post',
                data : {
                    course_id : course_id
                },
                success : function(data) {
                    cTable.fnDeleteRow(nRow);
                }
            });

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
