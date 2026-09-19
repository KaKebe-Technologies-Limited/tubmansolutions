<?php
/**
 * SMTP settings for website enquiries — Titan Email (Hostinger).
 *
 * 1. Copy this file to includes/mail-config.php (already done on first setup).
 * 2. Put the password of the info@htubmansolutions.com mailbox in 'password'.
 * mail-config.php is git-ignored and blocked from the web, so the password never leaves the server.
 */
return [
    'host'       => 'smtp.titan.email',
    'port'       => 465,
    'secure'     => 'ssl',                          // 'ssl' for 465, 'tls' for 587
    'username'   => 'info@htubmansolutions.com',
    'password'   => '',                             // <-- mailbox password (Hostinger hPanel → Emails → info@ → change password)
    'from_email' => 'info@htubmansolutions.com',    // must be the same mailbox as 'username'
    'from_name'  => 'H.Tubman Solutions Website',
    'to'         => 'info@htubmansolutions.com',    // where enquiries are delivered
    'cc'         => [],                             // optional extra recipients, e.g. ['sales@htubmansolutions.com']
];
