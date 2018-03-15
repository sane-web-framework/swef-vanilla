<?php $this->titleSet ('Plugins'); ?>
<?php $plugins = $this->swef->pluginsList (); ?>
<?php $c = $this->_GET (SWEF_GET_CLASSNAME); ?>

<div class="content">

<?php if(array_key_exists($c,$plugins)): ?>
<?php     $plugin = new $c ($this); ?>
<?php     $plugin->propertiesLoad (); ?>

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

</div>


<?php $this->pull ('dashboard.menu','title','Plugins'); ?>

<div class="menu-plugins">

<?php if (!is_array($plugins)): ?>

  <p class="error"><t en>Unable to list plugins</t></p>

<?php else: ?>

  <div class="list">

<?php     foreach ($plugins as $c=>$p): ?>

    <div class="item<?php if($this->_GET(SWEF_GET_CLASSNAME)==$c): ?> selected<?php endif; ?>">
      <h3><?php echo htmlentities ($c); ?></h3>
      <span>Enabled for:</span>
<?php         foreach ($p as $context=>$properties): ?>
<?php             if ($properties[SWEF_COL_ENABLED]): ?>
      <span class="hilite"><?php echo htmlentities ($context); ?></span>

<?php             endif; ?>
<?php     endforeach; ?>
<?php         if ($p[$this->swef->context[SWEF_COL_CONTEXT]][SWEF_STR_DASHBOARD]): ?>
      <div><a href="./sysadmin.plugins?c=<?php echo htmlentities ($c); ?>"><t en>Dashboard</t></a></div>
<?php         endif; ?>

    </div>
    <hr/>

<?php     endforeach; ?>

  </div>

<?php endif; ?>

</div>
