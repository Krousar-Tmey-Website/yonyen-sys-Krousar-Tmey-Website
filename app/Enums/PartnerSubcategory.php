<?php

namespace App\Enums;

enum PartnerSubcategory: string
{
    case CambodianPublicAuthorities = 'Cambodian Public Authorities';
    case OrganizationsFoundationsInstitutions = 'Organizations, Foundations and Institutions';
    case Companies = 'Companies';
    case TownsAndMunicipalities = 'Towns and Municipalities';

    /**
     * @return list<string>
     */
    public static function labels(): array
    {
        return array_column(self::cases(), 'value');
    }
}
