# npage_pagination
It is pagination library for php with mysql. It's create automatically generating navigation links.

![Pagination preview](https://github.com/minisuperfiles/npage_pagination/blob/main/examples/preview.png?raw=true)

### [Documentation](https://minisuperfiles.blogspot.com/p/documentation.html?project=npage_pagination) | [Download](https://github.com/minisuperfiles/MSFmultiSelect/archive/1.0.zip)

## Including library file
```php
require_once 'npage_pagination/npage_pagination.php';
```
## Using Example
```php
require_once "npage_pagination/npage_pagination.php"; // including npage pagination file
$npage = new npage_pagination(
	array(
		'hostname' => "localhost", // host name
		'username' => "root", // user name
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
## Syntax (arguments)

```
new npage_pagination($database, $query, $numofrows);
$database = array(
    'hostname' => "host_name", 
    'username' => "user_name", 
    'password' => "password", 
    'database' => "database_name",
    'port' => 3306
);
$query = "SELECT * FROM TABLENAME";
$numofrows = 10;
```
### database
Give the database access details in an array format.
<ol type="1">
<li><b>hostname</b></li>
<li><b>username</b></li>
<li><b>password</b></li>
<li><b>database</b></li>
<li><b>port</b></li>
</ol>

### query
Give the select query, it also supports join query and union query.

### numofrows
Give the how many numbers record needs of a page.

<h5>npage_pagination methods</h5><dl>
  <dt><code>npage_pagination:get_query()</code></dt>
<dd>This method helps to get the query of the current page.<ul>
<li><b>code</b> : <code>$npage->get_query();</code></li></ul></dd>
<dt><code>npage_pagination:get_records($datatype)</code></dt>
  <dd>This method is used to get the data of the current page. datatype argument helps to control get the return data type of records (array or object)<ul>
<li><b>code</b> : <code>$npage->get_records('array');</code></li></ul></dd>
<dt><code>npage_pagination:get_pageno()</code></dt>
  <dd>This method helps to get the page number of the current page.<ul>
<li><b>code</b> : <code>$npage->get_pageno();</code></li></ul></dd>
  <dt><code>npage_pagination:get_navigation()</code></dt>
  <dd>This method use to get HTML navigation buttons<ul>
<li><b>code</b> : <code>$npage->get_navigation();</code></li>
</ul></dd>
</dl>

Learn more about in [minisuperfiles.blogspot.com](https://minisuperfiles.blogspot.com)
