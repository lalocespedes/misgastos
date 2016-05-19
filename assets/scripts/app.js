	
	//alertify.set({ delay : 10000 });
	//alertify.log("Success notification");

	$('#form_expense_add')
		.validate({
			rules: {
				date: {
				required: true,
				date: true
				}
			},
			errorClass: "text-danger",
			errorPlacement: function(error, element) {
    		error.appendTo( element.parent("div").parent("div") );
  			},
        	submitHandler: function(form) {
        	$("#save").prop('disabled', true);
        	form.submit();
        	}
    	});

	// $('#lolo').click( function(event) {
	// 	rome(lolo, { time: false, invalidate: true }).show();
	// });

	$(".date-picker")
		.datepicker({ 
			dateFormat: 'yy-mm-dd'
		});


function save_expense() {

	console.log('clicked');

	$('#form_expense_add')
		
		.validate({
        	errorClass: 'text-danger',
        	submitHandler: function(e) {$("#save").prop('disabled', true);form.submit();}
    	


    	});

	 // Use Ajax to submit form data

	// $.ajax({
	// 	url: $('#form_expense_add').attr('action'),
	// 	type: 'POST',
	// 	data: $('#form_expense_add').serialize(),
	// })
	// .done(function() {
	// 	console.log("success");
	// })
	// .fail(function() {
	// 	console.log("error");
	// })
	// .always(function() {
	// 	console.log("complete");
	// });
	

}

$(".alert").fadeIn(3000 );