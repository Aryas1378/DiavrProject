<?php

namespace App\Policies;

use App\Models\AttributeDefaultValue;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AttributeDefaultValuePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return auth()->user()->hasRole('admin');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AttributeDefaultValue  $attributeDefaultValue
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, AttributeDefaultValue $attributeDefaultValue)
    {
        return auth()->user()->hasRole('admin');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return auth()->user()->hasRole('admin');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AttributeDefaultValue  $attributeDefaultValue
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, AttributeDefaultValue $attributeDefaultValue)
    {

        return auth()->user()->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AttributeDefaultValue  $attributeDefaultValue
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, AttributeDefaultValue $attributeDefaultValue)
    {
        return auth()->user()->hasRole('admin');
    }

}
