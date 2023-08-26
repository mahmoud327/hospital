<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{

    use \Astrotomic\Translatable\Translatable;

    protected $with = [
        'translations',
    ];

    protected $appends = [
        'image_path',
    ];


    protected $translationForeignKey = "blog_id";
    public $translatedAttributes = ['title', 'description'];
    public $translationModel = 'App\Models\Translation\Blog';
    protected $table = "blogs";
    protected $fillable = ['image', 'views', 'status'];

    /*
     * ----------------------------------------------------------------- *
     * --------------------------- Relations --------------------------- *
     * ----------------------------------------------------------------- *
     */



    public function likes()
    {
        return $this->hasMany('App\Models\Network\BlogLikes', 'blog_id', 'id');
    }

    /*
     * ----------------------------------------------------------------- *
     * --------------------------- scopes --------------------------- *
     * ----------------------------------------------------------------- *
     */

    public function ScopeStatus($q)
    {
        return $q->where('status', 1);
    }

    public function ScopeSearch($q, $search)
    {

        return $q->whereTranslationLike('title', '%' . $search . '%')
            ->orwhereTranslationLike('description', '%' . $search . '%')
            ->orwhereTranslationLike('short_description', '%' . $search . '%');

    }

    /*
     * ----------------------------------------------------------------- *
     * --------------------------- functions --------------------------- *
     * ----------------------------------------------------------------- *
     */



    /*
     * ----------------------------------------------------------------- *
     * --------------------------- modutators --------------------------- *
     * ----------------------------------------------------------------- *
     */

    /*
     * ----------------------------------------------------------------- *
     * --------------------------- Accessors --------------------------- *
     * ----------------------------------------------------------------- *
     */


    public function getImagePathAttribute()
    {
        return $this->image ? asset('uploads/blogs/' . $this->image) : asset('uploads/default.jpeg');
    }

}
