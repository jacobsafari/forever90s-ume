<?php

function getResourceURL($resource) {
	if ($resource) {
		$siteUrl = (string)kirby()->site()->url();
		$imageUrl = (string)$resource->url();
		return str_replace($siteUrl, '', $imageUrl);
	}
	return null;
}


function smellsLikeYaml($input) {
	if (gettype($input) !== 'string') return false;
	if (strlen($input) === 0) return false;
	$yamlArray = '/^-\s?\\n\s*[a-z]*:/';
	preg_match($yamlArray, $input, $output);
	return (count($output) > 0);
};

page::$methods['getPublicContent'] = function($page, $withChildren = false) {
	$content = $page->content()->toArray();
	$content['slug'] = (string)$page->uid();
	$content['id'] = (string)$page->id();
	$content['icons'] = new StdClass();
	if ($page->icon_image()->exists()) $content['icons']->default = (string)($page->icon());
	if ($page->icon_silhouette_image()->exists()) $content['icons']->silhouette = (string)($page->icon(true));
	if ($page->background_image()->exists()) $content['background'] = getResourceURL($page->background());
	if ($page->main_image()->exists()) $content['resource'] = getResourceURL($page->images()->find($page->main_image()));
	$content['type'] = (string)$page->intendedTemplate();
	$content['meta'] = (string)$page->meta();
	$content['visible'] = (bool)$page->isVisible();
	$content['text'] = (string)$page->text();

	foreach ($content as $key => $value) {
		if (smellsLikeYaml($value)) {
			$content[$key] = yaml($value);
		}
	}

	if ($withChildren) {
		$content['children'] = [];
		$children = $page->children();
		if ($children->count() > 0) {
			foreach ($children as $child) {
				$childContent = $child->getPublicContent($withChildren);
				array_push($content['children'], $childContent);
			}
		}
	}
	if (gettype($withChildren) === 'integer') $withChildren -= 1;
	return $content;
};

page::$methods['icon'] = function($page, $silhouette = false) {
	if ($silhouette) {
		if (!$page->icon_silhouette_image()->exists()) return false;
		$image_str = (string)$page->icon_silhouette_image();
	} else {
		if (!$page->icon_image()->exists()) return false;
		$image_str = (string)$page->icon_image();
	}
	if (null !== $page->files()->find($image_str) && $page->files()->find($image_str)->width() > 0) {
		return getResourceURL($page->files()->find($image_str));
	} else {
		$desktop = site()->pages()->find('desktop');
		switch ($page->intendedTemplate()) {
			case 'gif':
				$default = (!$silhouette) ? $desktop->default_gif_icon() : $desktop->default_gif_silhouette_icon() ;
				break;
			case 'folder':
				$default = (!$silhouette) ? $desktop->default_folder_icon() : $desktop->default_folder_silhouette_icon() ;
				break;
			case 'link':
				$default = (!$silhouette) ? $desktop->default_link_icon() : $desktop->default_link_silhouette_icon() ;
				break;
			default:
				$default = (!$silhouette) ? $desktop->default_text_icon() : $desktop->default_text_silhouette_icon() ;
				break;
		}
		$file = $desktop->files()->find($default);
		if ($file) return getResourceURL($file);
		return false;
	}
};

page::$methods['background'] = function($page) {
	if (!$page->background_image()->exists()) return false;
	$image_str = (string)$page->background_image();
	if (null !== $page->files()->find($image_str) && $page->files()->find($image_str)->width() > 0) {
		return $page->files()->find($image_str);
	} else if ($page->images()->count() > 0) {
		return $page->images()->first();
	} else {
		return site()->pages()->find('error')->images()->find('default_main_image.jpg');
	}
};


?>
