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
	include_once("../includes/shutdown.php");
?>
<p><?=_("Paste your own public OpenPGP key below. It should not contain a picture. CAcert will sign your key after submission.")?></p>
<form method="post" action="gpg.php">
<textarea name="CSR" cols="80" rows="15"><?=array_key_exists('CSR',$_POST)?strip_tags($_POST['CSR']):""?></textarea><br>
<input type="submit" name="process" value="<?=_("Submit")?>">
<input type="hidden" name="oldid" value="<?=$id?>">
</form>
