<?php

class ImgResizer extends CWidget {

    private $parameters = '100x100';
    public $imageUrl = 'http://www.yiiframework.com/files/logo/yii.png';
    public $command = 'resize';
    public $width = '100';
    public $height = '100';
    public $percent = '100';
    public $size = '100';
    public $degrees = '45';
    public $cornerx = '0';
    public $cornery = '0';
    public $text = 'ImgResizer 1.0';
    public $format = 'png';

    public function init() {

        if ($this->command == 'crop')
            $this->parameters = $this->cornerx . ',' . $this->cornery . ',' . $this->width . 'x' . $this->height;

        if ($this->command == 'convert')
            $this->parameters = $this->format;

        if ($this->command == 'wm')
            $this->parameters = $this->text;

        if ($this->command == 'rotate')
            $this->parameters = $this->degrees;

        if ($this->command == 'height')
            $this->parameters = $this->size;

        if ($this->command == 'width')
            $this->parameters = $this->size;

        if ($this->command == 'thumbnail')
            $this->parameters = $this->size;

        if ($this->command == 'square')
            $this->parameters = $this->size;

        if ($this->command == 'scale')
            $this->parameters = $this->percent;

        if ($this->command == 'fit')
            $this->parameters = $this->width . 'x' . $this->height;

        if ($this->command == 'resize')
            $this->parameters = $this->width . 'x' . $this->height;

        if (in_array($this->command, array('bw', 'invert', 'blur', 'sharpen')))
            $path = 'http://urlimg.com/' . $this->command . '/' . ($this->imageUrl) . '';
        else
            $path = 'http://urlimg.com/' . $this->command . '/' . $this->parameters . '/' . ($this->imageUrl) . '';

        echo '<img src="' . ($path) . '" alt="' . ($path) . '" title="' . ($path) . '" border="0" />';
    }

}