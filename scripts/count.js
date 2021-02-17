$(document).ready(function() {
    //Counter functionallity on redirection pages
	let count = 0;
	let interval;

	function timer() {
		interval = setInterval(() => {
			count++;

			let counter = 3 - count;

			$('.countdown').text(counter);

			if (count >= 3) {
				clearInterval(interval);
			}
		}, 1000);
	}

	timer();
});
