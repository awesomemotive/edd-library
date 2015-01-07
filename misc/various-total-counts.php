<?php // get the total count for... ALL THE THINGS - add to the list as you see fit


/**
 * Total number of published products
 *
 * @returns "# Products"
 */
$downloads_count = wp_count_posts( 'download' );
echo $downloads_count->publish . ' Products';


/**
 * Total number of file downloads (all products... NOT user-based)
 *
 * @returns "# Downloads"
 */
function edd_count_total_file_downloads() {
    global $edd_logs;
    return $edd_logs->get_log_count( null, 'file_download' );
}
echo edd_count_total_file_downloads() . ' Downloads';


/**
 * Total number of customers (it's a core function but you know... easy to find here)
 *
 * @returns "# Customers"
 */
echo edd_count_total_customers() . ' Customers';