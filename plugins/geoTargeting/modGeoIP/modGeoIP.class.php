<?php

require_once dirname(__FILE__) . '/modGeoIP.delivery.php';

/**
 * Class to get GeoTargeting information directly from the mod_geoip
 *
 * @package    OpenXPlugin
 * @subpackage GeoTargeting
 */
class Plugins_GeoTargeting_modGeoIP_ModGeoIP extends OX_Component
{

    /**
     * Return plugin name
     *
     * @return string A string describing the class.
     */
    function getName()
    {
        return $this->translate("Mod GeoIP");
    }

    /**
     * The method calls to the delivery half of the plugin to get the
     * geo information
     *
     * @return array An array that will contain the results of the
     *               GeoTargeting lookup.
     */
    function getGeoInfo($useCookie = false)
    {
        return Plugin_geoTargeting_modGeoIP_modGeoIP_Delivery_getGeoInfo($useCookie);
    }
}

