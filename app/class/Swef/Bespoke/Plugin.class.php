<?php

namespace Swef\Bespoke;

class Plugin extends \Swef\Base\SwefPlugin {

    public function __construct ($page,$ext) {
        // Always construct the base class - PHP does not do this implicitly
        parent::__construct ($page,$ext);
    }

    public function __destruct ( ) {
        // Always destruct the base class - PHP does not do this implicitly
        parent::__destruct ();
    }

}

?>
