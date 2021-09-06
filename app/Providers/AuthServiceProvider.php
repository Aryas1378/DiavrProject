<?php

namespace App\Providers;

use App\Models\Ad;
use App\Models\Attribute;
use App\Models\AttributeDefaultValue;
use App\Models\Category;
use App\Policies\AdPolicy;
use App\Policies\AttributeDefaultValuePolicy;
use App\Policies\AttributePolicy;
use App\Policies\CategoryPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Category::class => CategoryPolicy::class,
        Attribute::class => AttributePolicy::class,
        AttributeDefaultValue::class => AttributeDefaultValuePolicy::class,
        Ad::class => AdPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


    }
}
