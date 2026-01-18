<?php

namespace SFY\Taxonomies\Abstracts;

defined('ABSPATH') || exit;

abstract class AbstractTaxonomy
{
    abstract protected static function slug(): string;

    abstract protected static function getName(): string;

    abstract protected static function getSingularName(): string;

    abstract protected static function associatedPostType(): string;

    protected static function showInRest(): bool
    {
        return true;
    }

    protected static function hierarchical(): bool
    {
        return false;
    }

    protected static function labels(): array
    {
        $plural = static::getName();
        $singular = static::getSingularName();

        return [
            'name' => $plural,
            'singular_name' => $singular,
            'search_items' => 'Search ' . $plural,
            'all_items' => 'All ' . $plural,
            'parent_item' => static::hierarchical() ? 'Parent ' . $singular : null,
            'parent_item_colon' => static::hierarchical() ? 'Parent ' . $singular . ':' : null,
            'edit_item' => 'Edit ' . $singular,
            'update_item' => 'Update ' . $singular,
            'add_new_item' => 'Add ' . $singular,
            'new_item_name' => 'New ' . $singular . ' Name',
            'menu_name' => $plural,
        ];
    }

    public static function register(): void
    {
        $args = [
            'labels' => static::labels(),
            'public' => true,
            'hierarchical' => static::hierarchical(),
            'show_in_rest' => static::showInRest(),
        ];

        register_taxonomy(static::slug(), static::associatedPostType(), $args);
    }
}