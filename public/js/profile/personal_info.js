"use strict";

// Class definition
var KTProfile = function () {
	// Elements
	var avatar;
	var offcanvas;

	// Private functions
	var _initAside = function () {
		// Mobile offcanvas for mobile mode
		offcanvas = new KTOffcanvas('kt_profile_aside', {
            overlay: true,
            baseClass: 'offcanvas-mobile',
            //closeBy: 'kt_user_profile_aside_close',
            toggleBy: 'kt_subheader_mobile_toggle'
        });
	}

	var _initForm = function() {

        var validation;
        var form = KTUtil.getById('personal_form');

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
			form,
			{
				fields: {
					firstname: {
						validators: {
							notEmpty: {
								message: 'First Name is required'
							}
						}
					},
                    lastname: {
						validators: {
							notEmpty: {
								message: 'Last Name is required'
							}
						}
					},
                    company: {
						validators: {
							notEmpty: {
								message: 'Company Name is required'
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
                    company_site: {
						validators: {
							notEmpty: {
								message: 'Company site is required'
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
                    $('#personal_form').submit();
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

		avatar = new KTImageInput('kt_profile_avatar');

        $("#phone").inputmask("mask", {
            "mask": "(999) 999-9999"
        });

        $("#company_site").inputmask({
            mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]"
        });
	}

	return {
		// public functions
		init: function() {
			_initAside();
			_initForm();
		}
	};
}();

jQuery(document).ready(function() {
	KTProfile.init();
});
