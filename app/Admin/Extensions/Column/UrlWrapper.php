<?php
/**
 * Description:
 * User: Mustafa Genç
 * Date: 01/03/2018 01:15
 */

namespace App\Admin\Extensions\Column;

use Ekipisi\Admin\Facades\Admin;
use Ekipisi\Admin\Grid\Displayers\AbstractDisplayer;

class UrlWrapper extends AbstractDisplayer
{
    protected function script()
    {
        return <<<EOT

$('.grid-qrcode').popover({
    title: "Scan to Code Phone to Visit",
    html: true,
    trigger: 'focus'
});

new Clipboard('.clipboard');

$('.clipboard').tooltip({
  trigger: 'click',
  placement: 'bottom'
}).mouseout(function (e) {
    $(this).tooltip('hide');
});

EOT;

    }

    public function display()
    {
        Admin::script($this->script());

        $qrcode = "<img src='https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={$this->value}' style='height: 150px;width: 150px;'/>";

        return <<<EOT

<div class="input-group" style="width:150px;">
  <input type="text" id="grid-homepage-{$this->getKey()}" class="form-control input-sm" value="{$this->value}" />
  <span class="input-group-btn">
    <button class="btn btn-default btn-sm clipboard" data-clipboard-target="#grid-homepage-{$this->getKey()}" title="Bağlantı Kopyalandı!">
        <i class="fa fa-clipboard"></i>
    </button>
    <a class="btn btn-default btn-sm grid-qrcode" data-content="$qrcode" data-toggle='popover' tabindex='0'>
        <i class="fa fa-qrcode"></i>
    </a>
  </span>
</div>

EOT;

    }
}
