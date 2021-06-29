"use strict";

// Class Definition
var KTLogin = function() {
    var _handleSignInForm = function() {
        var validation;

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
			KTUtil.getById('signin_form'),
			{
				fields: {
					email: {
						validators: {
							notEmpty: {
								message: 'Email is required'
							}
						}
					},
					password: {
						validators: {
							notEmpty: {
								message: 'Password is required'
							}
						}
					}
				},
				plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    //defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		);

        var form_sumit = function()
        {
            validation.validate().then(function(status) {
		        if (status == 'Valid') {
                    $('#signin_form').submit();
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

        $('#btn_signin_submit').on('click', function (e) {
            e.preventDefault();

            form_sumit();

        });

        $('input').keydown(function(e) {
            if(e.which == 13)
            {
                e.preventDefault();
                form_sumit();
            }
        })

        $('#email').keydown(function() {
            $('#email_error').hide();
        });

        $('#password').keydown(function() {
            $('#password_error').hide();
        });
    }


    // Public Functions
    return {
        // public functions
        init: function() {

            _handleSignInForm();
        }
    };
}();

// Class Initialization
jQuery(document).ready(function() {
    KTLogin.init();
});
