<?php

/*
   LibreSSL - CAcert web application
   Copyright (C) 2004-2009  CAcert Inc.

   This program is free software; you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation; version 2 of the License.

   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with this program; if not, write to the Free Software
   Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
*/
include_once("../includes/mysql.php");


// add CCA acceptance during account creation from 2009-04-01 see https://bugs.cacert.org/view.php?id=708
$query="select * from `users` where `created`>='2009-04-01' order by `created`";
$res = mysql_query($query);
while($row = mysql_fetch_assoc($res)){
	$query="insert into `user_agreements` set `memid`=".$row['id'].", `secmemid`=0
		,`document`='CCA',`date`='".$row['created']."', `active`=1,`method`='account creation',`comment`=''" ;
	$res = mysql_query($query);
}

?>
