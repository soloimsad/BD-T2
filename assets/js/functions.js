/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// Set margin top to '.tradicional' content.
function tradicionCenter(){
	var tradicionHeight = ($('#tradicion .content').height()/2);
	$('#tradicion .content').css('margin-top','-'+tradicionHeight+'px');
}

$(document).ready(function(){
	// Menú móvil
	$('.wrap-menu-mobile .toggle-menu').on('click', function(e){
		e.preventDefault();
		$('#header .wrap-items-menu-mobile').slideToggle();
	});

	// Menú Top Bar
	$('.top-bar-menu .nav-item-megamenu')
	.on('mouseenter', function(e){
		var positionAngle = $(e.currentTarget).position().left-215;
		// console.log($(e.currentTarget).position());
		// if(positionAngle > 200){
		// 	$(e.currentTarget).find('.megamenu__usm .angle').removeClass('blue');
		// } else {
		// 	$(e.currentTarget).find('.megamenu__usm .angle').addClass('blue');
		// }
		// $(e.currentTarget).find('.megamenu__usm .angle').css('left',positionAngle);
		$(e.currentTarget).find('.megamenu__usm').fadeIn('fast');

		// Ocultamos todos los hijos del submenú
		$(e.currentTarget).find('.mega-sub-menu').children().hide();
		// Mostramos el primer submenú del megamenú
		$(e.currentTarget).find('.mega-sub-menu .row:first-child').show();
	})
	.on('mouseleave', function(e){
		$(e.currentTarget).find('.megamenu__usm').hide();
		// $(e.currentTarget).find('.megamenu__usm .angle').removeClass('blue');
	});
	

	// Evento para mostrar submenu del megamenu
	$('.mega-main-menu .list-main-menu .item-main-menu')
	.on('mouseenter', function(e){
		var targetID = $(e.currentTarget).attr('data-target');
		// Ocultamos todos los hijos del submenú
		$(e.currentTarget).parents('.megamenu__usm').find('.mega-sub-menu').children().hide();
		// Mostramos el submenú del megamenú que corresponda por el id del target
		$(e.currentTarget).parents('.megamenu__usm').find('#target-'+targetID).show();
	});


	// Mobile nav accordion.
	$('#header a#mobile-nav').click(function(){
		$('#header .mobile-nav').stop().slideToggle();
	});

	// Tablet nav accordion.
	$('#header a.tablet-nav').click(function(){
		$('#header ul.top-nav').stop().slideToggle();
	});

	tradicionCenter();

	/* sub nav */
	$('#nav .nav-item').hover(
		function() {
			$(this).addClass('hovered');
			$('#nav').addClass('hovered');
		}, function() {
			$(this).removeClass('hovered');
			$('#nav').removeClass('hovered');
		}
	);

	

	
});

$(window).resize(function() {

	// Show/hide tablet accordion top navigation
	var windowResizeWidth = $(window).width();
	if (windowResizeWidth<1000) {
		$('#header ul.top-nav').hide();
	} 
	else {
		$('#header ul.top-nav').show();
		$('#header ul.top-nav a');
	}
	tradicionCenter();

});

