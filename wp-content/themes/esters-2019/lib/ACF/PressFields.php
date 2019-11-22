<?php
namespace ThemeLib\ACF;

use ThemeLib\Theme;

class PressFields extends \WordpressLib\ACF\Fields {

	protected $postType = 'press';

	public function __construct() {
	}

	protected function getFieldsDefs() {
		return Theme::instance()->get('customFields', 'press');
	}

	protected function processPostObject(&$p) {
		parent::processPostObject($p);
		$p->image_src = wp_get_attachment_url($p->press_image);
	}

	protected function getLimitCount() {
		return 12 * 4;
	}

}
