<?php
@ini_set('error_log',NULL);
@ini_set('log_errors',0);
@ini_set('max_execution_time',0);
@set_time_limit(3600);

error_reporting(0);


$patterns = array(
/* start delete section */
array(
    "filename" => '/[^.]*\.php$/mi',
    "code" => '/<\?php eval\(\"\?\>\"\s*\.\s*base64_decode\(\".{10000,}\"\)\);\s*\?>.<\?php\s*\/\*[a-z,]{4,}/ms',
    "action" => 'delete'
),
array(
    "filename" => '/[^.]*\.php$/mi',
    "code" => '/if\(empty\(\$mordaurl\)/ms',
    "action" => 'delete'
),
array(
    "filename" => '/[^.]*\.php$/mi',
    "code" => '/http:\/\/tds\.narod\.ru\/i\.txt/ms',
    "action" => 'delete'
),
array(
    "filename" => '/[^.]*\.php$/mi',
    "code" => '/function\s*generateRandomString.*\$payload_file/ms',
    "action" => 'delete'
),
array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/MINI MINI MANI/iU',
    "action" => 'delete'
),
array(
    "filename" => '/.*\.(php|inc)$/mi',
    "code" => '/\$wp_nonce\s*=\s*("|\')[0-9a-z]{32}("|\')\s*;/m',
    "action" => 'delete'
),

array(
    "filename" => '/.*\.(php|inc|txt)$/mi',
    "code" => '/if\(!class_exists\(\'Ratel\'\)\){if\(function_exists\(\'is_user_logged_in\'\)\){if\(is_user_logged_in\(\)\)/m',
    "action" => 'delete'
),
array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/https:\/\/github\.com\/b374k\/b374k/msi',
    "action" => 'delete'
),
array(
    "filename" => '/.*\.(php|inc)$/mi',
    "code" => '/Jijle3 Web PHP Shell 2015/iU',
    "action" => 'delete'
),
array(
    "filename" => '/.*\.(php|inc)$/mi',
    "code" => '/Leaf PHP Mailer by \[leafmailer\.pw\]/iU',
    "action" => 'delete'
),
array(
    "filename" => '/.*\.(php|inc)$/mi',
    "code" => '/WebShellOrb 2\.6 - With PHP 7/iU',
    "action" => 'delete'
),

array(
    "filename" => '/metawp\.php$/mi',
    "code" => '/allkeyspharm/iU',
    "action" => 'delete'
),
array(
    "filename" => '/blockspluginn\.php$/mi',
    "code" => '/.*/iU',
    "action" => 'delete'
),
array(
    "filename" => '/supersociall\.php$/mi',
    "code" => '/.*/iU',
    "action" => 'delete'
),
array(
    "filename" => '/index\.php$/mi',
    "code" => '/www\.datecenter\.com/iU',
    "action" => 'delete'
),
array(
    "filename" => '/Jwlsjd_baaqifg\.php$/mi',
    "code" => '/.*/iU',
    "action" => 'delete'
),
array(
    "filename" => '/Jwlsjd_woiqusjfx\.php$/mi',
    "code" => '/.*/iU',
    "action" => 'delete'
),
array(
    "filename" => '/wp-sesion-manager\.php$/mi',
    "code" => '/function getbody\(\$body\)/iU',
    "action" => 'delete'
),
array(
    "filename" => '/.*\.php$/mi',
    "code" => '/if\(empty\(\$_GET\[\'ineedthispage\'\]\)\)/iU',
    "action" => 'delete'
),
array(
    "filename" => '/.*\.php$/mi',
    "code" => '/=Array\("pv"=>@phpversion\(\)/iU',
    "action" => 'delete'
),
array(
    "filename" => '/.*\.php$/mi',
    "code" => '/136\.12\.78\.46/iU',
    "action" => 'delete'
),
array(
    "filename" => '/.*\.php$/mi',
    "code" => '/=\s*Array\s*\(\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\',\s*\'[0-9A-Za-z]\'=>\'[0-9A-Za-z]\'/ms',
    "action" => 'delete'
),
array(
    "filename" => '/.*\.php$/mi',
    "code" => '/\$__=\'printf\';\$_=\'Loading the Wordpress \.\.\.\';/m',
    "action" => 'delete'
),
array(
    "filename" => '/.*\.php$/mi',
    "code" => '/register_shutdown_function\(\'builder__after_shutdown_check\'\);/m',
    "action" => 'delete'
),
array(
    "filename" => '/[^.]*\.(php|inc|txt)$/mi',
    "code" => '/wpautop=pre_admin_bar/ims',
    "action" => 'delete'
),
array(
    "filename" => '/.*\.php$/mi',
    "code" => '/define(\'WSO_VERSION\'/iU',
    "action" => 'delete'
),

array(
    "filename" => '/wp-clean-plugin\.php$/mi',
    "code" => '/.*/iU',
    "action" => 'delete'
),
array(
    "filename" => '/wp-craft-report\.php$/mi',
    "code" => '/.*/iU',
    "action" => 'delete'
),
array(
    "filename" => '/wp-hello-plugin\.php$/mi',
    "code" => '/.*/iU',
    "action" => 'delete'
),
array(
    "filename" => '/wp-load-report\.php$/mi',
    "code" => '/.*/iU',
    "action" => 'delete'
),
array(
    "filename" => '/wp-report\.php$/mi',
    "code" => '/.*/iU',
    "action" => 'delete'
),
array(
    "filename" => '/wp-sili-report-site\.php$/mi',
    "code" => '/.*/iU',
    "action" => 'delete'
),
array(
    "filename" => '/wp-zip-plugin\.php$/mi',
    "code" => '/.*/iU',
    "action" => 'delete'
),
array(
    "filename" => '/[^.]*\.(php)$/mi',
    "code" => '/\$_REQUEST\[\"[a-z]{3}\"\]\(\$_REQUEST/iU',
    "action" => 'delete'
), 
array(
    "filename" => '/[^.]*\.(php)$/mi',
    "code" => '/@system\("killall -9 "\.basename\("\/usr\/bin\/host"\)\);/iU',
    "action" => 'delete'
), 
array(
    "filename" => '/[^.]*\.(php)$/mi',
    "code" => '/intval\(__LINE__\) \* 337/iU',
    "action" => 'delete'
), 
array(
    "filename" => '/metawp\.php$/mi',
    "code" => '/openredirect\.net/iU',
    "action" => 'delete'
),

array(
    "filename" => '/wptemp\.js$/mi',
    "code" => '/error_reporting/iU',
    "action" => 'delete'
), 

