<?php
/**
 * Function to localize our site
 * @param $site The Site object
 */
return function(Felis\Site $site) {
// Set the time zone
    date_default_timezone_set('America/Detroit');

    $site->setEmail('vescheju@cse.msu.edu');
    $site->setRoot('/~vescheju/step8');
    $site->dbConfigure('mysql:host=mysql-user.cse.msu.edu;dbname=vescheju',
        'vescheju',       // Database user
        'gogreen',     // Database password
        'test8_');            // Table prefix
};