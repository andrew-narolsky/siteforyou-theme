<?php

namespace SFY\Core;

defined('ABSPATH') || exit;

class Theme
{
    public function __construct()
    {
        $this->init_hooks();
    }

    protected function init_hooks(): void
    {
        add_action('after_setup_theme', [$this, 'setup_theme']);
        add_action('wp_enqueue_scripts', [Assets::class, 'enqueue_front']);
        add_action('enqueue_block_editor_assets', [Assets::class, 'enqueue_editor']);
        add_action('acf/init', [Blocks::class, 'register_all']);
    }

    public function setup_theme(): void
    {
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('align-wide');

        add_theme_support('editor-styles');
        add_editor_style('/assets/dist/blocks.min.css');
    }
}
