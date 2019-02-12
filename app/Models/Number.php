<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Number extends Model
{
    protected $fillable = ['bought_by', 'number', 'device_id'];

    protected $casts =
    [
        'id' => 'int',
    ];

    /**
     * The attributes that should be mutated to dates.
     */
    protected $dates = ['deleted_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'bought_by');
    }
}
