<?php

namespace Acme\ColorPicker;

use Laravel\Nova\Fields\Field;

class ColorPicker extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'color-picker';
    

 /**
     * Set the hues that may be selected by the color picker.
     *
     * @param  array  $hues
     * @return $this
     */
    public function hues(array $hues)
    {
        return $this->withMeta(['hues' => $hues]);
    }
}
