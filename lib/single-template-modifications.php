<?php

////////////////////////////////////////////////////////////
// FORCE A SIDEBAR, THEN SET UP A SIDEBAR FOR SINGLE-JOBS //
////////////////////////////////////////////////////////////

//* Force content-sidebar layout setting
add_action( 'wp_head', 'elodin_jobs_force_sidebar_layout_jobs_singular' );
function elodin_jobs_force_sidebar_layout_jobs_singular() {
    global $post;

    if ( is_singular( 'jobs' ) )
        add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );
}

//* Register the jobs sidear
add_action( 'init', 'elodin_jobs_register_sidebar' );
function elodin_jobs_register_sidebar() {
    genesis_register_sidebar( array(
        'id'			=> 'jobs',
        'name'		  => __( 'Job listings (sidebar)', 'elodin-jobs' ),
        'description'   => __( 'The sidebar for individual job listings', 'elodin-jobs' ),
    ) );
}

//* Conditional logic for showing sidebars
add_action( 'genesis_header','elodin_jobs_switch_sidebar' );
function elodin_jobs_switch_sidebar() {
	global $post;

	if ( is_singular( 'jobs' ) ) {
		remove_action( 'genesis_sidebar', 'genesis_do_sidebar'); // remove the default genesis sidebar
		remove_action( 'genesis_sidebar', 'gencwooc_ss_do_sidebar' ); // remove the woocommerce sidebar
		remove_action( 'genesis_sidebar', 'ss_do_sidebar' ); // remove the default sidebar added by genesis simple sidebars
		add_action( 'genesis_sidebar', 'elodin_do_jobs_sidebar' );
	}
}

//* Output the blog sidebar
function elodin_do_jobs_sidebar() {
	dynamic_sidebar( 'jobs' );
}

///////////////////////////////////////////////
// ADD A WIDGET AREA BEFORE THE CONTENT AREA //
///////////////////////////////////////////////



//////////////////////////////////////////////
// ADD A WIDGET AREA AFTER THE CONTENT AREA //
//////////////////////////////////////////////

