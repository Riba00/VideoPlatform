<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Video extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = ['published_at'];



    public function getFormattedPublishedAtAttribute()
    {
        if (!$this->published_at) return '';
        $locale_date = $this->published_at->locale(config('app.locale'));
        return $locale_date->day . ' de ' . $locale_date->monthName . ' de ' . $locale_date->year;
    }

    public function getFormattedForHumansPublishedAtAttribute()
    {
        return optional($this->published_at)->diffForHumans(Carbon::now());
    }

    public function getPublishedAtTimestampAttribute()
    {
        return optional($this->published_at)->timestamp;
    }

    protected function onlyForSubscribers(): Attribute
    {
        return new Attribute(
            get: fn ($value) => (boolean) !is_null($this->needs_subscription)
        );
    }

    public function canBeDisplayed()
    {
        if ($this->only_for_subscribers) {
            if(!Auth::check()) return false;
        }
        return true;
    }

    public function markAsOnlyForSubscribers()
    {
        $this->needs_subscription = Carbon::now();
        $this->save();
        return $this;
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    public function setSerie(Serie $serie)
    {
        $this->serie_id = $serie->id;
        $this->save();
        return $this;
    }


}
