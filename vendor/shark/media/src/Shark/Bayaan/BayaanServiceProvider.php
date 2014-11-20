<?php

namespace Shark\Bayaan;

use Illuminate\Support\MessageBag;
use Illuminate\Support\ServiceProvider;

use Shark\Bayaan\Media\Repo\MediaRepository;
use Shark\Bayaan\Media\Repo\Media;
use Shark\Bayaan\Media\Form\PermissionForm;
use Shark\Bayaan\Media\Form\PermissionValidator;
/**
 * Description of MediaServiceProvider
 *
 * @author shark
 */
class BayaanServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot() {
        $this->package('shark/bayaan');
        include __DIR__ . '/routes.php';
    }

    /**
     * Register Group binding
     *
     * @author Steve Montambeault
     * @link   http://stevemo.ca
     *
     */
    public function registerGroup()
    {
        $app = $this->app;

        $app->bind('Stevemo\Cpanel\Group\Repo\CpanelGroupInterface', function($app)
        {
            return new GroupRepository($app['sentry'], $app['events']);
        });

        $app->bind('Stevemo\Cpanel\Group\Form\GroupFormInterface', function($app)
        {
            return new GroupForm(
                new GroupValidator($app['validator'], new MessageBag),
                $app->make('Stevemo\Cpanel\Group\Repo\CpanelGroupInterface')
            );
        });
    }
    
    /**
    * Get the services provided by the provider.
    *
    * @return array
    */
   public function provides()
   {
           return array('bayaan');
   }

}
