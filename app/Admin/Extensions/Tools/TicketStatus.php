<?php

namespace App\Admin\Extensions\Tools;

use Ekipisi\Admin\Grid\Tools\BatchAction;

class TicketStatus extends BatchAction
{
    protected $action;

    public function __construct($action = 1)
    {
        $this->action = $action;
    }
    
    public function script()
    {
        return <<<EOT
        
$('{$this->getElementClass()}').on('click', function() {

    $.ajax({
        method: 'post',
        url: '{$this->resource}/close',
        data: {
            _token:LA.token,
            ids: selectedRows(),
            action: {$this->action}
        },
        success: function () {
            $.pjax.reload('#pjax-container');
            toastr.success('Destek talepleri kapatıldı.');
        }
    });
});

EOT;

    }
}