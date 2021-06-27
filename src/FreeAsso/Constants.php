<?php
namespace FreeAsso;

/**
 * Constantes générales
 */
class Constants
{

    /**
     * Errors types
     * @var string
     */
    const ERROR_DONATION_CANT_CHANGE_CLIENT   = 5220001;
    const ERROR_DONATION_CANT_CHANGE_CAUSE    = 5220002;
    const ERROR_MOVEMENT_ARCHIVED             = 5220003;
    const ERROR_CONTRACT_CODE_EXISTS          = 5220004;
    const ERROR_MOVEMENT_STATUS               = 5220005;

    const ERROR_SITE_REL_SON                  = 6680001;
    const ERROR_SITE_REL_MEDIA                = 6680002;
    const ERROR_SITE_REL_FROM                 = 6680003;
    const ERROR_SITE_REL_TO                   = 6680004;
    const ERROR_SITE_REL_CAUSE                = 6680005;

    const ERROR_SITE_UNIQ_NAME                = 6690001;
    const ERROR_CLIENT_TYPE_NAME_EXISTS       = 6690002;
    const ERROR_CLIENT_TYPE_CODE_EXISTS       = 6690003;
    const ERROR_SUBSPECIES_NAME_EXISTS        = 6690004;
    const ERROR_SUBSPECIES_SCIENTIFIC_EXISTS  = 6690005;
    const ERROR_SESSION_NAME_EXISTS           = 6690006;
    const ERROR_CLIENT_CATEGORY_NAME_EXISTS   = 6690007;
    const ERROR_PAYMENT_TYPE_NAME_EXISTS      = 6690008;
    const ERROR_CAUSE_TYPE_NAME_EXISTS        = 6690009;
    const ERROR_CAUSE_MAIN_TYPE_NAME_EXISTS   = 6690010;
    const ERROR_SPECIES_NAME_EXISTS           = 6690011;
    const ERROR_CLIENT_NAME_EXISTS            = 6690012;
    const ERROR_SICKNESS_NAME_EXISTS          = 6690013;
    const ERROR_CAUSE_NAME_EXISTS             = 6690014;
    const ERROR_SITE_CODE_EXISTS              = 6690015;
    const ERROR_CAUSE_CODE_EXISTS             = 6690016;

    /**
     * Actions
     * @var string
     */
    const ACTION_CERTIFICATE_PRINT = 'FreeAsso_Certificate.print';

    /**
     * Specific events
     * @var string
     */
    const EVENT_END_CAUSE       = 'end_cause';
    const EVENT_END_SPONSORSHIP = 'end_sponsorship';
}
