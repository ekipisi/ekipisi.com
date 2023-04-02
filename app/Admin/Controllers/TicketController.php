<?php

namespace App\Admin\Controllers;

use App\Models\TicketModel;
use App\Models\TicketStatusModel;
use App\Models\TicketMessageModel;
use App\Models\TicketPriorityModel;
use App\Models\TicketTypeModel;
use App\Models\AdminModel;
use App\Models\UserModel;
use App\Models\UserProductModel;
use App\Models\DepartmentModel;
use App\Models\UserMailActivityModel;

use App\Http\Controllers\Controller;
use App\Admin\Extensions\Tools\TicketStatus;
use App\Admin\Extensions\Tools\TicketDelete;

use Ekipisi\Admin\Form;
use Ekipisi\Admin\Grid;
use Ekipisi\Admin\Layout\Row;
use Ekipisi\Admin\Layout\Column;
use Ekipisi\Admin\Layout\Content;
use Ekipisi\Admin\Widgets\InfoBox;
use Ekipisi\Admin\Facades\Admin;
use Ekipisi\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class TicketController extends Controller
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

            $content->header('Destek Talepleri');
            $content->description('Liste');
            $content->breadcrumb(
                ['text' => 'Destek Talepleri']
            );
            $content->body($this->grid());
        });
    }

    public function detail($id) {
        return Admin::content(function (Content $content) use ($id) {

            $ticket = TicketModel::where('id', $id)->first();

            $other_tickets = TicketModel::where([
                ['id', '!=', $id],
                ['user_id', $ticket->user_id]
                ])->get();

            $admins = AdminModel::all();
            $statuses = TicketStatusModel::all();
            $departments = DepartmentModel::where('status', 1)->get();
            $priorities = TicketPriorityModel::all();
            $types = TicketTypeModel::all();
                
            $content->header('Destek Talepleri');
            $content->description('Görüntüle');
            $content->breadcrumb(
                ['text' => 'Destek Talepleri', 'url' => admin_url('tickets')],
                ['text' => 'Talep Detayı']
            );
            $content->row(function (Row $row) use ($ticket, $other_tickets, $admins, $statuses, $departments, $priorities, $types) {
                $row->column(12, function (Column $column) use ($ticket, $other_tickets, $admins, $statuses, $departments, $priorities, $types) {
                    $column->append(
                        view('admin.ticket.detail')
                            ->with('ticket', $ticket)
                            ->with('others', $other_tickets)
                            ->with('admins', $admins)
                            ->with('statuses', $statuses)
                            ->with('departments', $departments)
                            ->with('priorities', $priorities)
                            ->with('types', $types)
                            ->with('assign_id', Admin::user()->id)
                    );
                });
            });

        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id) {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('Destek Talepleri');
            $content->description('Düzenle');
            $content->breadcrumb(
                ['text' => 'Destek Talepleri', 'url' => admin_url('tickets')],
                ['text' => 'Talep Düzenle']
            );
            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create(){
        return Admin::content(function (Content $content) {

            $content->header('Destek Talepleri');
            $content->description('Ekle');
            $content->breadcrumb(
                ['text' => 'Destek Talepleri', 'url' => admin_url('tickets')],
                ['text' => 'Talep Ekle']
            );
            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid() {
        return Admin::grid(TicketModel::class, function (Grid $grid) {

            $grid->model()->orderBy('updated_at', 'desc');

            $grid->id('ID')->sortable();

            $grid->user()->firstname('Müşteri')->display(function(){
                return "<a href='".admin_url('users/' . $this->user['id'] . '/detail')."'>" . $this->user['firstname'] . " " . $this->user['lastname'] . "</a>";
            })->sortable();

            $grid->title('Konu')->limit(30)->sortable();

            $grid->messages('Mesajlar')->display(function() {
                return "<center>" . count($this->messages) . "</center>";
            });
            
            $grid->status()->name('Durum')->display(function(){
                return "<span class='label label-" . $this->status['color'] . "'>" . $this->status['name'] . "</span>";
            })->sortable();

            $grid->priority()->name('Öncelik')->display(function(){
                return "<span class='label label-" . $this->priority['color'] . "'>" . $this->priority['name'] . "</span>";
            })->sortable();

            $grid->type()->name('Tip')->display(function(){
                if ($this->type==0) {
                    return "<center>-</center>";
                } else {
                    return "<span class='label label-" . $this->type['color'] . "'>" . $this->type['name'] . "</span>";
                }
            })->sortable();

            $grid->departman()->name('Departman')->sortable();

            $grid->created_at('Eklenme')->display(function() {
                return "<span data-toggle=\"tooltip\" data-placement=\"bottom\" data-html=\"true\" title='" . Carbon::parse($this->created_at)->format("d M Y, H:i") . "'>" . Carbon::parse($this->created_at)->diffForHumans() . "</span>" ;
            });
            $grid->updated_at('Güncellenme')->display(function() {
                return "<span data-toggle=\"tooltip\" data-placement=\"bottom\" data-html=\"true\" title='" . Carbon::parse($this->updated_at)->format("d M Y, H:i") . "'>" . Carbon::parse($this->updated_at)->diffForHumans() . "</span>" ;
            });

            $grid->tools(function ($tools) {
                $tools->batch(function ($batch) {
                    $batch->disableDelete();
                    $batch->add('Talepleri Kapat', new TicketStatus(2));
                });
            });

            $grid->actions(function ($actions) {                
                // $actions->disableEdit();
                $actions->disableDelete();
                $actions->prepend('<a href="' . admin_url('tickets/' . $actions->row->id . '/detail') . '" target="_self" class="disable-pjax btn btn-success btn-xs"><i class="fa fa-eye"></i></a>&nbsp;');
            });

            $grid->disableExport();
            $grid->paginate(config('admin.page.size'));

            $grid->filter(function (Grid\Filter $filter) {
                
                $filter->disableIdFilter();

                $filter->like('title', 'Başlık');

                $filter->where(function ($query) {
                    $query->where('priority_id', "{$this->input}");
                }, 'Öncelik')->select(TicketPriorityModel::all()->pluck('name', 'id'));

                $filter->where(function ($query) {
                    $query->where('status_id', "{$this->input}");
                }, 'Durum')->select(TicketStatusModel::all()->pluck('name', 'id'));

                $filter->where(function ($query) {
                    $query->where('department_id', "{$this->input}");
                }, 'Departman')->select(DepartmentModel::all()->pluck('name', 'id'));

                $filter->where(function ($query) {
                    $query->where('type_id', "{$this->input}");
                }, 'Tip')->select(TicketTypeModel::all()->pluck('name', 'id'));

            });

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form() {
        return Admin::form(TicketModel::class, function (Form $form) {

            $form->select('user_id', 'Müşteri')->options(function ($user_id) {
                $user = UserModel::find($user_id);
                if ($user) {
                    return [$user->id => $user->firstname . ' ' . $user->lastname];
                }
            })->ajax(admin_url('api/user'))
            ->load('service_id', admin_url('api/userproduct'))->rules('required')->setWidth(3);

            $form->select('status_id', 'Durum')->options(function ($status_id) {
                $status = TicketStatusModel::find($status_id);
                if ($status) {
                    return [$status->id => $status->name];
                }
            })->ajax(admin_url('api/ticketstatus'))->rules('required')->setWidth(3);

            $form->select('department_id', 'Departman')->options(function ($department_id) {
                $department = DepartmentModel::find($department_id);
                if ($department) {
                    return [$department->id => $department->name];
                }
            })->ajax(admin_url('api/department'))->rules('required')->setWidth(3);

            $form->select('service_id', 'Hizmet')->options(function ($service_id) {
                $product = UserProductModel::find($service_id);
                if ($product) {
                    return [$product->id => $product->title];
                }
            })->setWidth(3);

            $form->select('priority_id', 'Öncelik')->options(function ($priority_id) {
                $priority = TicketPriorityModel::find($priority_id);
                if ($priority) {
                    return [$priority->id => $priority->name];
                }
            })->ajax(admin_url('api/ticketpriority'))->rules('required')->setWidth(3);

            $form->select('type_id', 'Tip')->options(function ($type_id) {
                $type = TicketTypeModel::find($type_id);
                if ($type) {
                    return [$type->id => $type->name];
                }
            })->ajax(admin_url('api/tickettype'))->rules('required')->setWidth(3);

            $form->text('title', 'Başlık')->rules('required')->setWidth(4);
            $form->simplemde('message', 'Mesaj')->setWidth(8);
            $form->multipleImage('file', 'Dosya Eki')->setWidth(4);

            $form->text('ip', 'Ip Adresi')->value(\Request::ip())->rules('required')->setWidth(4);

            $form->hidden('id');
            $form->hidden('created_at');
            $form->hidden('updated_at');


            $form->saved(function (Form $form){

                $ticket_id = $form->model()->id;

                $ticket = TicketModel::where('id', $ticket_id)->first();
                $user = UserModel::where('id', $ticket->user_id)->first();

                $name = $user->firstname . " " . $user->lastname;
                $email = $user->email;
                $title = $ticket->title;
                $message = $ticket->message;
        
                $data = array(
                    'id' => $ticket_id,
                    'title' => $title,
                    'status' => $ticket->status['name'],
                    'description' => $message,
                    'name' => $name,
                    'email' => $email,
                    'activity_id' => 0
                );

                $activity = UserMailActivityModel::create([
                    'user_id' => $ticket->user_id,
                    'title' => $title,
                    'message' => view('mail/admin/support/create', $data),
                    'read' => 0
                ]);

                $data['activity_id'] = $activity->id;
        
                \Mail::send('mail/admin/support/create', $data, function ($message) use ($name, $email, $user, $activity, $ticket_id, $title) {
                    $message
                        ->to($email, $name)
                        ->from(config('support.mail'), config('app.name'))
                        ->replyTo(config('support.reply'), config('app.name'))
                        ->subject('[Ticket ID: ' . $ticket_id . '] ' . $title)
                        ->embedData([
                            'categories' => ['ekipisi_support_create'],
                            'custom_args' => [
                                'user_id' => strval($user->id),
                                'name' => strval($name),
                                'email' => strval($email),
                                'ticket_id' => strval($ticket_id),
                                'activity_id' => strval($activity->id)
                            ]
                        ], 'sendgrid/x-smtpapi');
                });

            });


        });
    }

    public function close(Request $request)
    {
        foreach (TicketModel::find($request->get('ids')) as $ticket) {
            $ticket->status_id = $request->get('action');
            $ticket->save();
        }
    }

    public function delete(Request $request, $id){
        TicketMessageModel::where('ticket_id', $id)->delete();
        TicketModel::destroy($id);
        return redirect(admin_url('tickets/'));
    }

    public function update(Request $request, $id){
        TicketModel::find($id)->update([
            'status_id' => $request->status,
            'department_id' => $request->department,
            'priority_id' => $request->priority,
            'type_id' => $request->type,
            'notes' => $request->note,
        ]);
        return redirect(admin_url('tickets/' . $id . '/detail'));
    }

    public function addreply(Request $request, $id){

        if (!empty($request->message)) {

            $multiple_path = array();

            if ($request->file) {
                for ($i = 0; $i < count($request->file); $i++) {
                    array_push($multiple_path, $request->file[$i]->store($id, 'warden'));
                }
            }

            TicketMessageModel::create([
                'ticket_id' => $id,
                'assign_id' => $request->assign_id,
                'user_id' => 0,
                'message' => $request->message,
                'file' => $multiple_path,
                'ip' => \Request::ip()
            ]);

            TicketModel::find($id)->update([
                'status_id' => config('support.admin.status')
            ]);
    
            $ticket = TicketModel::where('id', $id)->first();
            $user = UserModel::where('id', $ticket->user_id)->first();
    
            $name = $user->firstname . " " . $user->lastname;
            $email = $user->email;
            $title = $ticket->title;
            $department = $ticket->department['name'];
            $status = $ticket->status['name'];
    
            $data = array(
                'id' => $id,
                'title' => $title,
                'description' => $request->message,
                'name' => $name,
                'email' => $email,
                'department' => $department,
                'status' => $status,
                'activity_id' => 0
            );
    
            $activity = UserMailActivityModel::create([
                'user_id' => $ticket->user_id,
                'title' => '[Ticket ID: ' . $id . '] ' . $title,
                'message' => view('mail/admin/support/reply', $data),
                'read' => 0
            ]);

            $data['activity_id'] = $activity->id;
    
            \Mail::send('mail/admin/support/reply', $data, function ($message) use ($name, $email, $user, $ticket, $activity, $id, $title) {
                $message
                    ->to($email, $name)
                    ->from(config('support.mail'), config('app.name'))
                    ->replyTo(config('support.reply'), config('app.name'))
                    ->subject('[Ticket ID: ' . $id . '] ' . $title)
                    ->embedData([
                        'categories' => ['ekipisi_register'],
                        'custom_args' => [
                            'user_id' => strval($user->id),
                            'name' => strval($name),
                            'email' => strval($email),
                            'ticket_id' => strval($ticket->id),
                            'activity_id' => strval($activity->id)
                        ]
                    ], 'sendgrid/x-smtpapi');
            });

        }
        return redirect(admin_url('tickets/' . $id . '/detail'));
    }

    public function deletereply(Request $request, $id, $reply_id){
        TicketMessageModel::destroy($reply_id);
        return redirect(admin_url('tickets/' . $id . '/detail'));
    }


    public function merge(Request $request, $id) {

        $merged_id = $request->merged_id;
        $ticket = TicketModel::where('id', $id)->first();
    
        $messages = TicketMessageModel::where('ticket_id', $id)->get();

        $files = [];
        if (count($ticket->file)>0)
        foreach($ticket->file as $file){
            array_push($files, $file);
        }

        TicketMessageModel::create([
            'ticket_id' => $merged_id,
            'assign_id' => 0,
            'user_id' => $ticket->user_id,
            'message' => $ticket->message,
            'file' => $files,
            'ip' => $ticket->ip
        ]);

        foreach($messages as $message) {
            TicketMessageModel::find($message->id)->update([
                'ticket_id' => $merged_id
            ]);
        }

        TicketModel::destroy($id);
        return redirect(admin_url('tickets/' . $merged_id . '/detail'));
    }


}
