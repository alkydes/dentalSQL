<script src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker3.css"/>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/css/bootstrapValidator.min.css"/>

<script>
// 입력값 검증기
// https://github.com/nghuuphuoc/bootstrapvalidator
// http://bootstrapvalidator.votintsev.ru/getting-started/
$(document).ready(function() {
    $('#survey_form').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'fa fa-check',
            invalid: 'fa fa-times',
            validating: 'fa fa-refresh'
        },
        fields: {
            Corah1: {
                validators: {
                    notEmpty: {
                        message: 'Please select your fear level'
                    }
                }
            },           
            Corah2: {
                validators: {
                    notEmpty: {
                        message: 'Please select your fear level'
                    }
                }
            },           
            Corah3: {
                validators: {
                    notEmpty: {
                        message: 'Please select your fear level'
                    }
                }
            },           
            Corah4: {
                validators: {
                    notEmpty: {
                        message: 'Please select your fear level'
                    }
                }
            },                                
            vas_pain: {
                validators: {
                    notEmpty: {
                        message: 'Please select your pain level.'
                    }
                }
            },
            site: {
                validators: {
                      stringLength: {
                        min: 2,
                        max: 200,
                        message:'Please enter at least 2 characters and no more than 200'
                    },
                    notEmpty: {
                        message: 'Please supply a pain description of you'
                    }
                }
            },
            onset: {
                validators: {
                      stringLength: {
                        min: 2,
                        max: 200,
                        message:'Please enter at least 2 characters and no more than 200'
                    },
                    notEmpty: {
                        message: 'Please supply a pain description of you'
                    }
                }
            },
            character: {
                validators: {
                      stringLength: {
                        min: 2,
                        max: 200,
                        message:'Please enter at least 2 characters and no more than 200'
                    },
                    notEmpty: {
                        message: 'Please supply a pain description of you'
                    }
                }
            },
            radiate: {
                validators: {
                      stringLength: {
                        min: 2,
                        max: 200,
                        message:'Please enter at least 2 characters and no more than 200'
                    },
                    notEmpty: {
                        message: 'Please supply a pain description of you'
                    }
                }
            },
            association: {
                validators: {
                      stringLength: {
                        min: 2,
                        max: 200,
                        message:'Please enter at least 2 characters and no more than 200'
                    },
                    notEmpty: {
                        message: 'Please supply a pain description of you'
                    }
                }
            },
            time: {
                validators: {
                      stringLength: {
                        min: 2,
                        max: 200,
                        message:'Please enter at least 2 characters and no more than 200'
                    },
                    notEmpty: {
                        message: 'Please supply a pain description of you'
                    }
                }
            },
            exacerbation: {
                validators: {
                      stringLength: {
                        min: 2,
                        max: 200,
                        message:'Please enter at least 2 characters and no more than 200'
                    },
                    notEmpty: {
                        message: 'Please supply a pain description of you'
                    }
                }
            },


            }
        })
        .on('success.form.bv', function(e) {
            $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
                $('#contact_form').data('bootstrapValidator').resetForm();

            // Prevent form submission
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            // Use Ajax to submit form data
            $.post($form.attr('action'), $form.serialize(), function(result) {
                console.log(result);
            }, 'json');
        });
});


</script>