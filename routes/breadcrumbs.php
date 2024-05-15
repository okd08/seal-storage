<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// ホーム
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('ホーム', route('home'));
});

// ホーム > シール一覧
Breadcrumbs::for('index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('シール一覧', route('seals.index'));
});

// ホーム > シール一覧 > シール詳細
Breadcrumbs::for('show', function (BreadcrumbTrail $trail, $seal) {
    $trail->parent('index');
    $trail->push($seal['name'], route('seals.show', $seal['id']));
});

// ホーム > シール一覧 > シール投稿
Breadcrumbs::for('create', function (BreadcrumbTrail $trail) {
    $trail->parent('index');
    $trail->push('シール投稿', route('seals.create'));
});

// ホーム > シール一覧 > シール編集
Breadcrumbs::for('edit', function (BreadcrumbTrail $trail) {
    $trail->parent('index');
    $trail->push('パッケージ、シール編集');
});

// ホーム > シール一覧 > パッケージ管理
Breadcrumbs::for('index2', function (BreadcrumbTrail $trail) {
    $trail->parent('index');
    $trail->push('パッケージ管理', route('packages.index'));
});

// ホーム > シール一覧 > パッケージ管理 > パッケージ編集
Breadcrumbs::for('edit2', function (BreadcrumbTrail $trail) {
    $trail->parent('index2');
    $trail->push('パッケージ編集');
});