<?php

namespace App\Models;

use App\Http\Resources\MediaCenterResource;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ChatMessage extends Model implements HasMedia
{
    use InteractsWithMedia;


    protected $table = 'chat_messages';
    public $timestamps = true;

    protected $fillable = ['to_user_id', 'from_user_id', 'message'];

    public function toUser()
    {
        return $this->belongsTo('App\Models\User','to_user_id');
    }

    public function fromUser()
    {
        return $this->belongsTo('App\Models\User','from_user_id');
    }
    protected $hidden = ['created_at', 'updated_at'];


    public function scopeMessageCurrentUser($q, $to_user_id)
    {

        return $q->where([
            ['from_user_id', auth()->id()],
            ['to_user_id', $to_user_id]
        ])
            ->orwhere([
                ['from_user_id', $to_user_id],
                ['to_user_id', auth()->id()]
            ]);
    }
    public function getImagesAttribute()
    {
        if (($images = $this->getMedia('images'))->count()) {
            return MediaCenterResource::collection($images->sortBy(function ($image) {
                return !$image->getCustomProperty('isFeatured', false);
            }));
        }
        return
            [[
                'id' => 0,
                'original' => asset('awarebox.jpeg'),
                'order' => 1,
                'position' => 1,
                'is_featured' => true,
            ]];
    }
}
