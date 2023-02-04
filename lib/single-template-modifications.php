<?php

//* Register the jobs sidear
add_action( 'init', 'elodin_jobs_register_sidebar' );
function elodin_jobs_register_sidebar() {
    
    register_sidebar( array(
		'name'          => __( 'Job listings (above)', 'elodin-jobs' ),
		'id'            => 'before-single-job',
		'description'   => __( 'An area intended to house any short-form legal  language which should be included with every job listing.', 'elodin-jobs' ),
        'before_widget' => '<aside id="%1$s" class="widget inner-padding %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
	));
    
    register_sidebar( array(
		'name'          => __( 'Job listings (sidebar)', 'elodin-jobs' ),
		'id'            => 'jobs',
		'description'   => __( 'The sidebar for individual job listings', 'elodin-jobs' ),
        'before_widget' => '<aside id="%1$s" class="widget inner-padding %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
	));
    
    register_sidebar( array(
		'name'          => __( 'Job listings (below)', 'elodin-jobs' ),
		'id'            => 'after-single-job',
		'description'   => __( 'An area intended to house the job application form (or a CTA link to one if the application isn\'t part of this site', 'elodin-jobs' ),
        'before_widget' => '<aside id="%1$s" class="widget inner-padding %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
	));
}

//////////////////////////////////////
// DISPLAY ON A GENERATEPRESS THEME //
//////////////////////////////////////

add_action( 'generate_after_entry_header', 'elodin_jobs_add_widget_area_before_generatepress' );
function elodin_jobs_add_widget_area_before_generatepress() {
    
    if ( !is_singular( 'jobs' ) )
        return;
        
    if ( !is_active_sidebar( 'before-single-job' ) )
        return;
        
    echo '<div class="before-single-job">';
        dynamic_sidebar( 'before-single-job' );
    echo '</div>';
}

add_action( 'generate_before_right_sidebar_content', 'elodin_jobs_switch_sidebar_generatepress' );
function elodin_jobs_switch_sidebar_generatepress() {
    
    if ( !is_singular( 'jobs' ) )
        return;
        
    if ( !is_active_sidebar( 'jobs' ) )
        return;
    
    echo '<div class="sidebar-jobs">';
        dynamic_sidebar( 'jobs' );
    echo '</div>';
}

add_action( 'generate_after_content', 'elodin_jobs_add_widget_area_after_generatepress' );
function elodin_jobs_add_widget_area_after_generatepress() {
    
    if ( !is_singular( 'jobs' ) )
        return;
    
    if ( !is_active_sidebar( 'after-single-job' ) )
        return;
        
    echo '<div class="after-single-job">';
        dynamic_sidebar( 'after-single-job' );
    echo '</div>';
}

////////////////////////////////
// DISPLAY ON A GENESIS THEME //
////////////////////////////////


//* Force content-sidebar layout setting
add_action( 'wp_head', 'elodin_jobs_force_sidebar_layout_jobs_singular' );
function elodin_jobs_force_sidebar_layout_jobs_singular() {
    global $post;
    
    if ( is_admin() )
        return;

    if ( is_singular( 'jobs' ) )
        add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );
}

//* Conditional logic for showing sidebars
add_action( 'genesis_header','elodin_jobs_switch_sidebar_genesis' );
function elodin_jobs_switch_sidebar_genesis() {
	global $post;

	if ( is_singular( 'jobs' ) ) {
		remove_action( 'genesis_sidebar', 'genesis_do_sidebar'); // remove the default genesis sidebar
		remove_action( 'genesis_sidebar', 'gencwooc_ss_do_sidebar' ); // remove the woocommerce sidebar
		remove_action( 'genesis_sidebar', 'ss_do_sidebar' ); // remove the default sidebar added by genesis simple sidebars
		add_action( 'genesis_sidebar', 'elodin_do_jobs_sidebar_genesis' );
	}
}

//* Output the blog sidebar
function elodin_do_jobs_sidebar_genesis() {
	dynamic_sidebar( 'jobs' );
}

//* Display the widget area
add_action( 'genesis_before_entry_content', 'elodin_jobs_add_widget_area_before_genesis' );
function elodin_jobs_add_widget_area_before_genesis() {

    //* bail if we're not on a job
    if ( !is_singular( 'jobs' ) )
        return;
        
	genesis_widget_area( 'before-single-job', array(
        'before' => '<div class="jobs-widget-wrap-before">',
        'after' => '</div>', 
	) );
}

//* Display the widget area
add_action( 'genesis_after_entry_content', 'elodin_jobs_add_widget_area_after_genesis' );
function elodin_jobs_add_widget_area_after_genesis() {

    //* bail if we're not on a job
    if ( !is_singular( 'jobs' ) )
        return;

	genesis_widget_area( 'after-single-job', array(
        'before' => '<div class="jobs-widget-wrap-after">',
        'after' => '</div>',
	) );
}