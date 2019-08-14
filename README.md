# UTM Tracking plugin for Craft CMS 3.x

Easy UTM & Referrer tracking

## Requirements

* Craft CMS 3.0.0-beta.23 or later
* delight-im/cookie


## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require leaplogic/utm-tracking

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for UTM Tracking.


## Using UTM Tracking

```TWIG
{% do craft.utmTracking.sniff() %}
<script>
    window.referrer = "{{ craft.utmTracking.getReferrer()|e('js') }}" || "{{ craft.app.request.referrer }}";
    window.source = "{{ craft.utmTracking.getSource()|e('js') }}";
    window.medium = "{{ craft.utmTracking.getMedium()|e('js') }}";
</script>
```

## UTM Tracking Roadmap

Some things to do, and ideas for potential features:

* Release it

Brought to you by [Leap Logic LLC](https://leaplogic.net)
