<?php
require_once __DIR__ . '/accounting_header.php';
require_once __DIR__ . '/accounting_line.php';
require_once __DIR__ . '/api.php';
require_once __DIR__ . '/cause_growth.php';
require_once __DIR__ . '/cause_link.php';
require_once __DIR__ . '/cause_main_type.php';
require_once __DIR__ . '/cause_media.php';
require_once __DIR__ . '/cause_movement.php';
require_once __DIR__ . '/cause_sickness.php';
require_once __DIR__ . '/cause_type.php';
require_once __DIR__ . '/cause.php';
require_once __DIR__ . '/certificate.php';
require_once __DIR__ . '/certificate_generation.php';
require_once __DIR__ . '/client_category.php';
require_once __DIR__ . '/client_type.php';
require_once __DIR__ . '/client.php';
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/contract.php';
require_once __DIR__ . '/contract_media.php';
require_once __DIR__ . '/dashboard.php';
require_once __DIR__ . '/data.php';
require_once __DIR__ . '/donation.php';
require_once __DIR__ . '/donation_origin.php';
require_once __DIR__ . '/family.php';
require_once __DIR__ . '/item.php';
require_once __DIR__ . '/member.php';
require_once __DIR__ . '/movement.php';
require_once __DIR__ . '/payment_type.php';
require_once __DIR__ . '/receipt_generation.php';
require_once __DIR__ . '/receipt_type.php';
require_once __DIR__ . '/receipt.php';
require_once __DIR__ . '/session.php';
require_once __DIR__ . '/sickness.php';
require_once __DIR__ . '/site_media.php';
require_once __DIR__ . '/site_type.php';
require_once __DIR__ . '/site.php';
require_once __DIR__ . '/species.php';
require_once __DIR__ . '/specific.php';
require_once __DIR__ . '/sponsorship.php';
require_once __DIR__ . '/statistic.php';
require_once __DIR__ . '/subspecies.php';
require_once __DIR__ . '/unit.php';

$localRoutes = array_merge(
    $accountingHeader,
    $accountingLine,
    $apiRoutes,
    $causeGrowthRoutes,
    $causeLinkRoutes,
    $causeMainTypeRoutes,
    $causeMediaRoutes,
    $causeMovementRoutes,
    $causeRoutes,
    $causeSicknessRoutes,
    $causeTypeRoutes,
    $certificateRoutes,
    $certificateGenerationRoutes,
    $clientCategoryRoutes,
    $clientTypeRoutes,
    $clientRoutes,
    $configRoutes,
    $routes_contract,
    $routes_contract_media,
    $dashboardRoutes,
    $dataRoutes,
    $donationRoutes,
    $donationOriginRoutes,
    $familyRoutes,
    $itemRoutes,
    $memberRoutes,
    $movementRoutes,
    $paymentTypeRoutes,
    $receiptGenerationRoutes,
    $receiptTypeRoutes,
    $receiptRoutes,
    $sessionRoutes,
    $sicknessRoutes,
    $siteMediaRoutes,
    $siteTypeRoutes,
    $siteRoutes,
    $specificRoutes,
    $sponsorshipRoutes,
    $statisticRoutes,
    $unitRoutes,
    $routes_species,
    $routes_subspecies
);
return $localRoutes;
