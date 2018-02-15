<?php

namespace Swef\Bespoke;

class Page extends \Swef\Base\SwefPage {

    public function __construct ($swef) {
        // Always construct the base class - PHP does not do this implicitly
        parent::__construct ($swef);
    }

    public function __destruct ( ) {
        // Always destruct the base class - PHP does not do this implicitly
        parent::__destruct ();
    }

}

?>
