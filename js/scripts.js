$ = jQuery.noConflict();

$(document).ready(function(){
	$('.mobile-menu a').on('click', function(){
		$('nav.menu-sitio').toggle('slow'); //toggle muestra y oculta
	})

	var breakpoint = 768;

	$(window).resize(function(){
		if ($(document).width() >= breakpoint) {
			$('nav.menu-sitio').show()
		} else {
			$('nav.menu-sitio').hide()
		}
	})

	//ajustar mapa
	var mapa = $('#mapa')
	if (mapa.length > 0) {
		if ($(document).width() >= breakpoint) {
			ajustarMapa(0)
		} else {
			ajustarMapa(300)
		}
	}

	$(window).resize(function(){

		if ($(document).width() >= breakpoint) {
			ajustarMapa(0)
		} else {
			ajustarMapa(300)
		}
		
	})

	//Fluidbox
	$('.gallery a').each(function(){
		$(this).attr({'data-fluidbox' : ''})
	})

	if ($('[data-fluidbox]').length > 0) {
		$('[data-fluidbox]').fluidbox()
	}
})

function ajustarMapa(altura)
{
	if (altura == 0) {
		var ubicacionSection = $('.ubicacion-reservacion');
		var ubicacionAltura = ubicacionSection.height()
		$('#mapa').css({'height': ubicacionAltura})
	} else {
		$('#mapa').css({'height': altura})
	}
}

//Adapt the hight of images to the div element
function boxAjustment() {
  var images = $('.box-image');

  if (images.length > 0) {
    var imagesHeight = images[0].height,
        boxes = $('.content-box');

    $(boxes).each(function(i, element) {
      $(element).css({'height': imagesHeight + 'px'});
    });
  }
}