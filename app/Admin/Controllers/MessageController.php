<?php

namespace App\Admin\Controllers;

use App\Models\MessageModel;
use App\Http\Controllers\Controller;

use Ekipisi\Admin\Form;
use Ekipisi\Admin\Grid;
use Ekipisi\Admin\Layout\Row;
use Ekipisi\Admin\Layout\Column;
use Ekipisi\Admin\Layout\Content;
use Ekipisi\Admin\Facades\Admin;
use Ekipisi\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MessageController extends Controller
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

            $content->header('Mesajlar');
            $content->description('Liste');
            $content->breadcrumb(
                ['text' => 'Mesajlar']
            );
            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $message = MessageModel::where('id', $id)->first();

            MessageModel::find($id)->update(['read' => 1]);

            $content->header('Mesajlar');
            $content->description('Görüntüle');
            $content->breadcrumb(
                ['text' => 'Mesajlar', 'url' => admin_url('messages')],
                ['text' => 'Detay']
            );
            $content->row(function (Row $row) use ($message) {
                $row->column(12, function (Column $column) use ($message) {
                    $column->append(view('admin.message.detail')->with('message', $message));
                });
            });
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(MessageModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            
            $grid->type('Tip')->display(function(){
                $tip = "";
                if ($this->type == 1)
                    $tip = "İletişim";
                elseif ($this->type ==2)
                    $tip = "Demo";
                elseif ($this->type==3)
                    $tip = "Arayalım";
                elseif ($this->type==4)
                    $tip = "Sipariş";
                if ($this->note)
                    return "<span data-toggle=\"tooltip\" data-placement=\"bottom\" data-html=\"true\" title=\"<p>" . str_limit($this->note, $limit = 14, $end = '...') . "</p>\" style=\"text-decoration:underline\">" . $tip . "</span>";
                else
                    return $tip;
            })->sortable();

            $grid->read('Okundumu')->display(function() {
                if ($this->read)
                    return "<center><i class='fa fa-fw fa-envelope-open-o text-muted'></i></center>";
                else
                    return "<center><i class='fa fa-fw fa-envelope-o text-green'></i></center>";
            })->sortable();

            $grid->newsletter('Bülten')->status()->sortable();

            $grid->firstname('Ad Soyad')->display(function(){
                return $this->firstname . " " . $this->lastname;
            });

            $grid->email('E-posta');

            $grid->phone('Telefon')->display(function(){
                if ($this->phone) 
                   return $this->phone;
                else
                    return "<center>-</center>";
            });

            $grid->subject('Konu')->display(function() {
                if ($this->subject){
                    return str_limit($this->subject, $limit = 30, $end = '...');
                } else {
                    return "-";
                }
            });

            $grid->created_at("Eklenme Tarihi")->sortable();

            $grid->model()->orderBy('created_at', 'desc');

            $grid->tools(function ($tools) {
                $tools->batch(function ($batch) {
                    $batch->disableDelete();
                });
            });
            
            $grid->actions(function ($actions) {
                $actions->disableDelete();
                $actions->disableEdit();
                $actions->append('<a href="' . admin_url('messages/' . $actions->row->id . '/edit') . '" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>');
            });

            $grid->filter(function (Grid\Filter $filter) {
                
                $filter->disableIdFilter();

                $filter->where(function ($query) {
                    $query->where('type', "{$this->input}");
                }, 'Tip')->select([1=> 'İletişim', 2 => 'Demo', 3 => 'Arayalım', 4 => 'Sipariş']);

                $filter->like('firstname', 'Ad');
                $filter->like('lastname', 'Soyad');
                $filter->like('subject', 'Konu');
                $filter->like('email', 'E-Posta');
                $filter->like('phone', 'Telefon');

                $filter->equal('status', 'Durum')->radio([
                    ''   => 'Tümü',
                    0    => 'Okunmadı',
                    1    => 'Okundu',
                ]);

            });

            $grid->disableRowSelector();
            $grid->disableCreateButton();
            $grid->disableExport();
            $grid->paginate(config('admin.page.size'));
        });
    }

    public function updatenote(Request $request, $id){
        MessageModel::find($id)->update(['note' => $request->message]);
        return redirect(admin_url('messages/' . $id . '/edit'));
    }

}
