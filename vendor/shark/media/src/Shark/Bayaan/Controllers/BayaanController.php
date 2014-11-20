<?php namespace Shark\Bayaan\Controllers;

use View, Config, Input, Redirect, Lang;
use Shark\Bayaan\Media\Repo\MediaInterface;
use Shark\Bayaan\Media\Form\MediaFormInterface;


class BayaanController extends BaseController {

    /**
     * @var \Stevemo\Cpanel\User\Repo\CpanelUserInterface
     */
    private $media;

    /**
     * @var \Stevemo\Cpanel\User\Form\UserFormInterface
     */
    private $mediaForm;

    /**
     * @param CpanelUserInterface                         $users
     * @param \Stevemo\Cpanel\User\Form\UserFormInterface $userForm
     */
    public function __construct(MediaInterface $media, MediaFormInterface $mediaForm)
    {
        $this->media = $users;
        $this->mediaForm = $userForm;
    }


    /**
     * Show the dashboard
     *
     * @author Steve Montambeault
     * @link   http://stevemo.ca
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return View::make(Config::get('cpanel::views.dashboard'));
    }

    
}