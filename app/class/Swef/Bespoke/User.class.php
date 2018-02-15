<?php

namespace Swef\Bespoke;

class User extends \Swef\Base\SwefUser {

    public function __construct ($swef) {
        // Always construct the base class - PHP does not do this implicitly
        parent::__construct ($swef);
    }

    public function __destruct () {
        // Always destruct the base class - PHP does not do this implicitly
        parent::__destruct ();
    }

}

?>
