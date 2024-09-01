<?php

namespace App\Entities;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cpf',
        'name',
        'phone',
        'birth',
        'gender',
        'notas',
        'email',
        'password',
        'status',
        'permission',
    ];

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public $timestamps = true;
    protected $table = 'Users';

    public function getCpfAttribute()
    {
        $cpf = $this->attributes['cpf'];
        return substr($cpf,0,3) .'.' . substr($cpf,3,3) .'.' . substr($cpf,7,3) .'-' . substr($cpf,-2);
    }
    public function getPhoneAttribute()
    {
        $phone = $this->attributes['phone'];
        return "(" . substr($phone,0,2) . ") " . substr($phone,2,4) . "-" . substr($phone, -4);
    }
    public function getBirthAttribute()
    {
        $birth = explode('-', $this->attributes['birth']);
        if (count($birth) != 3) 
            return "";
        $birth = $birth[0] .'/'. $birth[1] .'/'. $birth[2];
        return $birth;
  }
}
