<?php $plugins = $this->swef->pluginsList (); ?>
<?php $c = $this->_GET (SWEF_GET_CLASSNAME); ?>

<?php if(array_key_exists($c,$plugins)): ?>
<?php     $plugin = new $c ($this); ?>
<?php     $plugin->propertiesLoad (); ?>

<?php $this->titleSet ('Plugins'); ?>

  <div class="option">
<?php     if ($plugins[$c][$this->swef->context[SWEF_COL_CONTEXT]][SWEF_STR_DASHBOARD]): ?>

    <div class="dashboard">
<?php         $plugin->_dashboard (); ?>

    </div>
<?php     endif; ?>

  </div>
<?php else: ?>

  <span>Select a plugin</span>
<?php endif; ?>

