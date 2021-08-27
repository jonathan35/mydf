$('.truancate').fewlines({lines : 2});

var navItems = document.querySelectorAll(".mobile-bottom-nav__item");
navItems.forEach(function(e, i) {
	e.addEventListener("click", function(e) {
		navItems.forEach(function(e2, i2) {
			e2.classList.remove("mobile-bottom-nav__item--active");
		})
		this.classList.add("mobile-bottom-nav__item--active");
	});
});

//table responsiveness js

$('body').on('click','tr td:first-child', function() {

$(window).on('resize', function() {
    
	if ($(this).width() < 760) {
		$('body').on('click','tr td:first-child', function() {

		  $(this).siblings().css({'display': 'inline-block'});

		  var $this = $(this);
		  setTimeout(function(){
		  $this.siblings().css('transform', 'translateY(0)'); 
		 },0);

		  $('tr td:first-child').not($(this)).siblings().css({'display': 'none', 'transform': 'translateY(-9999px)'});
	  });  
	} else if ($(this).width() > 760) {
		//unbind click : name is not clickable when screen is > 700px
		$( "tr td:first-child").unbind( "click" );
		//remove with jquery added styles
		$('tr td:first-child').siblings().css({'display': '', 'transform': ''});
	}

}).resize();
