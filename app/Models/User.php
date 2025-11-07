<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
        'firstname',
        'lastname',
        'email',
        'password',
        'role',
        'profileimage',
        'bio',
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

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function staff()
    {
        return $this->hasOne(dti_id::class, 'user_id', 'id');
    }

    public function information()
    {
        return $this->hasOne(user_information::class);
    }

    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class, 'user_id', 'id');
    }

    public function journals()
    {
        return $this->hasMany(journals::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function unreadNotifications()
    {
        return $this->notifications()->whereNull('read_at');
    }

    // Social features relationships
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function postLikes()
    {
        return $this->hasMany(PostLike::class);
    }

    public function commentLikes()
    {
        return $this->hasMany(CommentLike::class);
    }

    public function replyLikes()
    {
        return $this->hasMany(ReplyLike::class);
    }

    public function getProfileImageUrlAttribute()
    {
        if ($this->profileimage) {
            return asset('storage/' . $this->profileimage);
        }

        // Generate initials-based avatar as fallback
        $initials = strtoupper(substr($this->firstname, 0, 1) . substr($this->lastname, 0, 1));
        return "https://ui-avatars.com/api/?name={$initials}&background=random&color=fff&size=100&bold=true";
    }

    /**
     * Get database-agnostic SQL for concatenating firstname and lastname
     *
     * @return string
     */
    public static function getFullNameConcatSql(): string
    {
        $driver = DB::getDriverName();

        // SQLite uses || for concatenation
        if ($driver === 'sqlite') {
            return "(firstname || ' ' || lastname)";
        }

        // MySQL, MariaDB, PostgreSQL use CONCAT()
        return "CONCAT(firstname, ' ', lastname)";
    }
}
