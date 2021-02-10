function submitForm() {
	var email = document.getElementById('inputEmail').value;
	var phone = document.getElementById('inputPhone').value;
	var address = document.getElementById('inputAddress').value;
	var city = document.getElementById('inputCity').value;
	var state = document.getElementById('inputState').value;
	var zip = document.getElementById('inputZip').value;


	if (email == '' || email.indexOf('@') == -1 || email.indexOf('.') == -1) {
		alert('Please enter a valid email!');
		return;
	}

	if (phone == '' || phone.length != 10 ) {
		alert('Please enter a valid phone number!')
		return;
	}

	if (address == '') {
		alert('Please enter your address!')
		return;
	}

	if (city == '') {
		alert('Please enter your city!')
		return;
	}

	if (state == '') {
		alert('Please select your state!')
		return;
	}

	if (zip == '' || zip.length != 6) {
		alert('Please enter a valid zip code!')
		return;
	}

	alert('Submission successfull!!');

}