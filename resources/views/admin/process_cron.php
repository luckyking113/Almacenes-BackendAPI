<?php
ini_set('max_execution_time', 300);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(0); 



//require_once $_SERVER['DOCUMENT_ROOT'].'/db_connect.php';


//if($_SESSION['is_loggedin'] != 1)
//{
//    header("login.php");
//    exit;
//}

//require_once $_SERVER['DOCUMENT_ROOT'].'/good-products.php';

$msg = "First line of text\nSecond line of text";

$msg = wordwrap($msg,70);
mail("titu41@gmail.com","My Fee subject 5",$msg);


// download feed from source file and save to new .txt file for optimizing
$text = file_get_contents("https://www.armysurplusworld.com/media/feeds/feed_7.txt");
$myfile = fopen( "newfile.txt", "w") or die("Unable to open file sorry!");
fwrite($myfile, $text);
fclose($myfile);

// David // Create array to make code easier to read
$col = create_header_row();

// David // Create array to make custom_label_4
$good_prod = good_products();
$msg = "First line of text\nSecond line of text";

$msg = wordwrap($msg,70);
mail("titu41@gmail.com","My Fee subject 7",$msg);

exit;
// David // Create female array
$female  = array('girl', 'female', 'woman', 'ladies','hot shorts');

// David // Sizes
$sizes = array(
	"0-3 months"=>"newborn",
	"3-6 months"=>"infant",
	"6-9 months"=>"infant",
	"9-12 months"=>"infant",
	"12-18 months"=>"toddler",
	"2t"=>"toddler",
	"3t"=>"toddler",
	"4t"=>"toddler");

echo "working";
echo "<br>";

/*
// make an array of items from .txt file 
$result = array();
$file="newfile.txt";
$lines = file($file);
$item_ids = array();
foreach ($lines as $line_num => $line) {

        $arr = explode("\t", trim($line));
        if ($line_num === key($lines)){
            array_push($arr, "custom_label_4");
        } else {
            array_push($arr, "test");    
        }
        //$custom4 = () ? "" : "";

 }
array_shift($result);
*/
echo "working 2";
echo "<br>";
// code for saving feed to database
/*
mysqli_query($conn,"TRUNCATE TABLE file_data");
foreach(array_chunk($result, 1000) as $curta ) {
    $sql = array();
foreach($curta as $data)
{
    
      $sql[] = "( '". mysqli_real_escape_string($conn,$data['0']) ."', '". mysqli_real_escape_string($conn,$data['1']) ."', '". mysqli_real_escape_string($conn,$data[2])      ."', "
                        . " '". mysqli_real_escape_string($conn,$data['3'])."', '". mysqli_real_escape_string($conn,$data['4'])."', '". mysqli_real_escape_string($conn,$data['5'])."', '". mysqli_real_escape_string($conn,$data['6'])."', "
                        . " '". mysqli_real_escape_string($conn,$data['7'])."', '".  mysqli_real_escape_string($conn,$data['8'])."', '". mysqli_real_escape_string($conn,$data['9'])."', '". mysqli_real_escape_string($conn,@$data['10'])."', "
                        . " '". mysqli_real_escape_string($conn,@$data['11'])."', '". mysqli_real_escape_string($conn,@$data['12'])."', '". mysqli_real_escape_string($conn,$data['13']) ."', "
                        . " '". mysqli_real_escape_string($conn,$data['14']) ."', '". mysqli_real_escape_string($conn,$data['15']) ."', '". mysqli_real_escape_string($conn,@$data['16']) ."', '". mysqli_real_escape_string($conn,@$data['17']) ."', "
                        . " '". mysqli_real_escape_string($conn,@$data['18']) ."', '". mysqli_real_escape_string($conn,@$data['19']) ."', '". @$data['20'] ."', '". mysqli_real_escape_string($conn,@$data['21']) ."', '". mysqli_real_escape_string($conn,@$data['22']) ."', '". mysqli_real_escape_string($conn,@$data['23']) ."', '". mysqli_real_escape_string($conn,@$data['24']) ."')";
  
}
$dataQuery = implode("," , $sql);
       
$sql = " INSERT INTO file_data VALUES ".$dataQuery;
       mysqli_query($conn,$sql);
}
*/

// This function is used to write optimize feed in new .txt file
function write_tabbed_file($filepath, $array, $save_keys=false){
    $content = '';
    reset($array);
    while(list($key, $val) = each($array)){
 
        // replace tabs in keys and values to [space]
        $key = str_replace("\t", " ", $key);
        $val = str_replace("\t", " ", $val);
 
        if ($save_keys){ $content .=  $key."\t"; }
 
        // create line:
        $content .= (is_array($val)) ? implode("\t", $val) : $val;
        //Removed by David because it was adding extra empty lines to file
      //  $content .= "\n";
    }
 
    if (file_exists($filepath) && !is_writeable($filepath)){ 
        return false;
    }
    
  
    if ($fp = fopen($filepath, 'w')){
        fwrite($fp, $content);
        fclose($fp);
    }
    else { return false; }
    return true;
}



