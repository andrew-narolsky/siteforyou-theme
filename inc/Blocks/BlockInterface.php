<?php

namespace SFY\Blocks;

interface BlockInterface
{
    public function register_fields(): void;

    public function register_block(): void;

    public function render(array $block = [], $content = '', bool $is_preview = false): void;
}