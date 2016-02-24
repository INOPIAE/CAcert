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
*/ ?>
<? 
  include("../includes/general_stuff.php");
  ?>

<html>
<head>
    <title><?=_("Install CAcert Root using CEnroll Active-X component and PKCS-7")?></title>
    <link rel="stylesheet" href="styles/default.css" type="text/css">
    <script type="text/vbscript" src="/scripts/cenroll.vbs"></script>
</head>


<body LANGUAGE="VBScript" ONLOAD="InstallCert">

<? showbodycontent("CAcert.org",""); ?>
<p><?=_("Install a Root Certificate using Internet Explorer and the CEnroll ActiveX control. This avoids the Microsoft Certificate Installation wizard and all of its complexity and extra screens for users. This however will ONLY work for Microsoft Internet Explorer.")?></p>
<? showfooter(); ?>


