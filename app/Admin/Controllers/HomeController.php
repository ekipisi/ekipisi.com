<?php

namespace App\Admin\Controllers;

use App\Models\UserModel;
use App\Models\BillingModel;
use App\Models\TicketModel;
use App\Models\UserActivityModel;

use App\Http\Controllers\Controller;
use Ekipisi\Admin\Controllers\Dashboard;
use Ekipisi\Admin\Facades\Admin;
use Ekipisi\Admin\Layout\Column;
use Ekipisi\Admin\Layout\Content;
use Ekipisi\Admin\Layout\Row;
use Ekipisi\Admin\Widgets\InfoBox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Spatie\Analytics\Period;
use Activity;

class HomeController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        return Admin::content(function (Content $content) use($request) {

            UserActivityModel::where('user_id', Admin::user()->id)->delete();

            // Admin::script($this->script());

            $day = 30;
            if (isset($request->day)) {
                $day = $request->day;
            }

            try {
                $fetchUserTypes = Cache::remember('fetchUserTypes-' . $day, 0, function () use ($day) {
                    $fetchUserTypes = \Analytics::fetchUserTypes(Period::days($day));
                    $fetchUserTypes_rows = [];
                    foreach ($fetchUserTypes as $analytics) {
                        array_push($fetchUserTypes_rows, $analytics);
                    }
                    return $fetchUserTypes_rows;
                });

                $fetchMostVisitedPages = Cache::remember('fetchMostVisitedPages-' . $day, 0, function () use ($day) {
                    $fetchMostVisitedPages = \Analytics::fetchMostVisitedPages(Period::days($day), 180);
                    $mostvisited_rows = [];
                    foreach ($fetchMostVisitedPages as $analytics) {
                        array_push($mostvisited_rows, [$analytics['url'], $analytics['pageTitle'], $analytics['pageViews']]);
                    }
                    return $mostvisited_rows;
                });

                $fetchTotalVisitorsAndPageViews = Cache::remember('fetchTotalVisitorsAndPageViews-' . $day, 30, function () use ($day) {
                    $fetchTotalVisitorsAndPageViews = \Analytics::fetchTotalVisitorsAndPageViews(Period::days($day), 10);
                    $totalvisitor_rows = [];
                    foreach ($fetchTotalVisitorsAndPageViews as $analytics) {
                        array_push($totalvisitor_rows, [date_format($analytics['date'], 'd.m.Y'), $analytics['visitors'], $analytics['pageViews']]);
                    }
                    return $totalvisitor_rows;
                });

                $cities = Cache::remember('cities-' . $day, 30, function () use ($day) {
                    $cities = \Analytics::performQuery(Period::days($day), "ga:sessions,ga:pageviews", ['dimensions' => 'ga:city,ga:latitude,ga:longitude'])->rows;
                    $cities_rows = [];
                    foreach ($cities as $city) {
                        array_push($cities_rows, [$city[0], $city[1], $city[2], $city[3], $city[4]]);
                    }
                    return $cities_rows;
                });

                $fetchTopBrowsers = Cache::remember('fetchTopBrowsers-' . $day, 0, function () use ($day) {
                    $fetchTopBrowsers = \Analytics::fetchTopBrowsers(Period::days($day), 180);
                    $fetchTopBrowsers_rows = [];
                    foreach ($fetchTopBrowsers as $analytics) {
                        array_push($fetchTopBrowsers_rows, $analytics);
                    }
                    return $fetchTopBrowsers_rows;
                });

                $fetchTopReferrers = Cache::remember('fetchTopReferrers-' . $day, 0, function () use ($day) {
                    $fetchTopReferrers = \Analytics::fetchTopReferrers(Period::days($day), 180);
                    $fetchTopReferrers_rows = [];
                    foreach ($fetchTopReferrers as $analytics) {
                        array_push($fetchTopReferrers_rows, $analytics);
                    }
                    return $fetchTopReferrers_rows;
                });

                $fetchKeywords = Cache::remember('fetchKeywords-' . $day, 0, function () use ($day) {
                    $fetchKeywords = \Analytics::performQuery(Period::days($day), "ga:sessions", ['dimensions' => 'ga:keyword'], ['sort' => '-ga:sessions'])->rows;
                    $fetchKeywords_rows = [];
                    foreach ($fetchKeywords as $analytics) {
                        if ($analytics[0] != "(not provided)" && $analytics[0] != "(not set)" && $analytics[1] > 4) {
                            array_push($fetchKeywords_rows, ['keyword' => $analytics[0], 'session' => $analytics[1]]);
                        }
                    }
                    return $fetchKeywords_rows;
                });
            } catch (\Exception $e) {
                \Debugbar::addThrowable($e);
            }


            $content->header('Dashboard');
            $content->breadcrumb(
                ['text' => 'Dashboard']
            );
            $content->description('');

            try {
                $content->row(function (Row $row) use ($cities, $fetchMostVisitedPages, $fetchTotalVisitorsAndPageViews, $fetchUserTypes) {
                    $row->column(8, function (Column $column) use ($cities, $fetchTotalVisitorsAndPageViews) {
                        $column->append(view('admin.dashboard.city')->with('cities_rows', $cities));
                        $column->append(view('admin.dashboard.analytics')->with('totalvisitor_rows', $fetchTotalVisitorsAndPageViews));
                    });
                    $row->column(4, function (Column $column) use ($fetchMostVisitedPages, $fetchUserTypes) {
                        $column->append(view('admin.dashboard.visitor')->with('fetchUserTypes_rows', $fetchUserTypes));
                        // $column->append(view('admin.dashboard.page')->with('mostvisited_rows', $fetchMostVisitedPages));
                        $column->append(view('admin.dashboard.users')
                            ->with('online_users', \Tracker::onlineUsers())
                            ->with('ip', \Request::ip())
                            );
                    });
                });

                $content->row(function (Row $row) use ($fetchTopBrowsers, $fetchTopReferrers, $fetchKeywords, $fetchMostVisitedPages) {
                    $row->column(4, function (Column $column) use ($fetchTopBrowsers) {
                        $column->append(view('admin.dashboard.browser')->with('browsers_rows', $fetchTopBrowsers));
                    });
                    $row->column(4, function (Column $column) use ($fetchTopReferrers) {
                        $column->append(view('admin.dashboard.referrer')->with('referrers_rows', $fetchTopReferrers));
                    });
                    $row->column(4, function (Column $column) use ($fetchKeywords, $fetchMostVisitedPages) {
                        // $column->append(view('admin.dashboard.keyword')->with('keywords_rows', $fetchKeywords));
                        $column->append(view('admin.dashboard.page')->with('mostvisited_rows', $fetchMostVisitedPages));
                    });
                });

                $content->row(function (Row $row) {
                    $row->column(4, function (Column $column){
                        $activities = Activity::usersByMinutes(10)->get();
                        $numberOfUsers = Activity::users()->count(); 
                        $numberOfGuests = Activity::guests()->count();
    
                        $column->append(view('admin.dashboard.activities')
                            ->with('activities', $activities)
                            ->with('numberOfUsers', $numberOfUsers)
                            ->with('numberOfGuests', $numberOfGuests));
                    });

                    $row->column(4, function (Column $column){
                        $mostRecent = Activity::users()->mostRecent()->get();
                        $column->append(view('admin.dashboard.mostrecent')
                            ->with('activities', $mostRecent));
                    });

                    $row->column(4, function (Column $column){
                        $leastRecent = Activity::users()->leastRecent()->get();
                        $column->append(view('admin.dashboard.leastrecent')
                            ->with('activities', $leastRecent));
                    });

                });

            } catch
            (\Exception $e) {
                \Debugbar::addThrowable($e);
            }

        });
    }

    protected function script()
    {
        $title = config('admin.title');

        return <<<EOT
        $("#currency_refresh").click();
EOT;
    }
}
