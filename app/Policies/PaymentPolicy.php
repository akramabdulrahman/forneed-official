<?php

namespace App\Policies;

use App\User;
use App\App\Models\Payments\Payment;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the payment.
     *
     * @param  \App\User  $user
     * @param  \App\App\Models\Payments\Payment  $payment
     * @return mixed
     */
    public function view(User $user, Payment $payment)
    {
        //
    }

    /**
     * Determine whether the user can create payments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the payment.
     *
     * @param  \App\User  $user
     * @param  \App\App\Models\Payments\Payment  $payment
     * @return mixed
     */
    public function update(User $user, Payment $payment)
    {
        //
    }

    /**
     * Determine whether the user can delete the payment.
     *
     * @param  \App\User  $user
     * @param  \App\App\Models\Payments\Payment  $payment
     * @return mixed
     */
    public function delete(User $user, Payment $payment)
    {
        //
    }
}
