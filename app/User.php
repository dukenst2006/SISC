<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

/**
 * @property  string first_name
 * @property  string middle_name
 * @property  string last_name
 * @property  string email
 */
class User extends Authenticatable
{
    use Notifiable;
    use HybridRelations;

    /** @var string $ADMIN_ROLE the admin role name */
    const ADMIN_ROLE = 'admin';

    /** @var string the database connection to use for this model */
    protected $connection = 'mysql';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'first_name', 'middle_name', 'last_name', 'email', 'password', 'active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'role_id', 'password', 'remember_token', 'active', 'created_at', 'updated_at', 'deleted_at',
    ];

    /**
     * Set the user's first name.
     *
     * @param string $first_name the first name.
     */
    public function setFirstName($first_name) {
        $this->first_name = $first_name;
    }

    /**
     * Set the user's middle name.
     *
     * @param string $middle_name the first name.
     */
    public function setMiddleName($middle_name) {
        $this->middle_name = $middle_name;
    }

    /**
     * Set the user's last name.
     *
     * @param string $last_name the first name.
     */
    public function setLastName($last_name) {
        $this->last_name = $last_name;
    }

    /**
     * Set the user's email address.
     *
     * @param string $email the first name.
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * Return the user's full name.
     * The full name is composed of first, middle, and last name.
     *
     * @return string the full name of the user.
     */
    public function getFullName() {
        $full_name = $this->first_name . ' ';

        if (!empty($this->middle_name)) {
            $full_name .= $this->middle_name . ' ';
        }

        return $full_name . $this->last_name;
    }

    /**
     * Role relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    /**
     * Invoice relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }
}
