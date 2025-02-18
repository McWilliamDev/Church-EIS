<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\MembersModel;

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

    public static function getTotalUser($user_type)
    {
        return self::where('user_type', $user_type)
            ->where('user_type', '=', $user_type)
            ->where('is_delete', '=', 0)
            ->count();
    }

    public static function SearchUser($search)
    {
        $return = self::select('users.*')
            ->where(function ($query) use ($search) {
                $query->where('users.name', 'like', '%' . $search . '%')
                    ->orWhere('users.email', 'like', '%' . $search . '%');
            })
            ->limit(10)
            ->get();

        return $return;
    }

    public static function getAdmin()
    {
        return self::select('users.*')
            ->where('user_type', '=', 'admin')
            ->where('is_delete', '=', 0)
            ->orderBy('id', 'asc')
            ->paginate(10);
    }

    public static function getUser()
    {
        return self::select('users.*')
            ->where('users.user_type', '=', 'user')
            ->where('users.is_delete', '=', 0)
            ->orderBy('users.id', 'desc')
            ->paginate(10);
    }
    public static function getEmailUser($user_type)
    {
        return self::select('users.*')
            ->where('user_type', '=', $user_type) // Remove single quotes around $user_type
            ->where('is_delete', '=', 0)
            ->get();
    }

    public function getProfile()
    {
        if (!empty($this->profile_pic) && file_exists('upload/profile/' . $this->profile_pic)) {
            return url('upload/profile/' . $this->profile_pic);
        } else {
            return "";
        }
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
