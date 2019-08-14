<?php
/**
 * UTM Tracking plugin for Craft CMS 3.x
 *
 * Easy UTM & Referrer tracking
 *
 * @link      https://leaplogic.net
 * @copyright Copyright (c) 2019 Leap Logic LLC
 */

namespace leaplogic\utmtracking\services;

use leaplogic\utmtracking\enums;

use Craft;
use craft\base\Component;
use Delight\Cookie\Cookie;

/**
 * UtmTracking Service
 *
 * All of your plugin’s business logic should go in services, including saving data,
 * retrieving data, etc. They provide APIs that your controllers, template variables,
 * and other plugins can interact with.
 *
 * https://craftcms.com/docs/plugins/services
 *
 * @author    Leap Logic LLC
 * @package   UtmTracking
 * @since     1.0.0
 */
class UtmTracking extends Component
{
    // Public Methods
    // =========================================================================

    public function sniff()
    {
        // Only save values if it's our first visit
        if ($this->isSessionCookieSet(UtmTracking_Cookies::VISITED)) {
            return;
        }

        // Save referrer
        $this->saveReferrer();

        // Save UTM params
        $this->saveUTMParams();

        // Set visited cookie so the check above fails
        $this->setSessionCookie(UtmTracking_Cookies::VISITED, $value = true);
    }

    public function getValue($name)
    {
        return Cookie::get($name);
    }

    private function saveReferrer()
    {
        $referrer = Craft::$app->getRequest()->getUrlReferrer();

        if ($referrer) {
            $this->setSessionCookie(UtmTracking_Cookies::REFERRER, $referrer);
        }
    }

    private function saveUTMParams()
    {
        $source = Craft::$app->getRequest()->getParam(UtmTracking_Params::SOURCE);
        $medium = Craft::$app->getRequest()->getParam(UtmTracking_Params::MEDIUM);

        if ($source) {
            $this->setSessionCookie(UtmTracking_Cookies::SOURCE, $source);
        }

        if ($medium) {
            $this->setSessionCookie(UtmTracking_Cookies::MEDIUM, $medium);
        }
    }

    private function setSessionCookie($name, $value)
    {
        $cookie = new Cookie($name);
        $cookie->setValue($value);
        $cookie->setExpiryTime(0);
        $cookie->setSameSiteRestriction('');

        $cookie->save();
    }

    private function isSessionCookieSet($name)
    {
        return Cookie::exists($name);
    }
}
