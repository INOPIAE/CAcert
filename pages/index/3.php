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

<p><?=sprintf(_("You are bound by the %s Root Distribution Licence %s for any re-distributions of CAcert's roots."),"<a href='/policy/RootDistributionLicense.php'>","</a>")?></p>

<h3><?=_("Windows Installer") ?></h3>
<ul class="no_indent">
	<li><? printf(_("%s Windows installer package %s for browsers that use the Windows certificate store %s (for example Internet Explorer, Chrome on Windows and Safari on Windows)"), '<a href="certs/CAcert_Root_Certificates.msi">', '</a>', '<br/>')?></li>
	<li><?=_("SHA1 Hash:") ?> 2db1957db31aa0d778d1a65ea146760ee1e67611</li>
	<li><?=_("SHA256 Hash:") ?> 88883f2e3117bae6f43922fbaef8501b94efe4143c12116244ca5d0c23bcbb16</li>
</ul>

<h3><?=_("Class 1 PKI Key")?></h3>
<ul class="no_indent">
	<li><a href="certs/root.crt"><?=_("Root Certificate (PEM Format)")?></a></li>
	<li><a href="certs/root.der"><?=_("Root Certificate (DER Format)")?></a></li>
	<li><a href="certs/root.txt"><?=_("Root Certificate (Text Format)")?></a></li>
	<li><a href="<?=$_SERVER['HTTPS']?"https":"http"?>://crl.cacert.org/revoke.crl">CRL</a></li>
	<li><?=_("Fingerprints see below")?></li>
</ul>

<h3><?=_("Class 3 PKI Key")?></h3>
<ul class="no_indent">
	<li><a href="certs/class3.crt"><?=_("Intermediate Certificate (PEM Format)")?></a></li>
	<li><a href="certs/class3.der"><?=_("Intermediate Certificate (DER Format)")?></a></li>
	<li><a href="certs/class3.txt"><?=_("Intermediate Certificate (Text Format)")?></a></li>
	<li><a href="<?=$_SERVER['HTTPS']?"https":"http"?>://crl.cacert.org/class3-revoke.crl">CRL</a></li>
<?php /*
  class3 subroot fingerprint updated: 2011-05-23  class3 Re-sign project
  https://wiki.cacert.org/Roots/Class3ResignProcedure/Migration
*/ ?>
	<li><?=_("Fingerprints see below")?></li>
</ul>

<h3><?=_("GPG Key")?></h3>
<ul class="no_indent">
	<li><a href="certs/cacert.asc"><?=_("CAcert's GPG Key")?></a></li>
	<li><?=_("GPG Key ID:")?> 0x65D0FD58</li>
	<li><?=_("Fingerprint:")?> A31D 4F81 EF4E BD07 B456 FA04 D2BB 0D01 65D0 FD58</li>
</ul>

<h3><?=_("PKI fingerprint signed by the CAcert GPG Key")?></h3>
<a href="certs/cacert-pki-fingerprints.txt.asc"><?=_("Fingerprint file as download")?></a>
<pre>
-----BEGIN PGP SIGNED MESSAGE-----
Hash: SHA1

Fingerprints for the CAcert Class 1 Root certificate:
=====================================================

for a in md4 md5 sha1 ripemd160 sha224 sha256 sha384 sha512; do \
openssl x509 -noout -fingerprint -$a -in class1.pem ; done

MD4 Fingerprint
  EB:36:C3:01:E3:AC:CE:CE:D1:C1:DF:A5:D8:17:BC:50
MD5 Fingerprint
  A6:1B:37:5E:39:0D:9C:36:54:EE:BD:20:31:46:1F:6B
SHA1 Fingerprint
  13:5C:EC:36:F4:9C:B8:E9:3B:1A:B2:70:CD:80:88:46:76:CE:8F:33
RIPEMD160 Fingerprint
  EA:B7:2F:F1:24:04:4B:57:D4:45:BE:97:E7:3B:CD:92:C2:6D:AE:1D
SHA224 Fingerprint
  60:1D:E5:E5:56:C9:91:B6:BD:A6:75:43:FB:5C
  73:71:BD:E1:27:FF:A6:84:24:2F:66:F3:16:88
SHA256 Fingerprint
  FF:2A:65:CF:F1:14:9C:74:30:10:1E:0F:65:A0:7E:C1
  91:83:A3:B6:33:EF:4A:65:10:89:0D:AD:18:31:6B:3A
