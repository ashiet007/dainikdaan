<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'news';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['type','subject','details'];

    public function scopeHorizontal($query)
    {
        return $query->where('type','horizontal');
    }

    public function scopeVertical($query)
    {
        return $query->where('type','vertical');
    }


}
