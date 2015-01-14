<?php /*
   LibreSSL - CAcert web application
   Copyright (C) 2004-2008  CAcert Inc.

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

//generates a dot-code file of CAcert's Web of Trust
require_once("../includes/mysql.php");
require_once("../includes/notary.inc.php");

//get data
$int = 20;
$blnstrong = true;
$salt = bin2hex(openssl_random_pseudo_bytes($int, $blnstrong));

$res = query_init ("select CONVERT(sha1(`n`.`from` + '$salt'+ sha1(u1.uniqueID) ) USING utf8) as `f1`, CONVERT(sha1(`n`.`to` + '$salt' + sha1(u2.uniqueID)) USING utf8) as `t1`
    from `notary` as `n`
       inner join `users` as `u1` on `u1`.`id` = `n`.`from`
       inner join `users` as `u2` ON `u2`.`id` = `n`.`to`
    where `n`.`deleted` = 0
    group by `f1`, `t1`
    order by `t1`");

//start output
$output = "digraph G{\r\n";
$output1 = "";
$output2 = "";
$from=array();
$to = array();
//create edges
while($row = mysql_fetch_assoc($res)){
    $output2 .= '"' . $row['f1'] . '" -> "' . $row['t1'] . "\"\r\n";
    if (array_key_exists($row['f1'], $from)) {
         $from[$row['f1']] += 1;
    } else {
         $from[$row['f1']]  = 1;
    }
    if (array_key_exists($row['t1'], $to)) {
        $to[$row['t1']] += 1;
    } else {
        $to[$row['t1']] = 1;
    }
}

//create nodes
$output1 .= "node [style=filled, color=\"#CFFF00\"]\r\n";
$node = array();
$frommax = array();
$frommax['value'] = 0;

foreach($from as $fr => $value){
    $node[$fr]['from'] = $value;
    if ($value > $frommax['value']) {
        $frommax['value'] = $value;
        $frommax['key'] = $fr;
    }
}

foreach($to as $fr => $value){
    if (array_key_exists($fr, $node)) {
        $node[$fr]['to'] = $value;
    } else {
        $node[$fr]['from'] = 0;
        $node[$fr]['to'] = $value;
    }
}

foreach ($node as $n => $g) {
    if (array_key_exists('from',$g )) {
        if ( $g['from'] == 0) {
            $color = ", color=\"#00BE00\"";
        } else {
            $color = '';
        }
        if (array_key_exists('to',$g )) {
            $output1 .= '"' . $n . '" [label="' . $g['from'] . '/' . $g['to'] . '"' . $color . ']' . "\r\n";
        } else {
            $output1 .= '"' . $n . '" [label="' . $g['from'] . '/0"]' . "\r\n";
        }
    } else {
        $output1 .= '"' . $n . '" [label="0/' . $g['to'] . '", color=\"#00BE00\"]' . "\r\n";
    }
}

//assemble output
$output .= 'graph [size="46.81102,33.11024", len=0.5, overlap=false, outputorder=edgesfirst, start="' . $frommax['key'] . "\"]\r\n"
    . "edge [color=\"#11568C\"]\r\n". $output1 . $output2 . '}' . "\r\n";

//create output file
$filehandle = fopen("wot_map.dot","w");
fwrite($filehandle, $output);