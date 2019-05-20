$(document).ready(function(){
	var request;
	var requestAll;
	$(".button-collapse").sideNav();

	requestAll = $.ajax({
			url: "api/get_all_notes.php",
			type: "get",
			dataType: "json",
			success: function(data){
				var notes = data['notes'];
				// console.log(JSON.stringify(data));
				// console.log("Total notes :"+notes.length);
				var len = notes.length;
				if(len != 0)
				{
					for(var item in notes)
					{
						//gettiing values here
						var id = notes[item]['id'];
						var var_title = notes[item]['title'];
						var var_description = notes[item]['description'];
						var updated_at = notes[item]['updated_at'];
						var finished = notes[item]['finished'];
						var check_id = 'check'+id;
						var edit_id = 'edit'+id;
						var div1 = '<div class= "col s12 m6 l3" id="'+id+'">';
						var div2 = '<div class="card hoverable"><div class="card-content"><div><a class="btn-floating btn-small waves-effect waves-light grey right edit-btn" id = "'+edit_id+'"><i class="material-icons">create</i></a>';
						var div3 = '<span class="card-title">'+var_title+'</span></div>';
						var div4 = '<p class="card-description">'+var_description+'</p></div>';
						var div5 = '<div class="card-action"><input type="checkbox" class="filled-in" id="'+check_id+'"><label class="" for="'+check_id+'">Mark This Task As Finished</label></div></div></div>';
						$('#my-notes').prepend(div1+div2+div3+div4+div5);
						if (finished == 1)
						{
							$('#'+id).addClass('strikethrough');
							$('#'+id).find('.btn-floating').addClass('disabled');
							$('#'+id).find('.filled-in').prop('checked',true);
						}
					}
				}
				else
				{
					var no_notes = "You don't have any notes yet.";
					var div = '<div id="no-notes">';
					var content = '<h4>'+no_notes+'</h4></div>';

					$('#my-notes').append(div+content);
					$('#no-notes').show();
				}
				
			},
			error: function(errorThrown)
			{
				console.error(errorThrown);
			}
	});
	
	$('#add-form').submit(function(event){
		event.preventDefault();
		if(request)
		{
			request.abort();
		}
		var myForm = $(this);
		var var_title = $('#title').val();
		var var_description = $('#description').val();
		var myInput = myForm.find("input,button,select,textarea");
		var serializedData = myForm.serialize();
		// alert(var_title + ' ' + var_description);
		myInput.prop("disabled",true);
		request = $.ajax({
			url: "api/add_note.php",
			type: "post",
			dataType: "json",
			data: serializedData
		});

		request.done(function(response,textStatus,jqXHR){
			// console.log(json.stringify(response));
			// alert("Your Response :\n"+JSON.stringify(response));
			// alert(response['last_id']);
			// console.log('Last id : '+response['last_id']);
			$('#no-notes').hide();
			if(response['success'] == 1)
			{
				$('#add-form')[0].reset();
				var check_id = 'check'+response['last_id'];
				var edit_id = 'edit'+response['last_id'];
				var div1 = '<div class= "col s12 m6 l3" id="'+response['last_id']+'">';
				var div2 = '<div class="card hoverable"><div class="card-content"><div><a class="btn-floating btn-small waves-effect waves-light grey right edit-btn" id = "'+edit_id+'"><i class="material-icons">create</i></a>';
				var div3 = '<span class="card-title">'+var_title+'</span></div>';
				var div4 = '<p class="card-description">'+var_description+'</p></div>';
				var div5 = '<div class="card-action"><input type="checkbox" class="filled-in" id="'+check_id+'"><label class="" for="'+check_id+'">Mark This Task As Finished</label></div></div></div>';
				$('#my-notes').prepend(div1+div2+div3+div4+div5);
				Materialize.toast("Added Successfully !!!", 4000);
			}
			else
			{
				Materialize.toast("Error occured", 4000);
			}
			
			// window.location.reload(true);
		});

		request.fail(function (jqXHR, textStatus, errorThrown){
	        console.error(
	            "The following error occurred: "+
	            textStatus, errorThrown
	        );
	    });

		request.always(function () {
	        myInput.prop("disabled", false);
	    });
	});

	$('#float-add').click(function()
	{
		$("#add-container").toggleClass("hide overlay");
		$(this).toggleClass("top-right bottom-right");
		$('#float-add').toggleClass("rotate-close");
	});

	$('#float-edit').click(function()
	{
		$("#edit-container").toggleClass("hide overlay");
		$('#float-add').removeClass("hide");
		$(this).addClass("hide");
		$("#edit_title").val("");
		$("#edit_description").val("");
		$("#edit_id").val("");
	});

	$('#edit-form').submit(function(event){
		event.preventDefault();
		if(request)
		{
			request.abort();
		}
		var myForm = $(this);
		var myInput = myForm.find("input,button,select,textarea");
		var serializedData = myForm.serialize();
		// alert(serializedData);
		myInput.prop("disabled",true);
		request = $.ajax({
			url: "api/update_note.php",
			type: "post",
			dataType: "json",
			data: serializedData
		});

		request.done(function(response,textStatus,jqXHR){
			if(response['success']==1)
			{
				var id = response['note_id'];
				var title = response['title'];
				var description = response['description'];
				$('#'+id).find(".card-title").text(title);
				$('#'+id).find(".card-description").text(description);
				$("#edit_title").val("");
				$("#edit_description").val("");
				$("#edit_id").val("");
			}

			console.log('Response :'+JSON.stringify(response));
			console.log('TextStatus :'+textStatus);

		});

		request.fail(function (jqXHR, textStatus, errorThrown){
	        console.error(
	            "The following error occurred: "+
	            textStatus, errorThrown
	        );
	    });

		request.always(function () {
	        myInput.prop("disabled", false);
	    });

	});

	$(document).on('click','.edit-btn',function(){
		$("#edit-container").toggleClass("hide overlay");
		$('#float-edit').toggleClass("hide");
		$('#float-add').addClass("hide");
		var id = $(this).attr('id');
		var note_id = id.substr(4);
		var title_content = $('#'+note_id).find(".card-title").text();
		var description_content = $('#'+note_id).find(".card-description").text();
		$("#edit_title").val(title_content);
		$("#edit_description").val(description_content);
		$("#edit_id").val(note_id);
	});

	$(document).on('change', '.filled-in', function() {
		// code here
		var id = $(this).attr('id');
		var note_id = id.substr(5);
		var bool_status = this.checked;
		if(bool_status)
		{
			var status = 1;
		}
		else
		{
			var status = 0;
		}
		// alert('Check id : '+note_id+'\nStatus :'+this.checked);
		var request;

		var serializedData = 'note_id='+note_id+'&finished='+status;
	
		request = $.ajax({
			url: "api/mark_finish.php",
			type: "post",
			dataType: "json",
			data: serializedData
		});

		request.done(function(response,textStatus,jqXHR){
			console.log('Success value : '+response['success']);
			console.log('Success message : '+response['message']);
			if(response['success'] == 1)
			{
				var note_id = response['note_id'];
				$('#'+note_id).toggleClass('strikethrough');
				$('#'+note_id).find('.btn-floating').toggleClass('disabled');
			}
			// console.log('Response :'+response);
			// console.log('TextStatus :'+textStatus);
		});

		request.fail(function (jqXHR, textStatus, errorThrown){
	        console.error(
	            "The following error occurred: "+
	            textStatus, errorThrown
	        );
		});
		
	});
});