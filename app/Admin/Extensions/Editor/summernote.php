<?php
/**
 * Description:
 * User: Mustafa Genç
 * Date: 28/02/2018 23:06
 */

namespace App\Admin\Extensions\Editor;

use Ekipisi\Admin\Form\Field;

class summernote extends Field
{
    public static $js = [
        '/vendor/summernote/summernote.min.js',
        '/vendor/summernote/lang/summernote-tr-TR.js',
    ];

    public static $css = [
        '/vendor/summernote/summernote.css'
    ];

    protected $view = 'admin.editor.summernote';

    public function render()
    {
        $this->script = <<<EOT
        $(document).ready(function(){
            $('#{$this->getElementClass()[0]}').summernote({
                height: 200,  
            })
        });
EOT;

        return parent::render();
    }
}