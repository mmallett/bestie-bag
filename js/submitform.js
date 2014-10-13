
$("#contact button").click(submitform);

var defaultText = '<img src="img/spinner.gif"></img> Working...';

function submitform(){

	var button = $('#contact button');
	var messagebox = $('#messagebox');

	messagebox.removeClass('error');

	var validationErrors = validate();

	if(!validationErrors){

		messagebox.html(defaultText);
		messagebox.show();
		button.prop("disabled", true);

		var data = $('#contact form').serialize();

		$.post('sendmail.php', data)
		.done(function(data){
			messagebox.html(data);
			button.prop("disabled", false);
		})
		.fail(function(jqXHR, textStatus, errorThrown){
			messagebox.html(jqXHR.responseText);
			messagebox.addClass('error');
			button.prop("disabled", false);
		});

	}
	else{

		messagebox.show();
		messagebox.addClass('error');
		messagebox.html(validationErrors);

	}

}

function validate(){

	var ret = '';

	//check that name is not empty
	if(!$("#input-name").val()){
		ret += 'Please enter your name</br>';
	}

	//check that email at least contains *@*
	var emailRe = /\S+@\S+\.\S+/;
	if(!emailRe.test($("#input-email").val())){
		ret += 'Please enter your email address</br>';	
	}

	return ret;

}