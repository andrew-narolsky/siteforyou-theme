<?php

namespace SFY\Taxonomies;

use SFY\Posts\Person\Person;
use SFY\Taxonomies\Abstracts\AbstractTaxonomy;

class Team extends AbstractTaxonomy
{
    protected static function slug(): string
    {
        return 'team';
    }

    protected static function getName(): string
    {
        return 'Teams';
    }

    protected static function getSingularName(): string
    {
        return 'Team';
    }

    protected static function associatedPostType(): string
    {
        return Person::slug();
    }

    protected static function hierarchical(): bool
    {
        return true;
    }

    protected static function showInRest(): bool
    {
        return true;
    }
}
