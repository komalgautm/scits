
// user  account
$('#add_service_usenotused').formValidation({
    framework: 'bootstrap',
    excluded: [':disabled'],
    message: 'This value is not valid',
    icon: 
    {
        valid: 'fa fa-check',
        invalid: 'fa fa-times',
        validating: 'fa fa-refresh'
    },
    err: 
    {
        container: 'popover'
    },
    fields:
    {
        "name": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 2,
                    max: 30,
                    message: 'Name must between 2 to 30 alphabets'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z ]+$/,
                    message: 'Name can only consist of alphabets'
                }
            }
        },

        "phone_no": 
        {
            validators: 
            {
                notEmpty: 
                {
                    message: 'This field is required'
                },
                stringLength: {
                    min: 10,
                    max: 13,
                    message: 'Phone number must between 10 to 13 digits'
                },
                regexp: 
                {
                    regexp: /^[0-9]+$/,
                    message: 'Phone number can only consist of digits'
                }
            }
        },

        "date_of_birth": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 10,
                    max: 10,
                    message: 'DOB must contain  Numbers'
                },
                regexp: 
                {
                    regexp: /^[0-9,-]+$/,
                    message: 'DOB can only consist of Numbers'
                }
            }
        },

        "section": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 1,
                    max: 30,
                    message: 'This field must between 1 to 30 characters'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z,0-9 ]+$/,
                    message: 'Section Name can only consist of characters'
                }
            }
        },

        "admission_number": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 2,
                    max: 30,
                    message: 'This field must between 2 to 30 characters'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z,0-9 ]+$/,
                    message: 'Admission Number  can only consist of characters'
                }
            }
        },

        "short_description": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 2,
                    max: 200,
                    message: 'This field must between 1 to 200 characters'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z,0-9 ]+$/,
                    message: 'Field  can only consist of characters'
                }
            }
        },

        "height": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 1,
                    max: 20,
                    message: 'This field must between 1 to 30 characters'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z,0-9 ]+$/,
                    message: 'Height  can only consist of characters'
                }
            }
        },

        "weight": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 2,
                    max: 30,
                    message: 'This field must between 1 to 30 characters'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z,0-9 ]+$/,
                    message: 'Height  can only consist of characters'
                }
            }
        },

        "hair_and_eyes": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 2,
                    max: 30,
                    message: 'This field must between 1 to 30 characters'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z,0-9 ]+$/,
                    message: 'Field  can only consist of characters'
                }
            }
        },

        "email": 
        {
            validators: 
            {
               notEmpty: 
               {
                  message: 'This field is required'
               },
               emailAddress: {
                  message: 'The value is not a valid email address'
               },
               regexp: {
                  regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                  message: 'The value is not a valid email address'
               }/*,
               remote: 
               {
                   message: 'Email already exists',
                   url: 'check-user-email-exists',
                   type: 'GET',
                   delay: 2000     // Send Ajax request every 2 seconds
               }*/
            }
        },

        "markings": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 2,
                    max: 30,
                    message: 'This field must between 1 to 30 characters'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z,0-9 ]+$/,
                    message: 'Field  can only consist of characters'
                }
            }
        },
    }  
});


