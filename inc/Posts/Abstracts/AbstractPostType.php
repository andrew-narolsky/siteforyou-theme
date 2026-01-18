<?php

namespace SFY\Posts\Abstracts;

use ReflectionClass;

abstract class AbstractPostType
{
    abstract protected static function slug(): string;

    abstract protected static function getName(): string;

    abstract protected static function getSingularName(): string;

    abstract protected static function menuIcon(): string;

    protected static function getMenuName(): string
    {
        return static::getName();
    }

    protected static function supports(): array
    {
        return ['title', 'editor'];
    }

    protected static function showInRest(): bool
    {
        return true;
    }

    public static function register(): void
    {
        if (did_action('acf/init')) {
            static::registerAcfFields();
        } else {
            add_action('acf/init', [static::class, 'registerAcfFields']);
        }

        $plural = static::getName();
        $singular = static::getSingularName();
        $menu = static::getMenuName();

        $labels = [
            'name' => $plural,
            'singular_name' => $singular,
            'menu_name' => $menu,
            'name_admin_bar' => $singular,

            'add_new' => 'Add ' . $singular,
            'add_new_item' => 'Add ' . $singular,
            'edit_item' => 'Edit ' . $singular,
            'new_item' => 'New ' . $singular,
            'view_item' => 'View ' . $singular,
            'view_items' => 'View ' . $plural,
            'search_items' => 'Search ' . $plural,
            'not_found' => 'No ' . strtolower($plural) . ' found',
            'not_found_in_trash' => 'No ' . strtolower($plural) . ' found in Trash',
            'all_items' => 'All ' . $plural,
            'archives' => $singular . ' Archives',
            'attributes' => $singular . ' Attributes',
            'insert_into_item' => 'Insert into ' . strtolower($singular),
            'uploaded_to_this_item' => 'Uploaded to this ' . strtolower($singular),
        ];

        $args = [
            'labels' => $labels,
            'public' => true,
            'has_archive' => true,
            'supports' => static::supports(),
            'menu_icon' => static::menuIcon(),
            'show_in_rest' => static::showInRest(),
        ];

        register_post_type(static::slug(), $args);
    }

    public static function registerAcfFields(): void
    {
        if (
            !function_exists('acf_add_local_field_group') ||
            empty(static::acfFields())
        ) {
            return;
        }

        acf_add_local_field_group([
            'key' => 'group_' . static::slug(),
            'title' => static::getSingularName() . ' Fields',
            'fields' => static::normalizeAcfFields(static::acfFields()),
            'location' => [
                [
                    [
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => static::slug(),
                    ],
                ],
            ],
        ]);
    }

    protected static function normalizeAcfFields(array $fields, string $prefix = ''): array
    {
        $normalized = [];
        $order = 0;

        foreach ($fields as $name => $field) {
            $fullKey = $prefix . $name;

            $normalizedField = [
                'key'        => 'field_' . static::slug() . '_' . $fullKey,
                'name'       => $name,
                'label'      => $field['label']
                    ?? ucfirst(str_replace('_', ' ', $name)),
                'type'       => $field['type'] ?? 'text',
                'menu_order'=> $order++,
            ];

            foreach ($field as $k => $v) {
                if (!in_array($k, ['label', 'type', 'sub_fields'], true)) {
                    $normalizedField[$k] = $v;
                }
            }

            if (!empty($field['sub_fields'])) {
                $normalizedField['sub_fields'] = static::normalizeAcfFields(
                    $field['sub_fields'],
                    $fullKey . '_'
                );
            }

            $normalized[] = $normalizedField;
        }

        return $normalized;
    }

    protected static function acfFields(): array
    {
        $path = static::fieldsConfigPath();

        return is_readable($path) ? require $path : [];
    }

    protected static function fieldsConfigPath(): string
    {
        $reflection = new ReflectionClass(static::class);

        return dirname($reflection->getFileName()) . '/config/fields.php';
    }
}
