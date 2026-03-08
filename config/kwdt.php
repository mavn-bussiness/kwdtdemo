<?php

return [
    'name' => env('APP_NAME', 'Katosi Women Development Trust'),
    'short_name' => env('APP_SHORT_NAME', 'KWDT'),
    'founded' => env('APP_FOUNDED', 1996),
    'registered_number' => env('APP_REGISTERED_NUMBER', 'S.5914/6911'),
    'registration_law' => env('APP_REGISTRATION_LAW', 'Non-Governmental Organizations Registration Statute of 1989'),
    'members' => env('APP_MEMBERS', 1235),
    'groups' => env('APP_GROUPS', 52),
    'districts' => array_map('trim', explode(',', env('APP_DISTRICTS', 'Mukono, Kalangala, Buvuma'))),
    'female_percentage' => env('APP_FEMALE_PERCENTAGE', 88),

    'vision' => 'Empowered women and youth with healthy and productive livelihoods in a sustainable environment',
    'mission' => 'Enabling women and female youth in rural and fisher communities to effectively engage in their social, economic and political development for sustainable livelihoods',

    'about' => 'Katosi Women Development Trust (KWDT) is a registered non profit organization aiming to improve living standards of poor & rural fisher communities in Uganda by empowering them to engage in their development processes.',
];