// Read feed from file and make an item array for optimization
$result = array();
$file=$_SERVER['DOCUMENT_ROOT']."/newfile.txt";
$lines = file($file);
$item_ids = array();
$i=0;
foreach ($lines as $line_num => $line) {
        
        $line = str_replace("\n","",$line);
        
        if ($i == 0){
            $line .= "\tcustom_label_4";
            $line .= "\n";
        } else {
            $line .= "\t";
            $line .= "\n";
        }        
        
        $arr = explode("\t", $line);

        if(in_array(trim($arr[13]),$good_prod))
        {
            $arr[27] =  "good\n";
        }
        if(!in_array(trim($arr[0]), $item_ids))
        {
            $result[] = $arr;
            $item_ids[]  = trim($arr[0]);
        }
        $i++;
 }
echo "working 3";
echo "<br>";
$parent_id = array();
$simple_items = array();
$configurable_items = array();
$configurable_size = array();
$configurables = array();


// separate items as simple and configurable items
foreach($result as $key=>$data)
{
   
    if(!empty(trim($data[1])))
      {  
            $group_id = explode("-", $data[1]);
            if(count($group_id) > 1)
            {
                $result[$key][1] = $group_id[0];
            }
           // $parent_id[] = $data[1]; // old backup line
            //$result[$key][24] = 'Simple';
            $parent_id[] = $result[$key][1];
            $simple_items[] = $result[$key];

      }
      else
      {
          $configurables[] = $result[$key];
      }
}
echo "working 4";
echo "<br>";

// again proces configurable items to find out simple items from it
$singleColor = array();
foreach($configurables as $key=>$data)
{
    $configurable_size[$data[0]] = $configurables[$key][11];
    if(empty(trim($data[1])) && in_array(trim($data[0]), $parent_id))
    {  
       // $configurables[$key][24] = 'Configurable';
        $configurable_items[$data[0]] = $configurables[$key][2];
        $color = explode("," , $configurables[$key][20]);
        if(count($color) == 1)
        {
           $singleColor[] =  $configurables[$key][0];
        }

     }
    else
    {

     $simple_items[] = $configurables[$key];

    }
}

$group_id_occurance = array_count_values($parent_id);