array(
    "filename" => '/^validate\.php$/',
    "code" => '/4769e496038c3d0ee38f6267d389469b/iU',
    "action" => 'delete'
), 
array(
    "filename" => '/[^.]*\.(php)$/mi',
    "code" => '/\<\?php class Foo.*[\S]{1500}.*\(\); \?>/ims',
    "action" => 'delete'
),
array(
    "filename" => '/[^.]{8}\.php$/mi',
    "code" => '~;(?:@\$(?:\w{1,40}\(\$\w{1,40}\(\$\w{1,40}\(\$\w{1,40}\(\$\w{1,40}\)\)\)\);\s*\?>\s*\Z(?<X69bab67e>)|__\(\$__\d+\(@\$_\[\d+\]\.@\$_\[\d+\]\.(?<X3cab32a5>)|fun\(\s*str_rot13\((?<X21ff1a04>))|\$(?:\w{1,40}(?:=\'[^\']+\'\^\'[^\']+\';\w{1,40};(?<Xee1268f4>)|\^\$\w{1,40};\$\w{1,40}=\$\w{1,40}\^\'(?<Xb5c8b3b7>))|\{\$(?:\w{1,40}\}(?:\.=pack\("[^"]{1,20}?",0x00000000,0x00000000,0x00000000,strlen\(\$\{\$\{"(?<X17544b95>)|\s*=\s*get_option\(EWPT_PLUGIN_SLUG\);echo"[^"]+"\s*\.\s*esc_attr\(\$\{\$\{"[^"]+"\}\s*\["(?<X053254dc>))|\{"[^"]{1,100}"\}\[[^\]]{1,100}\]\}=system_custom\(\$\{\$\w{1,40}\}\);echo\$\{\$\{"[^"]{1,100}"\}\["[^"]{1,100}"\]\};print(?<X59363b64>))|_(?:\s*=\s*create_function\(\s*""\s*,\s*@gzuncompress\(\$_+\)\);\$_+\(\);\s*\?>(?<X3b196bf9>)|\w{1,10}=array\([^)]+\);\$payload="[^"]{4000,14000}";(?<X6b84e4fa>)|\w{1,40}=.\$_\w{1,40}\("[^"]+",\'\w{1,40}\'\);@\$_\w{1,40}\("[^"]+",.\$_\w{1,40}\((?<Xc499377f>))|b374k\s*=\s*\$\w{1,40}\(\s*[\'"]\$\w{1,40}[\'"]\s*,\s*[\'"\.,\seval]{7,40}\((?<X00783715>)|default_use_ajax=true;\$default_charset=_\w{1,40}\(\d\);\$GLOBALS(?<X571e31f8>)|this->tm_class_name_div=\$\{\$\{"\\x\w{2}(?<Xc136032c>))|\s*(?:(?:echo|print)\s*\(?[\'"]?<title>\s*Droid-X-Fahri\s*<(?<Xabb9412e>)|(?:goto\s*\w{1,40};\s*\w{1,40}:\s*@?ini_set\([^\)]{1,99}\);\s*){2}[^/]{9,99}<title>\s*\w{1,40}\s+backdoor\s*</title>(?<Xf5ee08ae>)|(?:passthru|exec|shell_exec|popen|system|eval)\(\s*[\'"]\./findsock[^\$]{1,40}\$_SERVER\[[\'"]REMOTE_ADDR[\'"]\][^\$]{1,40}\$_SERVER\[[\'"]REMOTE_PORT[\'"]\]\s*\)\s*\?>(?<Xf87c3b51>)|[#]{5,200}\s*\$SUBJECT\s*=\s*[\'"]\s*\((?:AMAZON|ADOBE|AZURE)\)\s*\((?:BILLING|LOGIN)\)\s*\(\s*\$IP\s*\)\s*\(\s*\$COUNTRYNAME\s*\)\s*[\'"]\s*;(?<X85bd1dec>)|\$(?:[O0_]+="[^"]*"\s*;\s*\$\w{1,40}="[^"]*"\s*;\s*\$\w{1,40}\s*=\$\w{1,40}\s*\(\s*"[^"]*"\s*,\s*"[^"]*"\s*,\s*"[^"]*"\s*\)\s*;\s*\$\w{1,40}\s*=\$\w{1,40}\s*\(\s*"[^"]*"\s*,\s*"[^"]*"\s*,\s*"[^"]*"\s*\)\s*;\s*\$\w{1,40}\s*=\$\w{1,40}\s*\(\s*"[^"]*"\s*,\s*\$\w{1,40}\s*\(\s*\$\w{1,40}\s*\(\s*"[^"]*"\s*,\s*"[^"]*"\s*,\s*\$\w{1,40}\s*\.\s*\$\w{1,40}\s*\.\s*\$\w{1,40}\s*\.\s*\$\w{1,40}\s*\)\s*\)\s*\)\s*;\s*\$\w{1,40}\s*\(\s*\)\s*;\s*echo\s*\$\w{1,40}\s*\.\s*"[^"]*"\s*;\s*(?<Xed409fbf>)|\w{1,20}\s*=\s*(?:http_get|file_get_contents)\s*\([\'"]https?://laggerghost\.github.io/[^\)]+\);(?<X396f5a9f>)|\w{1,30}\s*\(\s*\$\w{1,40}\s*\(\s*\$\w{1,40}\s*\.\s*\$\w{1,40}\s*,\s*\$\w{1,40}\s*\)\s*,\s*\$\w{1,40}\s*\)\s*;\s*\}\s*Prior2Line\s*\([^)]+\)\s*;\s*\Z(?<Xd91426bc>)|\w{1,40}=@\$GLOBALS\[\'_\d+_\'\]\[\d+\]\(\$\w{1,40}\s*\.\s*\$\w{1,40}\);\s*echo \$\w{1,40};\s*\?>\Z(?<Xef6444c9>)|\{[\'"](?:G|\\x47)(?:L|\\x4c)(?:O|\\x4f)(?:B|\\x42)(?:A|\\x41)(?:L|\\x4c)(?:S|\\x53)[\'"]\}\[[\'"](?:z|r|_|\\x7a|\\x5f|\\x72){1,40}[\'"]\]\(\$[zr_]{1,40},CURLOPT_USERAGENT,\\[\'"]WHR\\[\'"]\);(?<X9f4e4f65>))|\b\w{1,20}\(\$\w{1,10}\s*=\s*\$\w{1,10}\.\$\w{1,10}\[\d+\]\);\s*hebrevc\(\$\w{1,10}\s*=\s*\$\w{1,10}\.\$\w{1,10}\[\d+\]\);\s*\w{1,10}\(\$\w{1,10}\s*=\s*\$\w{1,10}\.\$\w{1,10}\[\d+\]\);(?<Xc0cc0607>)|\}\s*\}\s*(?:\$\w{1,20}\s*=\s*[\'"][3E]x[0o]rc[i1][s5][7t][\'"];(?<Xaefcf52e>)|\}\s*echo\s*[\'"][^\'"]{0,40}[\'"]?\s*\.?\s*php_uname\(\)\s*\.?\s*[\'"]?\\?r?\\?n?[\'"];\s*echo\s*getcwd\(\)\s*\.?\s*[\'"]?\\?r?\\?n?[\'"];\s*\?>\s*\Z(?<X46bc00b1>))|e(?:val\(\$GLOBALS\[\'\w+\'\]\[\d+\]\(\$GLOBALS\[\'\w+\'\]\[\d+\]\(\$\w+\)\)\);\?>(?<Xff5cf123>)|xit\s*\(\s*\)\s*;\s*\}\s*\}\s*\$\w{1,40}\s*=\s*\w{1,40}\s*\(\s*\$\w{1,40}\s*,\s*\$\w{1,40}\s*\)\s*;\s*\w{1,40}\s*\(\s*\$\w{1,40}\s*,\s*\$\w{1,40}\s*\[\s*\d+\s*\]\s*\(\s*\$\w{1,40}\s*\[\s*\d+\s*\]\s*,\s*\$\w{1,40}\s*\^\s*\w{1,40}\s*\(\s*\$\w{1,40}\s*,\s*\$\w{1,40}\s*,\s*\$\w{1,40}\s*\[\s*\d+\s*\]\s*\(\s*\$\w{1,40}\s*\)\s*\)\s*\)\s*\)\s*;\s*\}\s*\Z(?<Xb6f48e98>))|function\s*\w{1,40}\(\$\w{1,40}\)\s*\{\s*return\s*\(substr\(\$\w{1,40}\s*,\s*\d+\s*,\s*\d+\s*\)\s*==\s*\w{1,40}\(array\([^)]{1,100}\)\s*\)\s*\)\s*;\s*\}(?<Xdaa22f25>)|print\s+"Flooded:\s*\$ip\s*on\s*port\s*\$rand(?<Xcd59d33f>)|symlink\(\'/\'\.\$home\.\'/\'\.\$user\.\'/public_html/client\-area/configuration\.php\',\$user\.\'WHMCS\.txt\'\);(?<Xa6ec7963>))|\s+eval\s*\(\s*gzinflate\s*\(\s*base64_decode\s*\(\s*[\'"]Dc/JcoIwAADQz1GHQ2WH6SkIqOwBZLt0BBKkBIKyjX59[^\'"]{360}[\'"]\s*\)\s*\)\s*\)\s*;\s*\?>\s*\Z(?<X81061ad3>)|\}\s*echo\s+\'[^\']{1,100}\';\s*preg_replace\("\\x2F\\x2E\\x2A\\x2F\\x65","\\x65\\x76\\x61\\x6C\\x28(?<Xb5c8ee69>)|class\s*Smarty3\s*{\s*private\s*static\s*\$file_with_ip(?<Xe7d71793>)|e(?:urt\s*=\s*xaja_esu_tluafed\$(?<Xeeb8e898>)|val\(base64_decode\(gzuncompress\(base64_decode\(\$\w+\)\)\)\);\?>(?<X2f3113e9>)|xit;endif;endif;@iNI_sET\("error_log",null\);@iNi_SEt\((?<Xc1611835>))|file_put_contents\(\$_7\[\'.\'\]\[\'\w+\'\],\$_\d+,FILE_APPEND\|LOCK_EX\);}if(?<X7a70801a>)|if\(\$_POST\[\'\w{1,40}\'\]=="Upload"\){if\(@copy\(\$_FILES\[\'file\'\]\[\'tmp_name\'\],\$_FILES\[\'file\'\]\[\'name\'\]\)\)\{echo(?<X050624c3>)|lets_jump\(\$\{\$\w{1,40}},\$\{\$\w{1,40}\}\);\}\$\{\$\{(?<X1fd11051>)|return\${\$\w{1,20}};}public function getRules\(\){if\(\$this->detectionType==self::DETECTION_TYPE_EXTENDED\){return self::getMobileDetectionRulesExtended\(\);}(?<X0b943fbd>)|set_time_limit\(0\);array_walk\(\$_COOKIE,"enumerator"\);array_walk\(\$_POST,"enumerator"\);function enumerator\(\$value,\$key\)\{\$\{(?<Xcfc6bb52>))~smiS',
    "action" => 'delete'
), 
array(
    "filename" => '/[^.]*\.(php|inc|txt)$/mi',
    "code" => '/Www\.PHPJiaMi\.Com/ims',
    "action" => 'delete'
),
array(
    "filename" => '/^wp-vcd\.php$/mi',
    "code" => '/.*/ims',
    "action" => 'delete'
),
array(
    "filename" => '/^login_wall\.php$/mi',
    "code" => '/eval\(\$_POST\[/ims',
    "action" => 'delete'
),
array(
    "filename" => '/^wp-tmp\.php$/mi',
    "code" => '/wp_auth_key/ims',
    "action" => 'delete'
),
array(
    "filename" => '/^_config.cache\.php$/',
    "code" => '/.*/iU',
    "action" => 'delete'
),
array(
    "filename" => '/^wp-upload-class\.php$/',
    "code" => '/.*/iU',
    "action" => 'delete'
),
array(
    "filename" => '/^wp-interst\.php$/',
    "code" => '/.*/iU',
    "action" => 'delete'
),
array(
    "filename" => '/^e-preview\.php$/',
    "code" => '/.*/iU',
    "action" => 'delete'
),
array(
    "filename" => '/^wp-counts\.php$/',
    "code" => '/.*/iU',
    "action" => 'delete'
),
array(
    "filename" => '/^wp-remote-upload\.php$/',
    "code" => '/.*/iU',
    "action" => 'delete'
),
array(
    "filename" => '/^js\.php$/',
    "code" => '/\$ctime\(\$atime\)/iU',
    "action" => 'delete'
),
array(
    "filename" => '/[^.]*\.(php|inc|txt)$/mi',
    "code" => '/Sur The Mailer Finish His Job/ims',
    "action" => 'delete'
),
array(
    "filename" => '/[^.]*\.(php|inc|txt)$/mi',
    "code" => '/if\(!\(isset\(\$passwd\)\s*&&\s*\$O0O000\(\$passwd\)\s*==\s*\$O00O00\)\){/m',
    "action" => 'delete'
),
array(
    "filename" => '/[^.]*\.(php|inc|txt)$/mi',
    "code" => '/set_error_handler\("__i_client_error_handler"\);\$GLOBALS\["__i_client_error_stack"\] = array\(\);function __i_client_error_handler\(\$errno, \$errstr, \$errfile, \$errline\){if \(!\(error_reporting\(\) & \$errno\)\){return;}switch \(\$errno\) {case E_ERROR:case E_USER_ERROR:\$GLOBALS\["__i_client_error_stack"\]\[\] = "Error: "\.\$errstr\." in "\.\$errfile\."\[\$errline] \(PHP "\.PHP_VERSION\." "\.PHP_OS\."\)";/msi',
    "action" => 'delete'
),
array(
    "filename" => '/social\.png$/mi',
    "code" => '/WpPlLoadContent/msi',
    "action" => 'delete'
),
array(
    "filename" => '/.*\.(php|inc|txt)$/mi',
    "code" => '/\$default_action\s*=\s*(\'|")FilesMan(\'|")/msi',
    "action" => 'delete'
),
array(
    "filename" => '/[^.]*\.(php|inc|txt)$/mi',
    "code" => '/(shelleval)|(Shell Kageyama)|(supersociall)|(wp\-vcd\.php)|(0x5a455553\.github\.io\/MARIJUANA\/icon\.png)|(BlackhatCode)|(Jayalah Indonesiaku)|(\"jweyc\",\"aeskoly\",\"owhggiku\",\"callbrhy\")|(blockspluginn)|(Plugin Name: CMSmap - WordPress Shell)|(BlackhatCode)|(IndoXploit)|(crkekatkek_kfkukncktkikon)|(\$wp_nonce = isset\(\$_POST\[\'f_pp\'\]\))/ims',
    "action" => 'delete'
),
array(
    "filename" => '/wp-xmlrpc\.php$/mi',
    "code" => '/\$GLOBALS\[\'pass\'\]/msi',
    "action" => 'delete'
),
array(
    "filename" => '/.*\.php$/mi',
    "code" => '/\$__________=\$__________________\(\'\$_\',\$______________\)/m',
    "action" => 'delete'
),
array(
    "filename" => '/.*\.php$/mi',
    "code" => '/goto\s[0-9a-zA-Z]{5};\s[0-9a-zA-Z]{5}:\sif\s\([!]*file_exists\(realpath\(\'\'\)\s\.\s\"\\\\/m',
    "action" => 'delete'
),
array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/by zeura\.com/ims',
    "action" => 'delete'
), 
array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/PHP Encode Sh\*ll Auto v4 Fox/ims',
    "action" => 'delete'
), 
array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/eval\(pack\(\'H\*\',\'[0-9a-fA-F]{5000,}/m',
    "action" => 'delete'
), 
array(
    "filename" => '/template-config\.php$/mi',
    "code" => '/\$admworkurl="";/m',
    "action" => 'delete'
), 
array(
    "filename" => '/^class\.wp\.php$/mi',
    "code" => '/.*/m',
    "action" => 'delete'
),
array(
    "filename" => '/[^.]*\.(php|inc|txt)$/mi',
    "code" => '/foreach\s*\(\$[a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*\[[0-9]+\]\(\$_COOKIE,\s*\$_POST\)\s*as\s*\$[a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*\s*=>\s*\$[a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*/m',
    "action" => 'delete'
),
array(
    "filename" => '/[^.]*\.(php|inc|txt)$/mi',
    "code" => '/\(edoced_46esab\(lave\'\)\)/m',
    "action" => 'delete'
),

/* end delete section */
/* start cut section */
 
array(
    "filename" => '/[^.]*\.(php|inc|txt)$/mi',
    "code" => '/<script language=javascript>[^<]*eval\(String\.fromCharCode\(118, 97, 114, 32, 100, 61, 100, 111, 99, 117, 109, 101, 110, 116, 59, 118, 97, 114, 32, 115[^<]*\)\);<\/script>/m',
    "action" => 'cut'
),
array(
    "filename" => '/.*\.(php|inc|txt)$/mi',
    "code" => '/<\?php\s\$md5\s*=\s*(\'|")[0-9a-f]{32}(\'|").*\$wp_salt.*create_function.*\?>/mUs',
    "action" => 'cut'
),
array(
    "filename" => '/.*\.(php|inc|txt)$/mi',
    "code" => '/<\?php\s*if\(\(!@file_exists.*0444\);}\s*\?>/msU',
    "action" => 'cut'
),
array(
    "filename" => '/[^.]*\.(php|inc|txt)$/mi',
    "code" => '/\/\*aeR4Choc_start\*.*\/\*aeR4Choc_end\*\//m',
    "action" => 'cut'
),
array(
    "filename" => '/[^.]*\.(php|inc|txt)$/mi',
    "code" => '/<script>var z;if\(z!=\'\' && z!=\'lC\'\)\{z=null.*vU != \'\'\)\{vU=null\};<\/script>/msi',
    "action" => 'cut'
),
array(
    "filename" => '/[^.]*\.(php|inc|txt)$/mi',
    "code" => '/require_once\(plugin_dir_path\(__FILE__\) \. "(images|img)\/social\.png"\);/m',
    "action" => 'cut'
),
array(
    "filename" => '/[^.]*\.(php|inc|txt|js)$/mi',
    "code" => '/Element\.prototype\.appendAfter = function\(element\) {element\.parentNode\.insertBefore\(this, element\.nextSibling\);}, false;\(function\(\) { var elem = document\.createElement\(String\.fromCharCode\(115,99,114,105,112,116\)\); elem\.type = String\.fromCharCode\(116,101,120,116,47,106,97,118,97,115,99,114,105,112,116[^<]*String\.fromCharCode\(104,101,97,100\)\)\[0\]\.appendChild\(elem\);}\)\(\);/ms',
    "action" => 'cut'
),
array(
    "filename" => '/[^.]*\.(php|inc|txt)$/mi',
    "code" => '/<\?php if \(file_exists\(dirname\(__FILE__\) \. \'\/wp-vcd\.php\'\)\) include_once\(dirname\(__FILE__\) \. \'\/wp-vcd\.php\'\); \?>/ms',
    "action" => 'cut'
),
array(
    "filename" => '/[^.]*\.(php|inc|txt)$/mi',
    "code" => '/<script type=(\'|")text\/javascript(\'|")>[^<]*eval\(String\.fromCharCode\(118, 97, 114, 32, 100, 61, 100, 111, 99, 117, 109, 101, 110, 116, 59, 118, 97, 114, 32, 115[^<]*\)\);<\/script>/m',
    "action" => 'cut'
),

array(
    "filename" => '/[^.]*\.(php|inc|txt)$/mi',
    "code" => '/@die \(\$ctime\(\$atime\)\);/ims',
    "action" => 'cut'
),
array(
    "filename" => '/[^.]*\.(php|inc|txt)$/mi',
    "code" => '/if\(isset\(\$_POST\[chr\(97\)\.chr\(115\)\.chr\(97\).*owhggiku.*base64_decode\("bG9jYWwtZXJyb3Itbm90LWZvdW5k"\);}die\(\);}/m',
    "action" => 'cut'
),

array(
    "filename" => '/[^.]*\.(php|inc|txt)$/mi',
    "code" => '/<script type=text\/javascript> Element\.prototype\.appendAfter = function\(element\) {element\.parentNode\.insertBefore\(this, element\.nextSibling\);}, false;\(function\(\) { var elem = document\.createElement\(String.fromCharCode\(115,99,114,105,112,116\)\);[^<]*\(\);<\/script>/ms',
    "action" => 'cut'
),
array(
    "filename" => '/[^.]*\.(php|inc|txt)$/mi',
    "code" => '/<\?php\s*if\(!defined\(\'_NET\'\)\).*\/\*\,\.\*\/\s*\?>/msU',
    "action" => 'cut'
),
array(
    "filename" => '/[^.]*\.(php|inc|txt)$/mi',
    "code" => '/<\?php \/\*[^\*]*\*\/eval\/\*.*\*\/\s*\?>/m',
    "action" => 'cut'
),
array(
    "filename" => '/[^.]*\.(php|inc|txt)$/mi',
    "code" => '/include\s*\(\s*ABSPATH\s*\.\s*WPINC\s*\.\s*\'\/metawp\.php\'\s*\)\s*;/ims',
    "action" => 'cut'
),


array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/<\?php.+\$GLOBALS.+eval\/\*.*\]\);[}]{1,2}exit\(\);}[^>]+\?>/msi',
    "action" => 'cut'
),
array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/<\?php.+\$GLOBALS.+eval\/\*.*\]\)\);exit\(\);}[^>]+\?>/msi',
    "action" => 'cut'
),

