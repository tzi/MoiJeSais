<?php
session_start();
define( 'STEP_1' , 'home'     );
define( 'STEP_10', 'question' );
define( 'STEP_20', 'answer'   );
define( 'STEP_30', 'thank'    );

function get_next_step( $step ) {
	if ( $step == 1 ) {
		return 10;
	}
	if ( $step == 10 ) {
		return 20;
	}
	if ( $step == 20 ) {
		return 30;
	}
	return 1;
}

function get_message( $step ) {
	ob_start();		
	require( random( get_all_messages( $step ) ) );
	$html = ob_get_contents();
	ob_end_clean();
	return $html;
}

function get_all_messages( $step ) {
	return glob( 'messages/' . get_step_name( $step ) . '/*.php' );
}

function get_step_name( $step ) {
	return constant( 'STEP_' . $step );
}

function random( $choices ) {
	return $choices[ mt_rand( 0, count( $choices ) - 1 ) ];
}


if ( ! isset( $_SESSION[ 'step' ] ) || isset( $_GET[ 'reset' ] ) ) {
	$_SESSION[ 'step' ] = 1;
	unset( $_SESSION[ 'message' ], $_SESSION[ 'continue' ] );
}
if ( isset( $_GET[ 'continue' ] ) && $_GET[ 'continue' ] == $_SESSION[ 'continue' ] ) {
	$_SESSION[ 'step' ] = $_SESSION[ 'continue' ];
	unset( $_SESSION[ 'message' ], $_SESSION[ 'continue' ] );
}
if ( ! isset( $_SESSION[ 'continue' ] ) ) {
	$_SESSION[ 'continue' ] = get_next_step( $_SESSION[ 'step' ] );
}
if ( ! isset( $_SESSION[ 'message' ] ) ) {
	$_SESSION[ 'message' ] = get_message( $_SESSION[ 'step' ] );
}
$message = $_SESSION[ 'message' ];
if ( isset( $_SESSION[ 'uncache_message' ] ) ) {
	unset( $_SESSION[ 'message' ], $_SESSION[ 'uncache_message' ] );
}
