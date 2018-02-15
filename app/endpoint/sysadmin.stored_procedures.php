<?php $this->titleSet ('Stored procedures'); ?>

<div class="content">

<p>This tool requires that the database user have permissions to read stored procedure information from the database.</p>

<?php
$ordering   = array ('Name','Definer','Modified','Created','Security_type');
$o          = 'Name';
if (in_array($this->_GET('o'),$ordering)) {
    $o      = $this->_GET ('o');
}
?>

<?php $sps = $this->swef->db->dbCall (SWEF_CALL_SPSSTATUS,$this->swef->db->dbName()); ?>
<?php $sps = $this->swef->dataSort ($sps,$o,SWEF_SORT_ASC); ?>

<p>Database may require special configuration to show SQL code here.</p>

  <table class="smalltext">
    <thead>
      <th><a href="?o=Name">Name</a></th>
      <th><a href="?o=Definer">Definer</a></th>
      <th><a href="?o=Modified">Modified</a></th>
      <th><a href="?o=Created">Created</a></th>
      <th><a href="?o=Security_type">Security type</a></th>
      <th>Comment</th>
      <th>Code</th>
    </thead>
    <tbody class="list">
<?php foreach($sps as $sp): ?>

      <tr>
        <td><?php echo htmlentities ($sp['Name']); ?></td>
        <td><?php echo htmlentities ($sp['Definer']); ?></td>
        <td><?php echo htmlentities ($sp['Modified']); ?></td>
        <td><?php echo htmlentities ($sp['Created']); ?></td>
        <td><?php echo htmlentities ($sp['Security_type']); ?></td>
        <td><?php echo htmlentities ($sp['Comment']); ?></td>
        <td>&nbsp;</td>
      </tr>
<?php endforeach; ?>

    </tbody>
  </table>

</div>


<?php $this->pull ('dashboard.menu','Stored procedures'); ?>

