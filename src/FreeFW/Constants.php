<?php
namespace FreeFW;

/**
 * Constantes générales
 */
class Constants
{

    /**
     * Regex
     * @var string
     */
    const PARAM_REGEX = '[0-9a-zA-ZÀ-ÖØ-öø-ÿœŒ_\-\.\@\%\+\s\*]*';

    /**
     * Langues
     * @var string
     */
    const LANG_FR      = 'FR';
    const LANG_EN      = 'EN';
    const LANG_DE      = 'DE';
    const LANG_ES      = 'ES';
    const LANG_ID      = 'ID';
    const LANG_DEFAULT = 'FR';

    /**
     * Locales
     * @var string
     */
    const LOCALE_FR = 'FR_FR';
    const LOCALE_US = 'EN_US';

    /**
     * Monnaies
     * @var string
     */
    const CURRENCY_CHF    = 'CHF';
    const CURRENCY_EURO   = 'EUR';
    const CURRENCY_DOLLAR = 'USD';

    /**
     * Routes events
     *
     * @var string
     */
    const EVENT_NONE               = 'none';
    const EVENT_ROUTE_NOT_FOUND    = 'not-found';
    const EVENT_COMMAND_NOT_FOUND  = 'not-found';
    const EVENT_BEFORE_FINISH      = 'app-before-finish';
    const EVENT_AFTER_RENDER       = 'app-after-render';
    const EVENT_INCOMPLETE_REQUEST = 'app-inc-request';
    const EVENT_STORAGE_CREATE     = 'storage_create';
    const EVENT_STORAGE_UPDATE     = 'storage_update';
    const EVENT_STORAGE_DELETE     = 'storage_delete';
    const EVENT_STORAGE_BEGIN      = 'begin_transaction';
    const EVENT_STORAGE_COMMIT     = 'commit_transaction';
    const EVENT_STORAGE_ROLLBACK   = 'rollback_transaction';

    /**
     * Types d'objets
     * @var string
     */
    const TYPE_STRING             = 'STRING';
    const TYPE_MD5                = 'MD5';
    const TYPE_PASSWORD           = 'PASSWORD';
    const TYPE_TEXT               = 'TEXT';
    const TYPE_TEXT_HTML          = 'TEXT_HTML';
    const TYPE_BLOB               = 'BLOB';
    const TYPE_JSON               = 'JSON';
    const TYPE_DATE               = 'DATE';
    const TYPE_DATETIME           = 'DATETIME';
    const TYPE_DATETIMETZ         = 'DATETIMETZ';
    const TYPE_BIGINT             = 'BIGINT';
    const TYPE_BOOLEAN            = 'BOOLEAN';
    const TYPE_INTEGER            = 'INTEGER';
    const TYPE_DECIMAL            = 'DECIMAL';
    const TYPE_MONETARY           = 'MONETARY';
    const TYPE_TABLE              = 'TABLE';
    const TYPE_SELECT             = 'SELECT';
    const TYPE_LIST               = 'SELECT2';
    const TYPE_RESULTSET          = 'RESULTSET';
    const TYPE_FILE               = 'FILE';
    const TYPE_HTML               = 'HTML';
    const TYPE_IMAGE              = 'IMAGE';

    /**
     * Properties
     * @var unknown
     */
    const PROPERTY_PRIVATE    = 'private';
    const PROPERTY_TYPE       = 'type';
    const PROPERTY_ENUM       = 'enum';
    const PROPERTY_OPTIONS    = 'options';
    const PROPERTY_PUBLIC     = 'public';
    const PROPERTY_MERGE      = 'merge';
    const PROPERTY_DEFAULT    = 'default';
    const PROPERTY_COMMENT    = 'comment';
    const PROPERTY_SAMPLE     = 'sample';
    const PROPERTY_MIN        = 'min';
    const PROPERTY_MAX        = 'max';
    const PROPERTY_FK         = 'fk';
    const PROPERTY_DEPRECATED = 'deprecated';
    const PROPERTY_SCOPE      = 'scope';
    const PROPERTY_FUNCTION   = 'function';
    const PROPERTY_GETTER     = 'getter';
    const PROPERTY_SETTER     = 'setter';
    const PROPERTY_TITLE      = 'title';

    /**
     * Index
     * @var string
     */
    const INDEX_FIELDS = 'fields';
    const INDEX_EXISTS = 'exists';

