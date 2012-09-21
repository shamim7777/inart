<?php

/*--
-- Database: `collage`
--*/

$conn=mysql_connect("localhost","root","");

//$database=mysql_query("CREATE DATABASE nakano",$conn);

if (!$conn)
  {
  die('Could not connect: ' . mysql_error());
  }

// Create database
if (mysql_query("CREATE DATABASE collage",$conn))
  {
  echo "Database created";
  }
else
  {
  echo "Error creating database: " . mysql_error();
  }

mysql_select_db("collage",$conn);
	
	
/*
-- --------------------------------------------------------

--
-- Table structure for table `ia-collage`
--
*/
	
$ia-collage=mysql_query("CREATE TABLE  ia-collage(
  id int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY(id),
  email varchar(50),
  groupname varchar(50),
  date timestamp DEFAULT current_timestamp,
  complete boolean NOT NULL DEFAULT 0,
  active boolean NOT NULL DEFAULT 1,
  complete_url varchar(50)
)");

/*
-- --------------------------------------------------------

--
-- Table structure for table `ia-collage-images`
--
*/

$ia-collage-images=mysql_query("CREATE TABLE ia-collage-images(
  id int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY(id),
  url varchar(50)
)") ;

/*
-- --------------------------------------------------------

--
-- Table structure for table `ia-sigart`
--
*/

$ia-sigart=mysql_query("CREATE TABLE ia-sigart(
  id int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY(id),
  email varchar(50),
  background int,
  sig longblob,
  date timestamp DEFAULT current_timestamp,
  complete boolean NOT NULL DEFAULT 0,
  active boolean NOT NULL DEFAULT 1,
  complete_url varchar(50)
)");

/*
-- --------------------------------------------------------

--
-- Table structure for table `ia-background`
--
*/

$ia-background=mysql_query("CREATE TABLE ia-background(
  id int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY(id),
  url varchar(50),
  title varchar(50),
  city varchar(50),
  tag varchar(50),
  date timestamp DEFAULT current_timestamp
  )");


?>