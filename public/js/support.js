$(document).ready(function() {
    var validation;
    var form = KTUtil.getById('support_form');

    if(alert != '')
    {
        toastr.success(alert);
    }

    // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
    validation = FormValidation.formValidation(
        form,
        {
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: 'Your Name is required'
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
                content: {
                    validators: {
                        notEmpty: {
                            message: 'Message is required'
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
                $('#support_form').submit();
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

    $('#btn_send').click(function() {
        form_submit();
    });
});
