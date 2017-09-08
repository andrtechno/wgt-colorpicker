<?php

namespace panix\ext\colorpicker;

use yii\web\AssetBundle;

class ColorpickerAsset extends AssetBundle {

    public $sourcePath = __DIR__ . '/assets';
    public $css = [
        'css/colorpicker.css'
    ];
    public $js = [
        'js/colorpicker.js',
        'js/eye.js',
        'js/utils.js',
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}