array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/\<\?php.+\$_REQUEST\[\'password\'\].+\$end_wp_theme_tmp.+?\?\>/ims',
    "action" => 'cut'
),
array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/\<\?php.+\$O00OO0[\S]{1000}.+?\?\>/ims',
    "action" => 'cut'
),  
array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/\/\*[^*]{5}\*\/[^@]*@include "[^*]*\/\*[^*]{5}\*\//ims',
    "action" => 'cut'
),  
array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/<\?php[^>]*array[^>]*array[^>]*array[^>]*[\S]{3000}[^>]*\?>/iU',
    "action" => 'cut'
),
array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/<\?php[^>]*str_replace[^>]*str_replace[^>]*str_replace[^>]*[\S]{3000}[^>]*\?>/iU',
    "action" => 'cut'
),
array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/<\?php[\s]{500}[^>]*str_replace[^>]*str_replace[^>]*str_replace[^>]*[\s]{500}[^>]*\?>/iU',
    "action" => 'cut'
),
array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/\<script type=\'text\/javascript\' src=\'https:\/\/snippet\.adsformarket\.com\/same\.js\'\>/iU',
    "action" => 'cut'
),

array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/eval\(gzinflate\(base64_decode\(\'[\S]{500}.*\'\)\)\);/im',
    "action" => 'cut'
),

array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/\$[a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*=\'.*\$[a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*=\$[a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*\(\'\',.*\$[a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*\(\);$/im',
    "action" => 'cut'
),
array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/<\?php if\(!isset\(\$GLOBALS\["\\\\x61\\\\156\\\\x75\\\\156\\\\x61"\]\)\) { \$ua=strtolower\(\$_SERVER\["\\\\x48[^?]*\?><\?php.*?\?>/ims',
    "action" => 'cut'
),

array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/<\?php @error_reporting\(0\);.*BcVSir;} \?>/ims',
    "action" => 'cut'
),
array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/<\?php @error_reporting\(0\);.*BcVSir;} \?>/ims',
    "action" => 'cut'
),
array(
    "filename" => '/wp-config\.php$/mi',
    "code" => '/include\("wp-content\/w\.php"\);/ims',
    "action" => 'cut'
),
array(
    "filename" => '/.*\.php$/mi',
    "code" => '/@eval\(\$_POST\["wp_ajx_request"]\);/ims',
    "action" => 'cut'
),

