<?php

namespace Swef\Bespoke;

class Notification extends \Swef\Base\SwefNotification {

    public function __construct ( ) {
        // Always construct the base class - PHP does not do this implicitly
        parent::__construct ();
    }

    public function __destruct ( ) {
        // Always destruct the base class - PHP does not do this implicitly
        parent::__destruct ();
    }

}

?>
