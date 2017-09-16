<?php

namespace frontend\modules\api;

class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'frontend\modules\api\controllers';
    /**
     * @var
     */
    public $componentsList;

    public function init()
    {
        \Yii::configure(\Yii::$app, [
            'components' => $this->componentsList
        ]);
        parent::init();
    }
}
