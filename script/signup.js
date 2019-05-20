$(document).ready(function(){
	var request;
	$('#register-form')[0].reset();

	$(".button-collapse").sideNav();
	$('#register-form').submit(function(event){

		event.preventDefault();

		if(request)
		{
			request.abort();
		}

		var myForm = $(this);
		var myInput = myForm.find("input,button,select,textarea");
		var serializedData = myForm.serialize();

		myInput.prop("disabled",true);

		request = $.ajax({
			url: "api/register_user.php",
			type: "post",
			dataType: "json",
			data: serializedData
		});

		request.done(function (response, textStatus, jqXHR){
        // Log a message to the console
        var result = response;
        	console.log("Your response :\n"+JSON.stringify(result));
        	if(result['success'] == 1)
        	{
        		var errmsg = result['message'];
        		Materialize.toast(errmsg, 4000);
        		$(location).attr('href', 'login.php');
        		$('#register-form')[0].reset();

        	}
        	else
        	{
        		console.log("not success");
        		var errmsg = result['message'];
        		Materialize.toast(errmsg, 4000);
        		console.log(errmsg);
        	}
        
    	});

    	request.fail(function (jqXHR, textStatus, errorThrown){
        	Materialize.toast("Erro occured!", 4000);
	    });

    	request.always(function () {
	        // Reenable the inputs
	        myInput.prop("disabled", false);
	    });


	});
});