# npage_pagination
It is pagination library for php with mysql. It's create automatically generating navigation links.

<img src="https://raw.githubusercontent.com/minisuperfiles/npage_pagination/main/examples/preview.png" alt="Pagination preview" width="805"/>

### [Documentation](https://minisuperfiles.blogspot.com/p/documentation.html?project=npage_pagination) | [Download](https://github.com/minisuperfiles/MSFmultiSelect/archive/1.0.zip)

## Including library file
```php
require_once 'npage_pagination/npage_pagination.php';
```
## Using Example
```php
require_once "npage_pagination.php"; // including npage file
$npage = new npage_pagination(
	array(
		'hostname' => "localhost", // host name
		'username' => "root", // username
		'password' => "", // password
		'database' => "demo_proj" //database name
	),
	"SELECT * FROM `st_order`", //your query
	2 // number of records
); // create object
$data = $npage->get_records(); //get record from database in array format
```
```php
<div class="container"> 
<h1>nPage pagination - Page - <?php echo $npage->get_pageno(); // Get current page No ?></h1>
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
    //  print dynamic data
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
  <?php echo $npage->get_navigation(); // print navigation button ?>
</div>
```