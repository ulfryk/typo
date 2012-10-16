
/* Main JavaScript
 *
 */

(function($){
	/* ------------------------------ *
	 *		extend jQuery object	  *
	 * ------------------------------ */
	
	var _err = 0,		// containig up2date number of mistakes 
		_errors = [],	// array with info about those mistakes
		_iter = 0,		// holding number of currently selected sign
		_laps = [],		// holding starts and stops of time counting machine
		_time = {		// time value holders
			ms : 0,
			sec : 0,
			min : 0
		},
		_timerStatus = false, // if timer is clicking (true) or paused (false)
		_countAcc = function ( errors, signs) { // count accuracy
			var accuracy = 100;
			if ( errors < signs ) {
				accuracy = Math.round( ((signs-errors) / signs)*100 );
			} else {
				accuracy = 0;
			}
			return accuracy;
		},
		_summary = function ( ltrs, count ) { // renders final info about accuracy, number of mistakes etc.
				
			var l = _errors.length, i,
				sec = '<section class="error-info">\n\r<h2>';
			
			sec += 'Done with ' + l + ' errors - ' + _countAcc( l, count ) + '% accuracy.<br/>'; //typing accuracy
			sec += ' It took ' + $.timeCounter.getMin() + ':' + $.timeCounter.getSec() + '.' + $.timeCounter.getMs(); // time of typing
			sec += ' - ' + $.timeCounter.getSpeed( count ) + ' S/s </h2><br/>\n\r<ol>'; // typing speed
			
			for ( i = 0; i < l; i += 1 ) {
				sec += '<li>\n\r<p>You typed <strong>';
				sec += _errors[i].typed === ' ' ? '_' : _errors[i].typed; //what you typed ( renders '_' when typed ' ' )
				sec += '</strong> where should be <strong>';
				sec += _errors[i].letter === ' ' ? '_' : _errors[i].letter; //what you should type ( renders '_' when typed ' ' )
				sec += '</strong> <small>( pos: ';
				sec += _errors[i].pos + 1; // on what position
				sec += ' ) </small></p>\n\r</li>'
				
				ltrs.eq( _errors[i].pos ).addClass('err'); // light up mistaken positions
			}
			sec += '</ol>\n\r</section>';
			
			$('body').append( sec );
		},
		_translateChar = function ( chr ) { // private method wich translates some key codes like "/" or ";" to accurate char codes
			var outChar;
			switch ( chr ) {
				case 188: // ","
					outChar = 44;
					break;
				case 190: // "."
					outChar = 46;
					break;
				case 191: // "/"
					outChar = 47;
					break;
				case 186: // ";"
					outChar = 59;
					break;
				default: // other codes are ok
					outChar = chr;
					break;
			}
			
			return outChar;
		},
		_sumTime = function () { // outputs totalized time of typing
			var i, ms = 0;
			for ( i = 0 ; i < _laps.length ; i+=1 ) {
				ms += ( _laps[i].stop.getTime() - _laps[i].start.getTime() )
			}
			return ms;
		},
		_countTime = function ( ms ) { // counts time of typing and sets proper values in '_time' object
			_time.ms = ms % 1000;
			_time.sec = ( (ms - _time.ms) / 1000 ) % 60;
			_time.min = ( ( (ms - _time.ms) / 1000 ) - _time.sec ) / 60;
		};
	
	$.fn.setItAll = function ( range, signs, row, dataType ) { // public method that gets new practice set from server and renders it
		var postData = { // default data ( just in case )
				range: 'left',
				signs: 100,
				row: 'home',
				type: 'letters'
		}, container = this;
		
		container.pauseTyping();
		
		// some data type control
		if ( range		&& typeof range === 'string' )		postData.range = range;
		if ( signs		&& typeof signs === 'number' )		postData.signs = signs;
		if ( row		&& typeof row === 'string' )		postData.row = row;
		if ( dataType	&& typeof dataType === 'string' )	postData.type = dataType;
			
		$.post("index.php", postData, function(data) {
			container.insertLetters( $(data) ).startTyping(); // use other methods to render requested data
		});
		
		return container; // for chain use
	};
	
	$.fn.insertLetters = function ( data ) { // public method rendering new practice set
		var context = this;
		
		context.html('').append( data ); 
		$('section.error-info').remove(); // clear errors
		_errors = []; // clear errors
		_iter = 0; //clear signs count
		$.timeCounter.kill();
		
		return context; // for chain use
	};
	
	$.fn.startTyping = function () { // public method setting up typing interactions
		var context = this,
			letters = context.find('span'),
			lettCount = letters.length,
			max = lettCount - 1;
		
		letters.eq( _iter ).addClass('current');
		
		$(window).keydown( function (e) { // typing interactions
			var ch, tch;
			
			if ( !_timerStatus ) {
				$.timeCounter.start();
			}
			
			ch = letters.eq( _iter ).text().toUpperCase().charCodeAt(0); // current letter charcode
			tch = _translateChar(e.keyCode); // typed charcode
				
			if ( tch === ch ) { // case typed good
				
				letters.eq( _iter ).removeClass('current err');
				
				if ( _iter === max ) { // if came to the end
					
					context.pauseTyping( true ); // using another metod to puse/stop interactions
					_summary( letters, lettCount ); // use private method to show summary
					
				} else { // if not, highlight next letter
					
					_iter += 1;
					letters.eq( _iter ).addClass('current'); // not using '.next()' becouse in 'words' mode whole words are in div's so it won't work
					
				}
				
			} else { // case typed bad
				
				_errors[ _errors.length ] = { // add info about current mistake
					letter: String.fromCharCode( ch ),
					typed: String.fromCharCode( tch ),
					pos: _iter
				};
				
				letters.eq( _iter ).addClass('err'); // red higlight mistyped letter
				
			}
			
		});
		
		return context; // for chain use
	};
	
	$.fn.pauseTyping = function ( stopTime ) { // unbind typing functionality and pause or stop timer
		var context = this;
		stopTime = stopTime ? stopTime : false;
		$.timeCounter.stop( stopTime );
		$(window).unbind('keydown'); // :-) and that's all for pause
		return context; // for chain use
	};
	
	$.timeCounter = { // timeCounter object ( jQuery extension )
		start : function () { // start counting time ( also make new dates pair in _laps array ), orks only if it's paused or stopped
			if ( !_timerStatus ) {
				_laps[ _laps.length ] = {
					start : new Date(),
					stop : ''
				};
				_timerStatus = true;
			}
		},
		stop : function ( fin ) { // pause or stop timer (if 'fin'), only when it's counting
			if ( _timerStatus ) {
				_laps[ _laps.length-1 ].stop = new Date();
				if ( fin ) _countTime( _sumTime() );
				_timerStatus = false;
			}
		},
		kill : function () { // reset all counter data
			_laps = [];
			_time.ms = 0;
			_time.sec = 0;
			_time.min = 0;
		},
		getMs : function () { // outputs miliseconds in 000 format
			var out;
			if ( _time.ms > 99 ) {
				out = _time.ms;
			} else if ( _time.ms > 9 ) {
				out = '0' + _time.ms;
			} else {
				out = '00' + _time.ms;
			}
			return out;
		},
		getSec : function () { // outputs seconds in 00 format
			return _time.sec < 10 ? '0' + _time.sec : _time.sec ;
		},
		getMin : function () { // outputs minutes in 00 format
			return _time.min < 10 ? '0' + _time.min : _time.min ;
		},
		getSpeed : function ( count ) { // outputs speed in signs per second
			return Math.round(count / ( _sumTime() / 10000 )) / 10;
		}
	};
	
})(jQuery); // end extend $