array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/<\?php \/\*[0-9]{5}\*\/.*\/\*[0-9]{5}\*\/\s*\?>/ims',
    "action" => 'cut'
),
array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/eval\(gzinflate\(base64_decode\([^\(\)]*\)\)\);/ims',
    "action" => 'cut'
),
array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/\$onetihev="create.*unset\(\$itolok\);/ms',
    "action" => 'cut'
),
array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/<script\s*type=(\'|"|)text\/javascript(\'|"|)\s*(async|async\s*=\s*true)*\s*src=\'http[s]*:\/\/[^>]*(letsmakeparty3\.ga|lobbydesires\.com|trasnaltemyrecords\.com|blackentertainments\.com|dontstopthismusics\.com|littleandbiggreenballlon\.com|cdnwebsiteforyou\.biz|resolutiondestin\.com|developfirstline\.com|deliverygoodstrategy.com|developfirstline\.com|resolutiondestin\.com|chatwithgreenbar\.com|digestcolect\.com|stivenfernando\.com|verybeatifulantony\.com|trackstatisticsss\.com|digestcolect\.com|collectfasttracks\.com|verybeatifulantony\.com|destinyfernandi\.com)[^>]+\'><\/script>/m',
    "action" => 'cut'
),
array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/<\?php\s*\/\*\s*[a-zA-Z0-9]{20}\s*\*\/\s*\?>.*<\?php\s*\/\*\s*[a-zA-Z0-9]{20}\s*\*\/\s*\?>/is',
    "action" => 'cut'
),
array(
    "filename" => '/.*\.(php|inc|js)$/mi',
    "code" => '/Element\.prototype\.appendAfter = function\(element\) {element\.parentNode\.insertBefore\(this, element\.nextSibling\);}, false;\(function\(\) { var elem = document\.createElement\(String\.fromCharCode\(115,99,114,105,112,116\)\); elem\.type = String\.fromCharCode\(116,101,120,116,47,106,97,118,97,115,99,114,105,112,116.*var list = document\.getElementsByTagName\(\'script\'\);list\.insertBefore\(s, list\.childNodes\[0\]\);\s*}/ms',
    "action" => 'cut'
),
array(
    "filename" => '/.*\.(php|inc)$/mi',
    "code" => '/extract\(\$_REQUEST\);if\(md5\(\$b\)!=\'[0-9a-f]{32}\'\)\{die\(\);\}\$c\(\$f, \$a\);include_once \$f;/m',
    "action" => 'cut'
),
array(
    "filename" => '/.*\.(php|inc)$/mi',
    "code" => '/<\?php.*\/\/scp-173.*\?>/msU',
    "action" => 'cut'
),

