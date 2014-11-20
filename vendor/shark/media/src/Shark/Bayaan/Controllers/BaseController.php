<?php namespace Shark\Bayaan\Controllers;

use Controller;
use View;
use Config;

class BaseController extends Controller {

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if ( ! is_null($this->layout))
        {
            $this->layout = View::make($this->layout);
        }
        //share the config option to all the views
        View::share('bayaan', Config::get('bayaan::site_config'));
    }

    /**
     * get the validation service
     *
     * @author Syed Sharique
     *
     * @param  string $service
     * @param  array $inputs
     * @return Object
     */
    protected function getValidationService($service, array $inputs = array())
    {
        $class = '\\'.ltrim(Config::get("bayaan::validation.{$service}"), '\\');
        return new $class($inputs);
    }

}
