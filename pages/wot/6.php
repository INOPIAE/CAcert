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

if(!array_key_exists('notarise',$_SESSION['_config']))
	{
		echo "Error: No user data found.";
		exit;
	}

	$row = $_SESSION['_config']['notarise'];

	if($_SESSION['profile']['ttpadmin'] == 2)
		$methods = array('Face to Face Meeting', 'TTP-Assisted', 'TTP-TOPUP');
	elseif($_SESSION['profile']['ttpadmin'] == 1)
		$methods = array('Face to Face Meeting', 'TTP-Assisted');
	else
		$methods = array('Face to Face Meeting');

	$fname = $row['fname'];
	$mname = $row['mname'];
	$lname = $row['lname'];
	$suffix = $row['suffix'];
	$dob = $row['dob'];
	$name = $fname." ".$mname." ".$lname." ".$suffix;
	$_SESSION['_config']['wothash'] = md5($name."-".$dob);

	require_once($_SESSION['_config']['filepath']."/includes/notary.inc.php");

	AssureHead(_("Assurance Confirmation"),sprintf(_("Please check the following details match against what you witnessed when you met %s in person. You MUST NOT proceed unless you are sure the details are correct. You may be held responsible by the CAcert Arbitrator for any issues with this Assurance."), $fname));
	AssureTextLine(_("Name"),$name);
	AssureTextLine(_("Date of Birth"),$dob." ("._("YYYY-MM-DD").")");
	AssureMethodLine(_("Method"),$methods,'');
	AssureBoxLine("certify",sprintf(_("I certify that %s %s %s has appeared in person."), $fname, $mname, $lname),array_key_exists('certify',$_POST) && $_POST['certify'] == 1);
	AssureBoxLine("CCAAgreed",sprintf(_("I verify that %s %s %s has accepted the CAcert Community Agreement."), $fname, $mname, $lname),array_key_exists('CCAAgreed',$_POST) && $_POST['CCAAgreed'] == 1);
	AssureInboxLine("location",_("Location"),array_key_exists('location',$_SESSION['_config'])?$_SESSION['_config']['location']:"","");
	AssureInboxLine("date",_("Date"),array_key_exists('date',$_SESSION['_config'])?$_SESSION['_config']['date']:date("Y-m-d"),"<br/>"._("The date when the assurance took place. Please adjust the date if you assured the person on a different day (YYYY-MM-DD)."));
	AssureTextLine("",_("Only tick the next box if the Assurance was face to face."));
	AssureBoxLine("assertion",_("I believe that the assertion of identity I am making is correct, complete and verifiable. I have seen original documentation attesting to this identity. I accept that the CAcert Arbitrator may call upon me to provide evidence in any dispute, and I may be held responsible."),array_key_exists('assertion',$_POST) && $_POST['assertion'] == 1);
	AssureBoxLine("rules",_("I have read and understood the CAcert Community Agreement (CCA), Assurance Policy and the Assurance Handbook. I am making this Assurance subject to and in compliance with the CCA, Assurance policy and handbook."),array_key_exists('rules',$_POST) && $_POST['rules'] == 1);
	AssureTextLine(_("Policy"),"<a href=\"/policy/CAcert Community Agreement.php\" target=\"_blank\">"._("CAcert Community Agreement")."</a> -<a href=\"/policy/AssurancePolicy.php\" target=\"_blank\">"._("Assurance Policy")."</a> - <a href=\"http://wiki.cacert.org/AssuranceHandbook2\" target=\"_blank\">"._("Assurance Handbook")."</a>");
	AssureInboxLine("points",_("Points"),"","<br />(Max. ".maxpoints().")");
	AssureFoot($id,_("I confirm this Assurance"));

	if($_SESSION['profile']['ttpadmin'] >= 1) {
		?><div class='blockcenter'><a href="wot.php?id=16"><?=_('Show TTP details')?></a></div><?;
	}

?>
