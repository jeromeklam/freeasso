<?php
/**
 * Constantes pour le serveur SSO
 *
 * @author jeromeklam
 * @package SSO\Constants
 */
namespace FreeSSO;

/**
 * Constantes pour le serveur SSO
 * @author jeromeklam
 */
class Constants
{

    /**
     * Brokers, ...
     * @var mixed
     */
    const BROKER_KEY              = 'Api-Key';
    const BROKER_SECRET           = 'Api-Secret';
    const BROKER_SESSION_LIFETIME = 60; // Minutes

    /**
     * Cookies default values
     * @var mixed
     */
    const COOKIE_CDSSO          = 'Sso-Id';
    const COOKIE_APP            = 'App-Id';
    const HEADER_CDSSO          = 'Sso-Id';
    const HEADER_APP            = 'App-Id';
    const COOKIE_APP_DAYS       = 360; // Days

    /**
     * Other constants
     * @var mixed
     */
    const SESSION_LIFETIME = 50; // Seconds

    /**
     * Events
     * @var string
     */
    const EVENT_USER_VALIDATION = 'new_user_validation';
}
