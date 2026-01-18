<?php

namespace SFY\Core;

use SFY\Blocks\BlockInterface;

defined('ABSPATH') || exit;

class Blocks
{
    public static function register_all(): void
    {
        $blocks_dir = get_template_directory() . '/inc/Blocks/';

        $folders = glob($blocks_dir . '*', GLOB_ONLYDIR);

        foreach ($folders as $folder) {
            $class_file = $folder . '/' . basename($folder) . '.php';
            if (!file_exists($class_file)) continue;

            require_once $class_file;

            $namespace = 'SFY\\Blocks\\' . basename($folder);
            $class = $namespace . '\\' . basename($folder);

            if (class_exists($class) && in_array(BlockInterface::class, class_implements($class))) {
                new $class();
            }
        }

        add_filter('block_categories_all', function ($categories) {
            return array_merge([
                [
                    'slug' => 'sfy',
                    'title' => 'SFY',
                ]
            ], $categories);
        });
    }
}
