<?php

namespace SFY\Posts\Person;

use SFY\Posts\Abstracts\AbstractPostType;

class Person extends AbstractPostType
{
    public static function slug(): string
    {
        return 'person';
    }

    protected static function getName(): string
    {
        return 'Persons';
    }

    protected static function getSingularName(): string
    {
        return 'Person';
    }

    protected static function menuIcon(): string
    {
        return 'dashicons-groups';
    }

    protected static function supports(): array
    {
        return [
            'title',
            'thumbnail',
            'editor',
        ];
    }

    protected static function showInRest(): bool
    {
        return false;
    }
}