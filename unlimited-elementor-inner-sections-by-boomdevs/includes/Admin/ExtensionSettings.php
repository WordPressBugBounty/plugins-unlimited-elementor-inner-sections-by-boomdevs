<?php

namespace PrimeElementorAddons\Admin;

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Centralized Extension Settings Manager
 * Provides cached access to extension configuration
 */
class ExtensionSettings {
    /**
     * Legacy extension key migrations.
     *
     * @var array<string, string>
     */
    private static $legacy_extension_keys = [
        // 'top-table-of-contents' => 'table-of-contents',
    ];
    
    /**
     * Cached active extensions
     * @var array|null
     */
    private static $active_extensions = null;
    
    /**
     * Flag to distinguish null (not fetched) from empty array
     * @var bool
     */
    private static $cache_initialized = false;
    
    /**
     * Get active extensions with request-level caching
     * 
     * @return array Active extensions configuration
     */
    public static function get_active_extensions() {
        // Return cached data if already fetched
        if ( self::$cache_initialized ) {
            return self::$active_extensions;
        }
        
        // Fetch from database (WordPress handles its own caching)
        $extensions = get_option( 'pea_active_extensions', [] );
        
        // Ensure it's an array
        if ( ! is_array( $extensions ) ) {
            $extensions = [];
        }

        $extensions = self::migrate_legacy_extension_keys( $extensions );
        
        // Cache for this request
        self::$active_extensions = $extensions;
        self::$cache_initialized = true;
        
        return $extensions;
    }
    
    /**
     * Update active extensions and clear cache
     * 
     * @param array $extensions New extension configuration
     * @return bool True on success, false on failure
     */
    public static function update_active_extensions( $extensions ) {
        if ( ! is_array( $extensions ) ) {
            return false;
        }
        
        $result = update_option( 'pea_active_extensions', $extensions );
        
        // Clear cache after update
        self::clear_cache();
        
        return $result;
    }
    
    /**
     * Check if a specific extension is active
     * 
     * @param string $extension_key Extension identifier
     * @return bool True if extension is active
     */
    public static function is_extension_active( $extension_key ) {
        $active_extensions = self::get_active_extensions();
        
        return isset( $active_extensions[ $extension_key ] ) && 
               $active_extensions[ $extension_key ] === true;
    }
    
    /**
     * Get count of active extensions
     * 
     * @return int Number of active extensions
     */
    public static function get_active_count() {
        $active_extensions = self::get_active_extensions();
        
        return count( array_filter( $active_extensions, function( $value ) {
            return $value === true;
        }));
    }
    
    /**
     * Clear the local cache
     * Call this after updating extension settings
     * 
     * @return void
     */
    public static function clear_cache() {
        self::$active_extensions = null;
        self::$cache_initialized = false;
    }

    /**
     * Migrate legacy extension keys to their current slugs.
     *
     * @param array $extensions Active extension settings.
     * @return array
     */
    private static function migrate_legacy_extension_keys( $extensions ) {
        $did_migrate = false;

        foreach ( self::$legacy_extension_keys as $legacy_key => $new_key ) {
            if ( ! array_key_exists( $legacy_key, $extensions ) ) {
                continue;
            }

            if ( ! array_key_exists( $new_key, $extensions ) ) {
                $extensions[ $new_key ] = $extensions[ $legacy_key ];
            }

            unset( $extensions[ $legacy_key ] );
            $did_migrate = true;
        }

        if ( $did_migrate ) {
            update_option( 'pea_active_extensions', $extensions );
        }

        return $extensions;
    }
    
    /**
     * Reset all extension settings to default
     * 
     * @return bool True on success
     */
    public static function reset_to_defaults() {
        $result = delete_option( 'pea_active_extensions' );
        self::clear_cache();
        return $result;
    }
}
