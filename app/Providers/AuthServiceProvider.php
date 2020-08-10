<?php

namespace App\Providers;

use App\Domain\Acl\Models\Role;
use App\Domain\Admin\Models\Admin;
use App\Domain\Admin\Policies\AdminPolicy;
use App\Domain\Acl\Policies\RolePolicy;
use App\Domain\Option\Models\OptionType;
use App\Domain\Option\Policies\OptionTypePolicy;
use App\Domain\Taxon\Policies\TaxonPolicy;
use App\Domain\Taxonomy\Models\Taxon;
use App\Domain\Taxonomy\Models\Taxonomy;
use App\Domain\Taxonomy\Policies\TaxonomyPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Role::class => RolePolicy::class,
        Admin::class => AdminPolicy::class,
        Taxon::class => TaxonPolicy::class,
        Taxonomy::class => TaxonomyPolicy::class,
        OptionType::class => OptionTypePolicy::class,
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function (Admin $admin, $ability) {
            return $admin->email == config('ecc.admin_email') || $admin->hasRole('superadmin') ? true : null;
        });
    }
}
