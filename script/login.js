$(document).ready(function(){
	var request;
	$('#login-form')[0].reset();
	$(".button-collapse").sideNav();
	$('#login-form').submit(function(event){

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
			url: "api/login_user.php",
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
        		$('#login-form')[0].reset();
        		$(location).attr('href', 'index.php');

        	}
        	else
        	{
        		console.log("not success");
        		var errmsg = result['message'];
        		Materialize.toast(errmsg, 4000);
        		
        	}
    	});

    	request.fail(function (jqXHR, textStatus, errorThrown){
        // Log the error to the console
            console.warn(jqXHR.responseText);
	       Materialize.toast("Error occured", 4000);
	    });

    	request.always(function () {
	        // Reenable the inputs
	        myInput.prop("disabled", false);
	    }); 
	});
});