echo "working 5";
echo "<br>";
//process simple items to optimize feed 
foreach($simple_items as $key=>$item)
{
    
    if($key > 0)
    {
    if(array_key_exists($item[1], $configurable_items))
    {

           $simple_items[$key][2] = $configurable_items[$item[1]];
    }
    if(array_key_exists($item[1], $configurable_size))
    {
        $simple_items[$key][11] = $configurable_size[$item[1]];
    } 
    $simple_items[$key][19] = strtolower($simple_items[$key][19]);
    
   if(strtolower(trim($simple_items[$key][19])) != 'one size fits all')
    {
       $strrep = str_ireplace("one size fits all", "", $simple_items[$key][19],$count);
       $strrep =  str_replace(",", " ", $strrep);
       $simple_items[$key][19] = $strrep;
    } 
    //David// Remove One Size Fits All if not necessary
    if(strtolower(trim($simple_items[$key][19])) == 'one size fits all')
    {
        if(strpos(trim($simple_items[$key][16]),"Apparel & Accessories > Clothing", 0) !== 0)
        {
            $simple_items[$key][19] = "";
        }
        if(strpos(trim($simple_items[$key][16]),"Apparel & Accessories > Shoes", 0) !== 0)
        {
            $simple_items[$key][19] = "";
        }
    }
    


    //David// Fix Name Tapes & Dog Tags
    $temp_title = trim($simple_items[$key][$col['title']]);
    if(!stripos($temp_title, "top gun costume", 0)){
        if(stripos($temp_title, "dog tag", 0)){
            $simple_items[$key][$col['google_product_category']] = "Health & Beauty > Health Care > Medical Identification Tags & Jewelry";
            $simple_items[$key][$col['custom_label_0']] = "Dog Tag";
        } else if(stripos($temp_title, "bib", 0) && !stripos($temp_title, "bible", 0)){
            $simple_items[$key][$col['google_product_category']] = "Baby & Toddler > Nursing & Feeding > Bibs";
            $simple_items[$key][$col['custom_label_0']] = "Baby Bibs";
        } else if(stripos($temp_title, "costume", 0)){
            $simple_items[$key][$col['google_product_category']] = "Apparel & Accessories > Costumes & Accessories > Costumes";
            $simple_items[$key][$col['custom_label_0']] = "Costume";
        } else if(stripos($temp_title, "name", 0)){
            $simple_items[$key][$col['google_product_category']] = "Arts & Entertainment > Hobbies & Creative Arts > Arts & Crafts > Art & Crafting Materials > Embellishments & Trims > Sew-in Labels";
            $simple_items[$key][$col['custom_label_0']] = "Name Tapes";
        }

    }

    //David// Fix Age Gropu
    if(stripos(trim($simple_items[$key][$col['google_product_category']]),"apparel", 0) === FALSE){
        $simple_items[$key][$col['age_group']] = "";
    } else {
        if(array_key_exists(trim($simple_items[$key][$col['size']]), $sizes)){
            if(trim($simple_items[$key][$col['age_group']]) != $sizes[trim($simple_items[$key][$col['size']])]){
                $simple_items[$key][$col['age_group']] = $sizes[trim($simple_items[$key][$col['size']])];
            }
        }
    }

    //Append size to title if not already in title or set to one size fits all
    if (stripos($simple_items[$key][2], $simple_items[$key][19]) === FALSE) 
    { 
       if(strtolower(trim($simple_items[$key][19])) != 'one size fits all')
       {
         $simple_items[$key][2] =  $simple_items[$key][2]." ".$simple_items[$key][19];
       }
    }
    
    //Append color to title if not already in title
    if(!empty(trim($simple_items[$key][20])))
    {
       if (stripos($simple_items[$key][2], trim($simple_items[$key][20])) === false) 
       { 
         $simple_items[$key][2] =  $simple_items[$key][2]." ".$simple_items[$key][20] ;
       }
     }
     
     // Add custom_label_2 to title
        $simple_items[$key][2] =  $simple_items[$key][2]." ". trim($simple_items[$key][25]) ;
    
    // David // Remove simple items if custom_label_3 is set to Dis 
    if(stripos(trim($simple_items[$key][$col['custom_label_3']]), "Dis", 0) !== FALSE)
    {
        unset($simple_items[$key]);
    }
    
    //David// Fix out of stock and no color
    if(trim($simple_items[$key][$col['availability']]) == "out of stock" && trim($simple_items[$key][$col['color']]) == "")
    {
        unset($simple_items[$key]);
    }

    // Remove simple items if shipping weight is empty    
    if(empty(trim($simple_items[$key][11])))
    {
        unset($simple_items[$key]);
    }
    
    // David // Set gender
    
    if(empty(trim($simple_items[$key][22]))) 
    {
        
        $simple_items[$key][$col['gender']] = (striposa($simple_items[$key][$col['title']], $female, 0) !== FALSE) ? "female" : $simple_items[$key][$col['gender']];
        $simple_items[$key][$col['gender']] = (stripos($simple_items[$key][$col['product_type']], "women", 0) !== FALSE) ? "female" : $simple_items[$key][$col['gender']];
        $simple_items[$key][$col['gender']] = (stripos($simple_items[$key][$col['title']], "boy", 0) !== FALSE) ? "male" : $simple_items[$key][$col['gender']];
        $simple_items[$key][$col['gender']] = (substr(strtolower(trim($simple_items[$key][$col['title']])), 0, 3) == "men") ? "male" : $simple_items[$key][$col['gender']];
        if(empty(trim($simple_items[$key][22])) && trim($simple_items[$key][0]) != "")
        {
            $simple_items[$key][$col['gender']] = "unisex";
        }
        
    }
        
    // remove simple items which has item_group_id set and have the word "costume" in the title of the coresponding configurable item    
    //Removed by David because problem was fixed on server side. 
   /* if(!empty(trim($item[1])))
    {
        if (stripos($configurable_items[$item[1]], 'costume') !== false) {
         unset($simple_items[$key]);
           
        }
        
        
    }*/
    }
    
    
}

echo "working 6";
echo "<br>";

// remove items whose has group_item_id set and there is only one item with this group_item_id
$fial_titles = array();
foreach($simple_items as $key=>$item)
{
    if($key > 0)
    {
        if(!empty(trim($item[1])))
        {
            if($group_id_occurance[trim($item[1])] == '1')
            {
                unset($simple_items[$key]);
               
            }
            else
                $fial_titles[] = trim($item[2]);
            
        }
        else
            $fial_titles[] = trim($item[2]);
        
       
        // remove items if
        if (stripos($simple_items[$key][15], 'Weaponry') !== false || stripos($simple_items[$key][15], 'Manual') !== false) {
               unset($simple_items[$key]);
         }
         
         $title = trim($simple_items[$key][2]);
         $pieces = explode(' ', $title);
         $last_word = array_pop($pieces);
         
       
         
         if (empty(trim($simple_items[$key][14])) && strtolower($last_word) == 'new') {
               $simple_items[$key][14] = 'new';
         }
         else if (empty(trim($simple_items[$key][14])) && strtolower($last_word) == 'used') {
               $simple_items[$key][14] = 'used';
         }
    }
}

