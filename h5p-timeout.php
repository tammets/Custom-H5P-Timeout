<?php
/**
 * Plugin Name: Custom H5P Timeout
 * Description: Adjusts the timeout for H5P API cURL calls.
 * Version: 1.0
 * Author: Priit Tammets & ChatGPT & Pjotr Savitski
 */
 
 // Ensures the code is not directly accessed.
 if (!defined('ABSPATH')) {
     exit; // Exit if accessed directly.
 }
 
 // Function to modify the timeout for H5P API cURL calls
 function custom_h5p_timeout_http_request_args($r, $url) {
     // Check if the 'timeout' parameter is set and if it is less than 90 seconds
     // Also, verify if the URL contains 'api.h5p.org'
     if (isset($r['timeout']) && (int) $r['timeout'] < 90 && stripos($url, 'api.h5p.org') !== false) {
         // Set the timeout to 90 seconds if the conditions are met
         $r['timeout'] = 90;
     }
     // Return the modified arguments
     return $r;
 }
 
 // Hook into the 'http_request_args' filter with the custom function
 add_filter('http_request_args', 'custom_h5p_timeout_http_request_args', 10, 2);
 