<?php namespace Shark\Bayaan\Media\Repo;

interface MediaInterface {

    /**
     * Change status of a media
     *
     * @author Syed Sharique
     
     *
     * @param $id
     *
     * @return bool
     */
    public function changeStatus($id, $activate = true);

    

    /**
     * Check to see if the media is activated.
     *
     * @author Syed Sharique
     
     *
     * @return bool
     */
    public function check();

    /**
     * Create a new media
     *
     * @author Syed Sharique
     
     *
     * @param array $credentials
     * @param bool  $activate
     *
     
     */
    public function create(array $credentials, $activate = false);

   

    /**
     * Delete the media
     *
     * @author Syed Sharique
     
     *
     * @param int $id
     *
     * @return void
     */
    public function delete($id);

    /**
     * Returns an all media.
     *
     * @author Syed Sharique
     
     *
     * @return array
     */
    public function all();

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
    public function findOrFail($id, $columns = array('*'));


    
    /**
     * Update media information
     *
     * @author Syed Sharique
     
     *
     * @param       $id
     * @param array $attributes
     *
     
     */
    public function update($id, array $attributes);
   

    /**
     * Retrieve tags for a given media
     *
     * @author Syed Sharique
     
     *
     * @param int   $id
     * @param array $tags
     *
     
     */
    public function getTags($id, array $tags);
    
    
    /**
     * Update tags for a given media
     *
     * @author Syed Sharique
     
     *
     * @param int   $id
     * @param array $tags
     *
     
     */
    public function updateTags($id, array $tags);

   

} 