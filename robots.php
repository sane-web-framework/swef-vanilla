<?php

$system     =  !;
$system    |=   preg_match ('<^/api/?$>',$_SERVER['REQUEST_URI']);

?>
# www.robotstxt.org/

User-agent: *

<?php if(preg_match('<^www\..*$>',$_SERVER['HTTP_HOST'])): ?>
Disallow:       /403
Disallow:       /404
Disallow:       /api
Disallow:       /login
Disallow:       /logout

<?php else: ?>
Disallow:       /

<?php endif; ?>

