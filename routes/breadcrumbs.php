<?php

declare(strict_types=1);

use App\Domain\Acl\Models\Role;
use App\Domain\Admin\Models\Admin;
use App\Domain\Option\Models\OptionType;
use App\Domain\Page\Models\Page;
use App\Domain\Post\Models\Post;
use App\Domain\Taxonomy\Models\Taxon;
use App\Domain\Taxonomy\Models\Taxonomy;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

// Home
Breadcrumbs::for('admin.dashboard', function (BreadcrumbsGenerator $trail) {
    $trail->push(__('Trang chủ'), route('admin.dashboard'), ['icon' => 'icon-home2']);
});

// Home => Account Settings
Breadcrumbs::for('admin.account-settings.edit', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('Thiết lập tài khoản'), route('admin.account-settings.edit'));
});


/*
|--------------------------------------------------------------------------
| Application Breadcrumbs
|--------------------------------------------------------------------------
*/
// Home > Taxonomies
Breadcrumbs::for('admin.taxonomies.index', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('Danh mục'), route('admin.taxonomies.index'), ['icon' => 'icon-people']);
});

// Home > Taxonomies > Create

Breadcrumbs::for('admin.taxonomies.create', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.taxonomies.index');
    $trail->push(__('Tạo'), route('admin.taxonomies.create'));
});

// Home > Taxonomies > [taxonomy] > Edit
Breadcrumbs::for('admin.taxonomies.edit', function (BreadcrumbsGenerator $trail, Taxonomy $taxonomy) {
    $trail->parent('admin.taxonomies.index');
    $trail->push($taxonomy->name, '#');
    $trail->push(__('Chỉnh sửa'), route('admin.taxonomies.edit', $taxonomy));
});

// Home > Taxons > [taxon] > Edit
Breadcrumbs::for('admin.taxons.edit', function (BreadcrumbsGenerator $trail, Taxon $taxon) {
    $trail->push(__('Taxons'), '#');
    $trail->push($taxon->name, '#');
    $trail->push(__('Chỉnh sửa'), route('admin.taxons.edit', $taxon));
});

// Home > Posts
Breadcrumbs::for('admin.posts.index', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('Danh sách bài viết'), route('admin.admins.index'), ['icon' => 'icon-people']);
});

// Home > Posts > Create

Breadcrumbs::for('admin.posts.create', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.posts.index');
    $trail->push(__('Tạo'), route('admin.posts.create'));
});

// Home > Posts > [admin] > Edit
Breadcrumbs::for('admin.posts.edit', function (BreadcrumbsGenerator $trail, Post $post) {
    $trail->parent('admin.posts.index');
    $trail->push($post->title, '#');
    $trail->push(__('Chỉnh sửa'), route('admin.posts.edit', $post));
});

/*
|--------------------------------------------------------------------------
| System Breadcrumbs
|--------------------------------------------------------------------------
*/

// Home > Admins
Breadcrumbs::for('admin.admins.index', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('Tài khoản'), route('admin.admins.index'), ['icon' => 'icon-people']);
});

// Home > Admins > Create

Breadcrumbs::for('admin.admins.create', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.admins.index');
    $trail->push(__('Tạo'), route('admin.admins.create'));
});

// Home > Admins > [admin] > Edit
Breadcrumbs::for('admin.admins.edit', function (BreadcrumbsGenerator $trail, Admin $admin) {
    $trail->parent('admin.admins.index');
    $trail->push($admin->email, '#');
    $trail->push(__('Chỉnh sửa'), route('admin.admins.edit', $admin));
});

// Home > Roles
Breadcrumbs::for('admin.roles.index', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('Quyền'), route('admin.roles.index'), ['icon' => 'icon-shield2']);
});

// Home > Roles > Create

Breadcrumbs::for('admin.roles.create', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.roles.index');
    $trail->push(__('Tạo'), route('admin.roles.create'));
});

// Home > Roles > [role] > Edit
Breadcrumbs::for('admin.roles.edit', function (BreadcrumbsGenerator $trail, Role $role) {
    $trail->parent('admin.roles.index');
    $trail->push($role->display_name, '#');
    $trail->push(__('Edit'), route('admin.roles.edit', $role));
});

// Home > Pages
Breadcrumbs::for('admin.pages.index', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('Pages'), route('admin.pages.index'), ['icon' => 'icon-people']);
});

// Home > Pages > Create

Breadcrumbs::for('admin.pages.create', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.pages.index');
    $trail->push(__('Create'), route('admin.pages.create'));
});

// Home > Admins > [admin] > Edit
Breadcrumbs::for('admin.pages.edit', function (BreadcrumbsGenerator $trail, Page $page) {
    $trail->parent('admin.pages.index');
    $trail->push(__('Edit'), route('admin.pages.edit', $page));
});

// Home > Admins > [admin] > Update
Breadcrumbs::for('admin.pages.update', function (BreadcrumbsGenerator $trail, Page $page) {
    $trail->parent('admin.pages.index');
    $trail->push(__('Update'), route('admin.pages.update', $page));
});
