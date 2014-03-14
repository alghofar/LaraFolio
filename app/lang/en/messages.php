<?php

return [

    'users' => [

        'error' => [

            'must_be_authenticated'     => '<p>You must be authentified to access this page.</p>',
            'must_be_admin'             => '<p>You must be an Administrator to access this page.</p>',
            'already_activated'         => '<p>You have already activated your account. Please log in with your credentials.</p>',
            'activation_failed'         => '<p>The activation you provided doesn\'t match with our database.</p>',
            'user_not_exists_with_id'   => '<p>The user with an id of ":id" does not exist!<p>',
            'register_failed'           => '<p>An error occured on the user creation process.</p>',

        ],

        'success' => [

            'created'           => '<p>User created successfully!</p>',
            'updated'           => '<p>User updated successfully!</p>',
            'deleted'           => '<p>User deleted successfully!</p>',
            'suspended'         => '<p>User suspended successfully!</p>',
            'restored'          => '<p>User restored successfully!</p>',
            'settings_updated'  => '<p>Your Settings have been updated!</p>',
            'profile_updated'  => '<p>Your Profile has been updated!</p>',

        ],

    ],

    'auth' => [

        'error' => [

            'login_failed'      => '<p>The Email or password provided was incorrect, please try again.</p>',
            'account_suspended' => '<p>Impossible to log you in, cupcake! Your account has been suspended.</p>',
            'not_activated'     => '<p>Impossible to log you in, cupcake! Your account has not been activated, yet.</p>',

        ],

        'success' => [
            'register'  => '<p>Welcome to LaraFolio!</p><p>To complete your registration, enter the code from the email we just sent you!</p>',
            'login'     => '<p>You were successfully logged in! Enjoy the trip!</p>',
            'activate'  => '<p>Your account has been successfully activated!</p>',
        ],

        'info' => [

            'logout'    => '<p>You were successfully logged out! See you soon!</p>',

        ],

    ],

];