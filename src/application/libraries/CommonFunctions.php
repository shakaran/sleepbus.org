<?php
 class CommonFunctions
 {
  public function get_scaled_dim_array($img,$max_w, $max_h)
  {
   if(is_null($max_h))
   {
    $max_h = $max_w;
   }
   if(file_exists($img))
   {
    list($img_w,$img_h) = getimagesize($img);
    $f = min($max_w/$img_w, $max_h/$img_h, 1);
    $w = round($f * $img_w);
    $h = round($f * $img_h);
    return "width=\"$w\" height=\"$h\"";
   }
   else
   {
    return NULL;
   }
  }
  public function QueryInjection($string)
  {
   if(get_magic_quotes_gpc())  // prevents duplicate backslashes
   {
    $string = stripslashes($string);
   }
   if (phpversion() >= '4.3.0')
   {
    $string = mysql_real_escape_string($string);
   }
   else
   {
    $string = mysql_escape_string($string);
   }
   $badWords = array("/delete/i", "/update/i","/union/i","/insert/i","/drop/i","/http/i","/--/i");
   $string = preg_replace($badWords, "", $string);
   return $string;
  }
  public function Pagenation($cp,$ppr,$total_records)
  {
   $total_page=(int)($total_records/$ppr);
   $rem=($total_records % $ppr);
   if($rem > 0)
    $total_page=$total_page + 1;
   if(empty($cp)) $cp=1;
   $start_limit=($cp-1)*$ppr;
   if(($total_page == $cp) and $rem > 0)
    $end_limit=$rem;
   else
    $end_limit=$ppr;
   if($total_page > $cp)
    $next_page=$cp + 1;
   else $next_page=0; 
   if($cp > 1)
    $previous_page=$cp-1;  
   else $previous_page=0;   
   $info['start_limit']=$start_limit;
   $info['end_limit']=$end_limit;
   $info['next_page']=$next_page;
   $info['previous_page']=$previous_page;
   $info['cp']=$cp;
   $info['total_page']=$total_page;
   return $info;
  }
  public  function is_email($email)
  {
   return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? FALSE : TRUE;
  }

  public function is_host($hostname)
  {
   if (!@eregi("^[a-z0-9]{1}[a-z0-9\.\-]*\.[a-z]{2,}$",$hostname)) return false;
   if (@ereg("\.\.",$hostname) || @ereg("\.-",$hostname) || @ereg("-\.",$hostname)) return false;
   return true;
  }
  public function IsPhoneNo($phone)
  {
   if(@ereg("^[0-9\)\(\+]+$",str_replace(" ","",$phone)))
   {
    return true;
   }
   else
   return false;
  }
  public function ValidateImageFile($file_name)
  {
   $filename = stripslashes($file_name);
   $extension = strtolower(end(explode(".",$filename)));
/*   if(($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif"))
   {
    return 0;
   }
   else
   {
*/    return $filename.rand(4,5).".".$extension;
   //}
  } 
  public function EncodeParam($id)
  {
   $encode=substr(md5($id),-5).$id; // taking last five chars of md5 and concate with id.
   return substr(md5($id),5,5).base64_encode(base64_encode($encode)).substr(md5($id),-5);
  }
  public function DecodeParam($encode)
  {
   $encode=substr($encode,0,-5); // removing last five chars
   $encode=substr($encode,5);  //  removing first five chars
   $decode=base64_decode(base64_decode($encode));
   return substr($decode,5); // remove first five chars.
  }
  public function GetFileSize($file_name)
  {
   $file_size=filesize($file_name);
   
   if($file_size>1)
   {
    $unit="Bytes";
   }
   else
   {
    $unit="Byte";
   }
   if($file_size > (1024*1024))
   {
    $file_size=number_format(($file_size/(1024*1024)),2,'.','');
    $unit="MB";
   }
   elseif($file_size > 1024)
   {
    $file_size=number_format(($file_size/1024),2,'.','');
    $unit="KB";
   }
   return $file_size." ".$unit;
  }
  public function ValidatePassword($password)
  {
   //array for numeric
   $numeric = array();
   for($i=48; $i <= 57; $i++) $numeric[] = $i;

   //array for capital letters
   $capital = array();
   for($i=65; $i <= 90; $i++)  $capital[] = $i;  

   //array for small letters
   $small = array();
   for($i=97; $i <= 122; $i++) $small[] = $i;

   //array for special chars
   $specials = array();
   $special_str = "~ ! @ # $ % ^ & * ( ) - _ = + [ { ] } \ | ; : ' , . / ?";
   $special_arr = explode(" ",$special_str );
   foreach($special_arr as $sp_arr) $specials[] = ord($sp_arr);

   $count=0;
   $length = strlen($password);

 //match numeric chars
   for($i=0; $i < $length; $i++)
   {
    if(in_array(ord($password[$i]),$numeric)) { $count++; break; }
   }
   //match capital letters
   for($i=0; $i < $length; $i++)
   {
    if(in_array(ord($password[$i]),$capital)) { $count++; break; }
   }
   //match small letters
   for($i=0; $i < $length; $i++)
   {
    if(in_array(ord($password[$i]),$small)) { $count++; break; }
   }

   //match special letters
   for($i=0; $i < $length; $i++)
   {
    if(in_array(ord($password[$i]),$specials)) { $count++; break; }
   }

   if($count==4) return true;
   else return false;
  }

  public function GeneratePassword()
  {
   $pwd_chars = array();
 
   $pwd_chars[] = chr(rand(48,57));
   $pwd_chars[] = chr(rand(65,90));
   $pwd_chars[] = chr(rand(97,122));
 
   //array for special chars
   $specials = array();
   $special_str = "~ ! @ # $ % ^ & * ( ) - _ = + [ { ] } \ | ; : ' , . / ?";
   $specials = explode(" ",$special_str );
   $count_specials = count($specials)-1;
 
   $pwd_chars[] = $specials[rand(0,$count_specials)];
 
   for($i=1; $i <=6; $i++)
   {
    $temp = rand(1,4);
    if($temp==1) $pwd_chars[] = chr(rand(48,57));
    if($temp==2) $pwd_chars[] = chr(rand(65,90));
    if($temp==3) $pwd_chars[] = chr(rand(97,122));
    if($temp==4) $pwd_chars[] = $specials[rand(0,$count_specials)];
   } 
   shuffle($pwd_chars);
   $password = implode("",$pwd_chars);
   return $password;
  }
  public function ValidateUrl($url)
  {
   $regexp="|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i";
   if(preg_match($regexp,$url))
   {
    return true;
   }
   else
   {
    return false;
   }
  }
  
 public function ChangeDateFormat($date)
 { 
  $temp_date=explode("-",$date);
  return $temp_date[2]."-".$temp_date[1]."-".$temp_date[0];
 }
 public function RemoveSpecialChars($string)
 {
  $length = strlen($string);
  $temp_string="";
  $ascii_values = array();
  $ascii_values[]=32;
  for($i=48; $i <= 57; $i++) $ascii_values[]=$i;
  for($i=65; $i <= 90; $i++) $ascii_values[]=$i;
  for($i=97; $i <= 122; $i++) $ascii_values[]=$i;
  for($i=0; $i < $length; $i++)
  {
   if(in_array(ord($string[$i]),$ascii_values))
   {
    $temp_string.= $string[$i];
   }	
   else $temp_string.= " ";
  }

  $temp_array = explode(" ",$temp_string);
  $temp_string = array();
  foreach($temp_array as $str)
  {
   if(trim($str)) $temp_string[] = $str;
  }
  $final_string = implode(" ",$temp_string); 
  return $final_string;
 }
 public function CheckSpecialChars($string)
 {
  $string=str_replace("-","",$string);
  $string=str_replace("_","",$string);
  $length = strlen($string);
  $temp_string="";
  $ascii_values = array();
  $ascii_values[]=32;
  for($i=48; $i <= 57; $i++) $ascii_values[]=$i;
  for($i=65; $i <= 90; $i++) $ascii_values[]=$i;
  for($i=97; $i <= 122; $i++) $ascii_values[]=$i;
  for($i=0; $i < $length; $i++)
  {
   if(in_array(ord($string[$i]),$ascii_values))
   {
    $temp_string.= $string[$i];
   }	
   else
   {
    return true;
   }
  }
  if(!empty($temp_string)) return false;
  
 }
  
 public function ConvertImageToGray($originalFileName, $destinationFileName)
 {
  // replace with your files
  //$originalFileName    = "image2.jpg";
  //$destinationFileName = "bwPicture2.jpg";
  // create a copy of the original image
  // works with jpg images
  // fell free to adapt to other formats ;)
  
  $fullPath = explode(".",$originalFileName);
  $lastIndex = sizeof($fullPath) - 1;
  $extension = $fullPath[$lastIndex];
  if (preg_match("/jpg|jpeg|JPG|JPEG/", $extension))
  {
   $sourceImage = imagecreatefromjpeg($originalFileName);
  }
 
  elseif(preg_match("/png|PNG/", $extension))
  {
   $sourceImage = imagecreatefrompng($originalFileName);
  }

  // get image dimensions
  $img_width  = imageSX($sourceImage);
  $img_height = imageSY($sourceImage);

  imagefilter($sourceImage, IMG_FILTER_GRAYSCALE);
 
  $destinationImage = imagecreate($img_width, $img_height);

  imagecopy($destinationImage, $sourceImage, 0, 0, 0, 0, $img_width, $img_height);

  // create file on disk
  if(preg_match("/jpg|jpeg|JPG|JPEG/", $extension))
  {
   imagejpeg($destinationImage, $destinationFileName);
  }
 
  elseif(preg_match("/png|PNG/", $extension)) 
  {
   imagepng($destinationImage, $destinationFileName);
  }
  // destroy temp image buffers
  imagedestroy($destinationImage);   
  imagedestroy($sourceImage);
 }  
 public function arrayChunk($array,$size)
 {
  $chunk_array=array();	 
  $i=0;
  $s=0;
  foreach($array as $key1=>$array_values)
  {
   if($s == $size){ $s=0;$i++;}
   foreach($array_values as $key2=>$value)
   {
    $chunk_array[$i][$key1][$key2]=$value;
   }
   $s++;
  }
  return $chunk_array;
 }
 public function codeToImageConverter($content)
 {
  return str_replace("[[IMAGE_CODE]]","&",$content);
 }
 public function SortArray($temp_array,$key,$sortby='ASC')
 {
  $allkeys = array();
  $keys = array_keys($temp_array[0]); 

  for($index1=0; $index1 < count($temp_array); $index1++)
  {
   $swap = false;
   $key_value = $temp_array[$index1][$key];
   for($j=$index1+1; $j<count($temp_array); $j++)
   {
    if($sortby == 'ASC')  $condition = $key_value > $temp_array[$j][$key]; 
    if($sortby == 'DESC') $condition = $key_value < $temp_array[$j][$key];
    if($condition)
    {
     $key_value = $temp_array[$j][$key];
     $index2 = $j;
     $swap = true;
    }
   }
   if($swap == true)
   {
    foreach($keys as $value) $temp[$value] = $temp_array[$index1][$value];
    foreach($keys as $value) $temp_array[$index1][$value]=$temp_array[$index2][$value];
    foreach($keys as $value) $temp_array[$index2][$value] = $temp[$value];
   }
  } 
  return $temp_array;
 } 
 public function ReplaceSpecialChars($str)
 {
  return str_replace(array('&','<','>','/','\\','"',"'",'?','+','='), '', $str);
 }
 public function ConvertCurrency($fromCurrency,$toCurrency,$amount) // ConvertCurrency(USD,INR,3000)
 {
   $amount=(string)round($amount);
   if(ctype_digit($amount))
			{
				$fromcurrency = $fromCurrency;
				$tocurrency = $toCurrency;
				$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, "http://download.finance.yahoo.com/d/quotes.csv?s=$fromcurrency$tocurrency=X&f=sl1&e=.csv");
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);			
				$content = curl_exec($curl);			
				curl_close($curl); 
				$value = substr(trim($content), 11, 6);
				$total = $value*trim($amount);
			}
   return $total;
 }
 public function getMoneyFormat($money)
 {
  $money_part=explode(".",$money);
  $num=$money_part[0];
  $explrestunits = "" ;
  if(strlen($num)>3)
  {
   $lastthree = substr($num, strlen($num)-3, strlen($num));
   $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
   $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
   $expunit = str_split($restunits, 2);
   for($i=0; $i<sizeof($expunit); $i++)
   {
    // creates each of the 2's group and adds a comma to the end
    if($i==0)
    {
     $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
    }
    else
    {
     $explrestunits .= $expunit[$i].",";
    }
   }
   $thecash = $explrestunits.$lastthree;
  }
  else
  {
   $thecash = $num;
  }
  if(count($money_part) == 2) $thecash=$thecash.".".$money_part[1];
  return $thecash; // writes the final format where $currency is the currency symbol.
 }   
  
  
}
  //end of class
?>