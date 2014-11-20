<?php  namespace Shark\Bayaan\Media\Repo;

use Illuminate\Database\Eloquent\Model;

class Media extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'media';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('filename');

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = array('id');

    
    
    public function details()
    {
        return $this->hasMany('Shark\Bayaan\Media\Repo\MediaDetails');
    }
    /**
     * Mutator for Module name
     *
     * @author Syed Sharique
     
     *
     * @param  string $value
     * @return void
     */
    public function setNameAttribute($value)
    {
        //$this->attributes['name'] = ucfirst($value);
    }
   
} 