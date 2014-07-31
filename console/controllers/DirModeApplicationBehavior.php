<?php
/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2014 diemeisterei GmbH, Stuttgart
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dmstr\console\controllers;

use yii\base\Behavior;


/**
 * Class DirModeApplicationBehavior
 * @package dmstr\console\controllers
 * @author Tobias Munk <tobias@diemeisterei.de>
 */
class DirModeApplicationBehavior extends Behavior {
    public $newDirMode = 0777;
    public $newFileMode = 0666;
} 