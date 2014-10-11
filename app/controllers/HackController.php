<?php

abstract class HackController extends BaseController {
    /**
     * Include the base commodities
     * from this class
     *
     * @var boolean
     */
    protected $inc_base_commodities = true;

    /**
     * The default view
     *
     * @var string
     */
    protected $view = 'index';

    /**
     * The default layout
     *
     * @var string
     */
    protected $layout = 'hack::layouts.default';

    /**
     * The app
     *
     * @var Application
     */
    protected $app = NULL;

    /**
     * Get the app container
     *
     * @param null $pass
     *
     * @return Application
     */
    protected function app($pass = NULL)
    {
        if (!$this->app) {
            $this->app = app();
        }

        if (!$pass) return $this->app;

        return app($pass);
    }

    /**
     * Render the view
     *
     * A helper method removing the need to use View::make in
     * any extending controllers and allows us to tidy things
     * up before rendering the view.
     *
     * @param  string $view
     * @param  array $data
     * @param  string $layout
     *
     * @param array $share
     *
     * @return Response
     */
    protected function render($view, array $data = array(), $layout = NULL, $share = array())
    {
        // Organise the view to use
        if (!$view) {
            $view = $this->view;
        }

        // Set the layout if it is available
        if ($layout) {
            $this->layout = $layout;
        }

        $this->viewShare($share);

        // Return the view render
        $this->layout->content = View::make($view, $data);
    }

    /**
     * Share items with the view
     *
     * @param  array $share
     * @return void
     */
    protected function viewShare(array $share)
    {
        foreach ($share as $key => $value) {

            View::share($key, $value);

        }
    }

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        // Add the style handlers

        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

    /**
     * Create from the IoC
     *
     * This is a handy way to not have to include
     * the 'use' declaration in every controller
     *
     * @param  string $class
     *
     * @return mixed
     */
    protected function make($class)
    {
        return app()->make($class);
    }
}