$('#add_staff_usernotused').formValidation({
    framework: 'bootstrap',
    excluded: [':disabled'],
    message: 'This value is not valid',
    icon: 
    {
        valid: 'fa fa-check',
        invalid: 'fa fa-times',
        validating: 'fa fa-refresh'
    },
    err: 
    {
        container: 'popover'
    },
    fields:
    {
        "name": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 2,
                    max: 30,
                    message: 'Name must between 2 to 30 alphabets'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z ]+$/,
                    message: 'Name can only consist of alphabets'
                }
            }
        },

        "user_name": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 2,
                    max: 30,
                    message: 'Name must between 2 to 30 alphabets'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z,_ ]+$/,
                    message: 'Name can only consist of alphabets'
                }
            }
        },

        "phone_no": 
        {
            validators: 
            {
                notEmpty: 
                {
                    message: 'This field is required'
                },
                stringLength: {
                    min: 10,
                    max: 13,
                    message: 'Phone number must between 10 to 13 digits'
                },
                regexp: 
                {
                    regexp: /^[0-9]+$/,
                    message: 'Phone number can only consist of digits'
                }
            }
        },

        "date_of_birth": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 10,
                    max: 10,
                    message: 'DOB must contain  Numbers'
                },
                regexp: 
                {
                    regexp: /^[0-9,-]+$/,
                    message: 'DOB can only consist of Numbers'
                }
            }
        },

        "section": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 1,
                    max: 30,
                    message: 'This field must between 1 to 30 characters'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z,0-9 ]+$/,
                    message: 'Section Name can only consist of characters'
                }
            }
        },
        "description": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                /*stringLength: {
                    min: 1,
                    max: 30,
                    message: 'This field must between 1 to 30 characters'
                },*/
                regexp: 
                {
                    regexp: /^[A-Z,a-z,0-9 ]+$/,
                    message: 'Section Name can only consist of characters'
                }
            }
        },
        "payroll": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                /*stringLength: {
                    min: 1,
                    max: 30,
                    message: 'This field must between 1 to 30 characters'
                },*/
                regexp: 
                {
                    regexp: /^[A-Z,a-z,0-9 ]+$/,
                    message: 'Section Name can only consist of characters'
                }
            }
        },
        "holiday_entitlement": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                /*stringLength: {
                    min: 1,
                    max: 30,
                    message: 'This field must between 1 to 30 characters'
                },*/
                regexp: 
                {
                    regexp: /^[A-Z,a-z,0-9 ]+$/,
                    message: 'Section Name can only consist of characters'
                }
            }
        },

        "admission_number": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 2,
                    max: 30,
                    message: 'This field must between 2 to 30 characters'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z,0-9 ]+$/,
                    message: 'Admission Number  can only consist of characters'
                }
            }
        },

        "short_description": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 2,
                    max: 200,
                    message: 'This field must between 1 to 200 characters'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z,0-9 ]+$/,
                    message: 'Field  can only consist of characters'
                }
            }
        },

        "height": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 1,
                    max: 20,
                    message: 'This field must between 1 to 30 characters'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z,0-9 ]+$/,
                    message: 'Height  can only consist of characters'
                }
            }
        },

        "weight": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 2,
                    max: 30,
                    message: 'This field must between 1 to 30 characters'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z,0-9 ]+$/,
                    message: 'Height  can only consist of characters'
                }
            }
        },

        "hair_and_eyes": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 2,
                    max: 30,
                    message: 'This field must between 1 to 30 characters'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z,0-9 ]+$/,
                    message: 'Field  can only consist of characters'
                }
            }
        },

        "email": 
        {
            validators: 
            {
               notEmpty: 
               {
                  message: 'This field is required'
               },
               emailAddress: {
                  message: 'The value is not a valid email address'
               },
               regexp: {
                  regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                  message: 'The value is not a valid email address'
               }/*,
               remote: 
               {
                   message: 'Email already exists',
                   url: 'check-user-email-exists',
                   type: 'GET',
                   delay: 2000     // Send Ajax request every 2 seconds
               }*/
            }
        },

        "markings": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 2,
                    max: 30,
                    message: 'This field must between 1 to 30 characters'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z,0-9 ]+$/,
                    message: 'Field  can only consist of characters'
                }
            }
        },

        "job_title": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 2,
                    max: 30,
                    message: 'Title must between 2 to 30 characters'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z,0-9 ]+$/,
                    message: 'Title can only consist of characters'
                }
            }
        },
    } 
});


$('#edit_user_formnotused').formValidation({
    framework: 'bootstrap',
    excluded: [':disabled'],
    message: 'This value is not valid',
    icon: 
    {
        valid: 'fa fa-check',
        invalid: 'fa fa-times',
        validating: 'fa fa-refresh'
    },
    err: 
    {
        container: 'popover'
    },
    fields:
    {
        "name": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 2,
                    max: 30,
                    message: 'Name must between 2 to 30 alphabets'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z ]+$/,
                    message: 'Name can only consist of alphabets'
                }
            }
        },

        "user_name": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 2,
                    max: 30,
                    message: 'User Name must between 2 to 30 characters'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z,0-9 ]+$/,
                    message: 'User Name can only consist of characters'
                }
            }
        },
        "email": 
        {
            validators: 
            {
               notEmpty: 
               {
                  message: 'This field is required'
               },
               emailAddress: {
                  message: 'The value is not a valid email address'
               },
               regexp: {
                  regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                  message: 'The value is not a valid email address'
               }/*,
               remote: 
               {
                   message: 'Email already exists',
                   url: 'check-user-email-exists',
                   type: 'GET',
                   delay: 2000     // Send Ajax request every 2 seconds
               }*/
            }
        },

        "job_title": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 2,
                    max: 30,
                    message: 'Title must between 2 to 30 characters'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z,0-9 ]+$/,
                    message: 'Title can only consist of characters'
                }
            }
        },
        "access_level": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                }
            }
        },
        /*"phone_no": 
        {
            validators: 
            {
                notEmpty: 
                {
                    message: 'This field is required'
                },
                stringLength: {
                    min: 10,
                    max: 13,
                    message: 'Phone number must between 10 to 13 digits'
                },
                regexp: 
                {
                    regexp: /^[0-9]+$/,
                    message: 'Phone number can only consist of digits'
                }
            }
        },*/
        "status": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                }
            }
        }

    }  
});

