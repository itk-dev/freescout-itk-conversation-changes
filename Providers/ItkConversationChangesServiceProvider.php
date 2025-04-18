<?php

namespace Modules\ItkConversationChanges\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use TorMorten\Eventy\Facades\Events as Eventy;

define('ITK_CONVERSATION_CHANGES_MODULE', 'itkconversationchanges');
class ItkConversationChangesServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->hooks();
    }

    /**
     * Module hooks.
     */
    public function hooks()
    {
      // Add module's JS file to the application layout.
      Eventy::addFilter('javascripts', function($javascripts) {
        $javascripts[] = \Module::getPublicPath(ITK_CONVERSATION_CHANGES_MODULE).'/js/disableStatusChanges.js';
        return $javascripts;
      });

      \Eventy::addFilter('stylesheets', function($styles) {
        $styles[] = \Module::getPublicPath(ITK_CONVERSATION_CHANGES_MODULE).'/css/module.css';
        return $styles;
      });
      // Add module's JS file to the application layout.
      Eventy::addFilter('eup.javascripts', function($javascripts) {
        $javascripts[] = \Module::getPublicPath(ITK_CONVERSATION_CHANGES_MODULE).'/js/movePortalSubmitForm.js';
        return $javascripts;
      });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerTranslations();
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('itkconversationchanges.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'itkconversationchanges'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/itkconversationchanges');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/itkconversationchanges';
        }, \Config::get('view.paths')), [$sourcePath]), 'itkconversationchanges');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $this->loadJsonTranslationsFrom(__DIR__ .'/../Resources/lang');
    }

    /**
     * Register an additional directory of factories.
     * @source https://github.com/sebastiaanluca/laravel-resource-flow/blob/develop/src/Modules/ModuleServiceProvider.php#L66
     */
    public function registerFactories()
    {
        if (! app()->environment('production')) {
            app(Factory::class)->load(__DIR__ . '/../Database/factories');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
