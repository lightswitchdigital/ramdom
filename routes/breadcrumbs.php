<?php

use Diglactic\Breadcrumbs\Breadcrumbs;

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Главная', route('home'));
});

Breadcrumbs::for('about', function ($trail) {
    $trail->parent('home');
    $trail->push('О нас', route('about'));
});

Breadcrumbs::for('faq', function ($trail) {
    $trail->parent('home');
    $trail->push('О нас', route('faq'));
});

Breadcrumbs::for('projects', function ($trail) {
    $trail->parent('home');
    $trail->push('Проекты', route('projects'));
});
