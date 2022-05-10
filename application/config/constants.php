<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


//जलजला गाउँपालिका, गाउँ कार्यपालिकाको कार्यालय
//लामखेत पर्वत, गण्डकी प्रदेश, नेपाल

//----------------------------Custom Defines--------------------------------------------------------------------

// defined('SITE_OFFICE')          OR define('SITE_OFFICE', 'जलजला गाउँपालिका');
// defined('SITE_WARD_OFFICE')     OR define('SITE_WARD_OFFICE',"नं वडा कार्यालय");
// defined('SITE_PALIKA')          OR define('SITE_PALIKA', "गाउँकार्यपालिकाको कार्यालय");
defined('SITE_ADDRESS')         OR define('SITE_ADDRESS',"कुरिनटार");
// defined('SITE_STATE')           OR define('SITE_STATE',"गण्डकी प्रदेश, नेपाल");
// defined('SITE_OFFICE_TYPE')     OR define('SITE_OFFICE_TYPE', 'गाउँपालिका');
// defined('SITE_DISTRICT')        OR define('SITE_DISTRICT', 'भरतपुर, चितवन');

// defined('SITE_OFFICE_ENG')          OR define('SITE_OFFICE_ENG', "Jaljala Rural Municipality");
// defined('SITE_EMAIL')               OR define('SITE_EMAIL', "www.jaljalamun.gov.np");
// defined('SITE_WARD_OFFICE_ENG')     OR define('SITE_WARD_OFFICE_ENG',"No. Ward Office");
// defined('SITE_PALIKA_ENG')          OR define('SITE_PALIKA_ENG', "R. Muncipality Office");
// defined('SITE_ADDRESS_ENG')         OR define('SITE_ADDRESS_ENG',"Lamakhet, Parbat");
// defined('SITE_STATE_ENG')           OR define('SITE_STATE_ENG',"Gandaki Province, Nepal");
// defined('SITE_OFFICE_TYPE_ENG')     OR define('SITE_OFFICE_TYPE_ENG', 'R. Muncipality');
// defined('SITE_DISTRICT_ENG')        OR define('SITE_DISTRICT_ENG', 'Parbat');

defined('SITE_STATE_ID_EN')			OR define('SITE_STATE_ID_EN', '3');
defined('SITE_DISTRICT_ID_EN')		OR define('SITE_DISTRICT_ID_EN', '35');
defined('SITE_GAPA_ID_EN')			OR define('SITE_GAPA_ID_EN', '392');

// error_reporting(1);
