<?php

namespace Swef\Bespoke;

class Moment extends \Swef\Base\SwefMoment {

    public function __construct () {
        // Always construct the base class - PHP does not do this implicitly
        parent::__construct ();
    }

    public function __destruct () {
        // Always destruct the base class - PHP does not do this implicitly
        parent::__destruct ();
    }

}

?>
