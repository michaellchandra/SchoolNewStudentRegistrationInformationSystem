<?php

namespace App\Models;
// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'asalSekolah',
        'asalReferensiSekolah'
    ];

    public function hasRole($role)
    {
        return $this->role === $role;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }




    public function admin()
    {
        return $this->hasOne(Admin::class, 'user_id');
    }

    public function biodata() {
        return $this->hasOne(Biodata::class,'user_id');
    }


    // public function isAdmin()
    // {

    //     return $this->admin()->exists();
    // }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'user_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'user_id');
    }
    
}
