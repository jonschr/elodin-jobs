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

//* Register the widget area
add_action( 'init', 'elodin_jobs_register_widget_area_above' );
function elodin_jobs_register_widget_area_above() {
    genesis_register_sidebar( array(
        'id'		=> 'before-single-job',
        'name'		=> __( 'Job listings (above)', 'elodin-jobs' ),
        'description'	=> __( 'An area intended to house any short-form legal language which should be included with every job listing.', 'elodin-jobs' ),
    ) );
}

//* Display the widget area
add_action( 'genesis_before_entry_content', 'elodin_jobs_add_widget_area_before' );
function elodin_jobs_add_widget_area_before() {

    //* bail if we're not on a job
    if ( !is_singular( 'jobs' ) )
        return;
        
	genesis_widget_area( 'before-single-job', array(
        'before' => '<div class="jobs-widget-wrap-before">',
        'after' => '</div>',
	) );
}

//////////////////////////////////////////////
// ADD A WIDGET AREA AFTER THE CONTENT AREA //
//////////////////////////////////////////////

//* Register the widget area
add_action( 'init', 'elodin_jobs_register_widget_area_below' );
function elodin_jobs_register_widget_area_below() {
    genesis_register_sidebar( array(
        'id'		=> 'after-single-job',
        'name'		=> __( 'Job listings (below)', 'elodin-jobs' ),
        'description'	=> __( 'An area intended to house the job application form (or a CTA link to one if the application isn\'t part of this site', 'elodin-jobs' ),
    ) );
}

//* Display the widget area
add_action( 'genesis_after_entry_content', 'elodin_jobs_add_widget_area_after' );
function elodin_jobs_add_widget_area_after() {

    //* bail if we're not on a job
    if ( !is_singular( 'jobs' ) )
        return;

	genesis_widget_area( 'after-single-job', array(
        'before' => '<div class="jobs-widget-wrap-after">',
        'after' => '</div>',
	) );
}