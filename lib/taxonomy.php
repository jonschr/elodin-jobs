<?php

add_action( 'init', 'elodin_jobs_register_taxonomies' );
function elodin_jobs_register_taxonomies() {
	register_taxonomy(
		'job-categories',
		'jobs',
		array(
			'label' => __( 'Job Categories' ),
			'rewrite' => array( 'slug' => 'job-categories' ),
			'hierarchical' => true,
		)
	);
}