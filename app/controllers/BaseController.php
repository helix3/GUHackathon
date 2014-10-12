<?php

class BaseController extends Controller
{

    protected $layout = 'hack.theme.layouts.default';

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

    /**
     * Helpful way to use "Input" across all
     * controllers without having to declase the class
     *
     * @param  string $method
     * @param  mixed $args
     * @return mixed
     */
    protected function input($method, $args = array())
    {
        return call_user_func_array([$this->app['request'], $method], (array)$args);
    }


}
