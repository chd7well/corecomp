<?php
/*
 * This file is part of the 7well project.
 *
 * (c) julatools project <http://github.com/chd7well/> by CHD Electronic Engineering
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace chd7well\corecomp;


/*
* @author Christian Dumhart <christian.dumhart@chd.at>
*/
class Module extends \yii\base\Module
{
	
	private $menus=[]; //node: weight, [ID, label, url, comment, noguest]

	
	public function init()
	{
		parent::init();

		// ...  other initialization code ...
		
	}
	
	
	/** @var array Model map */
	public $modelMap = [];
	/**
	 * @var string The prefix for user module URL.
	 * @See [[GroupUrlRule::prefix]]
	 */
	public $urlPrefix = 'corecomp';
}