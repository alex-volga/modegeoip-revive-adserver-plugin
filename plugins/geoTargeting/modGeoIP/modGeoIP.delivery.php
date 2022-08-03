<?php

/**
 * Get the geo-information for this IP address using the GeoIP plugin
 *
 * @param boolean $useCookie Reading geo-information from the cookie enabled
 * @return array An array(
 *                  'country_code',
 *                  'region',
 *                  'city',
 *                  'postal_code',
 *                  'latitude',
 *                  'longitude',
 *                  'dma_code',
 *                  'area_code',
 *                  'organisation',
 *                  'isp',
 *                  'netspeed'
 *              );
 */
function Plugin_geoTargeting_modGeoIP_modGeoIP_Delivery_getGeoInfo($useCookie = true)
{
    $conf = $GLOBALS['_MAX']['CONF'];

    if ($conf['deliveryLog']['enabled'])
    {
        require_once RV_PATH . '/lib/RV.php';
        require_once MAX_PATH . '/lib/OA.php';
        OA::switchLogIdent('delivery');
    }

    // Try and read the data from the geo cookie...
    if ($useCookie && isset($_COOKIE[$conf['var']['viewerGeo']])) {
        $ret = _unpackGeoCookie($_COOKIE[$conf['var']['viewerGeo']]);
        if ($ret !== false) {
            return $ret;
        }
    }

    $ret = [
              'country_code' => $_SERVER['GEOIP_COUNTRY_CODE'] ?? '',
              'region' => '',
              'city' => '',
              'postal_code' => '',
              'latitude' => '',
              'longitude' => '',
              'dma_code' => '',
              'area_code' => '',
              'organisation' => '',
              'isp' => '',
              'netspeed' => '',
    ];

    // Store this information in the cookie for later use
    if ($useCookie && (!empty($ret))) {
        MAX_cookieAdd($conf['var']['viewerGeo'], _packGeoCookie($ret));
    }

    return $ret;
}
