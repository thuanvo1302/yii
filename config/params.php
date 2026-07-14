<?php

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'jwt'       => $_ENV['JWT_KEY'] ?? '',
    'ttl'        => $_ENV['JWT_TTL'],
    'currentUser' => ''
];
