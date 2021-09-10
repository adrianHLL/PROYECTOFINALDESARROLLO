$(document).ready(function(){
	$(".like").click(function(){
		var id = this.id;

		$.ajax({
			url: '../../control/User/megusta.php',
			type: 'POST',
			data: {id:id},

			success:function(data){
				$('.react'+id).html(data);
			}
		});
	});

	$('#filter').click(function() {
		var from_date = $('#from_date').val();
		var to_date = $('#to_date').val();
		if (from_date != '' && to_date != '') {
		  $.ajax({
			url: "../../control/User/fechas.php",
			method: "POST",
			data: {
			  from_date: from_date,
			  to_date: to_date
			},
			success: function(data) {
  
			  $('#order_table').html(data);
			}
		  });

		}
	  });

});