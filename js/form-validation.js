jQuery(document).ready(function ($) {
    $("form[name='addContact']").validate({
        rules: {
            fullname: "required",
            tel: "required",
            email: {
                required: true,
                email: true
            }
            // password: {
            //     required: true,
            //     minlength: 5
            // }
        },
        messages: {
            fullname: "Please enter your full name",
            tel: "Please enter your phone number",
            // password: {
            //     required: "Please provide a password",
            //     minlength: "Your password must be at least 5 characters long"
            // },
            email: "Please enter a valid email address"
        },
        /* Make sure the form is submitted to the destination defined
        *  in the "action" attribute of the form when valid */
        submitHandler: function(form) {
            form.submit();
        }
    });
});