$(document).ready(function() {

   /* ======= resize background image ======= */

	// if( $(window).width() > 768 && $(window).width() < 1400){
	//    $("header").css("height", $(window).height());
	//    console.log( $(window).height());
	// }

	var width = $(window).width();
	var height = $(window).height();
	// $("body").append("width - " + width + " height -" + height);

	var img_overlay = $(".img-overlay");
	var par_block_img_width = img_overlay.width();
	var par_block_img_height = img_overlay.height();
	 // $("body").append("width - " + par_block_img_width + " height -" + par_block_img_height);
	 //  $("body").append("width - " + width + " height -" + height);
	// img_overlay.css({"height":height});



	$(".big-btn-bar").click(function(){
		$(".top-menu").show();
		// $(".bg-color").addClass("dark-bg");
		$(".alex-wrap").addClass("alex-overlay");
		console.log("dddd");
	});

	$(".close-top-menu").click(function(){
		$(".top-menu").hide()
		// $(".bg-color").removeClass("dark-bg");
		$(".alex-wrap").removeClass("alex-overlay");
	});

	$(".btn-bar-top").click(function(){
		// $(".mob-menu").show();
		$(".mob-menu").addClass("show_mob_menu");
	});

	$(".close-mob-menu").click(function(){
		$(".mob-menu").removeClass("show_mob_menu");
	});


    $("#owl-demo").owlCarousel({
 
	      navigation : true, // Show next and prev buttons
	      slideSpeed : 400,
	      paginationSpeed : 500,
	      singleItem:true,
	      navigationText:["",""],
	      autoPlay: true,
		  afterMove: moved,

	      // "singleItem:true" is a shortcut for:
	      // items : 1, 
	      // itemsDesktop : false,
	      // itemsDesktopSmall : false,
	      // itemsTablet: false,
	      // itemsMobile : false
 
  	}); 	

  	 $(" #owl-demo .owl-page.active").append("<p class='num'>01</p>");


	  function moved(){
			var ind = $("header .owl-pagination .owl-page, #owl-gallery .owl-page").index( $(".active")) + 1; 	
			console.log(ind);
			$("header .owl-pagination .owl-page .num, #owl-gallery .owl-page .num").remove();
			$("header .owl-pagination .owl-page.active, #owl-gallery .owl-page.active").append("<p class='num'>0" + ind + "</p>");
	  }

 	  $("header .owl-pagination .owl-page, #owl-gallery .owl-page").click(function(){
			var ind = $("header .owl-pagination .owl-page, #owl-gallery .owl-page").index( $(".active")) + 1; 	
			// console.log(ind);
			$("header .owl-pagination .owl-page .num, #owl-gallery .owl-page .num").remove();
			$("header .owl-pagination .owl-page.active, #owl-gallery .owl-page.active").append("<p class='num'>0" + ind + "</p>");
 	 });


    $("#owl-movies").owlCarousel({
 
      // autoPlay: 3000, 
      // autoPlay: false,
      theme: "my-empty-owl",
      items : 3,
      // itemsDesktop : [1199,3],
      // itemsDesktopSmall : [979,3],
      // itemsDesktopSmall : [992,2],
      itemsCustom: [[320,1],[479,1],[767,1],[768,2],[992,2],[1199,3]],
      responsive: true,
      navigation:true,
      navigationText: ['','']
 
  });

    

  $("#owl-movie-feedback").owlCarousel({
 
      navigation : false, // Show next and prev buttons
      slideSpeed : 300,
      paginationSpeed : 400,
      // theme: "owl-theme",
      singleItem:true
 
      // "singleItem:true" is a shortcut for:
      // items : 1, 
      // itemsDesktop : false,
      // itemsDesktopSmall : false,
      // itemsTablet: false,
      // itemsMobile : false
 
  });


	// hide slider on mobile version

	// if( width < 768){
	//   	 $(".gal-hide-slider").removeAttr("id").removeClass("owl-carousel").removeClass("owl-theme");
	//   }
if (width > 767){
  $("#owl-gallery").owlCarousel({
 
      navigation : true, // Show next and prev buttons
      autoPlay: true,
      slideSpeed : 400,
      paginationSpeed : 500,
      // theme: "owl-theme",
      singleItem:true,
      afterMove: moved,
     navigationText: ['','']

 
      // "singleItem:true" is a shortcut for:
      // items : 1, 
      // itemsDesktop : false,
      // itemsDesktopSmall : false,
      // itemsTablet: false,
      // itemsMobile : false
 
  });
}

  $("#owl-gallery .owl-page.active").append("<p class='num'>01</p>");
  

	// $('.gal-img-popup').magnificPopup({
	// 	type: 'image',
	// 	closeOnContentClick: false,
	// 	mainClass: 'mfp-img-mobile',
	// 	image: {
	// 		verticalFit: true
	// 	}
		
	// });




});