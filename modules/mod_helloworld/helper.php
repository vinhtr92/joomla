<?php
/**
 * Helper class for Hello World! module
 * 
 * @package    Joomla.Tutorials
 * @subpackage Modules
 * @link http://docs.joomla.org/J3.x:Creating_a_simple_module/Developing_a_Basic_Module
 * @license        GNU/GPL, see LICENSE.php
 * mod_helloworld is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
// class ModHelloWorldHelper
// {
//     /**
//      * Retrieves the hello message
//      *
//      * @param   array  $params An object containing the module parameters
//      *
//      * @access public
//      */    
//     public static function getHello($params)
//     {
//         return 'Hello, World!';
//     }
// }

abstract class modHelloWorldHelper
{
	/**
	 * Get a list of the latest articles from the article model
	 *
	 * @param   \Joomla\Registry\Registry  &$params  object holding the models parameters
	 *
	 * @return  mixed
	 *
	 * @since 1.6
	 */
	public static function getList(&$params)
	// khai báo hàm với mức truy cập public và tham số là một biến tham chiếu với &.
	{
		// Get an instance of the generic articles model
		$model = JModelLegacy::getInstance('Articles', 'ContentModel', array('ignore_request' => true));
		// gán biến $model với kết quả của phương thức static ::getInstance của đối tượng JModelLegacy, phương thức này nhận vào 3 tham số là Articles,ContentModel và array('ignore_request => true')
		// lấy dữ liệu về từ model article chung

		// Set application parameters in model
		$app       = JFactory::getApplication();
		// echo "<pre>"; print_r($app); echo "</pre>"; die();
		// trả về  JApplicationCMS , qua chúng, bạn có thể truy xuất đến tùy chỉnh và biến đầu vào ( input variables)
		$appParams = $app->getParams();
		// gán biến $appParams với kết quả của việc gọi phương thức getParams() của đối tượng $app.
		$model->setState('params', $appParams);
		// gọi phương thức setState() của đối tượng $model với hai tham số là 'param' và $appParams

		// Set the filters based on the module params
		$model->setState('list.start', 0);
		// gọi phương thức setState, đặt giá trị cho list.start = 0;
		$model->setState('list.limit', (int) $params->get('count', 5));
		// gọi phương thức setState, đặ giá trị limit=  (int) $param->get('count',5)
		$model->setState('filter.published', 1);
		// gọi phương thức setState, đặt giá trị cho filter.published bằng 1

		// This module does not use tags data
		// module này không sử dụng dữ liệu tags
		$model->setState('load_tags', false);
		// gọi phương thức setState, đặt giá trị cho load_tags là false.

		// Access filter - đặt quyền truy cập filter
		$access     = !JComponentHelper::getParams('com_content')->get('show_noauth');
		// gán biến với ! JComponentHelper::getParams('com_content')->get('show_noauth');
		$authorised = JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id'));
		// gán biến $authorised với phương thúc ::getAuthorisedViewLevels(JFactory::getUser()->get('id')) của đối tượng JAccess.
		$model->setState('filter.access', $access);
		// gọi phương thức setState của đối tượng $model, thay dổi giá trị filter.access bằng $access

		// Category filter
		$model->setState('filter.category_id', $params->get('catid', array()));
		// gọi phương thức setState của $model, thay filter.category_id bằng giá trị $params->get('catid',array)
		// Filter by language
		$model->setState('filter.language', $app->getLanguageFilter());

		// Filer by tag
		$model->setState('filter.tag', $params->get('tag'), array());

		//  Featured switch
		switch ($params->get('show_featured'))
		{
			// tùy chọn của filer
			case '1' :
				$model->setState('filter.featured', 'only');
				break;
			case '0' :
				$model->setState('filter.featured', 'hide');
				break;
			default :
				$model->setState('filter.featured', 'show');
				break;
		}

		//switch featured articles

		// Set ordering
		$ordering = $params->get('ordering', 'a.publish_up');
		// gán biến ordering với kết quả của phương thức get nằm trong đối tượng params
		$model->setState('list.ordering', $ordering);
		// sử dụng phương thức setState của đối tượng $model
		if (trim($ordering) === 'rand()')
		{
			$model->setState('list.ordering', JFactory::getDbo()->getQuery(true)->Rand());
		}
		else
		{
			$direction = $params->get('direction', 1) ? 'DESC' : 'ASC';
			$model->setState('list.direction', $direction);
			$model->setState('list.ordering', $ordering);
		}
		// đặt thứ tự ordering

		// Check if we should trigger additional plugin events
		$triggerEvents = $params->get('triggerevents', 1);
		// kiểm tra nếu phải kích hoạt event plugin thêm vào hay không

		// Retrieve Content - nhận content
		$items = $model->getItems();
		// gán biến $items với kết quả phương thức getItems của đối tượng $model.
		// trả về danh sách các bài biết mới nhất bằng phương thức getItems của đối tượng $model

		foreach ($items as &$item)
		// sử dụng vòng lặp foreach để lặp qua từng item trong mảng $items.
		{
			$item->readmore = strlen(trim($item->fulltext));
			$item->slug     = $item->id . ':' . $item->alias;

			/** @deprecated Catslug is deprecated, use catid instead. 4.0 */
			$item->catslug  = $item->catid . ':' . $item->category_alias;

			if ($access || in_array($item->access, $authorised))
			{
				// We know that user has the privilege to view the article
				$item->link     = JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid, $item->language));
				$item->linkText = JText::_('MOD_ARTICLES_NEWS_READMORE');
			}
			else
			{
				$item->link = new JUri(JRoute::_('index.php?option=com_users&view=login', false));
				$item->link->setVar('return', base64_encode(ContentHelperRoute::getArticleRoute($item->slug, $item->catid, $item->language)));
				$item->linkText = JText::_('MOD_ARTICLES_NEWS_READMORE_REGISTER');
			}

			$item->introtext = JHtml::_('content.prepare', $item->introtext, '', 'mod_articles_news.content');

			if (!$params->get('image'))
			{
				$item->introtext = preg_replace('/<img[^>]*>/', '', $item->introtext);
			}

			if ($triggerEvents)
			{
				$item->text = '';
				$app->triggerEvent('onContentPrepare', array ('com_content.article', &$item, &$params, 0));

				$results                 = $app->triggerEvent('onContentAfterTitle', array('com_content.article', &$item, &$params, 0));
				$item->afterDisplayTitle = trim(implode("\n", $results));

				$results                    = $app->triggerEvent('onContentBeforeDisplay', array('com_content.article', &$item, &$params, 0));
				$item->beforeDisplayContent = trim(implode("\n", $results));

				$results                   = $app->triggerEvent('onContentAfterDisplay', array('com_content.article', &$item, &$params, 0));
				$item->afterDisplayContent = trim(implode("\n", $results));
			}
			else
			{
				$item->afterDisplayTitle    = '';
				$item->beforeDisplayContent = '';
				$item->afterDisplayContent  = '';
			}
			// tùy chọn cho từng bài viết mới nhất trong danh sách.
		}

        return $items;
        
    }
}