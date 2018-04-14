<?php $this->titleSet ('Home'); ?>

<div class="content">

  <h2><t en>Welcome</t> <?php echo htmlspecialchars ($this->swef->user->userName); ?>!</h2>

</div>

<div class="menu">

  <h2><t en>Home</t></h2>

<?php $this->pull ('dashboard.menu'); ?>

</div>