/* service users */
$('#add_service_user_formnotused').formValidation({
    framework: 'bootstrap',
    excluded: [':disabled'],
    message: 'This value is not valid',
    icon: 
    {
        valid: 'fa fa-check',
        invalid: 'fa fa-times',
        validating: 'fa fa-refresh'
    },
    err: 
    {
        container: 'popover'
    },
    fields:
    {
        "name": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 2,
                    max: 30,
                    message: 'Name must between 2 to 30 alphabets'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z ]+$/,
                    message: 'Name can only consist of alphabets'
                }
            }
        },
        "admission_number": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 2,
                    max: 30,
                    message: 'This field must between 2 to 30 characters'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z,0-9 ]+$/,
                    message: 'Admission Number  can only consist of characters'
                }
            }
        },
         "section": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 1,
                    max: 30,
                    message: 'This field must between 1 to 30 characters'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z,0-9 ]+$/,
                    message: 'Section Name can only consist of characters'
                }
            }
        },
        "email": 
        {
            validators: 
            {
               notEmpty: 
               {
                  message: 'This field is required'
               },
               emailAddress: {
                  message: 'The value is not a valid email address'
               },
               regexp: {
                  regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                  message: 'The value is not a valid email address'
               }/*,
               remote: 
               {
                   message: 'Email already exists',
                   url: 'check-user-email-exists',
                   type: 'GET',
                   delay: 2000     // Send Ajax request every 2 seconds
               }*/
            }
        },
         "height": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 1,
                    max: 20,
                    message: 'This field must between 1 to 30 characters'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z,0-9 ]+$/,
                    message: 'Height  can only consist of characters'
                }
            }
        },

        "date_of_birth": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 10,
                    max: 10,
                    message: 'DOB must contain  Numbers'
                },
                regexp: 
                {
                    regexp: /^[0-9,-]+$/,
                    message: 'DOB can only consist of Numbers'
                }
            }
        },
        
        "phone_no": 
        {
            validators: 
            {
                notEmpty: 
                {
                    message: 'This field is required'
                },
                stringLength: {
                    min: 10,
                    max: 13,
                    message: 'Phone number must between 10 to 13 digits'
                },
                regexp: 
                {
                    regexp: /^[0-9]+$/,
                    message: 'Phone number can only consist of digits'
                }
            }
        },
        
        "weight": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 2,
                    max: 30,
                    message: 'This field must between 1 to 30 characters'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z,0-9 ]+$/,
                    message: 'Height  can only consist of characters'
                }
            }
        },

         "hair_and_eyes": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 2,
                    max: 30,
                    message: 'This field must between 1 to 30 characters'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z,0-9 ]+$/,
                    message: 'Field  can only consist of characters'
                }
            }
        },
          "markings": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 2,
                    max: 30,
                    message: 'This field must between 1 to 30 characters'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z,0-9 ]+$/,
                    message: 'Field  can only consist of characters'
                }
            }
        },
          "short_description": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 2,
                    max: 200,
                    message: 'This field must between 1 to 200 characters'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z,0-9 ]+$/,
                    message: 'Field  can only consist of characters'
                }
            }
        },



        "status": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                }
            }
        }

    }  
});



