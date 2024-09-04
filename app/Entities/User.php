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

    public function groups()
    {
        return $this->belongsToMany(Group::class,'user_groups');
    }
     public function moviments()
     {
        return $this->hasMany(Moviment::class);
     }
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public $timestamps = true;
    protected $table = 'Users';

    // Mutator para salvar CPF sem formatação


    // Accessor para formatar CPF na exibição
    public function getFormattedCpfAttribute()
    {
        $cpf = $this->attributes['cpf'];
        return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9);
    }

    // Accessor para formatar telefone na exibição
    public function getFormattedPhoneAttribute()
    {
        $phone = $this->attributes['phone'];
        return "(" . substr($phone, 0, 2) . ") " . substr($phone, 2, 4) . "-" . substr($phone, 6);
    }

    public function getFormattedBirthAttribute()
    {
        $birth = explode('-', $this->attributes['birth']);
        if (count($birth) != 3) 
            return "";
        return $birth[0] . '/' . $birth[1] . '/' . $birth[2];
    }
}
