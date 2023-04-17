<?php
/*
Plugin Name: My AJAX Batch Job
Plugin URI: https://www.example.com
Description: A simple WordPress plugin that performs a batch job using AJAX.
Version: 1.0
Author: Your Name
Author URI: https://www.example.com
*/

// Register and enqueue the JavaScript file
function my_ajax_batch_job_scripts() {
    wp_enqueue_script( 'my-ajax-batch-job', plugin_dir_url( __FILE__ ) . 'my-ajax-batch-job.js', array( 'jquery' ), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'my_ajax_batch_job_scripts' );

// Define the AJAX action
function my_ajax_batch_job() {
    global $wpdb;
    
    // Get the batch job parameters from the AJAX request
    $offset = intval( $_POST['offset'] );
    $limit = intval( $_POST['limit'] );
    
    // Perform the batch job
    $results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}posts LIMIT {$offset}, {$limit}" );
    
    // Return the results as JSON
    echo json_encode( $results );
    
    // Don't forget to exit
    exit();
}
add_action( 'wp_ajax_my_ajax_batch_job', 'my_ajax_batch_job' );
add_action( 'wp_ajax_nopriv_my_ajax_batch_job', 'my_ajax_batch_job' );
