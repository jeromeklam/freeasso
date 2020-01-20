<?php
require_once __DIR__ . '/cause_link.php';
require_once __DIR__ . '/cause_main_type.php';
require_once __DIR__ . '/cause_media.php';
require_once __DIR__ . '/cause_movement.php';
require_once __DIR__ . '/cause_type.php';
require_once __DIR__ . '/cause.php';
require_once __DIR__ . '/client_category.php';
require_once __DIR__ . '/client_type.php';
require_once __DIR__ . '/client.php';
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/dashboard.php';
require_once __DIR__ . '/data.php';
require_once __DIR__ . '/donation.php';
require_once __DIR__ . '/payment_type.php';
require_once __DIR__ . '/site_media.php';
require_once __DIR__ . '/site_type.php';
require_once __DIR__ . '/site.php';
require_once __DIR__ . '/specific.php';
require_once __DIR__ . '/sponsorship.php';

$localRoutes = array_merge(
    $causeLinkRoutes,
    $causeMainTypeRoutes,
    $causeMediaRoutes,
    $causeMovementRoutes,
    $causeTypeRoutes,
    $causeRoutes,
    $clientCategoryRoutes,
    $clientTypeRoutes,
    $clientRoutes,
    $configRoutes,
    $dashboardRoutes,
    $dataRoutes,
    $donationRoutes,
    $paymentTypeRoutes,
    $siteMediaRoutes,
    $siteTypeRoutes,
    $siteRoutes,
    $specificRoutes,
    $sponsorshipRoutes,
);
return $localRoutes;
