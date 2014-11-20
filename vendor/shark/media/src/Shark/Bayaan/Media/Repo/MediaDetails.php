<?php  namespace Shark\Bayaan\Media\Repo;

use Illuminate\Database\Eloquent\Model;

class MediaDetails extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'media_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('media_id','title','tags', 'lang_code');

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = array('id');

    
    public function media()
    {
        return $this->belongsTo('Shark\Bayaan\Media\Repo\Media', 'media_details_media_id_foreign');
    }
    /**
     * Mutator for giving tags.
     *
     * @author Syed Sharique
     *
     * @param $tags
     *
     * @throws \InvalidArgumentException
     *
     * @return array
     *
     */
    public function getTagsAttribute($tags)
    {
        if (is_array($tags))
        {
            return $tags;
        }

        if ( ! $tags)
        {
            return array();
        }

        if ( ! $_tags = json_decode($tags, true))
        {
            throw new \InvalidArgumentException("Cannot JSON decode tags [$tags].");
        }

        return $_tags;
    }

   
    /**
     * Mutator for Title
     *
     * @author Syed Sharique
     *
     * @param  string $value
     * @return void
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucwords($value);
    }

    /**
     * Mutator for taking tags.
     *
     * @author Syed Sharique
     *
     * @param $tags
     *
     * @return void
     */
    public function setTagsAttribute($tags)
    {       

        $this->attributes['tags'] = ( ! empty($tags)) ? json_encode($tags) : '';
    }
} 