array(
    "filename" => '/.*\.(php|inc|txt)$/mi',
    "code" => '/<\?php\s*if\s*\(isset\(\$_REQUEST\[\'action\'\]\)\s*&&\s*isset\(\$_REQUEST\[\'password\'\]\)\s*&&\s*\(\$_REQUEST\[\'password\'\].*\?>/msU',
    "action" => 'cut'
),

array(
    "filename" => '/.*\.(php|inc|txt)$/mi',
    "code" => '/<\?php \$[a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]* = \'.*#[A-Z]#-#[A-Z]#-#[A-Z]#-#[A-Z]#-#[A-Z]#-.*-1; \?>/mU',
    "action" => 'cut'
),

/* end cut section */
/* start clean section */
array(
    "filename" => '/^init\.php$/',
    "code" => '/InfiniteWP/iU',
    "action" => 'clean'
), 
array(
    "filename" => '/^\.[^.]*\.(ico|png|jpg|gip)$/mi',
    "code" => '/.*basename.*/iU',
    "action" => 'clean'
), 
/* end clean section */
/* start manual section */

array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/\\x69\\x70\\x74\\x20\\x61\\x73\\x79\\x6E\\x63\\x20\\x63\\x6C\\x61\\x73\\x73\\x3D\\x22\\x3D\\x52\\x32\\x4E\\x34\\x54\\x55\\x77\\x7A\\x52\\x6C\\x6F\\x37\\x4C\\x54\\x63\\x31\\x4F\\x7A\\x45\\x3D\\x22\\x20\\x73\\x72\\x63\\x3D\\x22\\x68\\x74\\x74\\x70\\x73\\x3A\\x2F\\x2F\\x70\\x6C\\x61\\x79\\x2E\\x62\\x65\\x73\\x73\\x74\\x61/mi',
    "action" => 'manual'
),
array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/\$O00OO0/mi',
    "action" => 'manual'
),
array(
    "filename" => '/^opn-post\.php$/',
    "code" => '/.*/iU',
    "action" => 'manual'
),  
array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/spamhaus\.org/iU',
    "action" => 'manual'
),  
array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/mrilns\.com/iU',
    "action" => 'manual'
),
array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/rootkitninja\.com/iU',
    "action" => 'manual'
),
array(
    "filename" => '/new_readme\.php$/mi',
    "code" => '/callable/iU',
    "action" => 'manual'
),
array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/B Ge Team  File Manager/iU',
    "action" => 'manual'
),
array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/.{1500}$/m',
    "action" => 'manual'
),
array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/parors\.com/mi',
    "action" => 'manual'
),

