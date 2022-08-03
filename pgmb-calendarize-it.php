<?php
/**
 * Plugin Name:     Calendarize it! variables for Post to Google My Business
 * Plugin URI:      https://tycoonmedia.net
 * Description:     Adds Calendarize It! event variables to the Post to Google My Business plugin
 * Author:          Koen Reus
 * Author URI:      https://koenreus.com
 * Text Domain:     pgmb-calendarize-it
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Pgmb_Calendarize_It
 */

// Your code starts here.

function pgmb_add_calendarize_it_variables( $variables, $parent_post_id ) {
	$event_start_date = get_post_meta( $parent_post_id, 'fc_start_datetime', true );
	$event_end_date = get_post_meta( $parent_post_id, 'fc_end_datetime', true );
	if ( ! $event_start_date || !$event_end_date ) {
		return $variables;
	}

	$start_datetime = new \DateTime($event_start_date);
	$start_datetime->setTimezone(wp_timezone());

	$end_datetime = new \DateTime($event_end_date);
	$end_datetime->setTimezone(wp_timezone());

	$variables['%ci_event_start%'] = $start_datetime->format("Y-m-d H:i:s");
	$variables['%ci_event_end%'] = $end_datetime->format("Y-m-d H:i:s");

	return $variables;
}

add_filter( 'mbp_placeholder_variables', 'pgmb_add_calendarize_it_variables', 10, 2 );