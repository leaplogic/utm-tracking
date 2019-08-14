<?php
/**
 * UTM Tracking plugin for Craft CMS 3.x
 *
 * Easy UTM & Referrer tracking
 *
 * @link      https://leaplogic.net
 * @copyright Copyright (c) 2019 Leap Logic LLC
 */

namespace leaplogic\utmtracking\variables;

use leaplogic\utmtracking\UtmTracking;

use Craft;

/**
 * UTM Tracking Variable
 *
 * Craft allows plugins to provide their own template variables, accessible from
 * the {{ craft }} global variable (e.g. {{ craft.utmTracking }}).
 *
 * https://craftcms.com/docs/plugins/variables
 *
 * @author    Leap Logic LLC
 * @package   UtmTracking
 * @since     1.0.0
 */
class UtmTrackingVariable
{
    // Public Methods
    // =========================================================================

    public function sniff()
    {
        UtmTracking::$plugin->utmTracking->sniff();
    }

    public function getReferrer()
    {
        return UtmTracking::$plugin->utmTracking->getValue(UtmTracking_Cookies::REFERRER);
    }

    public function getSource()
    {
        return UtmTracking::$plugin->utmTracking->getValue(UtmTracking_Cookies::SOURCE);
    }

    public function getMedium()
    {
        return UtmTracking::$plugin->utmTracking->getValue(UtmTracking_Cookies::MEDIUM);
    }
}
