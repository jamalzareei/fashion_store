jQuery(document).ready(function($) {
	//owl carousel
	$("#owl-demo").owlCarousel({
		rtl: true,
		navigation : true, // Show next and prev buttons
		slideSpeed : 300,
		paginationSpeed : 400,
		//singleItem:true

		// "singleItem:true" is a shortcut for:
		items : 1, 
		// itemsDesktop : false,
		// itemsDesktopSmall : false,
		// itemsTablet: false,
		// itemsMobile : false

	});
	$('#owl-demo2').owlCarousel({
		rtl: true,
		margin:20,
		nav:true,
		navText: ['قبلی','بعدی'],
		autoplay:true,
		responsive:{
			0:{
				items:1
			},
			480:{
				items:2
			},
			700:{
				items:4
			},
			1000:{
				items:3
			},
			1100:{
				items:5
			}
		}
	});
});