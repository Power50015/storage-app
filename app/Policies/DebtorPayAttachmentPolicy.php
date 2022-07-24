<?php

namespace App\Policies;

use App\Models\DebtorPayAttachment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DebtorPayAttachmentPolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DebtorPayAttachment  $debtorPayAttachment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, DebtorPayAttachment $debtorPayAttachment)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DebtorPayAttachment  $debtorPayAttachment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, DebtorPayAttachment $debtorPayAttachment)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DebtorPayAttachment  $debtorPayAttachment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, DebtorPayAttachment $debtorPayAttachment)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DebtorPayAttachment  $debtorPayAttachment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, DebtorPayAttachment $debtorPayAttachment)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DebtorPayAttachment  $debtorPayAttachment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, DebtorPayAttachment $debtorPayAttachment)
    {
        //
    }
}
