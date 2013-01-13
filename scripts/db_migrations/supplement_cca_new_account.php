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
	$query="SELECT *
		FROM `users`
		WHERE `created` >= '2009-04-01' AND `verified` =1 AND `deleted` =0
		AND NOT `users`.`id` IN
			(SELECT `user_agreements`.`memid`
				FROM `user_agreements`
				WHERE `user_agreements`.`memid` = `users`.`id`
				AND `user_agreements`.`document` = 'CCA')";

$fp=fopen('cca_supplement_'.date('Y-m-d-His').'.log', 'w+');
$res = mysql_query($query);
$icount=0;

while($row = mysql_fetch_assoc($res)){
	$query="insert into `user_agreements` set `memid`=".$row['id'].", `secmemid`=0
		,`document`='CCA',`date`='".$row['created']."', `active`=1,`method`='account creation',`comment`=''" ;
	$res = mysql_query($query);
	if (1==$res) {
		fprintf($fp,'Account id %s with primary email address %s and creation date %s was succesfully inserted into user_agreements.',$row['id'],$row['email'],$row['created']);
		$icount+=1;
	}else{
		fprintf($fp,'There is a problem with account id %s with primary email address %s and creation date %s.',$row['id'],$row['email'],$row['created']);
		die(sprintf($fp,'There is a problem with account id %s with primary email address %s and creation date %s.',$row['id'],$row['email'],$row['created']));
	}
}

fprintf($fp,'%s accounts were succesfully inserted into user_agreements.',$icount);
fclose($fp);

echo(sprintf($fp,'%s accounts were succesfully inserted into user_agreements.',$icount));
?>

