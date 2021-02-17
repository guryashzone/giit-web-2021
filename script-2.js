$(document).on('click', '#add-item-btn', function () {

	var item = $('#item-input').val();

	if (item == '') {
		alert('Please enter an item!');
		return;
	}

	$('#cart').append('<li class="cart-items" title="Click to remove">' + item + '</li>');
	$('#item-input').val('');
})


$(document).on('click', '.cart-items', function () {
	$(this).remove();
})


$(document).on('click', '#hide-btn', function () {
	$('#test-div').fadeTo(1000, 0.1);
})


$(document).on('click', '#show-btn', function () {
	$('#test-div').fadeTo(1000, 1);
})

$(document).on('click', '#toggle-btn', function () {
	$('#test-div').fadeToggle();
})