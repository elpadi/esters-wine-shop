<?php

namespace ThemeLib\ACF;

use Functional as F;

class HomeFields extends \WordpressLib\ACF\Fields
{

    public function __construct()
    {
    }

    protected function getFieldsDefs()
    {
        global $themeData;
        return $themeData['custom_fields']['home_slides'];
    }

    protected function processRepeaterValues(&$groupedValues)
    {
        foreach ($groupedValues as &$values) {
            $values['image'] = sprintf('<img src="%s" alt="">', wp_get_attachment_url($values['hero_image']));
            $values['page'] = get_permalink($values['call-to-action']);
        }
    }
}
