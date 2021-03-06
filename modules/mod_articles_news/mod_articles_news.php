<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the news functions only once
JLoader::register('ModArticlesNewsHelper', __DIR__ . '/helper.php');

$list            = ModArticlesNewsHelper::getList($params);
// trả về danh sách các bài viết mới nhất, là kết quả của truy xuất phương thức getList thuộc đối tượng ModArticlesNewsHelper

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');

require JModuleHelper::getLayoutPath('mod_helloworld', $params->get('layout', 'horizontal'));
