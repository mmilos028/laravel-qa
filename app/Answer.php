<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    
    protected $fillable = [ 'body', 'user_id' ];
    
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body);
    }
    
    public static function boot()
    {
        parent::boot();
        
        static::created(function($answer){
            //echo "Answer created\n";
            $answer->question->increment('answers_count');
        });
        
            static::deleted(function($answer) {
               $answer->question->decrement('answers_count');
            });
        
        /*
        static::saved(function($answer){
            echo "Answer saved\n";
        });
        */
    }
    
    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
    
    
    
}
