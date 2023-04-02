<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use Ekipisi\Admin\Controllers\ModelForm;
use App\Http\Controllers\Controller;

use App\Models\CurrencyModel;
use App\Models\UserModel;
use App\Models\UserProductModel;
use App\Models\DepartmentModel;
use App\Models\TicketStatusModel;
use App\Models\TicketPriorityModel;
use App\Models\TicketTypeModel;
use App\Models\CountryModel;
use App\Models\ZoneModel;
use App\Models\TaxOfficeModel;

class ApiController extends Controller
{
    use ModelForm;

    public function makeurl(Request $request)
    {
        $name = $request->get('q');
        return str_slug($name, '-');
    }

    public function refresh_currency()
    {
        $json = file_get_contents('https://www.doviz.com/api/v2/currencies/all/latest');
        $currencies = json_decode($json);

        foreach($currencies as $currency) {
            if ($currency->code=="USD" || $currency->code=="EUR" ) {
                CurrencyModel::where('code', $currency->code)->update(['value' => 1 / $currency->selling]);
            }
        }
        return "OK";
    }

    public function currency(Request $request)
    {
        $q = $request->get('q');
        return CurrencyModel::where('title', 'like', "%$q%")->paginate(null, ['id', 'title as text']);
    }

    public function user(Request $request)
    {
        $q = $request->get('q');
        return UserModel::where('firstname', 'like', "%$q%")->orWhere('id', "%$q%")->paginate(null, ['id', 'firstname as text']);
    }
    
    public function userproduct(Request $request)
    {
        $q = $request->get('q');
        return UserProductModel::where('title', 'like', "%$q%")->paginate(null, ['id', 'title as text']);
    }

    public function userservice(Request $request)
    {
        $user_id = $request->get('q');
        return UserProductModel::where('user_id', $user_id)->paginate(null, ['id', 'title as text']);
    }

    public function userservicedetail(Request $request)
    {
        $id = $request->get('q');
        return UserProductModel::where('id', $id)->paginate(50);
    }
    
    public function department(Request $request)
    {
        $q = $request->get('q');
        return DepartmentModel::where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }

    public function ticketstatus(Request $request)
    {
        $q = $request->get('q');
        return TicketStatusModel::where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }

    public function ticketpriority(Request $request)
    {
        $q = $request->get('q');
        return TicketPriorityModel::where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }

    public function tickettype(Request $request)
    {
        $q = $request->get('q');
        return TicketTypeModel::where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }

    public function country(Request $request)
    {
        $q = $request->get('q');
        return CountryModel::where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }

    public function zone(Request $request)
    {
        $id = $request->get('q');
        return ZoneModel::where('id', $id)->paginate(50);
    }

    public function zone_list(Request $request)
    {
        $q = $request->get('q');
        return ZoneModel::where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }

    public function taxoffice(Request $request)
    {
        $q = $request->get('q');
        return TaxOfficeModel::where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }

    public function domain_user(Request $request)
    {
        $domain = $request->get('q');
        return UserProductModel::where('domain', 'like', "%$domain%")->first();
    }

}