array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/\$wp_auth_key/mi',
    "action" => 'manual'
),

array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/if\(md5\(\$_COOKIE\[\'password/mi',
    "action" => 'manual'
),
array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/eval\(\$_POST\[/ims',
    "action" => 'manual'
), 

array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/\$_POST\[\$key\] \= stripslashes\(\$value\)/ims',
    "action" => 'manual'
),

array(
    "filename" => '/[^.]*\.(php|inc)$/mi',
    "code" => '/eval\(\'\?\>\'/ims',
    "action" => 'manual'
), 
array(
    "filename" => '/[^.]*\.(php|inc|txt)$/mi',
    "code" => '~=(?:\'\);return\s*base64_decode\(\$a\[\$i\]\);\s*}\s*\?>Wordpress\s*<\?php\s*\$_0(?<X9ad023e6>)|=(?:==\+\+\+Coded\s+By\s+Izladen\+\+\+===(?<X24fa889e>)|\[BY\s+P!RA17DZ\]==(?<X21f210f8>)|\s*FALSE\)\s*{\s*break;\s*}\s*if\s*\(\$\w+\s*==\s*\d+ \|\|\s*\$\w+\s*===\s*\d+\s*\|\|\s*\$\w+\s*===\s*\d+\s*\)\s*{\s*\$\w+\[\$\w+\]\[(?<X28749162>))|>\s*[\'"]tools[\'"],\s*\/\*\s*available:(?:\s*(?:ls|search|upload|cmd|eval|sql|mailer|encoders|tools|processes|sysinfo),?\s*){9,11}\s*\*/(?<Xe414e656>)|@(?:\$_COOKIE;\s*\$(?<X195a722c>)|gzuncompress\s*\(\s*@base64_decode\s*\(\s*\$\w{1,40}\s*\)\s*\)\s*\)\s*\{\s*setcookie\s*\(\s*\'[^\']*\'\s*,\s*\$\w{1,40}\s*\)\s*;\s*setcookie\s*\(\s*\'[^\']*\'\s*,\s*\$\w{1,40}\s*\)\s*;\s*\$\w{1,40}=\s*create_function(?<X98ca4fb0>))|\s*(?:\$\w+\("",\s*\$\w+\(\$\w+\("\w+",\s*"",\s*\$\w+\.\$\w+\.\$\w+\.\$\w+\)\)\);\s*\$\w+\(\);\s*\?>(?<X7926e444>)|remove_tags\(\s*_dl\s*\(\s*\$_(?:GET|POST|COOKIE)\s*\[(?<X41c4209e>))|array\((?:[\'"]\^?(?:(?:\d{1,3}|\*)\.){3}(?:\d{1,3}|\*)[\'"],){9}[^\)]{999,9999}\);[^:<%&\^#]{9,4999}(?:exit\(|\{)header\([\'"](?:Location:\s*https?://|HTTP/[\d\.]{1,3}\s*404)(?<X5ef8aa8b>)|num_macros\(\s*\${\s*\${(?<X93ac7a6e>)|unserialize\(string_cpt\(base64_decode\(\$\w{1,40}\),\$\w{1,40}\)\);\$\w{1,40}=\$_REQUEST(?<X4f46ff6b>))~smiS',
    "action" => 'manual'
), 

array(
    "filename" => '/^index2\.php$/',
    "code" => '/.*/iU',
    "action" => 'manual'
),
array(
    "filename" => '/[^.]*\.(php|inc|txt)$/mi',
    "code" => '/\$[^\?\<\>\.\)\*\-\,\&\r\n\t\f\v=;:\|\}\+\/]+?\(\'\'/ims',
    "action" => 'manual'
),
array(
    "filename" => '/^wp-blog\.php$/',
    "code" => '/.*/iU',
    "action" => 'manual'
),
array(
    "filename" => '/[^.]*\.(php|inc|txt)$/mi',
    "code" => '/\$user_agent_to_filter = array\(/ims',
    "action" => 'manual'
),
array(
    "filename" => '/[^.]*\.(php|inc|txt)$/mi',
    "code" => '/\$wp_kses_data/ims',
    "action" => 'manual'
),
array(
    "filename" => '/[^.]*\.(php|inc|txt)$/mi',
    "code" => '/InfiniteWP Admin panel/ims',
    "action" => 'manual'
),
array(
    "filename" => '/[^.]*\.(php|inc|txt)$/mi',
    "code" => '/\$[a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*\s*=\s*(\'|")\$(\'|")/m',
    "action" => 'manual'
),
array(
    "filename" => '/[^.]*\.(php|inc|txt)$/mi',
    "code" => '/merna\.cc/m',
    "action" => 'manual'
),
array(
    "filename" => '/.*\.(php|inc|txt)$/mi',
    "code" => '/\$oOoo = \$wpdb/m',
    "action" => 'manual'
),
array(
    "filename" => '/.*\.(php|inc|txt)$/mi',
    "code" => '/include\(\$_REQUEST/m',
    "action" => 'manual'
),
array(
    "filename" => '/.*\.(php|inc|txt)$/mi',
    "code" => '/\$auth_pass\s*=\s*\"[a-fA-F0-9]{32}\";/m',
    "action" => 'manual'
),
array(
    "filename" => '/.*\.(php|inc|txt)$/mi',
    "code" => '/<br\/>Security Code: <br\/><input name=\"security_code\" value=\"\"\/><br\/>/m',
    "action" => 'manual'
),
array(
    "filename" => '/.*\.(php|inc|txt)$/mi',
    "code" => '/eval\(file_get_contents\(/m',
    "action" => 'manual'
),

/* end manual section */
/* start replace section */
array(
    "filename" => '/^dnd-upload-cf7\.php$/',
    "code" => '/wpcf7_enqueue_scripts/iU',
    "action" => 'replace',
    "url" => 'https://plugins.svn.wordpress.org/drag-and-drop-multiple-file-upload-contact-form-7/tags/1.3.3.3.2/inc/dnd-upload-cf7.php'
),
array(
    "filename" => '/^user-role\.php$/',
    "code" => '/wppb_userdata_add_user_role/iU',
    "action" => 'replace',
    "url" => 'https://pastebin.com/raw/v2ibAzFH'
),
array(
    "filename" => '/^ADNI_Uploader\.php$/',
    "code" => '/ADNI_Uploader/iU',
    "action" => 'replace',
    "url" => 'https://pastebin.com/raw/2yhCwCfi'
),



/* end replace section */ 

array(
    "filename" => '/shortcodes\.php$/mi',
    "code" => '/return\s*\$wpcf7_shortcode_manager->add_shortcode\(\s*\$tag,\s*\$func,\s*\$has_name\s*\);/ims',
    "action" => 'sreplace',
    "newcode" => 'if (method_exists($wpcf7_shortcode_manager,\'add_shortcode\')){return $wpcf7_shortcode_manager->add_shortcode($tag, $func, $has_name );}',
),

);


$paranoid = array(

array(
    "filename" => '/[^.]*\.(php|inc|txt)$/mi',
    "code" => '/\$[^\?\<\>\.\)\*\-\,\&\r\n\t\f\v=;:\|\}\+\/]+?\([^\)]/ims',
    "action" => 'manual'
),

);

echo date("H:i:s");
echo "<br>\n";

function strposa($haystack, $needle, $offset=0) {
    if(!is_array($needle)) {$needle = array($needle);}
        foreach($needle as $query) {
            if(strpos($haystack, $query, $offset) !== false) return true;
        }
    return false;
}

function DeadLetter(){
       die("<script>alert('End work');</script>");
}

if(!function_exists('stripos')) {
    function stripos($haystack, $needle, $offset = 0) {
    return strpos(strtolower($haystack), strtolower($needle), $offset);
    }
}

if(!function_exists('file_put_contents')) {
    function file_put_contents($file_name, $data) {
        $f = fopen($file_name,"w");
        fputs($f,$data);
        fclose($f);
    }
}   

function Check($text){
	$pos = stripos($text, 'zend');
	$pos2 = stripos($text, 'ioncube');
	if (($pos === false) && ($pos2 === false)){ return true;}
	return false;
}


function Get_Task_Number(){
    $count_file = '_task_n';
    if (file_exists($count_file)){
        $count = (int)file_get_contents($count_file);
        $new_count = $count+1;
        file_put_contents($count_file,$new_count);
        return $count;
    } else {
    	file_put_contents($count_file,'1');
        return 0;
    }
}

function Get_Task(){
    $task_file = '_task';
    clearstatcache();
    if (file_exists($task_file)){
        $count = Get_Task_Number();
        echo "Task num: $count <br>\n";
        $counter = 0;
        $handle = @fopen($task_file, "r");
        if ($handle) {
            while (($buffer = fgets($handle, 4096)) !== false) {
                if($counter == $count) {return trim($buffer);}
            $counter++;
            }
        fclose($handle);
        }
    
    } 
    return false;
}
function Check_Bad_Dir($fname){
    
    $part[] = 'cache';
    $part[] = 'trash';
    $part[] = 'snapshot';
    $part[] = '/.git';
    $part[] = 'lost+found';
    $part[] = '/cgroups_';
    $part[] = '/wflogs';
    $part[] = '/awstats';

    if(isset($_COOKIE['fast_worker'])){
        $part[] = 'wp-admin';
        $part[] = 'wp-content';
        $part[] = 'wp-includes';
        $part[] = 'cgi-bin';
        $part[] = 'mail';
    }
    
    $full[] = '/proc';
    $full[] = '/usr/lib';
    $full[] = '/tmp';
    $full[] = '/etc';
    $full[] = '/lib';
    $full[] = '/lib64';
    $full[] = '/bin';
    $full[] = '/sbin';
    $full[] = '/usr/etc';
    $full[] = '/boot';
    $full[] = '/dev';
    $full[] = '/opt';
    $full[] = '/selinux';
    $full[] = '/bin';
    $full[] = '/var/log';
    $full[] = '/var/cache';
    $full[] = '/usr/doc';
    $full[] = '/usr/X11R6';
    $full[] = '/usr/games';
    $full[] = '/usr/src';
    $full[] = '/usr/include';
    $full[] = '/usr/kerberos';
    $full[] = '/var/spool';
    $full[] = '/var/run';
    $full[] = '/var/lock';
    $full[] = '/usr/man';
    $full[] = '/var/db';
    $full[] = '/var/local';
    $full[] = '/var/mail';
    $full[] = '/usr/share/doc';
    $full[] = '/usr/share/man';
    $full[] = '/usr/share/X11';
    $full[] = '/usr/share/locale';
    $full[] = '/usr/share/perl';
    $full[] = '/usr/share/vim';
    $full[] = '/usr/share/icons';
    $full[] = '/sys';
    $full[] = '/usr/local/lib64';
    $full[] = '/usr/local/share/perl5';
    $full[] = '/usr/share/texmf';
    $full[] = '/usr/share/zoneinfo';
    $full[] = '/usr/share/texmf';
    $full[] = '/usr/share/themes';
    $full[] = '/FAKEFS';
    $full[] = '/usr/local/cpanel';
    $full[] = '/usr/portage';
    $full[] = '/mod_pagespeed/cache';
    $full[] = '/usr/ports';
    $full[] = '/usr/share/ri';
    $full[] = '/home/mailquota';
    $full[] = '/var/tmp';
    $full[] = '/var/profiles';
    $full[] = '/var/opt';
    $full[] = '/var/yp';
    $full[] = '/var/netenberg';
    $full[] = '/var/empty';
    $full[] = '/var/account';
    $full[] = '/var/crash';
    $full[] = '/var/cvs';
    $full[] = '/var/asl';
    $full[] = '/var/named';
    $full[] = '/var/lib';
    $full[] = '/var/games';
    $full[] = '/var/hostgator';
    $full[] = '/usr/sbin';
    $full[] = '/usr/bin';
    $full[] = '/usr/libexec';
    $full[] = '/usr/php4';
    $full[] = '/usr/share';
    $full[] = '/usr/lib64';
    $full[] = '/usr/local/lib';

    if (strposa($fname, $part)){
    return true;
    }
    if (in_array($fname,$full)){
    return true;
    }
    return false;
}

function Add_Task($dir){
	echo "Add $dir <br>\n";
    $task_file = '_task';
    $dir = trim($dir);
    $dir = str_replace('//','/',$dir);
    if (strlen($dir) > 2){
        $ypos = strlen($dir)-1;
        if($dir[$ypos] == '/'){
            $dir = substr($dir,0,$ypos);
        }
    }
    if (!@is_readable($dir)){return true;}
    if (Check_Bad_Dir($dir)){return true;}
 
    clearstatcache();
    if (file_exists($task_file)){
        $handle = @fopen($task_file, "r");
        if ($handle) {
            while (($buffer = fgets($handle, 4096)) !== false) {
                $buffer = trim($buffer);
                if($dir == $buffer){return false;}
            }
            fclose($handle);
        }
    } 
	$f = fopen($task_file,"a");
	fputs($f,"$dir". PHP_EOL);
	fclose($f);
}

function log_wp($file){
    $f = fopen('wp_log', "a");
    fputs($f,"$file\n");
    fclose($f);
}

function get_url($url){
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 20);
$ult = curl_exec($ch);
if($ult){return $ult;} else {
$tmp = file_get_contents($url);
return $tmp;  
}
}

