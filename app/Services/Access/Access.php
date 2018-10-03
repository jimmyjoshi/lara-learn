<?php

namespace App\Services\Access;

use Illuminate\Contracts\Auth\Authenticatable;
use App\Models\MailerLog\MailerLog;

/**
 * Class Access.
 */
class Access
{
    /**
     * Get the currently authenticated user or null.
     */
    public function user()
    {
        return auth()->user();
    }

    /**
     * Return if the current session user is a guest or not.
     *
     * @return mixed
     */
    public function guest()
    {
        return auth()->guest();
    }

    /**
     * @return mixed
     */
    public function logout()
    {
        return auth()->logout();
    }

    /**
     * Get the currently authenticated user's id.
     *
     * @return mixed
     */
    public function id()
    {
        return auth()->id();
    }

    /**
     * @param Authenticatable $user
     * @param bool            $remember
     */
    public function login(Authenticatable $user, $remember = false)
    {
        return auth()->login($user, $remember);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function loginUsingId($id)
    {
        return auth()->loginUsingId($id);
    }

    /**
     * Checks if the current user has a Role by its name or id.
     *
     * @param string $role Role name.
     *
     * @return bool
     */
    public function hasRole($role)
    {
        if ($user = $this->user()) {
            return $user->hasRole($role);
        }

        return false;
    }

    /**
     * Checks if the user has either one or more, or all of an array of roles.
     *
     * @param  $roles
     * @param bool $needsAll
     *
     * @return bool
     */
    public function hasRoles($roles, $needsAll = false)
    {
        if ($user = $this->user()) {
            return $user->hasRoles($roles, $needsAll);
        }

        return false;
    }

    /**
     * Check if the current user has a permission by its name or id.
     *
     * @param string $permission Permission name or id.
     *
     * @return bool
     */
    public function allow($permission)
    {
        if ($user = $this->user()) {
            return $user->allow($permission);
        }

        return false;
    }

    /**
     * Check an array of permissions and whether or not all are required to continue.
     *
     * @param  $permissions
     * @param  $needsAll
     *
     * @return bool
     */
    public function allowMultiple($permissions, $needsAll = false)
    {
        if ($user = $this->user()) {
            return $user->allowMultiple($permissions, $needsAll);
        }

        return false;
    }

    /**
     * @param  $permission
     *
     * @return bool
     */
    public function hasPermission($permission)
    {
        return $this->allow($permission);
    }

    /**
     * @param  $permissions
     * @param  $needsAll
     *
     * @return bool
     */
    public function hasPermissions($permissions, $needsAll = false)
    {
        return $this->allowMultiple($permissions, $needsAll);
    }

    /**
     * Today Mail Count
     *
     * @return int
     */
    public function todayMailCount()
    {
        return MailerLog::whereDate('created_at', date('Y-m-d'))->count();
    }

    /**
     * Total Mail Count
     *
     * @return int
     */
    public function totalMailCount()
    {
        return MailerLog::count();
    }

    /**
     * Add Mailer Signature
     *
     * @param object $model
     * @param string $body
     */
    public function addMailerSignature($model, $body)
    {
        $url            = route('frontend.read-sent-mail', ['id' => hasher()->encode($model->id) ]);
        $readSignature  = '<img class="custom-read" style="display: none;" src="'.$url.'" />';

        return $body . $readSignature;
    }

    /**
     * Total Read Count
     *
     * @param object $model
     * @param string $body
     */
    public function totalReadCount()
    {
        return MailerLog::whereNotNull('read_at')->count();
    }

    /**
     * Total Read Count
     *
     * @param object $model
     * @param string $body
     */
    public function todayReadCount()
    {
        return MailerLog::whereDate('read_at', date('Y-m-d'))->count();
    }
}
