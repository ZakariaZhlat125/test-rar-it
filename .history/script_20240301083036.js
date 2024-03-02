$(document).ready(function() {
	$('.draggable').on('dragstart', function(e){
	   var source_id = $(this).attr('id');
	   e.originalEvent.dataTransfer.setData("source_id", source_id);
	});

	$("#cart-item").on('dragenter', function (e){
		e.preventDefault();
		$(this).css('background', '#BBD5B8');
	});

	$("#cart-item").on('dragover', function (e){
		e.preventDefault();
	});

	$("#cart-item").on('drop', function (e){
		e.preventDefault();
		$(this).css('background', '#FFFFFF');
		var product_code = e.originalEvent.dataTransfer.getData('source_id');
		cartAction('add',product_code);
	});
});