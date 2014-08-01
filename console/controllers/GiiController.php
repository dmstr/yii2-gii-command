<?php
/**
 * @link      http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license   http://www.yiiframework.com/license/
 */

namespace dmstr\console\controllers;

use Yii;
use yii\console\Controller;

/**
 * Allows you to run Gii from the command line.
 * Example command:
 * $ ./yii gii/<generator> --property1=foo --property2=bar --generate=true
 * @author Tobias Munk <schmunk@usrbin.de>
 * @since  2.0
 */
class GiiController extends Controller
{
    /**
     * @var boolean whether to generate all files and overwrite existing files
     */
    public $generate = false;

    public $generators = [
        'model'        => ['class' => 'yii\gii\generators\model\Generator'],
        'crud'         => ['class' => 'yii\gii\generators\crud\Generator'],
        'controller'   => ['class' => 'yii\gii\generators\controller\Generator'],
        'form'         => ['class' => 'yii\gii\generators\form\Generator'],
        'module'       => ['class' => 'yii\gii\generators\module\Generator'],
        'extension'    => ['class' => 'yii\gii\generators\extension\Generator'],
        'giiant-model' => ['class' => 'schmunk42\giiant\model\Generator'],
        'giiant-crud'  => ['class' => 'schmunk42\giiant\crud\Generator'],
    ];

    /**
     * @var array stores generator attributes
     */
    private $_attributes = [];

    public function __set($key, $value)
    {
        $this->_attributes[$key] = $value;
    }

    public function __get($key)
    {
        if (isset($this->_attributes[$key])) {
            return $this->_attributes[$key];
        }
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        $actions = [];
        #var_dump(Yii::$app->getModule('gii')->generators);exit;
        foreach ($this->generators as $name => $generator) {
            // create a generate action for every generator
            $actions[$name] = [
                'class'         => '\dmstr\console\controllers\GenerateAction',
                'generatorName' => $name,
            ];
        }
        return $actions;
    }

    /**
     * @inheritdoc
     */
    public function options($id)
    {
        $generator = Yii::createObject($this->generators[$id]);
        return array_merge(
            parent::options($id),
            ['generate'],
            array_keys($generator->attributes) // global for all actions -- TODO this is broken
        );
    }
}
