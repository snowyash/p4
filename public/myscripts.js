$( document ).ready(function() {

    $( function() {
	    $( ".datepicker" ).datepicker();
	  	});

    $( '.delete-btn' ).click(function(){
    	$( '.delete-btn' ).parent().submit(); 
    	return false;
    });
    
} );

/* Welcome Page Animation */

var lastScrollTop = 0;
$( window ).scroll(function( event ){
   	var st = $( this ).scrollTop();
   	if (st > lastScrollTop){
       	$( ".jumbotron" ).addClass( "jumbotronAnimate" );
   	} else {
       	$( ".jumbotron" ).removeClass( "jumbotronAnimate" );
   	}
   	lastScrollTop = st;
});

$.fn.onRowItemHoverIn = function() {
	$( this ).addClass( "hide" );
	$( this ).removeClass( "msgHoverOut" );
	$( this ).next().removeClass( "hide" );
	$( this ).next().addClass( "msgHover" );
};

$.fn.onRowItemHoverOut = function() {
	$( this ).removeClass( "hide" );
	$( this ).addClass( "msgHoverOut" );
	$( this ).next().addClass( "hide" );
	$( this ).next().removeClass( "msgHover" );
};

$( ".row .col-lg-4" ).hover(function() {
	$( this ).find( ":nth-child(2)" ).onRowItemHoverIn();
		}, function() {
	$( this ).find( ":nth-child(2)" ).onRowItemHoverOut();
		}
);


