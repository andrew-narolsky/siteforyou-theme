<?php

namespace SFY\Core;

defined('ABSPATH') || exit;

class Assets
{
    const VERSION = '1.0.0';

    public static function enqueue_front(): void
    {
        wp_enqueue_style(
            'sfy-main',
            get_template_directory_uri() . '/assets/dist/styles.min.css',
            [],
            self::VERSION
        );

        wp_enqueue_script(
            'sfy-main',
            get_template_directory_uri() . '/assets/dist/scripts.min.js',
            [],
            self::VERSION,
            true
        );
    }

    public static function enqueue_editor(): void
    {
        wp_enqueue_style(
            'sfy-editor',
            get_template_directory_uri() . '/assets/dist/blocks.min.css',
            [],
            self::VERSION
        );
    }
}