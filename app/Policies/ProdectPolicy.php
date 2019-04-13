<?php

namespace App\Policies;

use App\Traits\AdminActions;
use App\User;
use App\Prodect;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProdectPolicy
{
    use HandlesAuthorization, AdminActions;


    /**
     * Determine whether the user can view the prodect.
     *
     * @param  \App\User  $user
     * @param  \App\Prodect  $prodect
     * @return mixed
     */
    public function addCategory(User $user, Prodect $prodect)
    {
       return $user->id === $prodect->seller->id;
    }


    public function deleteCategory(User $user, Prodect $prodect)
    {
        return $user->id === $prodect->seller->id;
    }

}
