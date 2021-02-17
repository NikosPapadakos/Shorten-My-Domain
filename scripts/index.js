$(document).ready(function() {
    //Enabling tooltips
	$('[data-toggle="tooltip"]').tooltip();

    //Copy to clipboard
	$(document).on('click', '#copy', function() {
		$(this).tooltip({
			title: 'Copied to clipboard!'
		});
		$(this).toggleClass('active');
		$(this).tooltip('show');

		var text = $('#this').html();
		var textString = `${text}`;

		navigator.clipboard.writeText(textString);
	});

	//checkbox default
	$(':checkbox').prop('checked', false);

	//checkbox functionality
	$(':checkbox').on('click', function() {
		$(':checkbox').parent().toggleClass('active');
	});

	//slider functionality
	$('#slider').on('input', function() {
		let value = $(this).val();
		let output = $('.output');

		if (value == 0) {
			output.html('10 mins');
		} else if (value == 1) {
			output.html('1 hour');
		} else if (value == 2) {
			output.html('1 day');
		} else if (value == 3) {
			output.html('1 week');
		} else if (value == 4) {
			output.html('15 days');
		}
	});

	//render active links
	function renderActive() {
		$.getJSON('http://localhost/smd/api/read_active.php', function extract(data) {
			let activeLinks = data.payload;
			$('#active').html(activeLinks);
		});
	}
	renderActive();

	$('body').on('click', '#reload-page', function() {
		window.location.reload();
	});

	//validation and creation
	$('#create').on('click', function() {
		let original = $.trim($('#url').val());
		let expiry_date = $('#slider').val();
		let renewable;
		if ($('#renew').is(':checked')) {
			renewable = '1';
		} else {
			renewable = '0';
		}

		function validURL(str) {
			var pattern = new RegExp(
				/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/
			);
			return pattern.test(str);
		}

		if (original === '') {
			$('#message').empty();
			let empty_msg =
				'<div class="alert alert-danger text-center" role="alert">Oops! Looks like URL is empty. Please enter a valid URL.</div>';
			$('#message').append(empty_msg);
		} else if (!validURL(original)) {
			$('#message').empty();
			let invalid_msg =
				'<div class="alert alert-danger text-center" role="alert">This URL is invalid. Please try again.</div>';
			$('#message').append(invalid_msg);
		} else {
			let newObj = {
				original: original,
				expiry_date: expiry_date,
				renewable: renewable
			};

			let stringify = JSON.stringify(newObj);
			$.ajax({
				type: 'POST',
				url: 'http://localhost/smd/api/save.php',
				data: stringify,
				contentType: 'application/json; charset=utf-8',
				dataType: 'json',
				success: function(data) {
					console.log(data);
				
			
					$(document).on('click', 'button.btn-secondary', function() {
						
						
						let shortObj = {
							shortened: data.payload.shortened
						};
						$.ajax({
							type: 'POST',
							url: 'http://localhost/smd/api/renew.php',
							data: JSON.stringify(shortObj),
							contentType: 'application/json; charset=utf-8',
							dataType: 'json',
							success: function(data) {
                                //Renew
								$('#message').empty();
								let success_re = `<div class="alert alert-success text-center" role="alert">Your new URL has been renewed successfully: <a id="this" class="alert-link" href="http://localhost/smd/${data
									.payload.shortened}">http://localhost/smd/${data.payload
									.shortened}</a>      <button type="button" id="copy" data-toggle="tooltip" data-placement="top"  class="btn btn-outline-dark btn-sm"><i class="bi bi-clipboard"></i></button></div>`;
								$('#message').append(success_re);
								$('#expiry').empty();
								let expiration_indicator = `<h1>Expires at: ${data.payload.expiry_date}</h1>`;
								$('#expiry').append(expiration_indicator);
								renderActive();
							},
							error: function(errMsg) {
								alert(errMsg);
							}
						});
					});

                    let enabled = data.payload.is_enabled;
                    
                    //Create new
					if (data.payload.creation_date == null) {
						$('.input-group-append').empty();
						$('.input-group-append').append(
							' <button id="reload-page" class="btn btn-primary"  type="button" >Shorten new!</button>'
						);

						$('#message').empty();
						let success_msg = `<div class="alert alert-success text-center" role="alert">Your new URL is: <a id="this" class="alert-link" href="http://localhost/smd/${data
							.payload.shortened}">http://localhost/smd/${data.payload
							.shortened}</a>      <button type="button" id="copy" data-toggle="tooltip" data-placement="top"  class="btn btn-outline-dark btn-sm"><i class="bi bi-clipboard"></i></button></div>`;
						$('#message').append(success_msg);
						renderActive();
						$('#expiry').empty();
						let expiration_indicator = `<h1>Expires at: ${data.payload.expiry_date}</h1>`;
						$('#expiry').append(expiration_indicator);
						if (data.payload.renewable == 1) {
							$('#expiry').append('<button class="btn btn-secondary" id="remake1">Renew URL</button>');
						}
					} else {
						var d = new Date();
						var current = d.getTime();
						var expiration_date_ms = new Date(data.payload.expiry_date);
						var renewability = data.payload.renewable;
						
                       
                        //Not expired but renewable
						if (current < expiration_date_ms && renewability == 1 && enabled == 1) {
							$('.input-group-append').empty();
							$('.input-group-append').append(
								' <button id="reload-page" class="btn btn-primary"  type="button" >Shorten new!</button>'
							);
							$('#message').empty();
							let msg = `<div class="alert alert-dark text-center" role="alert">This URL has already been commpressed: <a id="this" class="alert-link" href="http://localhost/smd/${data
								.payload.shortened}">http://localhost/smd/${data.payload
								.shortened}</a>      <button type="button" id="copy" data-toggle="tooltip" data-placement="top"  class="btn btn-outline-dark btn-sm"><i class="bi bi-clipboard"></i></button></div>`;
							$('#message').append(msg);
							$('#expiry').empty();
							let expiration_indicator = `<h1>Expires at: ${data.payload.expiry_date}</h1>`;
							$('#expiry').append(expiration_indicator);
                            $('#expiry').append('<button class="btn btn-secondary" id="remake2">Renew URL</button>');
                            
                            //Not expired and not renewable
						} else if (current < expiration_date_ms && renewability == 0 && enabled == 1) {
							$('.input-group-append').empty();
							$('.input-group-append').append(
								' <button id="reload-page" class="btn btn-primary"  type="button" >Shorten new!</button>'
							);
							$('#message').empty();
							let msg = `<div class="alert alert-dark text-center" role="alert">This URL has already been commpressed: <a id="this" class="alert-link" href="http://localhost/smd/${data
								.payload.shortened}">http://localhost/smd/${data.payload
								.shortened}</a>      <button type="button" id="copy" data-toggle="tooltip" data-placement="top"  class="btn btn-outline-dark btn-sm"><i class="bi bi-clipboard"></i></button></div>`;
							$('#message').append(msg);
							$('#expiry').empty();
							let expiration_indicator = `<h1>Expires at: ${data.payload.expiry_date}</h1>`;
                            $('#expiry').append(expiration_indicator);
                            
                            //Expired and not renewable
						} else if (current > expiration_date_ms && renewability == 0 && enabled == 1) {
							let id = data.payload.id;
							let deleteId = {
								id: id
							};
							$.ajax({
								type: 'DELETE',
								url: 'http://localhost/smd/api/delete.php',
								data: JSON.stringify(deleteId),
								contentType: 'application/json; charset=utf-8',
								dataType: 'json'
							});
							$('#expiry').empty();
							$('#delete-msg').empty();
							$('#delete-msg').append(
								'<h1>This URL has expired and has been deleted. Redirecting to home page in 3 seconds !</h1>'
							);
							setTimeout(function() {
								window.location.reload(1);
                            }, 3000);
                            
                            //Expired but renewable
						} else if (current >= expiration_date_ms && renewability == 1 && enabled == 1 && (expiration_date_ms.setMinutes(data.payload.active_period ))>= current) {
							
				
			
							let active = data.payload.active_period;
							let new_expiry_date;
							if (active == 10) {
								new_expiry_date = '10 minutes';
							} else if (active == 60) {
								new_expiry_date = '1 hour';
							} else {
								let days = active / 1440;
								if (days === 1) {
									new_expiry_date = `${days} day`;
								} else if (days > 1) {
									new_expiry_date = `${days} days`;
								}
							}

							$('.input-group-append').empty();
							$('.input-group-append').append(
								' <button id="reload-page" class="btn btn-primary"  type="button" >Shorten new!</button>'
							);
							$('#message').empty();
							let msg = `<div class="alert alert-dark text-center" role="alert">This URL has already been commpressed, but has expired. Please renew if you want to use it again.</div>`;
							$('#message').append(msg);
							$('#expiry').empty();
							let expiration_indicator = `<h1>This URL has expired. You can renew it for ${new_expiry_date}</h1>`;
							$('#expiry').append(expiration_indicator);
                            $('#expiry').append('<button class="btn btn-secondary" id="remake3">Renew URL</button>');
                            
                            //Admin disabled
						} else if (enabled == 0) {
							$('#expiry').empty();
							$('#delete-msg').empty();
							$('#delete-msg').append(
								'<h1>This URL has been disabled. Redirecting to home page in a moment!</h1>'
							);
							setTimeout(function() {
								window.location.reload(1);
							}, 3000);
							//renewble Expired and renew expiration is expired
						} else if (current > expiration_date_ms && renewability == 1 && enabled == 1 && (expiration_date_ms.setMinutes(data.payload.active_period))<current){
							let id = data.payload.id;
							let deleteId = {
								id: id
							};
							$.ajax({
								type: 'DELETE',
								url: 'http://localhost/smd/api/delete.php',
								data: JSON.stringify(deleteId),
								contentType: 'application/json; charset=utf-8',
								dataType: 'json'
							});
							$('#expiry').empty();
							$('#delete-msg').empty();
							$('#delete-msg').append(
								'<h1>This URL has expired and has been deleted. Redirecting to home page in 3 seconds !</h1>'
							);
							setTimeout(function() {
								window.location.reload(1);
                            }, 3000);








						}
					}
				},
				error: function(errMsg) {
					console.log(errMsg);
				}
			});
		}
	});
});
