<?php namespace Hack\Providers;

use Illuminate\Support\ServiceProvider;

class HackServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        require app_path('lib') . '/helpers.php';
    }


    public function register()
    {
        // Register the namespaces
        $this->namespaces();
    }

    /**
     * Load the theme namespaces
     *
     * @return void
     */
    protected function namespaces()
    {
        $ns = $this->app->make('config')->get('hack.themes', []);

        if (count($ns) < 1) return;

        foreach ($ns as $key => $value) {
            $this->app->make('view')->addNamespace($key, $value);
        }
    }

}