<?php
defined( 'ABSPATH' ) OR exit;
/**
 * Plugin Name: Scheduler
 * Description: A scheduler plugin
 * Author:      Moses Lara
 * Version: 0.0.0.1
 */


register_activation_hook(   __FILE__, array( 'SchedulerClass', 'on_activation' ) );
register_deactivation_hook( __FILE__, array( 'SchedulerClass', 'on_deactivation' ) );
register_uninstall_hook(    __FILE__, array( 'SchedulerClass', 'on_uninstall' ) );

add_action( 'plugins_loaded', array( 'SchedulerClass', 'init' ) );
class SchedulerClass
{
    protected static $instance;

    public static function init()
    {
        is_null( self::$instance ) AND self::$instance = new self;
        return self::$instance;
    }

    public static function on_activation()
    {
        if ( ! current_user_can( 'activate_plugins' ) )
            return;
        $plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
        check_admin_referer( "activate-plugin_{$plugin}" );

        # Uncomment the following line to see the function in action
        # exit( var_dump( $_GET ) );
    }

    public static function on_deactivation()
    {
        if ( ! current_user_can( 'activate_plugins' ) )
            return;
        $plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
        check_admin_referer( "deactivate-plugin_{$plugin}" );

        # Uncomment the following line to see the function in action
        # exit( var_dump( $_GET ) );
    }

    public static function on_uninstall()
    {
        if ( ! current_user_can( 'activate_plugins' ) )
            return;
        check_admin_referer( 'bulk-plugins' );

        // Important: Check if the file is the one
        // that was registered during the uninstall hook.
        if ( __FILE__ != WP_UNINSTALL_PLUGIN )
            return;

        # Uncomment the following line to see the function in action
        # exit( var_dump( $_GET ) );
    }
}