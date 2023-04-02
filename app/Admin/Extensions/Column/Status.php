<?php

namespace App\Admin\Extensions\Column;

use Ekipisi\Admin\Admin;
use Ekipisi\Admin\Grid\Displayers\AbstractDisplayer;

class Status extends AbstractDisplayer
{
    public function display()
    {
        if ($this->value) {
            return "<center><i class=\"fa fa-fw fa-check text-green\" aria-hidden=\"true\"></i></center>";
        } else {
            return "<center><i class=\"fa fa-fw fa-times text-red\" aria-hidden=\"true\"></i></center>";
        }
    }
}