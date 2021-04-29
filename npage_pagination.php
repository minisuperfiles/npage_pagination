<?php
/* @minisuperfiles
 * npage_pagination v1.0
 * Copyright (c) 2021 Mini Super Files | https://github.com/minisuperfiles/npage_pagination/blob/master/LICENSE
 * https://github.com/minisuperfiles/npage_pagination
 */
class npage_pagination {
	public $db;
  	public $limitRows;
	public $query;
	public $sqlObj;
	function __construct($db = null, $query = '', $limitRows = 10) {
		$this->db = $db; 
		$this->query = $query;  
		$this->limitRows = $limitRows;
		$this->bulid();
	}
	function db_connect() {
		if (isset($this->db['port'])) {
			$this->sqlObj = new mysqli($this->db['hostname'], $this->db['username'], $this->db['password'], $this->db['database'], $this->db['port']);
		} else {
			$this->sqlObj = new mysqli($this->db['hostname'], $this->db['username'], $this->db['password'], $this->db['database']);
		}
		if ($this->sqlObj->connect_errno) {
			echo "Failed to connect to MySQL: " . $this->sqlObj->connect_error;
		}
	}
	function bulid() {
		$this->db_connect();
		//get current page number
		if (isset($_GET['nPage'])) {
			$cu_pNo = $_GET['nPage'];
		} else {
			$cu_pNo = 1;
		}
		//set page number
		$this->pageNo = $cu_pNo;
		$qStr = true;
		//get query string
		if ($qStr == false) {
			$qStr='';
		} elseif($qStr == true) {
			$qStrs = preg_replace("/&nPage(=[^&]*)?|^nPage(=[^&]*)?&?/", "", $_SERVER['QUERY_STRING']);
			if ($qStrs != '') {
				$qStr = '&' . $qStrs;
			} else { 
				$qStr = ''; 
			}
		}
		//bulid query
		$countSQL = "select count(*) num from ({$this->query}) tmp";
		$sql = "select * from ({$this->query}) tmp";
		$limit_No = $this->limitRows;
		// page nation function start
		$stNO = (($cu_pNo - 1) * $limit_No);
		$rowCountQ = $this->sqlObj->query($countSQL);
		$row = $rowCountQ->fetch_assoc();
		$rowCount = $row['num'];
		if (0 < ($rowCount % $limit_No)) {
			$num = intval(($rowCount / $limit_No) + 1); 
		} else {
			$num = intval($rowCount/$limit_No); 
		}
		$renSQL = "select * from ({$sql}) tmp limit {$stNO},{$limit_No}";
		if ($cu_pNo != $num) { 
			$nNext = "?nPage=" . ($cu_pNo + 1) . $qStr; 
		} else { 
			$nNext = "javascript:void(0)"; 
		}
		if ($cu_pNo != 1) { 
			$nPervies = "?nPage=" . ($cu_pNo - 1) . $qStr; 
		} else {
			$nPervies="javascript:void(0)"; 
		}
		$html="
		<nav aria-label='Page navigation'>
		<ul class='pagination'>
		<li>
			<a href='{$nPervies}' aria-label='Previous'>
			<span aria-hidden='true'>«</span>
			</a>
		</li>";
		for ($n = 1; $n <= $num; $n++) {
			$classname = ($cu_pNo == $n) ? " class='active'" :  "";
			$html .= "<li{$classname}><a href='?nPage={$n}{$qStr}'";
			$html .= ">{$n}</a></li>";
		}
		$html .= "<li>
			<a href='{$nNext}' aria-label='Next'>
			<span aria-hidden='true'>»</span>
			</a>
		</li>
		</ul>
		</nav>
		";
		if ($rowCount > $limit_No) {
			$renHtml = $html;
		} else {
			$renHtml = "";
		}
		$this->result_query = $renSQL;
		$this->navigation = $renHtml;
	}
	function get_query() {
		return $this->result_query;
	}
	function get_records($resp = 'array') {
		$res = $this->sqlObj->query($this->result_query);
		$data = [];
		if ($resp == 'object') {
			while ($obj = $res->fetch_object()) {
				$data[] = $obj;
			}
		} else {
			$data = $res->fetch_all(MYSQLI_ASSOC);
		}
		return $data;
	}
	function get_navigation($id = 'npage_pagination1') {
		$html = "<div id='{$id}'>{$this->navigation}</div>";
		return $html;
	}
	function get_pageno() {
		return $this->pageNo;
	}
}
?>
