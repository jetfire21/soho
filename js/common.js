$(document).ready(function() {

   /* ======= resize background image ======= */

	// if( $(window).width() > 768 && $(window).width() < 1400){
	//    $("header").css("height", $(window).height());
	//    console.log( $(window).height());
	// }

	var width = $(window).width();
	var height = $(window).height();
	// $("body").append("width - " + width + " height -" + height);


	$(".big-btn-bar").click(function(){
		$(".top-menu").show();
		$(".bg-color").addClass("dark-bg");
	});

	$(".close-top-menu").click(function(){
		$(".top-menu").hide()
		$(".bg-color").removeClass("dark-bg");
	});

	$(".btn-bar-top").click(function(){
		$(".mob-menu").show();
	});

	$(".close-mob-menu").click(function(){
		$(".mob-menu").hide()
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

 	  $("header .owl-pagination .owl-page.active").append("<p class='num'>01</p>");

	  function moved(){
			var ind = $("header .owl-pagination .owl-page").index( $(".active")) + 1; 	
			console.log(ind);
			$("header .owl-pagination .owl-page .num").remove();
			$("header .owl-pagination .owl-page.active").append("<p class='num'>0" + ind + "</p>");
	  }

 	  $("header .owl-pagination .owl-page").click(function(){
			var ind = $("header .owl-pagination .owl-page").index( $(".active")) + 1; 	
			console.log(ind);
			$("header .owl-pagination .owl-page .num").remove();
			$("header .owl-pagination .owl-page.active").append("<p class='num'>0" + ind + "</p>");
 	 });


    $("#owl-movies").owlCarousel({
 
      // autoPlay: 3000, 
      // autoPlay: false,
      items : 3,
      // itemsDesktop : [1199,3],
      // itemsDesktopSmall : [979,3],
      // itemsDesktopSmall : [992,2],
      itemsCustom: [[320,1],[479,1],[767,1],[768,2],[992,2],[1199,3]],
      responsive: true,
      navigation:true,
      navigationText: ['','']
 
  });

});