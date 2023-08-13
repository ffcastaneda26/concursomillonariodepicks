<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'gender',
        'birthday',
        'facebook',
        'youtube',
        'instagram',
        'tweeter',
        'tiktok',
        'pinterest',
        'snapshat',
        'linkedin',
        'adult',
        'accept_terms',
        'password',
        'active',
    ];


    public function setEmailAttribute($value)
    {
        $this->attributes['email'] =  strtolower($value);
    }

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] =  ucwords($value);
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] =  ucwords($value);
    }


    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => ucwords($this->first_name) . ' ' .  ucwords($this->last_name ) . ' ' . ucwords($this->materno),
        );
    }


    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => ucwords($this->first_name) . ' ' .  ucwords($this->last_name ) . ' ' . ucwords($this->materno),
        );
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /*+------------+
      | Relaciones |
      +------------+
     */

    public function picks(): HasMany
    {
        return $this->hasMany(Pick::class);
    }

    public function positions(): HasMany
    {
        return $this->hasMany(Position::class);
    }


    /*+-----------------+
      | Funciones Apoyo |
      +-----------------+
     */

    public function has_position_record_round($round_id){
       return $this->positions->where('round_id',$round_id)->count();
    }

    public function is_active(){
        return $this->active;
    }

    public function is_adult(){
        return $this->adult;
    }

    // Pronósticos acertados en la jornada
    public function picks_hit_round($round_id){
        $hits = 0;
        foreach($this->picks->where('hit',1) as $pick){
            if($pick->game->round_id == $round_id && $pick->hit){
                $hits++;
            }


        }
        return $hits;
        return $this->picks()->game()->where('round_id',$round_id)->count();

    }

}
