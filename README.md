wgt-colorpicker
===========
Widget for Yii Framework 2.0 to use [colorpicker](http://www.eyecon.ro/colorpicker/)

[![Latest Stable Version](https://poser.pugx.org/panix/wgt-colorpicker/v/stable)](https://packagist.org/packages/panix/wgt-colorpicker) [![Total Downloads](https://poser.pugx.org/panix/wgt-colorpicker/downloads)](https://packagist.org/packages/panix/wgt-colorpicker) [![Monthly Downloads](https://poser.pugx.org/panix/wgt-colorpicker/d/monthly)](https://packagist.org/packages/panix/wgt-colorpicker) [![Daily Downloads](https://poser.pugx.org/panix/wgt-colorpicker/d/daily)](https://packagist.org/packages/panix/wgt-colorpicker) [![Latest Unstable Version](https://poser.pugx.org/panix/wgt-colorpicker/v/unstable)](https://packagist.org/packages/panix/wgt-colorpicker) [![License](https://poser.pugx.org/panix/wgt-colorpicker/license)](https://packagist.org/packages/panix/wgt-colorpicker)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist panix/wgt-colorpicker "*"
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
    $form->field($model, 'color')->widget(Colorpicker::className(), [

    ]);
 ?>
```
