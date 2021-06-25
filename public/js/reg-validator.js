$("#user_form").validate({
	rules:{
		first_name:{
			required: true,
			minlength: 2,
		}, 
		last_name:{
			required: true,
			minlength: 2,
		}, 
		date_of_birth:{
			required: true,
			dateISO: true,
		},
		gender:{
			required: true,
		},
		email:{
			required: true,
			email: true,
			remote: {
				url: "/user/checkemail",
				type: "post"
			}
		},
		phone_number:{
			required: true,
			digits: true,
		},
		password: {
			required: true,
			minlength: 8
		},
		cpassword: {
			required: true,
			minlength: 8,
			equalTo: "#password"
        }
	},  
	messages:{
		first_name:{
			required: "First name is required",
			min: "First name must have atleast 2 characters"
		},
		last_name:{
			required: "First name is required",
			min: "First name must have atleast 2 characters"
		},
		date_of_birth:{
			required: "Your date of birth is required",
		},
		gender:{
			required: "Your gender is required",
		},
		email:{
			required: "Your email is required",
			remote: "This email already exist",
		},
		phone_number:{
			required: "Phone number is required",
		},
		password:{
			required: "Your password is required",
		},
		cpassword:{
			required: "Please type again your password",
		},
		
	},
	errorElement: "small",
	errorClass: "text-danger",
});