echo "working 7";
echo "<br>";

function unique_multidim_array($array, $key) {
    $temp_array = array();
    $i = 0;
    $key_array = array();
   
    foreach($array as $val) {
        if (!in_array($val[$key], $key_array)) {
            $key_array[$i] = $val[$key];
            $temp_array[$i] = $val;
        }
        $i++;
    }
    return $temp_array;
} 

// Remove items with duplicate title
$simple_items = unique_multidim_array($simple_items,2); 


//echo "<pre>";
//print_r(count($simple_items)); 
//echo "<pre>";
//print_r($simple_items);
//exit;



echo "working 8";
echo "<br>";
write_tabbed_file($_SERVER['DOCUMENT_ROOT'].'/feed/armyfeed.txt',$simple_items);

// Stripos with an array
function striposa($haystack, $needles=array(), $offset=0) {
        $chr = array();
        foreach($needles as $needle) {
                $res = stripos($haystack, $needle, $offset);
                if ($res !== false) $chr[$needle] = $res;
        }
        if(empty($chr)) return false;
        return min($chr);
}

//   print_r($simple_items); exit;
function create_header_row(){
	$array = array(
		"id"=>"0",
		"item_group_id"=>"1",
		"title"=>"2",
		"description"=>"3",
		"link"=>"4",
		"image_link"=>"5",
		"additional_image_link"=>"6",
		"price"=>"7",
		"sale_price"=>"8",
		"sale_price_effective_date"=>"9",
		"availability"=>"10",
		"shipping_weight"=>"11",
		"brand"=>"12",
		"mpn"=>"13",
		"condition"=>"14",
		"product_type"=>"15",
		"google_product_category"=>"16",
		"is_bundle"=>"17",
		"shipping"=>"18",
		"size"=>"19",
		"color"=>"20",
		"age_group"=>"21",
		"gender"=>"22",
		"custom_label_0"=>"23",
		"custom_label_1"=>"24",
		"custom_label_2"=>"25",
		"custom_label_3"=>"26",		
		"custom_label_4"=>"27");	
	return $array;
}     
?>
<!DOCTYPE html>
<html lang="zxx">
    <head>
        <!-- Title -->
        <title>Login</title>

        <!-- Required Meta Tags Always Come First -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- ++++ keywords ++++ -->
        <meta name="keywords" content="css3, html5, bootstrap4">
        <!-- ++++ description ++++ -->
        <meta name="description" content="">

        <!-- ++++ favicon ++++ -->
        <link rel="icon" type="image/png" sizes="32x32" href="icon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="icon/favicon-96x96.png">
        <link rel="apple-touch-icon" sizes="57x57" href="icon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="114x114" href="icon/apple-icon-114x114.png">

        <!-- Load Styles -->
        <!-- ++++ bootstrap ++++ -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- ++++ main style ++++ -->
        <link rel="stylesheet" href="css/styles.css">
        <!-- ++++ responsive css ++++ -->
        <link rel="stylesheet" href="css/responsive-style.css">
    </head>
    <body>

        <header>

            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="#"><img src="images/fxlogo2.svg" alt="logo"/></a>

<div class="collapse navbar-collapse top-nav" id="navbarTogglerDemo03">
                        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                              <li><a href="home.php"><button class="btn btn-primary orange-fill-btn" type="submit">Inicio</button></a></li>
                            
                        </ul>
                    </div>
                </div>
            </nav>

        </header>


    <section style="background-color:#f3f5f9">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="login-form-content" style="margin-bottom:20%;width:80%">
                            <form class="login-form" method="post" action="submit_login.php" >
                                <h2>Data Feed Process </h2>
                                <div class="form-element-wrapper">
                                     <div class="col-sm-12 col-md-12">
                                         <div class="alert alert-success" role="alert">Data feed has been optimized and saved as new file. To view click <a href="feed/armyfeed.txt" target="_blank"><strong>here</strong></a></div>
                                  </div>
                                
                                    
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                            <div class="new-to-ForexMart">
                              
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>

        <section class="footer-nav">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">                     
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Legal documentation</a>
                            </li>
                           
                            <li class="nav-item">
                                <a class="nav-link" href="#">Privacy Policy</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Terms & Conditions</a>
                            </li>

                        </ul>
                        
                    </div>
                </div>
            </nav>


            
        </section>



        <!--js library of jQuery-->
        <script src="js/jquery-1.12.4.min.js"></script>
        <!--js library of bootstrap-->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>