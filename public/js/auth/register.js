"use strict";

// Class Definition
var KTLogin = function() {

    var _handleSignUpForm = function(e) {
        var validation;
        var form = KTUtil.getById('signup_form');

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
			form,
			{
				fields: {
					username: {
						validators: {
							notEmpty: {
								message: 'Username is required'
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
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'The password is required'
                            }
                        }
                    },
                    password_confirmation: {
                        validators: {
                            notEmpty: {
                                message: 'The password confirmation is required'
                            },
                            identical: {
                                compare: function() {
                                    return form.querySelector('[name="password"]').value;
                                },
                                message: 'The password and its confirm are not the same'
                            }
                        }
                    },
                    agree: {
                        validators: {
                            notEmpty: {
                                message: 'You must accept the terms and conditions'
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

        $('#usesrname').keydown(function() {
            $('#username_error').hide();
        });

        $('#email').keydown(function() {
            $('#email_error').hide();
        });

        $('#password').keydown(function() {
            $('#password_error').hide();
        });

        $('#phone').keydown(function() {
            $('#phone_error').hide();
        });

        var form_submit = function()
        {
            validation.validate().then(function(status) {
		        if (status == 'Valid') {
                    $('#signup_form').submit();
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

        $("#phone").inputmask("mask", {
            "mask": "(999) 999-9999"
        });

        $('#btn_signup_submit').on('click', function (e) {
            e.preventDefault();

            form_submit();
        });

        $('input').keydown(function(e) {


            if(e.which == 13)
            {
                e.preventDefault();
                form_submit();
            }
        })
        // Handle cancel button
        $('#btn_signup_cancel').on('click', function (e) {
            e.preventDefault();

            window.location.assign('/auth/login');
        });
    }


    // Public Functions
    return {
        // public functions
        init: function() {

            _handleSignUpForm();
        }
    };
}();

// Class Initialization
jQuery(document).ready(function() {
    KTLogin.init();
});
