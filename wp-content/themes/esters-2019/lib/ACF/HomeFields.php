<?php
namespace ThemeLib\ACF;

use Functional as F;

class HomeFields extends \WordpressLib\ACF\Fields {

	public function __construct() {
	}

	protected function getFieldsDefs() {
		global $themeData;
		return $themeData['custom_fields']['home_slides'];
	}

	protected function processRepeaterValues(&$groupedValues) {
		foreach ($groupedValues as &$values) {
			$values['image'] = wp_get_attachment_image($values['hero_image'], 'large');
			$values['page'] = get_permalink($values['call-to-action']);
		}
	}

}
