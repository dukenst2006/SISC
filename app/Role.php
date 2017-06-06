<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Eloquent relationship to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }

    /**
     * Returns the id for admin role.
     *
     * @return int the id for admin role.
     */
    public static function getAdminId()
    {
        return self::where('name', 'admin')->first()->id;
    }

    /**
     * Returns the id for salesperson role.
     *
     * @return int the id for salesperson role.
     */
    public static function getSalespersonId()
    {
        return self::where('name', 'salesperson')->first()->id;
    }
}
