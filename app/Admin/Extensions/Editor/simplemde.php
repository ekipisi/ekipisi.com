<?php
/**
 * Description:
 * User: Mustafa Genç
 * Date: 28/02/2018 23:06
 */

namespace App\Admin\Extensions\Editor;

use Ekipisi\Admin\Form\Field;

class simplemde extends Field
{
    // public static $js = [
    //     '/vendor/summernote/summernote.min.js',
    //     '/vendor/summernote/lang/summernote-es-EU.js',
    // ];

    // public static $css = [
    //     '/vendor/summernote/summernote.css'
    // ];

    protected $view = 'admin.editor.simplemde';

    public function render()
    {
        $this->script = <<<EOT
        var simplemde = new SimpleMDE({
        element: document.getElementById("{$this->id}"),
        parsingConfig: {
            allowAtxHeaderWithoutSpace: true,
            strikethrough: true,
            underscoresBreakWords: true,
        },
        promptURLs: false,
        spellChecker: false,
            tabSize: 4,
        });
EOT;

        return parent::render();
    }
}