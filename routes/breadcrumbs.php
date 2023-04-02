<?php
Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push(__('navigation.user.home'), route('home'));
});

Breadcrumbs::register('contact', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('contact.title'), route('contact'));
});

Breadcrumbs::register('about', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('about.title'), route('about'));
});

Breadcrumbs::register('reference', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('reference.title'), route('reference'));
});

Breadcrumbs::register('payment', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('payment.title'), route('payment'));
});

Breadcrumbs::register('product.ecommerce.pack', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('product.pack.title'), route('product.ecommerce.pack'));
});

Breadcrumbs::register('product.ecommerce.module', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('product.module.title'), route('product.ecommerce.module'));
});

Breadcrumbs::register('service.project', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('service.project.title'), route('service.project'));
});

Breadcrumbs::register('service.website', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('service.website.title'), route('service.website'));
});

Breadcrumbs::register('service.google', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('service.google.title'), route('service.google'));
});

Breadcrumbs::register('user.home', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('user.title'), route('user.home'));
});

Breadcrumbs::register('user.solutions', function ($breadcrumbs) {
    $breadcrumbs->parent('user.home');
    $breadcrumbs->push(__('user.solution.title'), route('user.solutions'));
});

Breadcrumbs::register('user.announce.home', function ($breadcrumbs) {
    $breadcrumbs->parent('user.home');
    $breadcrumbs->push(__('user.announce.title'), route('user.announce.home'));
});

Breadcrumbs::register('user.announce.detail', function ($breadcrumbs) {
    $breadcrumbs->parent('user.announce.home');
    $breadcrumbs->push(__('user.announce.detail.title'), route('user.announce.detail', ['id' => 1, 'domain' => 'none']));
});

Breadcrumbs::register('user.profile', function ($breadcrumbs) {
    $breadcrumbs->parent('user.home');
    $breadcrumbs->push(__('user.profile.title'), route('user.profile'));
});

Breadcrumbs::register('user.password', function ($breadcrumbs) {
    $breadcrumbs->parent('user.home');
    $breadcrumbs->push(__('user.password.title'), route('user.password'));
});

Breadcrumbs::register('user.email.home', function ($breadcrumbs) {
    $breadcrumbs->parent('user.home');
    $breadcrumbs->push(__('user.email.title'), route('user.email.home'));
});

Breadcrumbs::register('user.support.home', function ($breadcrumbs) {
    $breadcrumbs->parent('user.home');
    $breadcrumbs->push(__('user.support.title'), route('user.support.home'));
});

Breadcrumbs::register('user.support.add', function ($breadcrumbs) {
    $breadcrumbs->parent('user.support.home');
    $breadcrumbs->push(__('user.support.add.title'), route('user.support.add'));
});

Breadcrumbs::register('user.support.detail', function ($breadcrumbs) {
    $breadcrumbs->parent('user.support.home');
    $breadcrumbs->push(__('user.support.detail.title'), route('user.support.detail', 1));
});

Breadcrumbs::register('user.service.home', function ($breadcrumbs) {
    $breadcrumbs->parent('user.home');
    $breadcrumbs->push(__('user.service.title'), route('user.service.home'));
});

Breadcrumbs::register('user.service.detail', function ($breadcrumbs) {
    $breadcrumbs->parent('user.service.home');
    $breadcrumbs->push(__('user.service.detail.title'), route('user.service.detail', 0));
});

Breadcrumbs::register('user.billing.home', function ($breadcrumbs) {
    $breadcrumbs->parent('user.home');
    $breadcrumbs->push(__('user.billing.title'), route('user.billing.home'));
});

Breadcrumbs::register('user.billing.payment', function ($breadcrumbs) {
    $breadcrumbs->parent('user.billing.home');
    $breadcrumbs->push(__('user.billing.payment.title'), route('user.billing.payment', 1));
});

Breadcrumbs::register('user.faq.home', function ($breadcrumbs) {
    $breadcrumbs->parent('user.home');
    $breadcrumbs->push(__('user.faq.title'), route('user.faq.home'));
});

Breadcrumbs::register('user.faq.search', function ($breadcrumbs) {
    $breadcrumbs->parent('user.faq.home');
    $breadcrumbs->push(__('user.faq.search.title'), route('user.faq.search'));
});

Breadcrumbs::register('user.faq.category', function ($breadcrumbs, $id) {
    $category = \App\Models\FaqCategoryModel::where('id', $id)->first();
    $breadcrumbs->parent('user.faq.home');
    $breadcrumbs->push($category->name, route('user.faq.category', $id));
});

Breadcrumbs::register('user.faq.detail', function ($breadcrumbs, $id) {
    $faq = \App\Models\FaqModel::where('id', $id)->first();
    $breadcrumbs->parent('user.faq.category', $faq->category_id);
    $breadcrumbs->push($faq->name, route('user.faq.detail', $id));
});

Breadcrumbs::register('user.partnership.home', function ($breadcrumbs) {
    $breadcrumbs->parent('user.home');
    $breadcrumbs->push(__('user.partnership.title'), route('user.partnership.home'));
});

Breadcrumbs::register('user.partnership.add', function ($breadcrumbs) {
    $breadcrumbs->parent('user.partnership.home');
    $breadcrumbs->push(__('user.partnership.add.title'), route('user.partnership.add'));
});