<?php

return [
    'menu'     => [
        'dashboard'          => 'Dashboard',
        'admin_users'        => 'Admin Users',
        'users'              => 'Users',
        'site-configuration' => 'Site Configuration',
    ],
    'messages' => [
        'general' => [
            'update_success' => 'Successfully updated.',
            'create_success' => 'Successfully created.',
            'delete_success' => 'Successfully deleted.',
        ],
        'campaign' => [
            'approve_campaign' => 'Your application for AAA campaign was approved. We will contact you shortly for next steps.',
        ],

    ],
    'errors'   => [
        'general'  => [
            'save_failed' => 'Failed To Save. Please contact with developers',
        ],
        'requests' => [
            'me' => [
                'email'    => [
                    'required' => 'Email Required',
                    'email'    => 'Email is not valid',
                ],
                'password' => [
                    'min' => 'Password need at least 6 letters',
                ],
            ],
        ],
    ],
    'pages'    => [
        'common'                   => [
            'buttons' => [
                'create'          => 'Create New',
                'edit'            => 'Edit',
                'save'            => 'Save',
                'delete'          => 'Delete',
                'cancel'          => 'Cancel',
                'add'             => 'Add',
                'search'          => 'Search',
                'preview'         => 'Preview',
                'forgot_password' => 'Send Me Email!',
                'reset_password'  => 'Reset Password',
                'clear'           => 'Restore',
                'close'           => 'Close',
                'serve_image'     => 'Server image',
                'computer_image'  => 'Computer\'s image',
                'approve'         => 'Approve',
            ],
            'labels' => [
                'image_lib_title' => 'Image libraries',
            ],
        ],
        'auth'                     => [
            'buttons'  => [
                'sign_in'         => 'Sign In',
                'forgot_password' => 'Send Me Email!',
                'reset_password'  => 'Reset Password',
            ],
            'messages' => [
                'remember_me'     => 'Remember Me',
                'please_sign_in'  => 'Sign in to start your session',
                'forgot_password' => 'I forgot my password',
                'reset_password'  => 'Please enter your e-mail address and new password',
            ],
        ],
        'site-configurations'      => [
            'columns' => [
                'locale'                => 'Locale',
                'name'                  => 'Name',
                'title'                 => 'Title',
                'keywords'              => 'Keywords',
                'description'           => 'Descriptions',
                'ogp_image_id'          => 'OGP Image',
                'twitter_card_image_id' => 'Twitter Card Image',
            ],
        ],
        'articles'                 => [
            'columns' => [
                'slug'               => 'Slug',
                'title'              => 'Title',
                'keywords'           => 'Keywords',
                'description'        => 'Description',
                'content'            => 'Content',
                'cover_image_id'     => 'Cover Image',
                'locale'             => 'Locale',
                'is_enabled'         => 'Active',
                'publish_started_at' => 'Publish Started At',
                'publish_ended_at'   => 'Publish Ended At',
                'is_enabled_true'    => 'Enabled',
                'is_enabled_false'   => 'Disabled',

            ],
        ],
        'user-notifications'       => [
            'columns' => [
                'user_id'       => 'User',
                'category_type' => 'Category',
                'type'          => 'Type',
                'data'          => 'Data',
                'locale'        => 'Locale',
                'content'       => 'Content',
                'read'          => 'Read',
                'read_true'     => 'Read',
                'read_false'    => 'Unread',
                'sent_at'       => 'Sent At',
            ],
        ],
        'admin-user-notifications' => [
            'columns' => [
                'user_id'       => 'User',
                'category_type' => 'Category',
                'type'          => 'Type',
                'data'          => 'Data',
                'locale'        => 'Locale',
                'content'       => 'Content',
                'read'          => 'Read',
                'read_true'     => 'Read',
                'read_false'    => 'Unread',
                'sent_at'       => 'Sent At',
            ],
        ],
        'images'                   => [
            'columns' => [
                'url'                    => 'URL',
                'title'                  => 'Title',
                'is_local'               => '',
                'entity_type'            => 'EntityType',
                'entity_id'              => 'ID',
                'file_category_type'     => 'Category',
                's3_key'                 => '',
                's3_bucket'              => '',
                's3_region'              => '',
                's3_extension'           => '',
                'media_type'             => 'Media Type',
                'format'                 => 'Format',
                'file_size'              => 'File Size',
                'width'                  => 'Width',
                'height'                 => 'Height',
                'has_alternative'        => '',
                'alternative_media_type' => '',
                'alternative_format'     => '',
                'alternative_extension'  => '',
                'is_enabled'             => 'Status',
                'is_enabled_true'        => 'Enabled',
                'is_enabled_false'       => 'Disabled',
            ],
        ],
        'users'                    => [
            'columns' => [
                'name'                      => 'Name',
                'email'                     => 'Email',
                'password'                  => 'Password',
                'drivers_licence_image_id'  => 'Driver licence',
            ],
        ],
        'countries'   => [
            'columns'  => [
                'code' => 'Code',
                'name_en' => 'English name',
                'name_local' => 'Local name',
                'flag_image_id' => 'Flag image',
                'order' => 'Order',
            ],
        ],
        'cities'   => [
            'columns'  => [
                'name_en' => 'English name',
                'name_local' => 'Local name',
                'country_code' => 'Country',
                'order' => 'Order',
            ],
        ],
        'advertisers'   => [
            'columns'  => [
                'name' => 'Name',
                'email' => 'Email',
                'password' => 'Password',
                'locale' => 'Locale',
                'profile_image_id' => 'Profile Image',
                'remember_token' => 'Remember Token',
            ],
        ],
        'areas'   => [
            'columns'  => [
                'name_en' => 'English name',
                'name_local' => 'Local name',
                'country_code' => 'Country',
                'city_id' => 'City',
                'longitude' => 'Longitude',
                'latitude' => 'Latitude',
                'radius' => 'Radius',
                'location_data' => 'Location data',
                'order' => 'Order',
            ],
        ],
        'oauth-clients'   => [
            'columns'  => [
                'user_id' => 'User_id',
                'name' => 'Name',
                'secret' => 'Secret',
                'redirect' => 'Redirect',
                'personal_access_client' => 'Personal_access_client',
                'password_client' => 'Password_client',
                'revoked' => 'Revoked',
            ],
        ],
        'campaigns'   => [
            'columns'  => [
                'name' => 'Name',
                'description' => 'Description',
                'distance' => 'Distance',
                'minimum_revenue' => 'Minimum revenue',
                'maximum_revenue' => 'Maximum revenue',
                'budget_currency_code' => 'Budget currency',
                'budget' => 'Budget',
                'spend' => 'Spend',
                'start_date' => 'Start date',
                'end_date' => 'End date',
                'country_code' => 'Country',
                'city_id' => 'City',
                'advertiser_id' => 'Advertiser',
                'brand_image_id' => 'Campaign image',
                'area_id' => 'Area',
                'status' => 'Status',
            ],
        ],
        'campaign-images'   => [
            'columns'  => [
                'campaign_id' => 'Campaign',
                'image_id' => 'Wrapping image',
                'base_revenue' => 'Earning rate',
                'currency_code' => 'Currency',
                'image_type' => 'Wrapping type',
            ],
        ],
        'area-weights'   => [
            'columns'  => [
                'area_id' => 'Area',
                'day_of_week' => 'Day of week',
                'start_time' => 'Start time',
                'end_time' => 'End time',
                'weight' => 'Weight',
            ],
        ],
        'area-weight-logs'   => [
            'columns'  => [
                'area_id' => 'Area id',
                'day_of_week' => 'Day of week',
                'start_time' => 'Start time',
                'end_time' => 'End time',
                'weight' => 'Weight',
                'active_to' => 'Active to',
            ],
        ],
        'advertiser-notifications'   => [
            'columns'  => [
                'advertiser_id' => 'Advertiser',
                'category_type' => 'Category',
                'type' => 'Type',
                'data' => 'Data',
                'content' => 'Content',
                'locale' => 'Locale',
                'read' => 'Read',
                'sent_at' => 'Sent_at',
            ],
        ],
        'payment-logs'   => [
            'columns'  => [
                'user_id' => 'User',
                'bank_account_id' => 'Bank account',
                'status' => 'Status',
                'paid_amount' => 'Paid amount',
                'paid_for_month' => 'Paid for month',
                'currency_code' => 'Currency code',
                'paid_at' => 'Paid at',
                'note' => 'Note',
            ],
        ],
        'banks'   => [
            'columns'  => [
                'name' => 'Name',
                'description' => 'Description',
                'order' => 'Order',
            ],
        ],
        'bank-accounts'   => [
            'columns'  => [
                'user_id' => 'User',
                'bank_id' => 'Bank',
                'branch_name' => 'Branch name',
                'owner_name' => 'Owner name',
                'account_info' => 'Account info',
            ],
        ],
        'campaign-users'   => [
            'columns'  => [
                'campaign_id' => 'Campaign',
                'campaign' => 'Campaign',
                'user_id' => 'User',
                'user' => 'User',
                'wrapping_image_id' => 'Wrapping image',
                'status' => 'Status',
                'finished_at' => 'Finished at',
                'user_info' => 'User info',
                'created_at' => 'Applied at',
            ],
        ],
        /* NEW PAGE STRINGS */
    ],
    'roles'    => [
        'super_user' => 'Super User',
        'site_admin' => 'Site Administrator',
    ],
];
