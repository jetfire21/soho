

$(document).ready(function() {

	$(window).on('load', function () {
		var slider_img = $("#owl-shop-slider img:first-child").height();
		$(".shop-home-page .shop-big-menu-btn").height(slider_img);
		console.log('s2 '+ slider_img);
	});

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


	$(window).resize(function() {
	    var slider_img = $("#owl-shop-slider img").height();
	    $(".shop-big-menu-btn").height(slider_img);
	     console.log('s1 '+ slider_img);

	});

	$(".big-btn-bar, .shop-big-menu-btn img").click(function(){
		$(".top-menu").show();
		// $(".bg-color").addClass("dark-bg");
		$(".alex-wrap").addClass("alex-overlay");
		// console.log("dddd");
	});

	$(".close-top-menu").click(function(){
		$(".top-menu").hide()
		// $(".bg-color").removeClass("dark-bg");
		$(".alex-wrap").removeClass("alex-overlay");
	});

	$(".btn-bar-top, .shop-btn-mobile img").click(function(){
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
			var ind = $("#owl-demo .owl-pagination .owl-page, #owl-gallery .owl-page, #owl-shop-slider .owl-page").index( $(".active")) + 1; 	
			console.log(ind);
			$("#owl-demo .owl-pagination .owl-page .num, #owl-gallery .owl-page .num, #owl-shop-slider .owl-page .num").remove();
			$("#owl-demo .owl-pagination .owl-page.active, #owl-gallery .owl-page.active, #owl-shop-slider .owl-page.active").append("<p class='num'>0" + ind + "</p>");
	  }

 	  $("#owl-demor .owl-pagination .owl-page, #owl-gallery .owl-page, #owl-shop-slider .owl-page").click(function(){
			var ind = $("#owl-demo .owl-pagination .owl-page, #owl-gallery .owl-page, #owl-shop-slider .owl-page").index( $(".active")) + 1; 	
			// console.log(ind);
			$("#owl-demo .owl-pagination .owl-page .num, #owl-gallery .owl-page .num, #owl-shop-slider .owl-page .num").remove();
			$("#owl-demo .owl-pagination .owl-page.active, #owl-gallery .owl-page.active, #owl-shop-slider .owl-page.active").append("<p class='num'>0" + ind + "</p>");
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

  $("#owl-shop-slider").owlCarousel({
 
      navigation : true, // Show next and prev buttons
      autoPlay: false,
      slideSpeed : 400,
      paginationSpeed : 500,
      // theme: "owl-theme",
      singleItem:true,
	  afterMove: moved,
     navigationText: ['','']
 
  });

     $("#owl-shop-slider .owl-page.active").append("<p class='num'>01</p>");

if (width > 991){
   $("#owl-shop-products").owlCarousel({
 
      navigation : true, // Show next and prev buttons
      autoPlay: false,
      slideSpeed : 400,
      paginationSpeed : 500,
      // theme: "owl-theme",
      singleItem:true,
	  afterMove: moved,
     navigationText: ['','']
 
  });
}

	$(".single-product .thumbs > div").click( function(){
		var big_img = $(this).children().attr("data-img");
		console.log(big_img);
		$(".single-main-img img").attr("src", big_img);
	});

  $(".wrap_quantity .plus").click(function(){
   		var count = $(this).parent().find("input").val();
   		count++;
   		$(this).parent().find("input").val(count);
   });

   $(".wrap_quantity .minus").click(function(){
   		var count = $(this).parent().find("input").val();
   		if(count > 1) count--;
   		$(this).parent().find("input").val(count);
   });

});