SHA384 Fingerprint
  DF:63:0B:17:89:70:CF:75:B1:E2:4E:F0:DD:7B:F5:24
  B6:9D:64:80:6E:D1:EC:07:BF:D5:F7:AB:32:DE:96:51
  9D:46:CC:CA:D3:B3:E3:89:40:6E:7B:A8:2B:55:B4:B6
SHA512 Fingerprint
  EB:0A:D8:4F:11:B4:B0:8B:F7:6C:78:66:EF:32:84:22
  92:BB:B2:86:2F:B6:FC:49:C0:A3:F8:07:62:9C:A8:F5
  DD:28:A0:DE:7B:0C:04:D5:66:02:0A:C4:FF:2B:A4:4E
  2F:61:2A:A5:8A:1A:E4:CC:AC:E4:86:D2:44:95:2F:C2

Fingerprints for the CAcert Class 3 Intermediate certificate:
=============================================================

for a in md4 md5 sha1 ripemd160 sha224 sha256 sha384 sha512; do \
openssl x509 -noout -fingerprint -$a -in class3.pem ; done

MD4 Fingerprint
  60:B7:CD:A2:F2:18:55:3F:1B:F0:43:31:A4:06:82:9C
MD5 Fingerprint
  F7:25:12:82:4E:67:B5:D0:8D:92:B7:7C:0B:86:7A:42
SHA1 Fingerprint
  AD:7C:3F:64:FC:44:39:FE:F4:E9:0B:E8:F4:7C:6C:FA:8A:AD:FD:CE
RIPEMD160 Fingerprint
  41:A5:08:B6:C7:35:54:58:0E:F6:EE:C1:86:FA:A3:6D:BF:E9:D5:E1
SHA224 Fingerprint
  90:C6:94:5B:4B:91:D3:72:49:BD:CD:D2:A4:51
  CC:24:A6:E0:8A:1D:ED:1E:E3:C4:53:7C:17:21
SHA256 Fingerprint
  4E:DD:E9:E5:5C:A4:53:B3:88:88:7C:AA:25:D5:C5:C5
  BC:CF:28:91:D7:3B:87:49:58:08:29:3D:5F:AC:83:C8
SHA384 Fingerprint
  DF:92:B7:83:6F:2A:CD:A0:07:9A:0B:14:7C:C8:D5:92
  20:E7:6C:76:61:9A:75:3C:0B:64:D1:3F:13:E3:A5:CB
  C6:81:92:0A:86:62:A0:95:44:03:DE:10:AB:72:1D:B1
SHA512 Fingerprint
  3C:6E:24:87:E4:9F:43:06:15:E4:E5:7C:9D:8D:67:5F
  36:41:FC:00:3F:7D:95:26:DD:BC:AA:35:DA:6D:5D:B4
  B1:59:03:47:62:BA:BA:4C:29:98:60:42:96:EC:C3:11
  5F:AB:81:2F:04:F0:E4:D4:B2:EE:C6:9C:B3:B8:3B:F1

Fingerprints for the CAcert OpenPGP signing key:
================================================

LC_ALL=C gpg --list-key --fingerprint gpg@cacert.org

pub   1024D/65D0FD58 2003-07-11 [expires: 2033-07-03]
      Key fingerprint = A31D 4F81 EF4E BD07 B456  FA04 D2BB 0D01 65D0 FD58
uid                  CA Cert Signing Authority (Root CA) &ltgpg@cacert.org&gt
sub   2048g/113ED0F2 2003-07-11 [expires: 2033-07-03]

pub   1024D/9E2BD1F2 2003-08-05 [expires: 2033-07-28]
      Key fingerprint = 9F94 ACDD D289 67E7 1FB7  1C3A 77AE 7F12 9E2B D1F2
uid                  CA Cert Signing Authority (Low Security Key) &ltlowgpg@cacert.org&gt
sub   2048g/456D7D4B 2003-08-05 [expires: 2033-07-28]

-----BEGIN PGP SIGNATURE-----
Version: GnuPG v1.4.9 (GNU/Linux)

iEYEARECAAYFAlRjfL0ACgkQ0rsNAWXQ/VggAgCfeOmWhcZTV9NePao/Wx/HVqgd
+7oAn1Lo/aEB415RLGmty+xSKYGjz35z
=dFvo
-----END PGP SIGNATURE-----
</pre>

<h3><?=_("History")?></h3>
<p>
<? printf(_('An overview over all CA certificates ever issued can be found in '.
        '%sthe wiki%s.'),
    '<a href="//wiki.cacert.org/Roots/StateOverview">',
    '</a>') ?>
</p>
