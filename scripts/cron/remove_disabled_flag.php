#!/usr/bin/php -q
<? /*
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

require_once(dirname(__FILE__).'/../../includes/mysql.php');

//updated disable flag when client certificate is expired
mysql_query("update `emailcerts` set `disablelogin` = 1 where `expire` < NOW() and `disablelogin` = 0");


//updated disable flag when client certificate is expired
mysql_query("update `emailcerts` set `disablelogin` = 1 where `revoked`!='0000-00-00 00:00:00' and `disablelogin` = 0");

