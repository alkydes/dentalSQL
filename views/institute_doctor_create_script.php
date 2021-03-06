<script src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker3.css"/>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/css/bootstrapValidator.min.css"/>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>

<script>

$( document ).ready(function() {

	// 날자 선택기
	// https://github.com/uxsolutions/bootstrap-datepicker
	// https://bootstrap-datepicker.readthedocs.io/en/latest/
	$("#from-datepicker").datepicker({ 
        format: 'yyyy-mm-dd',
        daysOfWeekHighlighted: '0',
        todayHighlight: true,
        startDate: "-100y", // 100살까지 따지자, 100세에 치아가 있을까?
        endDate: '+0d',  	// 오늘 이후에 생일이 있을리 없으니까.
		startView: 2,		//처음 1년단위로 끊어 보여주기
    	maxViewMode: 3,		// 10년 단위가 최대, 100년 단위는 불필요하니까.
		beforeShowYear: function (date){
		  if (date.getFullYear() == 1990) {
			return false;
		  }
        }
        // language: 'kr',  // 한국달력
    })				// 이걸로 옵션입력 안되더라
	//Listen for the change even on the input
    .on('changeDate show hide', function(ev) {
			$('#registration_form').bootstrapValidator('revalidateField', 'date');
	}); // 바로 재검증 하기
	// 시간까지 빼려면 Pickadate도 괜찮은 듯 나중에 써보자. 예제가 있다.


	// 날자 선택기
	// https://github.com/uxsolutions/bootstrap-datepicker
	// https://bootstrap-datepicker.readthedocs.io/en/latest/
	$("#from-drdatepicker").datepicker({ 
        format: 'yyyy-mm-dd',
        daysOfWeekHighlighted: '0',
        todayHighlight: true,
        startDate: "-100y", // 100살까지 따지자, 100세에 치아가 있을까?
        endDate: '+0d',  	// 오늘 이후에 생일이 있을리 없으니까.
		startView: 2,		//처음 1년단위로 끊어 보여주기
    	maxViewMode: 3,		// 10년 단위가 최대, 100년 단위는 불필요하니까.
		beforeShowYear: function (date){
		  if (date.getFullYear() == 1990) {
			return false;
		  }
        }
        // language: 'kr',  // 한국달력
    })				// 이걸로 옵션입력 안되더라
	//Listen for the change even on the input
    .on('changeDate show hide', function(ev) {
			$('#registration_form').bootstrapValidator('revalidateField', 'drdate');
	}); // 바로 재검증 하기
	// 시간까지 빼려면 Pickadate도 괜찮은 듯 나중에 써보자. 예제가 있다.


	// 입력값 검증기
	// https://github.com/nghuuphuoc/bootstrapvalidator
	// http://bootstrapvalidator.votintsev.ru/getting-started/
    $('#registration_form').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'fa fa-check',
            invalid: 'fa fa-times',
            validating: 'fa fa-refresh'
        },
        fields: {
            first_name: {
                validators: {
                        stringLength: {
                        min: 1,
                    },
                        notEmpty: {
                        message: 'Please supply your first name'
                    }
                }
            },
            last_name: {
                validators: {
                     stringLength: {
                        min: 1,
                    },
                    notEmpty: {
                        message: 'Please supply your last name'
                    }
                }
            },
            date: {
                validators: {
                    notEmpty: {
                        message: 'The date of birth is required'
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'The date of birth is not valid'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and cannot be empty'
                    },
                   // different: {
                   //     field: 'first_name', 'last_name',
                   //     message: 'The password cannot be the same as username'
                   // },
                    stringLength: {
                        min: 8,
                        message: 'The password must have at least 8 characters'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your email address'
                    },
                    emailAddress: {
                        message: 'Please supply a valid email address'
                    }
                }
            },
            phone: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your phone number'
                    },
                    phone: {
                        country: 'GB',
                        message: 'Please supply a vaild phone number with area code'
                    }
                }
            },
            gender: {
                validators: {
                    notEmpty: {
                        message: 'The gender is required'
                    }
                }
            },
            hospital: {
                validators: {
                    notEmpty: {
                        message: 'Please select your hospital'
                    }
                }
            },
            drcode: {
                validators: {
                    stringLength: {
                        min: 5,
                        max: 8,
                    },
                    notEmpty: {
                        message: 'Please supply your license number'
                    },
                }
            },
            drdate: {
                validators: {
                    notEmpty: {
                        message: 'The date of license is required'
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'The date of license is not valid'
                    }
                }
            },
            specialty: {
                validators: {
                      stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please enter your specialty'
                    }
                }
            },
            comment: {
                validators: {
                      stringLength: {
                        min: 10,
                        max: 200,
                        message:'Please enter at least 10 characters and no more than 200'
                    },
                    notEmpty: {
                        message: 'Please supply a description of you'
                    }
                    }
                }
            }
        })
        .on('success.form.bv', function(e) {
            $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...


			/*
                $('#registration_form').data('bootstrapValidator').resetForm();

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

			*/

			document.getElementById('registration_form').submit();

    });
    

});


</script>
