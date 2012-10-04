
/* Main JavaScript
 *
 */


(function($){
	
	$.fn.setItAll = function ( typo, signs ) {
		var postData = {
				typo: 'default',
				signs: 100
		}, container = this;
		
		if ( typo && typeof typo === 'string' ) {
			postData.typo = typo;
		}
		
		if ( signs && typeof signs === 'number' ) {
			postData.signs = signs;
		}
			
		$.post("setting.php", postData, function(data) {
			container.insertLetters( $(data) ).startTyping();
		});
		
		return container;
	};
	
	$.fn.insertLetters = function ( data ) {
		var context = this;
		context.html('').append( data );
		$('section.error-info').remove();
		return context;
	};
	
	$.fn.startTyping = function () {
		var context = this, letters = context.find('span'),
			lett_count = letters.length, max = lett_count - 1,
			iter = 0, err = 0, errors = [],
			summary = function ( ers ) {
				
				var l = ers.length, i,
					sec = '<section class="error-info">\n\r<h2>Done with ' + l + ' errors - ' + Math.round( ( (lett_count - l) / lett_count )*100 ) + '% accuracy.</h2>\n\r<ol>';
				
				for ( i = 0; i < l; i += 1 ) {
					sec += '<li>\n\r<p>You typed <strong>';
					sec += ers[i].typed === ' ' ? '_' : ers[i].typed;
					sec += '</strong> where should be <strong>';
					sec += ers[i].letter === ' ' ? '_' : ers[i].letter;
					sec += '</strong> <small>( pos: ';
					sec += ers[i].pos + 1;
					sec += ' ) </small></p>\n\r</li>'
					
					letters.eq( ers[i].pos ).addClass('err');
				}
				sec += '</ol>\n\r</section>';
				
				$('body').append( sec );
			};
	
		letters.eq( iter ).addClass('current');
		
		$(window).keydown( function (e) {
			var ch = letters.eq( iter ).text().toUpperCase().charCodeAt(0),
				tch = e.keyCode;
				
				switch ( tch ) {
					case 188:
						tch = 44;
						break;
					case 190:
						tch = 46;
						break;
					case 191:
						tch = 47;
						break;
					case 186:
						tch = 59;
						break;
				}
				
			if ( tch === ch ) {
				
				letters.eq( iter ).removeClass('current err').next().addClass('current');
				if ( iter === max ) {
					$(window).unbind( 'keydown' );
					summary( errors );
					
				} else {
					iter += 1;
				}
				
			} else {
				
				errors[err] = {
					letter: String.fromCharCode( ch ),
					typed: String.fromCharCode( tch ),
					pos: iter
				};
				err += 1;
				letters.eq( iter ).addClass('err');
			}
		});
		
		return context;
	};
	
})(jQuery);

jQuery( function ($) {
	var ltrs = $('section p.letters'),
		panel = $('.settings-panel'),
		_rebuild = function () {
			var range = panel.find('ul').data( 'range' ) ? panel.find('ul').data( 'range' ) : 'default',
				count = panel.find('input.signs-count').val() ? -(-panel.find('input.signs-count').val()) : 20;
				console.log( count );
			ltrs.setItAll( range, count );
		},
		_numberEdit = function( key ) {
			var numberCodes = [8,48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105], o;
	
			if ($.inArray(-(-key ), numberCodes) > -1) {
				o = true;
			} else {
				o = false;
			}
	
			return o;
	
		};

	
	$('img.rebuild').click( function () {
		panel.fadeIn(300).find('section').slideDown(400);
	});
	
	$('img.refresh').click( function () {
		_rebuild();
	});
	
	panel.find('ul li').click( function () {
		var that = $(this), range = that.text(), sel = '', keys = $('.line span');
		
		that.parent().data( 'range', range );
		
		switch ( range ) {
			case 'left' :
				sel = '.a, .s, .d, .f';
				break;
			case 'leftex' :
				sel = '.a, .s, .d, .f, .g';
				break;
			case 'right' :
				sel = '.j, .k, .l, .semicolon';
				break;
			case 'rightex' :
				sel = '.h, .j, .k, .l, .semicolon';
				break;
			case 'both' :
				sel = '.a, .s, .d, .f, .g, .h, .j, .k, .l, .semicolon';
				break;
			case 'punct' :
				sel = '.a, .d, .g, .h, .k, .semicolon, .dot, .comma, .slash';
				break;
		}
		
		panel.find('ul li, .line span').removeClass('selected');
		//keys.removeClass('selected');
		that.addClass('selected');
		panel.find( sel ).addClass('selected');
		
	});
	
	panel.find('img.go').click( function () {
		panel.fadeOut( 400 ).find('section').slideUp(300);;
		_rebuild();
	});
	
	panel.find('input.signs-count').keydown( function (e) {
		var key = e.keyCode, that = $(this)
		if ( !_numberEdit( key ) ) e.preventDefault();
		
		if ( key === 38 && that.val() < 200 ) {
			
			that.val( -(-that.val()) + 1 );
		}
		
		if ( key === 40 && that.val() > 10 ) {
			that.val( that.val() - 1 );
		}
		
	});
	
	
	
	panel.find('input.signs-count').keyup( function () {
		
		var that = $(this);			
		if ( that.val() > 200 ) that.val(200);
		if ( that.val() < 10 ) that.val(10);
		if ( !that.val() ) that.val(100);
		
	});
	
});


	/*
	var letters = $('p', 'section').find('span'),
		lett_count = letters.length,
		max = lett_count - 1,
		iter = 0,
		err = 0,
		errors = [],
		summary = function ( ers ) {
			
			var l = ers.length, i,
				sec = '<section>\n\r<h2>Done with ' + l + ' errors - ' + Math.round( ( (lett_count - l) / lett_count )*100 ) + '% accuracy.</h2>\n\r<ol>';
			
			for ( i = 0; i < l; i += 1 ) {
				sec += '<li>\n\r<p>You typed <strong>';
				sec += ers[i].typed === ' ' ? '_' : ers[i].typed;
				sec += '</strong> where should be <strong>';
				sec += ers[i].letter === ' ' ? '_' : ers[i].letter;
				sec += '</strong> <small>( pos: ';
				sec += ers[i].pos + 1;
				sec += ' ) </small></p>\n\r</li>'
				
				letters.eq( ers[i].pos ).addClass('err');
			}
			sec += '</ol>\n\r</section>';
			
			$('body').append( sec );
		};
		
	letters.eq( iter ).addClass('current');
	
	
	
	
	
	$(window).keydown( function (e) {
		var ch = letters.eq( iter ).text().toUpperCase().charCodeAt(0),
			tch = e.keyCode;
			
			switch ( tch ) {
				case 188:
					tch = 44;
					break;
				case 190:
					tch = 46;
					break;
				case 191:
					tch = 47;
					break;
				case 186:
					tch = 59;
					break;
			}
			
		if ( tch === ch ) {
			
			letters.eq( iter ).removeClass('current err').next().addClass('current');
			if ( iter === max ) {
				$(window).unbind( 'keydown' );
				summary( errors );
				
			} else {
				iter += 1;
			}
			
		} else {
			
			errors[err] = {
				letter: String.fromCharCode( ch ),
				typed: String.fromCharCode( tch ),
				pos: iter
			};
			err += 1;
			letters.eq( iter ).addClass('err');
		}
	});

*/
>>>>>>> e3ea82c409092d73cb72e95044e0695056d2e0d2