    /**
     * Relation
     * @var string
     */
    const REL_MODEL   = 'model';
    const REL_FIELD   = 'field';
    const REL_TYPE    = 'type';
    const REL_REMOVE  = 'remove';
    const REL_EXISTS  = 'exists';
    const REL_COMMENT = 'comment';
    const REL_OPTIONS = 'options';
    
    //
    const REL_REMOVE_CHECK   = 'check';
    const REL_REMOVE_CASCADE = 'cascade';

    /**
     * Foreign Key
     * @var string
     */
    const FOREIGN_MODEL = 'model';
    const FOREIGN_FIELD = 'field';
    const FOREIGN_TYPE  = 'type';

    /**
     * Options
     * @var string
     */
    const OPTION_REQUIRED         = 'REQUIRED';
    const OPTION_PK               = 'PK';
    const OPTION_FK               = 'FK';
    const OPTION_JSONIGNORE       = 'NOJSON';
    const OPTION_ALLIGNORE        = 'NOALL';
    const OPTION_LOCAL            = 'LOCAL';
    const OPTION_FUNCTION         = 'FUNCTION';
    const OPTION_UNIQ             = 'UNIQ';
    const OPTION_BROKER           = 'BROKER';
    const OPTION_USER             = 'USER';
    const OPTION_GROUP            = 'GROUP';
    const OPTION_GROUP_RESTRICTED = 'GROUPRESTR';
    const OPTION_NESTED_PARENT_ID = 'NPARENT';
    const OPTION_NESTED_POSITION  = 'NPOSITION';
    const OPTION_NESTED_LEFT      = 'NLEFT';
    const OPTION_NESTED_RIGHT     = 'NRIGHT';
    const OPTION_NESTED_LEVEL     = 'NLEVEL';
    const OPTION_NOMERGE          = 'NOMERGE';

    /**
     * Default constants
     * @var string
     */
    const DEFAULT_COUNTRY       = 'COUNTRY';
    const DEFAULT_LANG          = 'LANG';
    const DEFAULT_NOW           = 'NOW';
    const DEFAULT_CURRENT_YEAR  = 'YEAR';
    const DEFAULT_TRUE          = 'TRUE';
    const DEFAULT_FALSE         = 'FALSE';
    const DEFAULT_CURRENT_USER  = 'USER';
    const DEFAULT_CURRENT_GROUP = 'GROUP';

    /**
     * Errors types
     * @var string
     */
    const ERROR_REQUIRED                = 666001;
    const ERROR_FOREIGNKEY              = 666002;
    const ERROR_UNIQINDEX               = 666003;
    const ERROR_VALUES                  = 666004;
    const ERROR_MAXLENGTH               = 666005;
    const ERROR_ID_IS_MANDATORY         = 666006;
    const ERROR_NOT_FOUND               = 666007;
    const ERROR_NO_DATA                 = 666008;
    const ERROR_NOT_UPDATE              = 666009;
    const ERROR_NOT_DELETE              = 666010;
    const ERROR_NOT_INSERT              = 666011;
    const ERROR_ID_IS_UNAVALAIBLE       = 666012;
    const ERROR_NOT_AUTHENTICATED       = 666013;
    const ERROR_IN_DATA                 = 666014;
    const ERROR_EDITION_NOT_FOUND       = 666015;
    const ERROR_GROUP_SWITCH            = 666016;
    const ERROR_EMAIL_CODE_EXISTS       = 666017;
    const ERROR_EDITION_NAME_EXISTS     = 666018;
    const ERROR_IMAGETYPE_NOT_SUPPORTED = 666019;

    /**
     * Success types
     * @var integer
     */
    const SUCCESS_RESPONSE_EMPTY    = 6800204;
    const SUCCESS_RESPONSE_ADD      = 6800201;
    const SUCCESS_RESPONSE_OK       = 6800200;

    /**
     * Models error codes
     * @var integer
     */
    const ERROR_COUNTRY_NAME_EXISTS = 6700001;
    const ERROR_COUNTRY_CODE_EXISTS = 6700002;
    const ERROR_LANG_NAME_EXISTS    = 6700003;
    const ERROR_LANG_CODE_EXISTS    = 6700004;
    const ERROR_LANG_ISO_EXISTS     = 6700005;
}
