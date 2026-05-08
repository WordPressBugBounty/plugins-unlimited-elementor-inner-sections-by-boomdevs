<?php

namespace PrimeElementorAddons\Admin;

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Centralized Widget Settings Manager
 * Provides cached access to widget configuration
 */
class WidgetSettings {
    /**
     * Legacy widget key migrations.
     *
     * @var array<string, string>
     */
    private static $legacy_widget_keys = [
        'top-table-of-contents' => 'table-of-contents',
    ];
    
    /**
     * Cached active widgets
     * @var array|null
     */
    private static $active_widgets = null;
    
    /**
     * Flag to distinguish null (not fetched) from empty array
     * @var bool
     */
    private static $cache_initialized = false;
    
    /**
     * Get active widgets with request-level caching
     * 
     * @return array Active widgets configuration
     */
    public static function get_active_widgets() {
        // Return cached data if already fetched
        if ( self::$cache_initialized ) {
            return self::$active_widgets;
        }
        
        // Fetch from database (WordPress handles its own caching)
        $widgets = get_option( 'pea_active_widgets', [] );
        
        // Ensure it's an array
        if ( ! is_array( $widgets ) ) {
            $widgets = [];
        }

        $widgets = self::migrate_legacy_widget_keys( $widgets );
        
        // Cache for this request
        self::$active_widgets = $widgets;
        self::$cache_initialized = true;
        
        return $widgets;
    }
    
    /**
     * Update active widgets and clear cache
     * 
     * @param array $widgets New widget configuration
     * @return bool True on success, false on failure
     */
    public static function update_active_widgets( $widgets ) {
        if ( ! is_array( $widgets ) ) {
            return false;
        }
        
        $result = update_option( 'pea_active_widgets', $widgets );
        
        // Clear cache after update
        self::clear_cache();
        
        return $result;
    }
    
    /**
     * Check if a specific widget is active
     * 
     * @param string $widget_key Widget identifier
     * @return bool True if widget is active
     */
    public static function is_widget_active( $widget_key ) {
        $active_widgets = self::get_active_widgets();
        
        return isset( $active_widgets[ $widget_key ] ) && 
               $active_widgets[ $widget_key ] === true;
    }
    
    /**
     * Get count of active widgets
     * 
     * @return int Number of active widgets
     */
    public static function get_active_count() {
        $active_widgets = self::get_active_widgets();
        
        return count( array_filter( $active_widgets, function( $value ) {
            return $value === true;
        }));
    }
    
    /**
     * Clear the local cache
     * Call this after updating widget settings
     * 
     * @return void
     */
    public static function clear_cache() {
        self::$active_widgets = null;
        self::$cache_initialized = false;
    }

    /**
     * Migrate legacy widget keys to their current slugs.
     *
     * @param array $widgets Active widget settings.
     * @return array
     */
    private static function migrate_legacy_widget_keys( $widgets ) {
        $did_migrate = false;

        foreach ( self::$legacy_widget_keys as $legacy_key => $new_key ) {
            if ( ! array_key_exists( $legacy_key, $widgets ) ) {
                continue;
            }

            if ( ! array_key_exists( $new_key, $widgets ) ) {
                $widgets[ $new_key ] = $widgets[ $legacy_key ];
            }

            unset( $widgets[ $legacy_key ] );
            $did_migrate = true;
        }

        if ( $did_migrate ) {
            update_option( 'pea_active_widgets', $widgets );
        }

        return $widgets;
    }
    
    /**
     * Reset all widget settings to default
     * 
     * @return bool True on success
     */
    public static function reset_to_defaults() {
        $result = delete_option( 'pea_active_widgets' );
        self::clear_cache();
        return $result;
    }
}
