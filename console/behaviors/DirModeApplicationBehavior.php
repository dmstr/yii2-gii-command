<?php
/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2014 diemeisterei GmbH, Stuttgart
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dmstr\console\behaviors;

use yii\base\Behavior;


/**
 * Class DirModeApplicationBehavior
 *
 * Note: This is just a hotfix which allows runnning the GiiCommand
 *
 * @package dmstr\console\controllers
 * @author Tobias Munk <tobias@diemeisterei.de>
 */
class DirModeApplicationBehavior extends Behavior {
    public $newDirMode = 0777;
    public $newFileMode = 0666;
} 