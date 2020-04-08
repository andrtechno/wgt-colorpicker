<?php

namespace panix\ext\colorpicker;

use Yii;
use yii\widgets\InputWidget;
use yii\helpers\Json;
use yii\helpers\Html;
use yii\base\Exception;
use panix\engine\base\TranslationTrait;

/**
 * Class ColorPicker
 * @package panix\ext\colorpicker
 */
class ColorPicker extends InputWidget
{
    use TranslationTrait;

    /**
     * ColorPicker mode. Possible values are:
     *
     * textInput - presents a textfield with a color picker attached (default)
     * flat - presents a color picker in flat mode
     * selector - attached to a square selector
     *
     * @var string
     */
    private $mode = 'textInput';

    /**
     * The default color. String for hex color
     *
     * @var <type>
     */
    public $value = '000000';

    /**
     * Whatever if the color values are filled in the fields while changing
     * values on selector or a field. If false it may improve speed. Default true
     *
     * @var boolean
     */
    private $livePreview = true;

    /**
     * Whetever the color picker will be animated
     *
     * @var boolean
     */
    private $fade = false;

    /**
     * Whetever the color picker will slide
     *
     * @var boolean
     */
    private $slide = false;

    /**
     * Whetever the color picker will appear as a curtain
     *
     * @var boolean
     */
    private $curtain = false;

    /**
     * Times for the effect delays
     *
     * @var integer
     */
    private $timeFade = 500;
    private $timeSlide = 500;
    private $timeCurtain = 500;

    /**
     * Callback function triggered when the color picker is shown
     *
     * @var string
     */
    public $onShow = '';

    /**
     * Callback function triggered before the color picker is shown
     *
     * @var string
     */
    public $onBeforeShow = '';

    /**
     * Callback function triggered when the color picker is hidden
     *
     * @var string
     */
    public $onHide = '';

    /**
     * Callback function triggered when the color is changed
     *
     * @var string
     */
    public $onChange = '';

    /**
     * Callback function triggered when the color it is chosen
     *
     * @var string
     */
    public $onSubmit = '';

    /**
     * ID of the element which will be the selector in "selector" mode. Ideally
     * this should be a div or another widget with a more complex design
     *
     * @var string
     */
    public $selector = '';

    //***************************************************************************
    // Setters and getters
    //***************************************************************************

    /**
     * Check valid modes
     *
     * @param string $value
     * @throws Exception
     */
    public function setMode($value)
    {
        if (!in_array($value, ['textInput', 'flat', 'selector','picker']))
            throw new Exception(Yii::t('colorpicker', 'INVALID_MODE'));
        $this->mode = $value;
    }

    /**
     *
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * Hexadecimal value for the starting color.
     *
     * @param string $value
     * @throws Exception
     */
    public function setValue($value)
    {
        if (!preg_match('/^[0-9A-F]{6}$/i', $value))
            throw new Exception(Yii::t('colorpicker', 'INVALID_COLOR'));
        $this->value = $value;
    }

    /**
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Boolean value for livePreview
     *
     * @param boolean $value
     * @throws Exception
     */
    public function setLivePreview($value)
    {
        if (!is_bool($value))
            throw new Exception(Yii::t('colorpicker', 'INVALID_VALUE'));
        $this->livePreview = $value;
    }

    /**
     *
     * @return boolean
     */
    public function getLivePreview()
    {
        return $this->livePreview;
    }

    /**
     * @param $value
     * @throws Exception
     */
    public function setFade($value)
    {
        if (!is_bool($value))
            throw new Exception(Yii::t('colorpicker', 'INVALID_VALUE'));
        $this->fade = $value;
    }

    public function getFade()
    {
        return $this->fade;
    }

    /**
     * @param $value
     * @throws Exception
     */
    public function setSlide($value)
    {
        if (!is_bool($value))
            throw new Exception(Yii::t('colorpicker', 'INVALID_VALUE'));
        $this->slide = $value;
    }

    public function getSlide()
    {
        return $this->slide;
    }

    /**
     * @param $value
     * @throws Exception
     */
    public function setCurtain($value)
    {
        if (!is_bool($value))
            throw new Exception(Yii::t('colorpicker', 'INVALID_VALUE'));
        $this->curtain = $value;
    }

    public function getCurtain()
    {
        return $this->curtain;
    }

    /**
     * @param $value
     * @throws Exception
     */
    public function setTimeFade($value)
    {
        if (!is_int($value))
            throw new Exception(Yii::t('colorpicker', 'INVALID_VALUE'));
        $this->timeFade = $value;
    }

    public function getTimeFade()
    {
        return $this->timeFade;
    }

    /**
     * @param $value
     * @throws Exception
     */
    public function setTimeSlide($value)
    {
        if (!is_int($value))
            throw new Exception(Yii::t('colorpicker', 'INVALID_VALUE'));
        $this->timeSlide = $value;
    }

    public function getTimeSlide()
    {
        return $this->timeSlide;
    }

    /**
     * @param $value
     * @throws Exception
     */
    public function setTimeCurtain($value)
    {
        if (!is_int($value))
            throw new Exception(Yii::t('colorpicker', 'INVALID_VALUE'));
        $this->timeCurtain = $value;
    }