jQuery( function ($) { // on document/window load ...
	
	// semi global vars and functions
	var ltrs = $('section p.letters'), // place for contents to type
		panel = $('.settings-panel'), // the settings panel
		ieInfo,
		_rebuild = function () { // get values, send request and render new excercise
			var range = panel.find('.select-typo').data( 'range' ) ? panel.find('.select-typo').data( 'range' ) : 'left',
				count = panel.find('input.signs-count').val() ? -(-panel.find('input.signs-count').val()) : 50;
				rows = ['top', 'home', 'bottom'],
				row = rows[ panel.find('.line.ac').index() ],
				dataType = panel.find('.select-type').data( 'type' ) ? panel.find('.select-type').data( 'type' ) : 'letters';
			ltrs.setItAll( range, count, row, dataType );
		},
		_useful = function( key ) { // check if typed key is number, numpad number, backspace or left/right arrow
			var numberCodes = [8, 37, 39, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105], o;
	
			if ( $.inArray( -(-key ) , numberCodes) > -1 ) { // "-(-" makes us shure 'key' type is 'number' not 'string'
				o = true;
			} else {
				o = false;
			}
	
			return o;
		};
	
	if ( $('.oldie').length ) {// for old ie users go black
		$('div, section, img').remove();
		$('body').append('<p class="go-black-4-ie"></p>');
		$('.go-black-4-ie').html('<strong>Upgrade your browser</strong> to IE9 or higher, <strong>or change it</strong> to Chrome, Firefox, Opera, Safari or whatever works good.');
	} else { // for normal users behave good :)
		
		/* ------------------------ *
		 *		 control icons		*
		 * ------------------------ */
		$('img.rebuild').click( function () { // open settings panel
			panel.fadeIn(300).pauseTyping().find('section').slideDown(400);
		});
		
		$('img.refresh').click( function () { // just rebuid with same settings
			_rebuild();
		});
		
		panel.find('img.go-back').click( function () { // close panel without refreshing content
			panel.fadeOut( 400 ).find('section').slideUp(300);
			ltrs.startTyping();
		});
		
		panel.find('img.go').click( function () { // close panel and rebuild content with chosen settings
			panel.fadeOut( 400 ).find('section').slideUp(300);
			_rebuild();
			
		});
		
		
		/* ------------------------ *
		 *		panel controls		*
		 * ------------------------ */
		
		panel.find('ul li').click( function () { // list contols ( black buttons )
			var that = $(this),
				txt = that.text(), 
				sel = '',
				acLine = panel.find( '.line.ac' ),
				keys = acLine.find( 'span' ),
				i, contCount;
			
			if ( that.is('.select-typo li') ) { // if its ranges list
				
				that.parent().data( 'range', txt ); // remember chosen range
			
				switch ( txt ) { // translate range to numbers of keys in line
					case 'left'		:	sel = [0,1,2,3];				break;
					case 'leftex'	:	sel = [0,1,2,3,4];				break;
					case 'right'	:	sel = [6,7,8,9];				break;
					case 'rightex'	:	sel = [5,6,7,8,9];				break;
					case 'both'		:	sel = [0,1,2,3,4,5,6,7,8,9];	break;
				}
				
				acLine.data('selected', sel ); // remember chosen keys
				
				panel.find('.line span').removeClass('selected'); // remove highlight from all keys
				
				for ( i = 0; i < sel.length; i += 1 ) {
					keys.eq( sel[i] ).addClass('selected'); //highlight proper keys
				}
				
			}
			
			if ( that.is('.select-type li') && txt != that.parent().data('type') ) { // if it's modes list, and it's beeing changed
			
					contCount = panel.find('input.signs-count'); // currently selected number of elements
					
					if ( txt === 'words' )		contCount.val( Math.round(contCount.val()/4) ); // number of elements depends on mode
					if ( txt === 'letters' )	contCount.val( contCount.val()*4 ); // number of elements depends on mode
					
					that.parent().data( 'type', txt );
			}
			
			
			that.addClass('selected').siblings().removeClass('selected'); // just highlight controll
			
		});
		
		panel.find('.line').click( function () { // choose keyboard line
			var next = $(this),
				prev = next.siblings('.ac'),
				sel = prev.data('selected');
			
			if ( !next.is('.ac')) {
				prev.removeClass('ac').find('.selected').removeClass('selected');
				next.data( 'selected', sel ).addClass('ac');
				for ( i = 0; i < sel.length; i += 1 ) {
					next.find('span').eq( sel[i] ).addClass('selected');
				}
			}
			
		});
		
		// number of items control
		panel.find('input.signs-count').keydown( function (e) { // control used keys
			var key = e.keyCode, that, contType, max, min;
			
			if ( !_useful( key ) ) e.preventDefault(); // if typed key is not number key, backspace or arrow left/right prevent from normal behaviour
			
			that = $(this);
			contType = panel.find('.select-type').data('type');
			
			max = contType === 'letters' ? 200 : 50 ;
			min = contType === 'letters' ? 20 : 5 ;
			
			if ( key === 38 && that.val() < max ) that.val( -(-that.val()) + 1 ); // if arrow up and didn't reach max - add one
			if ( key === 40 && that.val() > min ) that.val( that.val() - 1 ); // if arrow down and didn't reach min - substract one
			
		});
		panel.find('input.signs-count').keyup( function () { // control value after use of keys
			var that = $(this),
				contType = panel.find('.select-type').data('type'),
				max = contType === 'letters' ? 200 : 50,
				min = contType === 'letters' ? 20 : 5,
				mid = contType === 'letters' ? 100 : 25;
				
			if ( that.val() > max )	that.val( max );
			if ( that.val() < min )	that.val( min );
			if ( !that.val() )		that.val( mid );
			
		});
	}
});

