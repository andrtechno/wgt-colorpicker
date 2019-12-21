<?php

namespace panix\ext\colorpicker;

use panix\engine\web\AssetBundle;

/**
 * Class ColorPickerAsset
 * @package panix\ext\colorpicker
 */
class ColorPickerAsset extends AssetBundle
{

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
