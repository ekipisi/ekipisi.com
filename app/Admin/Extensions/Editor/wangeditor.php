<?php
/**
 * Description:
 * User: Mustafa Genç
 * Date: 28/02/2018 23:08
 */

namespace App\Admin\Extensions\Editor;

use Ekipisi\Admin\Form\Field;

class wangeditor extends Field
{
    protected $view = 'admin.editor.wangeditor';

    protected static $css = [
        '/vendor/wangEditor-3.0.10/release/wangEditor.css',
    ];

    protected static $js = [
        '/vendor/wangEditor-3.0.10/release/wangEditor.js',
    ];

    public function render()
    {
        $name = $this->formatName($this->column);

        $this->script = <<<EOT

var E = window.wangEditor
var editor = new E('#{$this->id}');
editor.customConfig.zIndex = 0
editor.customConfig.uploadImgShowBase64 = true
editor.customConfig.onchange = function (html) {
    $('input[name=$name]').val(html);
}
editor.create()

EOT;
        return parent::render();
    }
}
