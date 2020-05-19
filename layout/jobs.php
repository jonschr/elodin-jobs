<?php

//* Output jobs before
add_action( 'before_loop_layout_jobs', 'elodin_jobs_before' );
function elodin_jobs_before( $args ) {
	wp_enqueue_style( 'elodin-jobs-styles' );
}

//* Output each jobs
add_action( 'add_loop_layout_jobs', 'elodin_jobs_each' );
function elodin_jobs_each() {

	//* Global vars
	global $post;
	$id = get_the_ID();

	//* Vars
	$title = get_the_title();
    $permalink = get_the_permalink();
    $excerpt = apply_filters( 'the_content', apply_filters( 'the_content', get_the_excerpt() ) );
	// $thing = get_post_meta( $id, 'thing', true );

	//* Markup
    if ( $permalink )
        printf( '<a href="%s" class="overlay"></a>', $permalink );

    if ( $title )
        printf( '<h3>%s</h3>', $title );

    if ( $excerpt )
        printf( '<div class="excerpt">%s</div>', $excerpt );

}