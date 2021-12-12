<?php
include('include/my.php');
/*
Forma de uso
include_once ("usersOnline.class.php");
$visitors_online = new usersOnline();

if ($visitors_online->count_users() == 1) {
	echo "There is " . $visitors_online->count_users() . " visitor online";
}
else {
	echo "There are " . $visitors_online->count_users() . " visitors online";
}

--------------------------------------------
Table structure:
CREATE TABLE `useronline` (
  `id` int(10) NOT NULL auto_increment,
  `ip` varchar(15) NOT NULL default '',
   dir TEXT NOT NULL default '',
  `timestamp` varchar(15) NOT NULL default '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id`(`id`)
) TYPE=MyISAM COMMENT='' AUTO_INCREMENT=1 ;

*/

class usersOnline {

	var $timeout = 2000;
	var $count = 0;
	
	function usersOnline () {
		$this->timestamp = time();
		$this->ip = $this->ipCheck();
		$this->new_user();
		$this->delete_user();
		$this->count_users();
	}
	
	function ipCheck() {
	/*
	This function checks if user is coming behind proxy server. Why is this important?
	If you have high traffic web site, it might happen that you receive lot of traffic
	from the same proxy server (like AOL). In that case, the script would count them all as 1 user.
	This function tryes to get real IP address.
	Note that getenv() function doesn't work when PHP is running as ISAPI module
	*/
		if (getenv('HTTP_CLIENT_IP')) {
			$ip = getenv('HTTP_CLIENT_IP');
		}
		elseif (getenv('HTTP_X_FORWARDED_FOR')) {
			$ip = getenv('HTTP_X_FORWARDED_FOR');
		}
		elseif (getenv('HTTP_X_FORWARDED')) {
			$ip = getenv('HTTP_X_FORWARDED');
		}
		elseif (getenv('HTTP_FORWARDED_FOR')) {
			$ip = getenv('HTTP_FORWARDED_FOR');
		}
		elseif (getenv('HTTP_FORWARDED')) {
			$ip = getenv('HTTP_FORWARDED');
		}
		else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
	
	function new_user() {#http://".$_SERVER[HTTP_HOST].
		$insert = mysql_query ("INSERT INTO useronline(timestamp, ip, dir,referer) VALUES ('$this->timestamp', '$this->ip', '".$_SERVER[REQUEST_URI]."','".$_SERVER[HTTP_REFERER]."')");
	}
	
	function delete_user() {
		$delete = mysql_query ("DELETE FROM useronline WHERE timestamp < ($this->timestamp - $this->timeout)");
	}
	
	function count_users() {
		$count = mysql_num_rows ( mysql_query("SELECT DISTINCT ip FROM useronline"));
		return $count;
	}

}
?>