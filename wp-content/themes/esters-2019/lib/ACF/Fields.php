<?php

namespace ThemeLib\ACF;

use Functional as F;

class Fields extends \WordpressLib\ACF\Fields
{

    protected $postType = 'calendar-event';

    public function __construct()
    {
    }

    protected function getFieldNames()
    {
        global $themeData;
        return F\pluck($themeData['custom_fields']['events'], 'name');
    }

    protected function getSelectClauses()
    {
        global $wpdb;

        return array_merge(parent::getSelectClauses(), [
            "`event_date`.`meta_value` as date",
        ]);
    }

    protected function getFromClauses()
    {
        global $wpdb;

        return array_merge(parent::getFromClauses(), [
            "`$wpdb->postmeta` AS event_date ON `ID`=`event_date`.`post_id` AND `event_date`.`meta_key`='real_date'",
        ]);
    }

    protected function getOrderByClauses()
    {
        return [
            "TIMESTAMP(`event_date`.`meta_value`) DESC",
        ];
    }

    protected function updatePostObject(&$p)
    {
        parent::updatePostObject($p);
        $p->image_html = wp_get_attachment_image($p->image_one);
    }
}
