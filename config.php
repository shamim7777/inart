<?php

 		$server = "localhost"; //Host type
		$user = "inart"; //Databace username
		$password = "inart!@#"; //Database password
		$database = "webemerse_inart"; //Database name
		/*
		$server = "localhost"; //Host type
		$user = "root"; //Databace username
		$password = ""; //Database password
		$database = "exling"; //Database name
		*/
		ini_set('session.bug_compat_warn', 0);
		//Database connection
		mysql_connect("$server", "$user", "$password") || die("<b>Could not connect to server...</b><br><font color=\"#808080\">Please check database username and password!<br>" . mysql_error() . "<br><br></font>");
		mysql_select_db("$database") || die("<b>Database not found...</b><br><font color=\"#808080\">Please check database name<br></font>");
	

?>