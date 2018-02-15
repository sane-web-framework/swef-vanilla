<?php $this->titleSet ('System constants'); ?>
<?php

// Define
$dirs                                   = array (SWEF_CONFIG_PATH,SWEF_DIR_PLUGIN);
$prefixes                               = array ('constant.','configure.');
$suffixes                               = array ('.define.php');
$d                                      = scandir (SWEF_DIR_PLUGIN);
foreach ($d as $dir) {
    if (is_dir(SWEF_DIR_PLUGIN.'/'.$dir)) {
        array_push ($dirs,SWEF_DIR_PLUGIN.'/'.$dir);
    }
}
$files                                  = array ();
$files['http.php']                      = file ('./http.php');

// Search for files
foreach ($dirs as $dir) {
    $f                                  = scandir ($dir);
    foreach ($f as $file) {
        foreach ($prefixes as $p) {
            if (strpos($file,$p)===SWEF_INT_0) {
                $files[$file]           = file ($dir.'/'.$file);
                continue 2;
            }
        }
        foreach ($suffixes as $p) {
            if (substr($file,0-strlen($p))===$p) {
                $files[$file]           = file ($dir.'/'.$file);
                continue 2;
            }
        }
    }
}

// Search for constants
$constants                              = array ();
$c                                      = $this->swef->getDefinedConstants ();
$like                                   = trim ($this->_POST('swef-constants-like'));
$constants                              = array ();
foreach ($c as $constant=>$value) {
    $type                               = gettype ($value);
    if (is_array($value)) {
        $value                          = preg_replace (SWEF_STR_WHITESPACE_PREG,SWEF_STR__SPACE,print_r($value,SWEF_BOOL_TRUE));
    }
    if (!strlen($like) || stristr($constant,$like) || stristr($value,$like)) {
        $f                              = SWEF_STR__EMPTY;
        $l                              = SWEF_STR__EMPTY;
        foreach ($files as $file=>$lines) {
            foreach ($lines as $i=>$line) {
                if (strpos($line,$constant)===SWEF_BOOL_FALSE) {
                    continue;
                }
                $m                      = null;
                if (!preg_match (SWEF_PREG_CONSTANT_FIXED,$line,$m)) {
                    continue;
                }
                if ($m[1]=="'".$constant."'") {
                    $f                  = $file;
                    $l                  = $i + 1;
                    break 2;
                }
                if (!preg_match (SWEF_PREG_CONSTANT_VAR,$line,$m)) {
                    continue;
                }
                if ($m[1]=="'".$constant."'") {
                    $f                  = $file;
                    $l                  = $i + 1;
                    break 2;
                }
            }
        }
        $constants[$constant]           = array ($f,$l,$type,$value);
    }
}
if (!count($constants)) {
    $this->notify ($this->swef->translate('No user constants found'));
}


?>

<div class="content">

  <div class="list">
    <div class="constant">
      <label for="">Files:</label>
    </div>
<?php foreach ($files as $f=>$r): ?>

    <div class="constant">
      <span><?php echo htmlentities ($f); ?></span>
    </div>
<?php endforeach; ?>

  </div>

  <div class="vspace"></div>

  <form id="swef-constants" method="post" action="">

    <div class="input">
      <label for="" class="tiny">Like:</label>
      *<input type="text" name="swef-constants-like" value="<?php echo htmlentities ($this->_POST('swef-constants-like')); ?>" />*
      <input type="submit" value="<t en>Filter</t>" />
    </div>

  </form>

  <div class="vspace"></div>

  <div class="list">
<?php foreach ($constants as $c=>$v): ?>
    <div class="constant">
      <label for=""><?php echo htmlentities ($v[0]); ?></label>
      <label for="" class="wee"><?php if($v[1]): ?>[<?php echo htmlentities ($v[1]); ?>]:<?php endif; ?></label>
      <label for="" class="vast"><?php echo htmlentities ($c); ?></label>
      <label for="" class="tiny"><?php echo htmlentities ($v[2]); ?></label>
      <span><?php echo htmlentities ($v[3]); ?></span>
    </div>
<?php endforeach; ?>
  </div>

</div>


<?php $this->pull ('dashboard.menu','Constants'); ?>

