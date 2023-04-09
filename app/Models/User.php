<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\ACL\Role;
use App\Models\Content\News;
use App\Models\ACL\Permission;
use App\Models\Content\Page;
use App\Models\Content\Theater;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Content\PublicCall;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use App\Traits\Permissions\HasPermissionsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasPermissionsTrait;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name' ,
        'username' ,
        'password',
        'email' ,
        'mobile' ,
        'profile_photo' ,
        'email_verified_at',
        'mobile_verified_at' ,
        'is_staff' ,
        'is_block'
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
    ];

    const DEFAULT_PROFILE_PHOTO = 'images/user/default.png';

    // set data before store to database
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function setEmailVerifiedAtAttribute($verified_at)
    {
        $this->attributes['email_verified_at'] = date("Y-m-d H:i:s", time());
    }

    public function setMobileVerifiedAtAttribute($verified_at)
    {
        $this->attributes['mobile_verified_at'] = date("Y-m-d H:i:s", time());
    }

    // relations
    public function news()
    {
        return $this->hasMany(News::class);
    }

    public function publicCalls()
    {
        return $this->hasMany(PublicCall::class );
    }

    public function theaters()
    {
        return $this->hasMany(Theater::class );
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }

    // accessor
    public function getProfileImageAttribute()
    {
        return $this->profile_photo ?? self::DEFAULT_PROFILE_PHOTO;
    }
}
