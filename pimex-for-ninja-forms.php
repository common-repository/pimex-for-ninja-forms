<?php

/*
Plugin Name: Pimex for Ninja Forms
Plugin URI: https://dev.pimex.co/integration
Description: Pimex is a Web application that lets you organize your potential customers come from wherever it comes, Facebook, Google, AdWords and more.
Version: 1.0.0
Author: Pimex Inc
Author URI: https://pimex.co/
Text Domain: pimex.co

Copyright 2017 WP Pimex.
*/

require_once dirname( __FILE__ ) . '/lib/actions/async.php';

class Pimex_NF {

    static public $url = '';
  
    static public function init () {
        self::$url = plugin_dir_url( __FILE__ );
        
        add_action( 'wp_enqueue_scripts', ['Pimex_NF', 'enqueue_scripts'] );
        add_filter( 'ninja_forms_register_actions', [ 'Pimex_NF', 'start_async_action' ] );
        add_action('wp_head', ['Pimex_NF', 'asyncTag']);
    }

    static public function enqueue_scripts () {
        $url = self::$url . '/assets/js/pimex-nf-action.js';
        wp_enqueue_script('asyncPimexAction', $url, ['nf-front-end-deps'], '0.0.1', TRUE );
    }

    static public function asyncTag () {
        echo "<script>
		!function(e,n,t,c,y,s,r,u){s=n.createElement(t),r=n.getElementsByTagName(t)[0],
		s.async=!0,s.src=c,r.parentNode.insertBefore(s,r),
		s.onload = function () {Pimex.init(y, false)}}
		(window,document,'script','//statics.pimex.co/services/async.js', false);
		</script>";
    }
    
    static public function start_async_action ($actions) {
        $actions['pimex'] = new NF_Async_Pimex();
        return($actions);
    }

}

Pimex_NF::init();