<?php

namespace App\Admin\Controllers;

use App\Models\TrackerModel;
use App\Models\FirewallModel;

use App\Admin\Extensions\Tools\IsRobot;

use Ekipisi\Admin\Form;
use Ekipisi\Admin\Grid;
use Ekipisi\Admin\Show;
use Ekipisi\Admin\Layout\Column;
use Ekipisi\Admin\Layout\Content;
use Ekipisi\Admin\Layout\Row;
use Ekipisi\Admin\Widgets\Table;
use Ekipisi\Admin\Widgets\Box;
use Ekipisi\Admin\Facades\Admin;
use Ekipisi\Admin\Controllers\ModelForm;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Request;

class TrackerController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Oturumlar');
            $content->description('Liste');
            $content->breadcrumb(['text' => 'Oturumlar']);
            $content->body($this->grid());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(TrackerModel::class, function (Grid $grid) {
            
            $grid->model()->where([['updated_at', '>=', date('Y-m-d').' 00:00:00']]);
            $grid->model()->orderBy('updated_at', 'desc');

            if (in_array(Request::get('is_robot'), ['e', 'h'])) {
                $robot = Request::get('is_robot') == 'e' ? 1 : 0;
                $grid->model()->where('is_robot', $robot);
            }

            if (Request::get('blocked')){
                admin_toastr('Ip Adresi Engellendi.', 'error', ['timeOut' => 3000]);
            }

            if (Request::get('unblocked')){
                admin_toastr('Ip Adresindeki Engel Kaldırıldı.', 'success', ['timeOut' => 3000]);
            }

            $grid->id('ID');

            $grid->is_robot('Robot')->status()->sortable();

            $grid->is_mobile('Mobil')->display(function($is_mobile){
                if ($is_mobile['is_mobile']) {
                    return "<center><i class=\"fa fa-fw fa-check text-green\" aria-hidden=\"true\"></i></center>";
                } else {
                    return "<center><i class=\"fa fa-fw fa-times text-red\" aria-hidden=\"true\"></i></center>";
                }
            });

            $grid->column('Toplam Ziyaret')->display(function(){
                $count = count($this->log);
                if ($count > 3) {
                    return "<center><span class='text-red' style='font-weight:bold;'><i class='fa fa-hand-o-right'></i> " . $count . " Sayfa</span></center>";
                } else {
                    return "<center>" . $count . " Sayfa</center>";
                }
            });

            $grid->client_ip('Ip Adresi')->display(function($client_ip){
                if (Request::ip()==$client_ip){
                    return "<span class='label label-success' data-toggle='tooltip' title='".$client_ip."'>(Siz)</span>";
                } else {
                    return "<a href='https://geoiptool.com/en/?IP=" . $client_ip . "' target='_blank'>" . $client_ip . "</a>";
                }
            });

            $grid->device("Tip")->display(function($device){
                return $device['kind'] . " - " . $device['platform'];
            });

            $grid->language()->preference('Dil');
            
            $grid->agent('Tarayıcı')->display(function($agent){
                return "<a href='https://www.google.com/search?q=" . $agent['name'] . "' target='_blank'>" . str_limit($agent['name'], $limit = 50, $end = '...') . "</a>";
            });

            // $grid->referer('Geldiği Adres')->display(function($referer){
            //     return "<a href='" . $referer['url'] . "' target='_blank'>" . str_limit($referer['url'], $limit = 30, $end = '...') . "</a>";
            // });

            $grid->created_at('Giriş Zamanı')->display(function() {
                return Carbon::parse($this->created_at)->format("d M Y, H:i");
            })->sortable();

            $grid->updated_at('Son İşlem Zamanı')->display(function() {
                return Carbon::parse($this->updated_at)->format("d M Y, H:i");
            })->sortable();

            $grid->disableExport();
            $grid->disableCreateButton();
            $grid->paginate(config('admin.page.size'));

            $grid->tools(function ($tools) {
                $tools->batch(function ($batch) {
                    $batch->disableDelete();
                });

                $tools->append(new IsRobot());
            });

            $grid->actions(function ($actions) {
                $actions->disableDelete();
                $actions->disableEdit();
                
                $firewall = FirewallModel::where('ip_address', $actions->row->client_ip)->first();
                if ($firewall){
                    if ($firewall->whitelisted) {
                        $actions->append('<a class="btn btn-danger btn-xs" data-toggle="tooltip" title="Engelle" href="' . admin_url('tracker/block/' . $actions->row->id) . '"><i class="fa fa-ban"></i></a>&nbsp;');
                    } else {
                        $actions->append('<a class="btn btn-success btn-xs" data-toggle="tooltip" title="Engeli Kaldır" href="' . admin_url('tracker/unblock/' . $actions->row->id) . '"><i class="fa fa-ban"></i></a>&nbsp;');
                    }
                } else {
                    $actions->append('<a class="btn btn-danger btn-xs" data-toggle="tooltip" title="Engelle" href="' . admin_url('tracker/block/' . $actions->row->id) . '"><i class="fa fa-ban"></i></a>&nbsp;');
                }                
                $actions->append('<a class="btn btn-info btn-xs" data-toggle="tooltip" title="Detaylı Bilgi" href="' . admin_url('tracker/detail/' . $actions->row->id) . '"><i class="fa fa-eye"></i></a>');
            });

            $grid->filter(function (Grid\Filter $filter) {
                $filter->disableIdFilter();

                $filter->like('client_ip', 'Ip Adresi');
            });

            
        });
    }

    public function detail($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('Oturumlar');
            $content->description('Detaylı Bilgi');

            $content->breadcrumb(
                ['text' => 'Oturumlar', 'url' => admin_url('tracker') . "?is_robot=h"],
                ['text' => 'Detaylı Bilgi']
            );


            $tracker_detail = TrackerModel::where('id', $id)->first();

            $detail_headers = [];
            $detail_rows = [
                ['<strong>Ip Adresi :</strong> <a target="_blank" href="https://geoiptool.com/en/?IP='.$tracker_detail->client_ip.'">' . $tracker_detail->client_ip . "</a>"],
                ['<strong>Robot :</strong> ' . ($tracker_detail->is_robot ? "Evet" : "Hayır")],
                ['<strong>Mobil :</strong> ' . ($tracker_detail->is_mobile['is_mobile'] ? "Evet" : "Hayır")],
                ['<strong>Tip :</strong> ' . $tracker_detail->device['kind'] . " - " . $tracker_detail->device['platform'] . " " . $tracker_detail->device['platform_version']],
                ['<strong>Üst Bilgi :</strong> <a target="_blank" href="https://www.google.com/search?q='.$tracker_detail->agent['name'].'">' . $tracker_detail->agent['name'] . "</a>"],
                ['<strong>Tarayıcı :</strong> ' . $tracker_detail->agent['browser'] . " " . $tracker_detail->agent['browser_version']],
                ['<strong>Dil :</strong> ' . $tracker_detail->language['preference'] . " (" . $tracker_detail->language['language-range'] . ")"],
                ['<strong>Geldiği Adres :</strong> <a target="_blank" href="'.$tracker_detail->referer['url'].'">' . $tracker_detail->referer['url'] . '</a>'],
                ['<strong>Giriş Zamanı :</strong> ' . $tracker_detail->created_at],
                ['<strong>Son İşlem Zamanı :</strong> ' . $tracker_detail->updated_at]
            ];

            $log_headers = ['Path', 'Metod', 'Ajax', 'Güvenli', 'Json', 'Json İstek', 'İlk İşlem Zamanı', 'Son İşlem Zamanı'];

            $log_rows = [];

            foreach($tracker_detail->log as $log){
                $log_rows[] = [
                    "<a target='_blank' href='" . url($log->path['path']) . "'>" . $log->path['path'] . "</a>",
                    $log->method,
                    ($log->is_ajax ? "Evet" : "Hayır"),
                    ($log->is_secure ? "Evet" : "Hayır"),
                    ($log->is_json ? "Evet" : "Hayır"),
                    ($log->wants_json ? "Evet" : "Hayır"),
                    $log->created_at,
                    $log->updated_at,
                ];
            }

            $detail_table = new Table($detail_headers, $detail_rows);
            $log_table = new Table($log_headers, $log_rows);

            $detail_box = new Box('Ziyaretçi Detayları', $detail_table);
            $detail_box->style('info');

            $log_box = new Box('Yapılan İşlem', $log_table);
            $log_box->style('warning');

            $content->row(function (Row $row) use ($detail_box) {
                $row->column(12, function (Column $column) use ($detail_box) {
                    $column->append($detail_box);
                });
            });

            $content->row(function (Row $row) use ($log_box) {
                $row->column(12, function (Column $column) use ($log_box) {
                    $column->append($log_box);
                });
            });

            $content->row(function (Row $row) use ($tracker_detail) {
                $row->column(12, function (Column $column) use ($tracker_detail) {

                    $firewall = FirewallModel::where('ip_address', $tracker_detail->client_ip)->first();

                    $block_button = '<a class="btn btn-danger btn-block btn-lg" href="' . admin_url('tracker/block/' . $tracker_detail->id) . '"><i class="fa fa-ban"></i> Ip Adresini Engelle</a>';

                    $unblock_button = '<a class="btn btn-success btn-block btn-lg" href="' . admin_url('tracker/unblock/' . $tracker_detail->id) . '"><i class="fa fa-ban"></i> Ip Adresindeki Engeli Kaldır</a>';

                    if ($firewall){
                        if ($firewall->whitelisted) {
                            $column->append($block_button);
                        } else {
                            $column->append($unblock_button);
                        }
                    } else {
                        $column->append($block_button);
                    }   

                });
            });

        });
    }

    public function block($id){
        $tracker_detail = TrackerModel::where('id', $id)->first();
        $firewall = FirewallModel::where('ip_address', $tracker_detail->client_ip)->first();
        if ($firewall) {
            FirewallModel::find($firewall->id)->update([
                'whitelisted' => 0
            ]);
        } else {
            FirewallModel::updateOrCreate([
                'ip_address' => $tracker_detail->client_ip,
                'whitelisted' => 0
            ]);
        }
        Cache::flush();
        return redirect(admin_url('tracker/?blocked=1'));
    }

    public function unblock($id){
        $tracker_detail = TrackerModel::where('id', $id)->first();
        $firewall = FirewallModel::where('ip_address', $tracker_detail->client_ip)->first();
        FirewallModel::find($firewall->id)->update([
            'whitelisted' => 1
        ]);
        Cache::flush();
        return redirect(admin_url('tracker/?unblocked=1'));
    }

}
