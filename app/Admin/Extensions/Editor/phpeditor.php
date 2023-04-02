<?php
/**
 * Description:
 * User: Mustafa Genç
 * Date: 01/03/2018 01:08
 */

namespace App\Admin\Extensions\Editor;

use Ekipisi\Admin\Form\Field;

class phpeditor extends Field
{
    protected $view = 'admin.editor.phpeditor';

    protected static $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.35.0/codemirror.js',
        'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.35.0/addon/edit/matchbrackets.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.35.0/mode/htmlmixed/htmlmixed.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.35.0/mode/xml/xml.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.35.0/mode/javascript/javascript.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.35.0/mode/css/css.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.35.0/mode/clike/clike.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.35.0/mode/php/php.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.35.0/addon/search/search.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.35.0/addon/selection/active-line.js',
        'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.35.0/addon/search/match-highlighter.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.35.0/addon/runmode/colorize.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.35.0/addon/comment/comment.min.js'
    ];

    protected static $css = [
        'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.35.0/codemirror.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.35.0/theme/blackboard.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.35.0/theme/monokai.min.css'
    ];

    public function render()
    {
        $this->script = <<<EOT

CodeMirror.fromTextArea(document.getElementById("{$this->id}"), {
    lineNumbers: true,
    styleActiveLine: true,
    matchBrackets: true,
    theme:"monokai",
    mode: "text/x-php",
    lineWrapping: true,
    extraKeys: {
        "Tab": function(cm){
            cm.replaceSelection("    " , "end");
        }
     }
});

EOT;
        return parent::render();

    }
}
