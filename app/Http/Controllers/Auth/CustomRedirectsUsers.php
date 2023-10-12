<?php

namespace App\Http\Controllers\Auth;

trait CustomRedirectsUsers
{
    public function customRedirectPath()
    {
        // Your custom redirection logic goes here
        // For example, redirect admins to /admin/dashboard
        // and others to the default /home route.
        if (auth()->user()->hasRole('admin')) {
            return '/admin-dash';
        } elseif (auth()->user()->hasRole('tenant')) {
            return '/tenant-dash';
        }

        return '/home'; // Default redirect path for other users

        return '/home'; // Default redirect path for other users
    }
}