function write_log($text){

    $f = fopen('big_log',"a");
    fputs($f,"$text\n");
    fclose($f);
}

function manual_log($file,$code){
    $code = trim($code);
    $f = fopen('manual_log', "a");
    fputs($f,"$file=====$code\n");
    fclose($f);
}

function need_check($filename){
    global $patterns;

    foreach ($patterns as $t) {
        if(preg_match($t['filename'], $filename)){
            return true;
        }
    }
    return false;
}

function modify($file){
    
//    global $exceptions;
    global $patterns, $paranoid;

    $filename = basename($file);

    $para = false;

    if(isset($_COOKIE['paranoid_worker'])){
        $para = true;
    }

    if(!need_check($filename)){
        return true;
    } else {
        $tmp = file_get_contents($file);

        if($para){
            $paranoid_tmp = preg_replace('~\/\*.*?\*\/~ism', '', $tmp);
            $paranoid_tmp = preg_replace('~//[^\r\n]*~is', '', $paranoid_tmp);
        }   
    }

    foreach ($patterns as $t) { 
        if(preg_match($t['filename'], $filename)){           
        if (preg_match($t['code'], $tmp)) {


            switch ($t['action']) {
            

            case "cut":
                copy($file,$file . '.suspected');
                $tmp = preg_replace($t['code'], '', $tmp);
                if (file_put_contents($file, $tmp) === false){

                    if(chmod($file,0777)){
                        if (file_put_contents($file, $tmp) === false){
                            manual_log($file,'write error after cut');    
                        }
                    } else {
                        manual_log($file,'write error after cut');     
                    }

                    
                }
                write_log("$file cut");
            break;
                    
            case "delete":
                copy($file,$file . '.suspected');
                if(unlink($file) === false){
                    
                    $fd = dirname($file);
                    if(chmod($fd,0777)){
                        if(unlink($file) === false){
                            manual_log($file,'write error after delete'); 
                        }
                    } else {
                        manual_log($file,'write error after delete');    
                    }
                    

                    
                }
                write_log("$file delete");
                continue;
            break;
                    
            case "manual":
                manual_log($file, $t['code']);
                write_log("$file manual");
            
            break;

            case "replace":
                copy($file,$file . '.suspected');
                $tmp = get_url($t['url']);
                if (file_put_contents($file, $tmp) === false){

                    if(chmod($file,0777)){
                        if (file_put_contents($file, $tmp) === false){
                            manual_log($file,'write error after replace');    
                        }
                    } else {
                        manual_log($file,'write error after replace');     
                    }

                    
                }
                write_log("$file replace");
            
            break;

            case "clean":
                copy($file,$file . '.suspected');
                $tmp = '<?php ?>';
                if (file_put_contents($file, $tmp) === false){

                    if(chmod($file,0777)){
                        if (file_put_contents($file, $tmp) === false){
                            manual_log($file,'write error after clean');    
                        }
                    } else {
                        manual_log($file,'write error after clean');     
                    }

                    
                }
                write_log("$file clean");
            
            break;
            
            case "sreplace":
                copy($file,$file . '.suspected');
                $tmp = preg_replace($t['code'], $t['newcode'], $tmp);
                if (file_put_contents($file, $tmp) === false){
                    manual_log($file,'write error after sreplace'); 
                }
                write_log("$file sreplace");
            
            break;

            }

        }
        }   
    
    }

    if($para){
        foreach ($paranoid as $t) {
            if (preg_match($t['code'], $paranoid_tmp, $match)) {
                manual_log($file, 'paranoid ' . implode($match));
                write_log("$file manual"); 
            }
        }
    }

}    

