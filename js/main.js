
/* Main JavaScript
 *
 */

jQuery( function ($) {
	var letters = $('p', 'section').find('span'),
		max = letters.length - 1,
		iter = 0,
		err = 0,
		errors = [],
		summary = function ( ers ) {
			var l = ers.length, i,
				sec = '<section><ol>'
			
			console.log( l );
			
			for ( i = 0; i < l; i += 1 ) {
				sec += '<li>\n\r<p>You typed <strong>';
				sec += ers[i].typed === ' ' ? '_' : ers[i].typed;
				sec += '</strong> where should be <strong>';
				sec += ers[i].letter;
				sec += '</strong> <small>( pos: ';
				sec += ers[i].pos + 1;
				sec += ' ) </small></p>\n\r</li>'
				
			}
			
			sec += '</ol></section>';
			
			$('body').append( sec );
		};
		
		
		letters.eq( iter ).addClass('current');
		
	$(window).keydown( function (e) {
		var ch = letters.eq( iter ).text().toUpperCase().charCodeAt(0),
			tch = e.keyCode;
		if ( tch === ch ) {
			
			letters.eq( iter ).removeClass('current err').next().addClass('current');
			
			if ( iter === max ) {
				
				$(window).unbind( 'keydown' );
				
				console.log( errors );
				
				summary( errors );
				alert('Done with ' + err + ' errors');
				
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
});
