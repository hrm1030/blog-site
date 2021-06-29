$(document).ready(function() {
    $("#six_digit_number").inputmask({
        "mask": "9",
        "repeat": 6,
        "greedy": false
    }); // ~ mask "9" or mask "99" or ... mask "9999999999"

    var validation;

    // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
    validation = FormValidation.formValidation(
        KTUtil.getById('verify_form'),
        {
            fields: {
                six_digit_number: {
                    validators: {
                        notEmpty: {
                            message: '6 digit number is required'
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
                $('#verify_form').submit();
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

    $('#btn_verify_submit').on('click', function (e) {
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
})
