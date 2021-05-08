<?php

namespace ThemeLib\ACF;

use ThemeLib\Theme;

class EventFields extends \WordpressLib\ACF\Fields
{

    protected $postType = 'calendar-event';

    public function __construct()
    {
    }

    protected function getFieldsDefs()
    {
        return Theme::instance()->get('customFields', 'events');
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

    protected function getWhereClauses()
    {
        global $wpdb;

        return array_merge(parent::getWhereClauses(), [
            "DATEDIFF(`event_date`.`meta_value`, NOW()) > -2",
        ]);
    }

    protected function getOrderByClauses()
    {
        return [
            "TIMESTAMP(`event_date`.`meta_value`) ASC",
        ];
    }

    protected function getLimitCount()
    {
        return 0;
    }

    protected function processPostObject(&$p)
    {
        parent::processPostObject($p);
        $p->image_html = wp_get_attachment_image($p->image_one);
        $p->full_description = wpautop($p->full_description);
    }
}
