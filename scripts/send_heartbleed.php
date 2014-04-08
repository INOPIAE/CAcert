#!/usr/bin/php -q
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

// read texts

$lines_EN = "";
if (file_exists("thawte_EN.txt"))
{
	$fp = fopen("thawte_EN.txt", "r");
	while(!feof($fp))
	{
		$line = trim(fgets($fp, 4096));
		$line = wordwrap($line, 75, "\n")."\n";
		$line = mb_convert_encoding($line, "HTML-ENTITIES", "UTF-8");
		$lines_EN .= $line;
	}
	fclose($fp);
}

$lines_DE = "";
if (file_exists("thawte_DE.txt"))
{
	$fp = fopen("thawte_DE.txt", "r");
	while(!feof($fp))
	{
		$line = trim(fgets($fp, 4096));
		$line = wordwrap($line, 75, "\n")."\n";
		$line = mb_convert_encoding($line, "HTML-ENTITIES", "UTF-8");
		$lines_DE .= $line;
	}
	fclose($fp);
}

$lines_NL = "";
if (file_exists("thawte_NL.txt"))
{
	$fp = fopen("thawte_NL.txt", "r");
	while(!feof($fp))
	{
		$line = trim(fgets($fp, 4096));
		$line = wordwrap($line, 75, "\n")."\n";
		$line = mb_convert_encoding($line, "HTML-ENTITIES", "UTF-8");
		$lines_NL .= $line;
	}
	fclose($fp);
}

$lines_FR = "";
if (file_exists("thawte_FR.txt"))
{
	$fp = fopen("thawte_FR.txt", "r");
	while(!feof($fp))
	{
		$line = trim(fgets($fp, 4096));
		$line = wordwrap($line, 75, "\n")."\n";
		$line = mb_convert_encoding($line, "HTML-ENTITIES", "UTF-8");
		$lines_FR .= $line;
	}
	fclose($fp);
}

$lines_ES = "";
if (file_exists("thawte_ES.txt"))
{
	$fp = fopen("thawte_ES.txt", "r");
	while(!feof($fp))
	{
		$line = trim(fgets($fp, 4096));
		$line = wordwrap($line, 75, "\n")."\n";
		$line = mb_convert_encoding($line, "HTML-ENTITIES", "UTF-8");
		$lines_ES .= $line;
	}
	fclose($fp);
}

$lines_RU = "";
if (file_exists("thawte_RU.txt"))
{
	$fp = fopen("thawte_RU.txt", "r");
	while(!feof($fp))
	{
		$line = trim(fgets($fp, 4096));
		$line = wordwrap($line, 75, "\n")."\n";
		$line = mb_convert_encoding($line, "HTML-ENTITIES", "UTF-8");
		$lines_RU .= $line;
	}
	fclose($fp);
}

// read last used id
$lastid = 0;
if (file_exists("send_thawte_lastid.txt"))
{
	$fp = fopen("send_thawte_lastid.txt", "r");
	$lastid = trim(fgets($fp, 4096));
	fclose($fp);
}

echo "ID now: $lastid\n";


$count = 0;

$query = "select `id`,`fname`,`lname`,`email`,`language` from `users` where `deleted` = 0 and `id` > '$lastid' order by `id`";

$res = mysql_query($query);

while($row = mysql_fetch_assoc($res))
{
	$mailtxt = "Hello ${row["fname"]} ${row["lname"]},\n".$lines_EN."\n\n";
	switch ($row["language"])
	{
		case "de_DE":
		case "de":
			$mailtxt .= $lines_DE;
			break;

		case "nl_NL":
		case "nl":
			$mailtxt .= $lines_NL;
			break;

		case "fr_FR":
		case "fr":
			$mailtxt .= $lines_FR;
			break;

		case "es_ES":
		case "es":
			$mailtxt .= $lines_ES;
			break;

		case "ru_RU":
		case "ru":
			$mailtxt .= $lines_RU;
			break;
	}

	sendmail($row['email'], "[CAcert.org] Changes at CAcert", $mailtxt, "mailing@cacert.org", "", "", "CAcert", "returns@cacert.org", "");

	$fp = fopen("send_thawte_lastid.txt", "w");
	fputs($fp, $row["id"]."\n");
	fclose($fp);

	$count++;
	echo "Sent ${count}th mail. User ID: ${row["id"]}\n";

	sleep (1);
}