    public function getTimeCurtain()
    {
        return $this->timeCurtain;
    }

    //***************************************************************************
    // Utilities
    //***************************************************************************

    private function jsOptions()
    {
        $options = [];
        $options['color'] = "'" . $this->value . "'";
        $options['livePreview'] = "'" . $this->livePreview . "'";
        $options['onShow'] = $this->onShow;
        $options['onBeforeShow'] = $this->onBeforeShow;
        $options['onHide'] = $this->onHide;
        $options['onSubmit'] = $this->onSubmit;

        switch ($this->mode) {
            case 'textfield':
                $options['flat'] = 'false';
                break;

            case 'flat':
                $options['flat'] = 'true';
                break;

            case 'selector':
                $options['flat'] = 'false';
                break;

            case 'picker':
                $options['flat'] = 'false';
                break;
        }
        return Json::encode($options);
    }

    //***************************************************************************
    // Paint the widget
    //***************************************************************************

    public function run()
    {
        $this->init_i18n(__DIR__, 'colorpicker');

        $view = $this->getView();
        ColorPickerAsset::register($view);

        $options = $this->jsOptions();

        $js_effects = '';
        if (($this->mode != 'flat') && ($this->fade || $this->slide || $this->curtain)) {
            $fi = $fo = $si = $so = $ci = $co = '';
            if ($this->fade) {
                $fi = "$(colpkr).fadeIn({$this->timeFade});";
                $fo = "$(colpkr).fadeOut({$this->timeFade});";
            }
            if ($this->slide) {
                $si = "$(colpkr).slideDown({$this->timeSlide});";
                $so = "$(colpkr).slideUp({$this->timeSlide});";
            }
            if ($this->curtain) {
                $ci = "$(colpkr).show({$this->timeCurtain});";
                $co = "$(colpkr).hide({$this->timeCurtain});";
            }
            $js_effects = <<<EOP
onShow: function (colpkr) {
   {$fi}
   {$si}
   {$ci}
   return false;
},
onHide: function (colpkr) {
   {$fo}
   {$so}
   {$co}
   return false;
},
EOP;
        }

        switch ($this->mode) {
            case 'textInput':
                //$this->options['id'] = $this->id;
                if (!isset($this->options['class'])) {
                    $this->options['class'] = 'form-control';
                }

                $this->options['size'] = !isset($this->options['size']) ? 6 : $this->options['size'];
                $this->options['maxlength'] = !isset($this->options['maxlength']) ? 6 : $this->options['maxlength'];
                if ($this->hasModel())
                    $html = Html::activeTextInput($this->model, $this->attribute, $this->options);
                else
                    $html = Html::textInput($this->name, $this->value, $this->options);
                $js = <<<EOP
$('#{$this->options['id']}').ColorPicker({
   {$js_effects}
	onSubmit: function(hsb, hex, rgb) {
		$('#{$this->options['id']}').val('#'+hex);
	},
	onBeforeShow: function() {
		$(this).ColorPickerSetColor(this.value);
	},
   onChange: function(hsb, hex, rgb) {
      $('#{$this->options['id']}').val('#'+hex);
   }
})
.bind('keyup', function(){
	$(this).ColorPickerSetColor(this.value);
});
EOP;
                $view->registerJs($js);
                echo $html;
                break;

            case 'flat':
                $html = <<<EOP
<div id="{$this->id}"></div>
EOP;
                $js = <<<EOP
$('#{$this->id}').ColorPicker({$options});
EOP;
                $view->registerJs($js);
                echo $html;
                break;

            case 'picker':
                if (!isset($this->options['class'])) {
                    $this->options['class'] = 'form-control';
                }

                $this->options['size'] = !isset($this->options['size']) ? 6 : $this->options['size'];
                $this->options['maxlength'] = !isset($this->options['maxlength']) ? 6 : $this->options['maxlength'];
                if ($this->hasModel())
                    $html = Html::activeHiddenInput($this->model, $this->attribute, $this->options);
                else
                    $html = Html::hiddenInput($this->name, $this->value, $this->options);
                $html .= '<div id="'.$this->options['id'].'-selector" class="colorpicker_select dark"></div>';

                $js = <<<EOP
                
var value = $('#{$this->options['id']}').val();
$('#{$this->options['id']}-selector').css('backgroundColor', value);

$('#{$this->options['id']}-selector').ColorPicker({
   {$js_effects}
	onChange: function (hsb, hex, rgb) {
		$('#{$this->options['id']}-selector').css('backgroundColor', '#' + hex);
		$('#{$this->options['id']}').val('#'+hex);
	}
});
EOP;
                $view->registerJs($js);
                echo $html;
                break;

            case 'selector':
                if (empty($this->selector)) {
                    throw new Exception(Yii::t('colorpicker', 'A selector must be specified.'));
                } else {
                    $selector = $this->selector;
                }
                $js = <<<EOP
$('#{$selector}').ColorPicker({
   {$js_effects}
	onChange: function (hsb, hex, rgb) {
		$('#{$selector}').css('backgroundColor', '#' + hex);
	}
});
EOP;
                $view->registerJs($js);
                echo '';
                break;
        }
    }

}