$('#edit_service_user_formnotused').formValidation({
    framework: 'bootstrap',
    excluded: [':disabled'],
    message: 'This value is not valid',
    icon: 
    {
        valid: 'fa fa-check',
        invalid: 'fa fa-times',
        validating: 'fa fa-refresh'
    },
    err: 
    {
        container: 'popover'
    },
    fields:
    {
        "name": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 2,
                    max: 30,
                    message: 'Name must between 2 to 30 alphabets'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z ]+$/,
                    message: 'Name can only consist of alphabets'
                }
            }
        },
        "admission_number": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 2,
                    max: 30,
                    message: 'This field must between 2 to 30 characters'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z,0-9 ]+$/,
                    message: 'Admission Number  can only consist of characters'
                }
            }
        },
         "section": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 1,
                    max: 30,
                    message: 'This field must between 1 to 30 characters'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z,0-9 ]+$/,
                    message: 'Section Name can only consist of characterssss'
                }
            }
        },
        "email": 
        {
            validators: 
            {
               notEmpty: 
               {
                  message: 'This field is required'
               },
               emailAddress: {
                  message: 'The value is not a valid email address'
               },
               regexp: {
                  regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                  message: 'The value is not a valid email address'
               }/*,
               remote: 
               {
                   message: 'Email already exists',
                   url: 'check-user-email-exists',
                   type: 'GET',
                   delay: 2000     // Send Ajax request every 2 seconds
               }*/
            }
        },
         "height": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 1,
                    max: 20,
                    message: 'This field must between 1 to 30 characters'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z,0-9 ]+$/,
                    message: 'Height  can only consist of characters'
                }
            }
        },

        "date_of_birth": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 10,
                    max: 10,
                    message: 'DOB must contain  Numbers'
                },
                regexp: 
                {
                    regexp: /^[0-9,-]+$/,
                    message: 'DOB can only consist of Numbers'
                }
            }
        },
        
        "phone_no": 
        {
            validators: 
            {
                notEmpty: 
                {
                    message: 'This field is required'
                },
                stringLength: {
                    min: 10,
                    max: 13,
                    message: 'Phone number must between 10 to 13 digits'
                },
                regexp: 
                {
                    regexp: /^[0-9]+$/,
                    message: 'Phone number can only consist of digits'
                }
            }
        },
        
        "weight": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 2,
                    max: 30,
                    message: 'This field must between 1 to 30 characters'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z,0-9 ]+$/,
                    message: 'Height  can only consist of characters'
                }
            }
        },

         "hair_and_eyes": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 2,
                    max: 30,
                    message: 'This field must between 1 to 30 characters'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z,0-9 ]+$/,
                    message: 'Field  can only consist of characters'
                }
            }
        },
          "markings": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 2,
                    max: 30,
                    message: 'This field must between 1 to 30 characters'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z,0-9 ]+$/,
                    message: 'Field  can only consist of characters'
                }
            }
        },
          "short_description": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 2,
                    max: 200,
                    message: 'This field must between 1 to 200 characters'
                },
                regexp: 
                {
                    regexp: /^[A-Z,a-z,0-9 ]+$/,
                    message: 'Field  can only consist of characters'
                }
            }
        },
        "status": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                }
            }
        }

    }  
});

$('#user_set_password').formValidation({
    framework: 'bootstrap',
    excluded: [':disabled'],
    message: 'This value is not valid',
    icon: 
    {
        valid: 'fa fa-check',
        invalid: 'fa fa-times',
        validating: 'fa fa-refresh'
    },
    err: 
    {
        container: 'popover'
    },
    fields:
    {
        "password": 
        {
            validators: 
            {
                notEmpty: 
                {
                   message: 'Please enter new password, This field is required'
                }
            }
        },

       "confirm_password": 
       {
             validators: 
            {
                notEmpty: 
                {
                   message: 'Please confirm your password this field is required,'
                },
                identical: 
                {
                   field:   'password',
                   message: 'The new password and its confirm are not the same'
                }
            }
       }
    }    
});

$('#user_set_password').formValidation({
    framework: 'bootstrap',
    excluded: [':disabled'],
    message: 'This value is not valid',
    icon: 
    {
        valid: 'fa fa-check',
        invalid: 'fa fa-times',
        validating: 'fa fa-refresh'
    },
    err: 
    {
        container: 'popover'
    },
    fields:
    {
        "password": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                stringLength: {
                    min: 4,
                    max: 30,
                    message: 'Password must between 4 to 30 alphabets'
                }
            }
        },
        "confirm_password": 
        {
            validators: 
            {
                notEmpty: 
                {
                  message: 'This field is required'
                },
                identical: 
                {
                    field: 'password',
                    message: 'Password and Confirm password are not same'
                }
            }
        }
    }  
});

