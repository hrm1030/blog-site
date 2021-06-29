$(document).ready(function() {
    var validation;
        var form = KTUtil.getById('password_form');

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
			form,
			{
				fields: {
					current_password: {
						validators: {
							notEmpty: {
								message: 'Current password is required'
							}
						}
					},
                    new_password: {
						validators: {
							notEmpty: {
								message: 'New password is required'
							}
						}
					},
                    confirm_password: {
						validators: {
							notEmpty: {
								message: 'Confirm password is required'
							},
                            identical: {
                                compare: function() {
                                    return form.querySelector('[name="new_password"]').value;
                                },
                                message: 'The password and its confirm are not the same'
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
                    $('#password_form').submit();
                    KTApp.blockPage({
                        overlayColor: 'red',
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

        $('#btn_save').on('click', function (e) {
            e.preventDefault();

            form_submit();
        });
});
