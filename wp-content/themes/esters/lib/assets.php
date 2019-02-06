<?php

namespace Roots\Sage\Assets;

/**
 * Get paths for assets
 */
class JsonManifest {
  private $manifest;

  public function __construct($manifest_path) {
    if (file_exists($manifest_path)) {
      $this->manifest = json_decode(file_get_contents($manifest_path), true);
    } else {
      $this->manifest = [];
    }
  }

  public function get() {
    return $this->manifest;
  }

  public function getPath($key = '', $default = null) {
    $collection = $this->manifest;
    if (is_null($key)) {
      return $collection;
    }
    if (isset($collection[$key])) {
      return $collection[$key];
    }
    foreach (explode('.', $key) as $segment) {
      if (!isset($collection[$segment])) {
        return $default;
      } else {
        $collection = $collection[$segment];
      }
    }
    return $collection;
  }
}

function load_asset_file($type, $theme_uri, $theme_path, $rel_path, $path='') {
	if (empty($path)) $path = "$theme_path/$type/$rel_path";
	if (!file_exists($path)) trigger_error("$type file $path is missing.", E_USER_ERROR);
	if (apply_filters('can_load_asset_file', true, $rel_path, $type) == false) return null;
	$uri = "$theme_uri/$type/$rel_path";
	$handle = str_replace('/', '-', $rel_path);
	$version = filemtime($path);
	if ($type == 'css') wp_enqueue_style("esters-$handle", $uri, [], $version);
	if ($type == 'js') wp_enqueue_script("esters-$handle", $uri, [], $version);
}

function load_asset_dir($theme_path, $type, $dir, $loader) {
	foreach (glob("$theme_path/$type/$dir/*.$type") as $path) {
		$loader(str_replace($theme_path."/$type/", '', $path), $path);
	}
}

function asset_path($filename, $dir='assets') {
	return sprintf('%s/%s/%s', get_template_directory_uri(), $dir, $filename);
	/*
  $dist_path = get_template_directory_uri() . '/dist/';
  $directory = dirname($filename) . '/';
  $file = basename($filename);
  static $manifest;

  if (empty($manifest)) {
    $manifest_path = get_template_directory() . '/dist/' . 'assets.json';
    $manifest = new JsonManifest($manifest_path);
  }

  if (array_key_exists($file, $manifest->get())) {
    return $dist_path . $directory . $manifest->get()[$file];
  } else {
    return $dist_path . $directory . $file;
  }
	 */
}
