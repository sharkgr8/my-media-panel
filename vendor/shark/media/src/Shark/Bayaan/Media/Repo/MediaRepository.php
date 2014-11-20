<?php  namespace Shark\Bayaan\Media\Repo;

use Illuminate\Events\Dispatcher;
use Illuminate\Config\Repository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MediaRepository implements MediaInterface {

    /**
     * @var \Illuminate\Events\Dispatcher
     */
    protected  $event;

    /**
     * @var Permission
     */
    protected  $model;

    /**
     * @var \Illuminate\Config\Repository
     */
    protected $config;

    /**
     * @param Permission                    $model
     * @param Dispatcher                    $event
     * @param \Illuminate\Config\Repository $config
     */
    public function __construct(Media $model, Dispatcher $event, Repository $config)
    {
        $this->event = $event;
        $this->model = $model;
        $this->config = $config;
    }

    /**
     * Grab all the media from storage
     *
     * @author Syed Sharique
     
     *
     * @param array $columns
     *
     * @return \Illuminate\Database\Eloquent\Collection|\StdClass|static[]
     */
    public function all($columns = array('*'))
    {
        return $this->model->with('mediaDetails')->all($columns);
    }

    /**
     * Put into storage a new media
     *
     * @author Syed Sharique
     
     *
     * @param array $data
     *
     * @return bool|\Illuminate\Database\Eloquent\Model|\StdClass|static
     */
    public function create(array $data)
    {
        $media = $this->model->create(array(
            'filename'        => $data['filename'],
            'permissions' => $data['permissions']
        ));

        if ( ! $perm )
        {
            return false;
        }
        else
        {
            $this->event->fire('mediaDetails.create', array($perm));
            return $perm;
        }
    }

    /**
     * Delete a permission from storage
     *
     * @author Syed Sharique
     
     *
     * @param $id
     *
     * @return bool
     */
    public function delete($id)
    {
        try
        {
            $perm = $this->model->findOrFail($id);
            $oldData = $perm;
            $perm->delete();
            $this->event->fire('permissions.delete', array($oldData));

            return true;
        }
        catch ( ModelNotFoundException $e)
        {
            return false;
        }
    }

    /**
     * Get a Permission model by it's primary key
     *
     * @author Syed Sharique
     
     *
     * @param       $id
     * @param array $columns
     *
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|\StdClass|static
     */
    public function find($id, $columns = array('*'))
    {
        return $this->model->find($id,$columns);
    }

    /**
     *
     *
     * @author Syed Sharique
     
     *
     * @param       $id
     * @param array $columns
     *
     * @throws PermissionNotFoundException
     *
     * @return mixed
     */
    public function findOrFail($id, $columns = array('*'))
    {
        try
        {
            return $this->model->findOrFail($id,$columns);
        }
        catch ( ModelNotFoundException $e )
        {
            throw new PermissionNotFoundException;
        }
    }

   
   /**
     * Update a permission into storage
     *
     * @author Syed Sharique
     
     *
     * @param array $data
     *
     * @return bool
     */
    public function update(array $data)
    {
        $media = $this->findOrFail($data['id']);

        $media->filename = $data['filename'];
        $media->active = $data['active'];
        $media->save();

        $this->event->fire('media.update',array($media));

        return true;
    }
    
    /**
     * Activate a media
     *
     * @author Syed Sharique
     *
     * @param $id
     *
     * @return bool
     */
    public function changeStatus($id, $activate = true)
    {
        $media = $this->findOrFail($id);

        $media->active = (int)$activate;
        $media->save();

        return false;
    }
}