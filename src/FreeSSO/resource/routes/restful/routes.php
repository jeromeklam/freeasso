<?php
require_once __DIR__ . '/broker.php';
require_once __DIR__ . '/domain.php';
require_once __DIR__ . '/group_type.php';
require_once __DIR__ . '/group_user.php';
require_once __DIR__ . '/group.php';
require_once __DIR__ . '/job_function.php';
require_once __DIR__ . '/sso.php';
require_once __DIR__ . '/user.php';
require_once __DIR__ . '/user_token.php';

return array_merge(
    $routes_broker,
    $routes_domain,
    $routes_group_type,
    $routes_group_user,
    $routes_group,
    $routes_job_function,
    $routes_sso,
    $routes_user,
    $routes_user_token
);
