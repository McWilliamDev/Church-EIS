<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'phonenumber',
        'position',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
    public static function getSingle($id)
    {
        return self::find($id);
    }
    public static function getAdmin()
    {
        return self::select('users.*')
            ->where('user_type', '=', 'admin')
            ->where('is_delete', '=', 0)
            ->orderBy('id', 'asc')
            ->paginate(10);
    }
    public static function getEmailSingle($email)
    {
        return User::where('email', '=', $email)->first();
    }
    public static function getTokenSingle($remember_token)
    {
        return User::where('remember_token', '=', $remember_token)->first();
    }
}
