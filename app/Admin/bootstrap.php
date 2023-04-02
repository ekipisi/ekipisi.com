<?php

use Ekipisi\Admin\Form;
use Ekipisi\Admin\Widgets\Navbar;
use Ekipisi\Admin\Grid\Column;

use App\Admin\Extensions\Editor\summernote;
use App\Admin\Extensions\Editor\simplemde;
use App\Admin\Extensions\Editor\wangeditor;
use App\Admin\Extensions\Editor\phpeditor;

use App\Admin\Extensions\Column\ExpandRow;
use App\Admin\Extensions\Column\UrlWrapper;
use App\Admin\Extensions\Column\Status;
use App\Admin\Extensions\Column\Popover;

use App\Admin\Extensions\Nav\LinksLeft;
use App\Admin\Extensions\Nav\LinksRight;

Ekipisi\Admin\Form::forget(['map', 'editor']);

Form::extend('editor', wangeditor::class);
Form::extend('summernote', summernote::class);
Form::extend('simplemde', simplemde::class);
// Form::extend('codemirror', phpeditor::class);

Column::extend('expand', ExpandRow::class);
Column::extend('urlwrapper', UrlWrapper::class);
Column::extend('status', Status::class);
Column::extend('popover', Popover::class);
Column::extend('prependicon', function ($value, $icon) {
    if ($value)
        return "<i class='fa fa-fw fa-$icon'></i> $value";
    else
        return "-";
});
Column::extend('color', function ($value) {
    return "<span style='display:inline-block; margin-top:2px; width:27px; height:27px; border: 1px solid $value; border-radius: 4px; background-color: $value'></span>";
});
Column::extend('thumb', function ($value) {
    if ($value) {
        $name = basename($value);
        return "<img src=\"".Storage::disk('warden')->url($value)."\" class=\"img img-thumbnail external\" width=\"24\">";
    }
    else 
        return "";
});

Admin::js('/vendor/chartjs/Chart.bundle.js');
Admin::js('/vendor/jvectormap/jquery-jvectormap-2.0.3.min.js');
Admin::js('/vendor/jvectormap/jquery-jvectormap-world-mill-en.js');
Admin::js('/vendor/bootstrap-maxlength/bootstrap-maxlength.js');
Admin::js('/vendor/easy-autocomplete/jquery.easy-autocomplete.js');
Admin::js('/vendor/prism/prism.js');
Admin::js('/vendor/bootstrap-select/js/bootstrap-select.js');
Admin::js('/vendor/bootstrap-select/js/i18n/defaults-tr_TR.js');
Admin::js('/vendor/clipboard/dist/clipboard.min.js');
Admin::js('/vendor/simplemde/simplemde.min.js');
Admin::js('/vendor/laramanager/sorttable.js');
Admin::js('/js/admin.js');

Admin::css('/vendor/prism/prism.css');
Admin::css('/vendor/jvectormap/jquery-jvectormap-2.0.3.css');
Admin::css('/vendor/bootstrap-select/css/bootstrap-select.css');
Admin::css('/vendor/easy-autocomplete/easy-autocomplete.css');
Admin::css('/vendor/easy-autocomplete/easy-autocomplete.themes.css');
Admin::css('/vendor/simplemde/simplemde.min.css');
Admin::css('/vendor/admin.css');

Admin::navbar(function (Navbar $navbar) {
    $navbar->left(new LinksLeft());
    $navbar->right(new LinksRight());
});
