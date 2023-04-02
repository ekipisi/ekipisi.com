<?php

namespace App\Admin\Extensions\Tools;

use Ekipisi\Admin\Admin;
use Ekipisi\Admin\Grid\Tools\AbstractTool;
use Illuminate\Support\Facades\Request;

class IsRobot extends AbstractTool
{
    protected function script()
    {
        $url = Request::fullUrlWithQuery(['is_robot' => '_robot_']);

        return <<<EOT

        $('input:radio.is-robot').change(function () {
            var url = "$url".replace('_robot_', $(this).val());
            $.pjax({container:'#pjax-container', url: url });
        });
EOT;
    }

    public function render()
    {
        Admin::script($this->script());

        $options = [
            'h'     => 'Robotları Gizle',
            'e'     => 'Robotları Göster',
        ];

        return view('admin.tools.robot', compact('options'));
    }
}