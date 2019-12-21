wgt-colorpicker
===========
Widget for Yii Framework 2.0 to use [colorpicker](http://www.eyecon.ro/colorpicker/)

[![Latest Stable Version](https://poser.pugx.org/panix/wgt-colorpicker/v/stable)](https://packagist.org/packages/panix/wgt-colorpicker) [![Total Downloads](https://poser.pugx.org/panix/wgt-colorpicker/downloads)](https://packagist.org/packages/panix/wgt-colorpicker) [![Monthly Downloads](https://poser.pugx.org/panix/wgt-colorpicker/d/monthly)](https://packagist.org/packages/panix/wgt-colorpicker) [![Daily Downloads](https://poser.pugx.org/panix/wgt-colorpicker/d/daily)](https://packagist.org/packages/panix/wgt-colorpicker) [![Latest Unstable Version](https://poser.pugx.org/panix/wgt-colorpicker/v/unstable)](https://packagist.org/packages/panix/wgt-colorpicker) [![License](https://poser.pugx.org/panix/wgt-colorpicker/license)](https://packagist.org/packages/panix/wgt-colorpicker)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer require --prefer-dist panix/wgt-colorpicker "*"
```

or add

```
"panix/wgt-colorpicker": "*"
```

to the require section of your `composer.json` file.



Usage
-----

Once the extension is installed, simply use it in your code by :

```php
<?php
    echo $form->field($model, 'color')->widget(ColorPicker::className(), [

    ])->textInput(['maxlength' => 7]);
 ?>
```


# Configuration

| Опция  | Тип | Описание |
| --- | :---: | --- |
| `mode` | string | ColorPicker mode: **textInput** - presents a textfield with a color picker attached (default). **flat** - presents a color picker in flat mode. **selector** - attached to a square selector |
| `value` | string | The default color. String for hex color. Default is **#000000** |
| `livePreview` | boolean | Whatever if the color values are filled in the fields while changing values on selector or a field. If false it may improve speed. Default is **true** |
| `fade` | boolean | Whetever the color picker will be animated Default is **false** |
| `slide` | boolean | Whetever the color picker will slide Default is **false** |
| `curtain` | boolean | Whetever the color picker will appear as a curtain Default is **false** |
| `timeFade` | int | Times for the effect delays Default is **500** |
| `timeSlide` | int | Times for the effect delays Default is **500** |
| `timeCurtain` | int | Times for the effect delays Default is **500** |
| `onShow` | string | Callback function triggered when the color picker is shown. |
| `onBeforeShow` | string | Callback function triggered before the color picker is shown. |
| `onHide` | string | Callback function triggered when the color picker is hidden. |
| `onChange` | string | Callback function triggered when the color is changed. |
| `onSubmit` | string | Callback function triggered when the color it is chosen. |


### Examaple
```php
<?php
    echo $form->field($model, 'color')->widget(ColorPicker::className(), [
        'onShow' => new JsExpression('function() {}),
    ])->textInput(['maxlength' => 7]);
 ?>

