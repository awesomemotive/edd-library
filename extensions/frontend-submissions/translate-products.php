<?php
/*
Plugin Name: EDD FES - Translate Products
Plugin URL: https://github.com/easydigitaldownloads/library/blob/master/extensions/frontend-submissions/translate-products.php
Description: Code required to translate the word "Products".
Version: 1.0
Author: Phil Johnston
Author URI: https://easydigitaldownloads.com
*/

function my_custom_fes_product_constant_plural_uppercase( $products_name ){
	return 'Products'; // Replace this with your languages word for "Products"
}
add_filter( 'fes_product_constant_plural_uppercase', 'my_custom_fes_product_constant_plural_uppercase' );

function my_custom_fes_product_constant_plural_lowercase( $products_name ){
	return 'products'; // Replace this with your languages word for "products"
}
add_filter( 'fes_product_constant_plural_lowercase', 'my_custom_fes_product_constant_plural_lowercase' );

function my_custom_fes_product_constant_singular_uppercase( $products_name ){
	return 'Product'; // Replace this with your languages word for "Product"
}
add_filter( 'fes_product_constant_singular_uppercase', 'my_custom_fes_product_constant_singular_uppercase' );

function my_custom_fes_product_constant_singular_lowercase( $products_name ){
	return 'product'; // Replace this with your languages word for "product"
}
add_filter( 'fes_product_constant_singular_lowercase', 'my_custom_fes_product_constant_singular_lowercase' );
