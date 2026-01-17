<?php

namespace SFY\Blocks\Example;

use SFY\Blocks\BlockInterface;

defined('ABSPATH') || exit;

class Example implements BlockInterface
{
    protected string $basePath;

    public function __construct()
    {
        $this->basePath = __DIR__;

        $this->register_fields();
        $this->register_block();
    }

    public function register_fields(): void
    {
        if (!function_exists('acf_add_local_field_group')) return;

        acf_add_local_field_group(
            require $this->basePath . '/config/fields.php'
        );
    }

    public function register_block(): void
    {
        if (!function_exists('acf_register_block_type')) return;

        $config = require $this->basePath . '/config/block.php';

        $config['render_callback'] = [$this, 'render'];

        acf_register_block_type($config);
    }

    public function render(array $block = [], $content = '', bool $is_preview = false): void
    {
        $data = [
            'title' => get_field('title'),
            'text' => get_field('text'),
            'image' => get_field('image'),
        ];

        if (empty($data['title']) && empty($data['text'])) return;

        require $this->basePath . '/view/view.php';
    }
}