<?php
function __autoload($name) {
	$fileName = 'core/' . $name . '.php';
	include_once( $fileName );
}

$getter = new contentGetter();

$typo = 'adghk,./;';

$conf = array(
	'home' => array(
		'left' => 'asdf',
		'leftex' => 'asdfg',
		'right' => 'jkl;',
		'rightex' => 'hjkl;',
		'both' => 'asdfghjkl;'
	),
	'bottom' => array(
		'left' => 'zxcv',
		'leftex' => 'zxcvb',
		'right' => 'm,./',
		'rightex' => 'nm,./',
		'both' => 'zxcvbnm,./'
	),
	'top' => array(
		'left' => 'qwer',
		'leftex' => 'qwert',
		'right' => 'uiop',
		'rightex' => 'yuiop',
		'both' => 'qwertyuiop'
	)
);

$words = array(
	'home' => array(
		'left' => array( 'fagasa', 'fasada', 'fagas', 'faga', 'agfa', 'gafa', 'fasad', 'gaf', 'agf', 'fag', 'agada', 'gaga', 'fasa', 'gada', 'gag', 'agad', 'daga', 'fas', 'dada', 'gad', 'fa', 'saga', 'dag', 'aga', 'sag', 'sad', 'sasa', 'asas', 'ag', 'sas', 'aaa', 'da', 'ad', 'asa', 'aa', 'as' ),
		'leftex' => array( 'fagasa', 'feedera', 'agrafa', 'feeder', 'fagas', 'farada', 'efedra', 'agraf', 'grafa', 'fasada', 'gafa', 'reggae', 'faga', 'graf', 'fasad', 'agfa', 'farad', 'efedr', 'safes', 'grege', 'degras', 'farsa', 'sfera', 'grasera', 'feses', 'sargasa', 'fag', 'afera', 'gaf', 'agf', 'sardara', 'free', 'arfa', 'segars', 'safe', 'fere', 'gaga', 'draga', 'rafa', 'agada' ),
		'rightex' => array( 'kulkuj', 'kolokuj', 'kuliku', 'huloku', 'ulokuj', 'kuluj', 'hulku', 'kokilij', 'kluku', 'huloki', 'kuliki', 'jukki', 'kikuj', 'lilijko', 'lulku', 'hokku', 'kijku', 'holiku', 'jukko', 'uliku', 'lokuj', 'kulko', 'kulki', 'hulok', 'kilku', 'ukuj', 'hulki', 'jukk', 'kuku', 'huju', 'kokilio', 'huku', 'kluki', 'kluko', 'ukuli', 'kliku', 'holku', 'kulili', 'holuj', 'juku' ),
		'both' => array( 'sahajdaka', 'sfajdaj', 'alkajska', 'fajdaj', 'sahajdak', 'klaskaj', 'fajf', 'falaska', 'jafska', 'dallaska', 'skajska', 'kalfas', 'hajdaj', 'kajsaka', 'fajka', 'gdakaj', 'sfajda', 'gafla', 'fagasa', 'flaka', 'falka', 'fakla', 'flaga', 'halfa', 'skalska', 'sajdaka', 'kaskada', 'kafla', 'haskala', 'kajsak', 'fajda', 'kajaka', 'alfka', 'sajdak', 'kaskad', 'klaska', 'fasada', 'haskal', 'kajak', 'half' ),
		'bothex' => array( 'gadulsku', 'alofijska', 'ofiklejd', 'ufajdali', 'diflugio', 'fukugo', 'ufologu', 'udehejski', 'fauluje', 'alofijski', 'golfiku', 'flaguje', 'felaskiej', 'flekuje', 'fluksjo', 'kugluje', 'fluksji', 'hajduku', 'udehejska', 'figluje', 'fluksje', 'falaskiej', 'fluksja', 'flokuje', 'ufologii', 'fiksuje', 'delhijski', 'faksuje', 'delhijska', 'deklasuje', 'odfasuje', 'fiokuje', 'alofijka', 'koliguje', 'aksjologie', 'alofijek', 'juhasiego', 'judofil', 'folguj', 'sufluj'),
		'mixed' => array( 'eutrofizmie', 'nieodczutymi', 'odlatujemy', 'ulatujemy', 'filujecie', 'ruminujecie', 'odsalutuje', 'refutacje', 'litosferami', 'odczarujmy', 'namordujcie', 'rutynizacjo', 'szafujmy', 'fluorenami', 'odmulajcie', 'dializujmy', 'troficznej', 'facjendom', 'relacjonizmie', 'emfatyczni', 'trofealnym', 'luftuj', 'rezystancjom', 'admirujecie', 'alternujmy', 'falcydiom', 'afelicznej', 'rutynizacji', 'acidofilny', 'ultracyzmie', 'rutenizacyj', 'zamurujcie', 'flotacyj', 'roztulajcie', 'delimitacje', 'dyfteriami', 'afinujmy', 'stryjuniami', 'ustrojeniami', 'antyofercie')
	)
);

$row = $conf['home'];

$wordGroup = $words['home']['mixed'];

if (isset($_POST['row'])) {
	switch ( $_POST['row'] ) {
		case 'home' :
			$row = $conf['home'];
			break;
		case 'top' :
			$row = $conf['top'];
			break;
		case 'bottom' :
			$row = $conf['bottom'];
			break;
	}
	
}

if (isset($_POST['typo'])) {
	switch ( $_POST['typo'] ) {
		case 'left' :
			$typo = $row['left'];
			break;
		case 'leftex' :
			$typo = $row['leftex'];
			break;
		case 'right' :
			$typo = $row['right'];
			break;
		case 'rightex' :
			$typo = $row['rightex'];
			break;
		case 'both' :
			$typo = $row['both'];
			break;
	}

	$wordGroup = $words['home'][$_POST['typo']];
	
}

$typo .= ' ';

$signs = 100;

if ( isset($_POST['signs']) && is_numeric($_POST['signs']) ) 
	$signs = ( $_POST['signs'] > 9 && $_POST['signs'] < 201 ) ? $_POST['signs'] : 100;

$l = strlen( $typo ) - 1;
$lw = count( $wordGroup ) - 1;


if ( isset($_POST['type']) && $_POST['type'] === 'words' ) {
	
	
	
	for ($i = 0; $i < $signs/2; $i++) {
		$thisWord = str_split( $wordGroup[ rand( 0, $lw ) ] );
		
		echo '<strong style="float:left;display:block">';
		
		for ($j = 0; $j < count( $thisWord ); $j++) {
			echo '<span>' . $thisWord[$j] . '</span>';
		}
	
		echo '<span> </span></strong>';
		
	}


} else {
	
	for ($i = 0; $i < $signs; $i++) {
		echo '<span>' . $typo[ rand( 0, $l ) ] . '</span>';
	}
	
}

