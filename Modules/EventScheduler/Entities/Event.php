<?php

namespace Modules\EventScheduler\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $table = 'event_list';

    protected $fillable = [
        'name',
        'description',
        'event_time',
        'email_to_notification',
        'sent',
        'sent_time'
    ];

    /**
     * Casting data.
     *
     * @var array
     */
    protected $casts = [
        'sent' => 'boolean',
    ];
    
    protected static function newFactory()
    {
        return \Modules\EventScheduler\Database\factories\EventFactory::new();
    }

    /**
     * Set the event time.
     *
     * @param  string  $value
     * @return void
     */
    public function setEventTimeAttribute($value)
    {
        $this->attributes['event_time'] = Carbon::createFromFormat('d/m/Y H:i', $value)->timestamp;
    }

   /**
     * Get the event time.
     *
     * @param  string  $value
     * @return string
     */
    public function getEventTimeAttribute($value)
    {
        return Carbon::createFromTimestamp($value)->format('d/m/Y H:i');
    }
}