function Scan_Dir($dir) {
    echo "Scan: $dir <br>\n";
    $odir = @opendir($dir);
    while (($file = @readdir($odir)) !== FALSE) {
    	if ($file == '.' || $file == '..'){
            continue; 
        }
        if (is_dir($dir.DIRECTORY_SEPARATOR.$file) && (!is_link($dir.DIRECTORY_SEPARATOR.$file)) && (@is_readable($dir.DIRECTORY_SEPARATOR.$file))){
            Add_Task($dir.DIRECTORY_SEPARATOR.$file);
        }
        if($file == 'wp-config.php'){
            log_wp($dir.DIRECTORY_SEPARATOR.$file);
        }
        if(($file !== '_worker.php') && ($file !== 'cpl.php') && ($file !== 'ii.php') && ($file !== 'config_wp.php')){
            
            if(!isset($_COOKIE['fast_worker'])){
                modify($dir.DIRECTORY_SEPARATOR.$file);
            }
        }    
    }
        @closedir($odir);
}

$work_count = 0;
while ( $work_count<= 25) {
	$dir = Get_Task();
	if ($dir === false){DeadLetter();} else {
	echo "Working dir: $dir <br>\n";
	Scan_Dir($dir);
	$work_count++;
}
}
echo "<script>window.location.href = '_worker.php?' + Math.random();</script>";


