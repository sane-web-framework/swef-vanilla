<?php

namespace Swef\Bespoke;

class Database extends \Swef\Base\SwefDatabase {

    public function __construct ($dsn,$usr,$pwd) {
        // Always construct the base class - PHP does not do this implicitly
        parent::__construct ($dsn,$usr,$pwd);
    }

    public function __destruct ( ) {
        // Always destruct the base class - PHP does not do this implicitly
        parent::__destruct ();
    }

}

?>
