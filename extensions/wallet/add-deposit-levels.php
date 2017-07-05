<?php
/*
 * Plugin Name: Easy Digital Downloads - Add Wallet Deposit Levels
 * Description: Deposit levels are pre-defined in EDD Wallet. This plugin allows you to add custom deposit levels, which can then be selected as available Deposit Levels for customers.
 * Author: EDD Team
 * Version: 1.0
 */

function custom_wallet_desposit_levels( $levels ) {

	// add comma-separated deposit levels to default list
	// 2000 and 5000 are dollar value examples - adjust as needed
	$more_levels = array( '2000', '5000' );
	return array_merge( $levels, $more_levels );
}
add_filter( 'edd_wallet_deposit_levels', 'custom_wallet_desposit_levels' );