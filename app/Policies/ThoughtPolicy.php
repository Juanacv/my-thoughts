<?php

namespace App\Policies;

use App\Models\Thought;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ThoughtPolicy
{
    /**
     * Determina si el usuario puede actualizar o eliminar el Thought.
     */
    public function update(User $user, Thought $thought)
    {
        return $user->id === $thought->user_id;
    }

    public function delete(User $user, Thought $thought)
    {
        return $user->id === $thought->user_id;
    }
}
