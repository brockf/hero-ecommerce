<?php

/**
* IonCube Event Handler
*
* Display the IonCube errors in our standard error box
*
* @param int $err_code
* @param array $params
*
* @return void
*/

function ioncube_event_handler ($err_code, $params) {
	// create $message depending on the error
	
	if ($err_code == ION_CORRUPT_FILE) {
		$message = 'A corrupted file, <b>' . $params['current_file'] . '</b>, was included.';
	}
	elseif ($err_code == ION_EXPIRED_FILE) {
		$message = 'File <b>' . $params['current_file'] . '</b> has expired.';
	}
	elseif ($err_code == ION_NO_PERMISSIONS) {
		$message = 'An encoded file has a server restriction that this server does not meet.';
	}
	elseif ($err_code == ION_CLOCK_SKEW) {
		$message = 'Please verify that your system clock is properly set.';
	}
	elseif ($err_code == ION_UNTRUSTED_EXTENSION) {
		$message = 'A file was included that includes an untrusted extension.';
	}
	elseif ($err_code == ION_LICENSE_NOT_FOUND) {
		$message = 'Your license file could not be located.  Please upload your license file to <b>/app/config/license.txt</b>.  If you do not have a license, please contact support.';
	}
	elseif ($err_code == ION_LICENSE_CORRUPT) {
		$message = 'Your license file is corrupt.  Please re-upload your license file to <b>/app/config/license.txt</b>.  If you do not have a license, please contact support.';
	}
	elseif ($err_code == ION_LICENSE_EXPIRED) {
		$message = 'Your license file has expired.  If you were using a trial license, please contact support for a non-expiring license.<br /><br />Please re-upload your license file to <b>/app/config/license.txt</b>.  If you do not have a license, please contact support.';
	}
	elseif ($err_code == ION_LICENSE_PROPERTY_INVALID) {
		$message = 'Your license file could not be validated, due to a license property.';
	}
	elseif ($err_code == ION_LICENSE_HEADER_INVALID) {
		$message = 'Your license file is corrupt (header alteration).<br /><br />Please re-upload your license file to <b>/app/config/license.txt</b>.  If you do not have a license, please contact support.';
	}
	elseif ($err_code == ION_LICENSE_SERVER_INVALID) {
		$message = 'Your license file is not valid for this server.<br /><br />Please contact support and request an updated license that validates your current server environment (domain: ' . $_SERVER['SERVER_NAME'] . '; IP address: ' . $_SERVER['SERVER_ADDR'] . ').  You will need to re-upload your license file to <b>/app/config/license.txt</b>.';
	}
	elseif ($err_code == ION_UNAUTH_INCLUDING_FILE) {
		$message = 'An unauthorized file is trying to include an encoded script (<b>' . $params['include_file'] . '</b>).';
	}
	elseif ($err_code == ION_UNAUTH_INCLUDED_FILE) {
		$message = 'An unauthorized file has been included (<b>' . $params['include_file'] . '</b>).';
	}
	elseif ($err_code == ION_UNAUTH_APPEND_PREPEND_FILE) {
		$message = 'An unauthorized file has been appended/prepended to an encoded script (<b>' . $params['include_file'] . '</b>).';
	}
	
	$message = '<p>IonCube Error: ' . $message . '</p>';
	
	if (!file_exists(FCPATH . '.htaccess') or filesize(FCPATH . '.htaccess') == 0) {
		$message .= '<p>Also, while reporting this issue, we noticed that you do not have a <b>/.htaccess</b> file in your root app folder.  Please upload this file or rename <b>1.htaccess</b> to <b>.htaccess</b> now.</p>';
		die($message);
	}
	
	// show error
	$heading = 'IonCube License Error';
	$message .= '<p><a href="javascript:location.reload();">Refresh after this has been fixed</a></p>';
	
	require(APPPATH . 'errors/error_general.php');
	die();
}