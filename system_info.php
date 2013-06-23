<?php

/**
* System Info
*
* Return the server adapter info for use in licensing with IonCube.
*
* @copyright Electric Function, Inc.
* @package Hero Framework
* @author Electric Function, Inc.
*/

$data = ioncube_server_data();

echo '<html><body><pre>' . $data . '</pre></body></html>';