<?php 
	function scp($tmpsource = '/tmp/ubuntu.webm', 
		$destination = '/tmp/destination.webm', 
		$user='david', 
		$password='123',
		$address='localhost', 
		$port=22, 
		$perms=0644){
		if (!function_exists("ssh2_connect")) die("function ssh2_connect doesn't exist");
		// log in at $address on port $port
		if(!($con = ssh2_connect($address, $port))){
			echo "fail: unable to establish connection\n";
		} else {
			// try to authenticate with username root, password secretpassword
			if(!ssh2_auth_password($con, $user, $password)) {
				echo "fail: unable to authenticate\n";
			} else {
				// allright, we're in!
				echo "okay: logged in...\n";
				if (ssh2_scp_send($con, $tmpsource, $destination, 0644)){
					echo '<br><br>copy done';
				} else {
					echo '<br><br>copy failed';
				}
			}
		}
	}
?>
