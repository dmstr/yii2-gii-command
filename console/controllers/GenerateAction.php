<?php
/**
 * @link      http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license   http://www.yiiframework.com/license/
 */


namespace dmstr\console\controllers;

use dmstr\console\behaviors\DirModeApplicationBehavior;

/**
 * Runs generator from Gii module
 * @author Tobias Munk <schmunk@usrbin.de>
 * @since  2.0
 */
class GenerateAction extends \yii\base\Action
{
    public $generatorName;
    public $generator;

    /**
     * Load specified generator and generate files
     */
    public function run()
    {
        \Yii::$app->attachBehavior('dirmode-fix',DirModeApplicationBehavior::className());

        echo "Loading generator '$this->generatorName'...\n\n";
        $generator = $this->loadGenerator($this->generatorName);
        if ($generator->validate()) {
            $files   = $generator->generate();
            $answers = [];
            if ($this->controller->generate == true) {
                foreach ($files AS $file) {
                    $answers[$file->id] = true;
                }
            } else {
                echo "NOT generating new files or overwriting existing files. Use --generate=true to enable file creation.\n";
            }
            $params['hasError'] = $generator->save($files, (array)$answers, $results);
            $params['results']  = $results;
            echo $params['hasError'];
            echo "\n";
            echo $results;
        } else {
            echo "Attribute Errors\n";
            echo "----------------\n";
            foreach ($generator->errors AS $attribute => $errors) {
                echo "$attribute: " . implode('; ', $errors) . "\n";
            }
            echo "\n";
        }
    }

    /**
     * Loads the generator with the specified ID.
     *
     * @param  string $id the ID of the generator to be loaded.
     *
     * @return \yii\gii\Generator    the loaded generator
     * @throws NotFoundHttpException
     */
    private function loadGenerator($id)
    {
        if (isset($this->controller->generators[$this->generatorName])) {
            // using a new object for multiple controller runs
            $this->generator = \Yii::createObject($this->controller->generators[$this->generatorName]);
            foreach ($this->generator->attributes AS $name => $attribute) {
                if ($this->controller->$name) {
                    $this->generator->$name = $this->controller->$name;
                }
            }
            $this->generator->init();
            return $this->generator;
        } else {
            throw new \yii\console\Exception("Code generator not found: $id");
        }
    }

}