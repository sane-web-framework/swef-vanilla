<?php

namespace Swef\Bespoke;

class Endpoint extends \Swef\Base\SwefEndpoint {

    public function __construct ($swef,$endpoint=SWEF_STR__EMPTY) {
        // Always construct the base class - PHP does not do this implicitly
        parent::__construct ($swef,$endpoint);
    }

    public function __destruct ( ) {
        // Always destruct the base class - PHP does not do this implicitly
        parent::__destruct ();
    }

}

?>
