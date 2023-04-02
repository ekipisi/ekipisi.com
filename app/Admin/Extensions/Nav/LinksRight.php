<?php
/**
 * Description:
 * User: Mustafa Genç
 * Date: 01/03/2018 01:02
 */

namespace App\Admin\Extensions\Nav;

use App\Models\MessageModel;
use App\Models\BillingModel;
use App\Models\TicketModel;

class LinksRight
{
    public function __toString()
    {
        $app_link = url("/");
        $message_link = admin_url("messages");
        $ticket_link = admin_url("tickets");
        $billing_link = admin_url("billings");
        $clear_cache_link = admin_url('clearcache');

        $messages = MessageModel::where('read', 0)->count();
        $billings = BillingModel::where('status', 0)->count();
        $tickets = TicketModel::where('status_id', '!=', 2)->count();

        if ($messages>0)
            $messages_html = "<span class=\"label label-success\">$messages</span>";
        else
            $messages_html = "";

        if ($billings>0)
            $billings_html = "<span class=\"label label-info\">$billings</span>";
        else
            $billings_html = "";

        if ($tickets>0)
            $tickets_html = "<span class=\"label label-warning\">$tickets</span>";
        else
            $tickets_html = "";


        return <<<EOT
        <li>
            <a href="$billing_link" data-toggle="tooltip" data-placement="bottom" title="Ödemeler">
                <i class="fa fa-credit-card"></i>
                $billings_html
            </a>
        </li>
        <li>
            <a href="$ticket_link" data-toggle="tooltip" data-placement="bottom" title="Teknik Destek">
                <i class="fa fa-tags"></i>
                $tickets_html
            </a>
        </li>
        <li>
            <a href="$message_link" data-toggle="tooltip" data-placement="bottom" title="Mesajlar">
                <i class="fa fa-envelope"></i>
                $messages_html
            </a>
        </li>
        <li>
            <a href="javascript:void(0);" id="currency_refresh" data-toggle="tooltip" data-placement="bottom" title="Döviz Kurunu Güncelle">
                <i class="fa fa-refresh"></i>
            </a>
        </li>
        <li>
            <a href="javascript:void(0);" data-href="$app_link" id="homePage" data-toggle="tooltip" data-placement="bottom" title="Ana Sayfa">
                <i class="fa fa-globe"></i>
            </a>
        </li>
        <li class="dropdown">
            <a href="javascript:void(0);" data-href="$clear_cache_link" id="clearCache" data-toggle="tooltip" data-placement="bottom" title="Clear Cache">
                <i class="fa fa-bolt"></i>
            </a>
        </li>
EOT;
    }
}