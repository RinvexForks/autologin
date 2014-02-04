<?php namespace Studious\Autologin\Providers;

use Illuminate\Database\Eloquent\Model;
use Studious\Autologin\Interfaces\AutologinInterface;

class EloquentAutologinProvider extends Model implements AutologinInterface {
	
    protected $table = 'autologin_tokens';

    protected $fillable = array('user_id', 'token', 'path');

    /**
     * Creates a autologin token.
     *
     * @param  array  $attributes
     * @return \Studious\Autologin\Interfaces\AutologinInterface
     */
    public static function create(array $attributes)
    {
        return parent::create($attributes);
    }

    /**
     * Find a user by the given token.
     *
     * @param  string  $token
     * @return \Studious\Autologin\Interfaces\AutologinInterface
     */
    public static function findByToken($token)
    {
        return parent::firstByAttributes(array(
            'token' => $token
        ));
    }

    /**
     * Delete a autologin token by the given token.
     * 
     * @param  string  $token
     * @return void
     */
    public static function deleteByToken($token)
    {
        $this->findByToken($token)->delete();
    }

    /**
     * Delete all autologin tokens that are now expired.
     *
     * @param  string  $expiry
     * @return void
     */
    public static function deleteExpiredTokens($expiry)
    {
        $this->where('created_at', '<=', $expiry)
            ->delete();
    }

    /**
     * Get the identifier for the token.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the user identifier for the token.
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Get the token for the token.
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Get the path for the token.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
}