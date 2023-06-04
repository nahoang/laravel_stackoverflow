<?php

namespace App\Models;

use Parsedown;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Question extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body'];
    
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function setTitleAttribute($value) {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getUrlAttribute() {
        return route("questions.show", $this->slug);
    }

    public function getCreatedDateAttribute() {
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute() 
    {
        if ($this->answers_count > 0) {
            if ($this->best_answer_id) {
                return "answered-accepted";
            }
            return "answered";
        }
        return "unanswered";
    }

    public function getBodyHtmlAttribute() 
    {
        $parsedown = new Parsedown();
        return $parsedown->text($this->body);
    }

    public function answers() 
    {
        return $this->hasMany(Answer::class);    
    }

    public function acceptBestAnswer(Answer $answer) 
    {
        $this->best_answer_id = $answer->id;
        $this->save();
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps(); //, 'question_id', 'user_id');
    }

    public function isFavorited() 
    {
        return $this->favorites()->where('user_id', auth()->id())->count() > 0;
    }

    public function getIsFavoriteAttribute()
    {
        return $this->isFavorited();
    }

    public function getFavoritesCountAttribute() 
    {
        return $this->favorites->count();
    }

}
