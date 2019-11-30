<?php

namespace App\Policies;

use App\User;
use App\Advancer;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdvancerPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any advancers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the advancer.
     *
     * @param  \App\User  $user
     * @param  \App\Advancer  $advancer
     * @return mixed
     */
    public function view(User $user, Advancer $advancer)
    {
        //
    }

    /**
     * Determine whether the user can create advancers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the advancer.
     *
     * @param  \App\User  $user
     * @param  \App\Advancer  $advancer
     * @return mixed
     */
    public function update(User $user, Advancer $advancer)
    {
        //
    }

    /**
     * Determine whether the user can delete the advancer.
     *
     * @param  \App\User  $user
     * @param  \App\Advancer  $advancer
     * @return mixed
     */
    public function delete(User $user, Advancer $advancer)
    {
        //
    }

    /**
     * Determine whether the user can restore the advancer.
     *
     * @param  \App\User  $user
     * @param  \App\Advancer  $advancer
     * @return mixed
     */
    public function restore(User $user, Advancer $advancer)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the advancer.
     *
     * @param  \App\User  $user
     * @param  \App\Advancer  $advancer
     * @return mixed
     */
    public function forceDelete(User $user, Advancer $advancer)
    {
        //
    }
}
