<?php
require ("../npage_pagination.php");
$t = new npage_pagination(
	array(
		'hostname' => "localhost",
		'username' => "root",
		'password' => "",
		'database' => "demo_proj"
	),
	"SELECT * FROM `st_receipt`",
	2
);
$data = $t->get_records();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>nPage pagination Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container"> 
<h1>nPage pagination - Page - <?php echo $t->get_pageno() ?></h1>
<?php if($data) { ?>
  <table class="table table-hover">
    <thead>
      <tr>
      <?php 
      $keys = array_keys($data[0]); 
      for ($i = 0; $i < count($keys); $i++) {
      ?>
        <th><?php echo $keys[$i]; ?></th>
    <?php } ?>
      </tr>
    </thead>
    <tbody>
    <?php
    for ($i = 0; $i < count($data); $i++) {
      ?>
      <tr>
      <?php
        for ($j = 0; $j < count($keys); $j++) {
      ?>
        <td><?php echo $data[$i][$keys[$j]]; ?></td>
        <?php } ?>
      </tr>
    <?php } ?>
    </tbody>
  </table>
  <?php } else { ?>
  No records
  <?php } ?>
  <?php echo $t->get_navigation(); ?>
</div>
</body>
</html>