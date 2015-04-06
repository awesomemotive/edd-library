<?php
/**
* Lower all prices for all variably priced downloads by 1 dollar or whatever your currency is.
*/
add_filter( 'edd_get_variable_prices', function( $prices ) {
	foreach( $prices as $i => $price ) {
		$this_price = absint( $price[ 'amount' ] );
		if ( 0 < $this_price ) {
			$this_price = (int) $this_price - 1;
			$prices[ $i ][ 'amount' ] = edd_sanitize_amount( $this_price );
		}

	}

	return $prices;
}, 99 );

/**
* Lower all variable prices for a download whose ID is 42 by 25%
*/
add_filter( 'edd_get_variable_prices', function( $prices, $download_id ) {
	if ( 42 == (int) $download_id ) {
  	foreach( $prices as $i => $price ) {
  		$this_price = absint( $price[ 'amount' ] );
  		if ( 0 < $this_price ) {
  			$this_price = (int) $this_price / 2;
  			$prices[ $i ][ 'amount' ] = edd_sanitize_amount( $this_price );
  		}
  		
  	}
  	
	}

	return $prices;
}, 99, 2 );
