$(document).ready(function() {

    $(function() {
	    $( ".datepicker" ).datepicker();
	  });

    $('.delete-btn').click(function(){
    	$('.delete-btn').parent().submit(); 
    	return false;
    });
    
} );