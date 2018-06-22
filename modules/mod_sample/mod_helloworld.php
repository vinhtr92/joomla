<?php
/**
 * Hello World! Module Entry Point
 * 
 * @package    Joomla.Tutorials
 * @subpackage Modules
 * @license    GNU/GPL, see LICENSE.php
 * @link       http://docs.joomla.org/J3.x:Creating_a_simple_module/Developing_a_Basic_Module
 * mod_helloworld is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// No direct access
defined('_JEXEC') or die;
//Checks to make sure that this file is being included from the Joomla! application
// Include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';
// require_one file helper/php
$hello = modHelloWorldHelper::getHello($params);
// Our helper class contain method getHello.
//
require JModuleHelper::getLayoutPath('mod_helloworld');

/*  File mod_helloworld.php có ba nhiệm vụ chính:
1 là include file helper.php chứa các class sẽ được sử dụng để thu thập dữ liệu cần thiết  // include file helper.php
2 là sử dụng các class có nhiệm vụ thu thập dữ liệu trong file helper.php để thu thập dữ liệu.
3 là include template để hiển thị ra dữ liệu thu thập được.

 */