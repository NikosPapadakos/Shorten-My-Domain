$(document).ready(function() {

    //Sign in fucntionallity
	$('#btn-log').on('click', function(e) {
		e.preventDefault;

		let username = $('#inputUsername').val();
		let password = $('#inputPassword').val();
		let checked = $('#remember').is(':checked');
		let unreadable_pass = btoa(password)

		if (username === '' || password === '') {
			$('#message').empty();
			let empty_msg = '<div class="alert alert-danger text-center" role="alert">Inputs cannot be empty!</div>';
			$('#message').append(empty_msg);
		} else {
			let creds = {
				username: username,
				password: password
			};

			$.ajax({
				type: 'POST',
				url: 'http://localhost/smd/api/authentication.php',
				data: JSON.stringify(creds),
				contentType: 'application/json; charset=utf-8',
				dataType: 'json',
				success: function(data) {
					if (data.payload == 'true') {

                        //Remember me cookies set
						if (checked) {
							Cookies.set('username', `${username}`, { expires: 1, sameSite: 'strict' });
							Cookies.set('password', `${unreadable_pass}`, { expires: 1, sameSite: 'strict' });
							Cookies.set('check', `checked`, { expires: 1, sameSite: 'strict' });
							window.location.replace('http://localhost/smd/admin.php');
						} else {
							window.location.replace('http://localhost/smd/admin.php');
						}
					} else {
						$('#message').empty();
						let empty_msg =
							'<div class="alert alert-danger text-center" role="alert">Invalid username or password.</div>';
						$('#message').append(empty_msg);
					}
				},
				error: function(errMsg) {
					alert(errMsg);
				}
			});
		}
	});
});
