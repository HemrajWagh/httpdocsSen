<?php

$name=$email=$mobile=$tym=$project=$cost=$message=$proj="";


if (isset($_REQUEST['name'])) {
    $name=$_REQUEST['name'];
}
if (isset($_REQUEST['email'])) {
    $email=$_REQUEST['email'];
}
if (isset($_REQUEST['mobile'])) {
    $mobile=$_REQUEST['mobile'];
}
if(isset($_REQUEST['tym'])){
    $tym = $_REQUEST['tym'];
}
//$campaign=$_REQUEST['campaign'];
if (isset($_REQUEST['pid'])) {
    $project=$_REQUEST['pid'];
}
if(isset($_REQUEST['cost-sheet'])){
    $cost=$_REQUEST['cost-sheet'];
}
// if (isset($_REQUEST['message'])) {
//     $message=$_REQUEST['message'] ." ".  $cost. "$nbsp Calling Time:" . $tym ;
// }
if (isset($_REQUEST['comment'])) {
    $comment=$_REQUEST['comment'];
}

$proj= "saffron";
//$project=$_REQUEST['project'];

//$projects = array(
//			"527663432578816955"  =>"Mystic" ,
//			"527663432578816438" => "Springs",
//			"527663432578816547" => "Symphony",
//			"527663432578816202" => "Home"
// 								);
//								
							//$project = $projects[$projectId];
$source= 'MP_Digital';//$_REQUEST['Source'];

// $wuid='527748409256816694_ws_527660047398816469';
// $uid='527660047398816469';
// $campaign='Megapolis_Digital';

// $RQurl = 'http://api.realtyredefined.in/rqLeadAPI.php?wuid=' . $wuid . '&name=' . urlencode($name) . '&mobile=' . urlencode($mobile) . '&email=' . urlencode($email) . '&Source=' . urlencode($source) . '&Message=' .urlencode($message)  . '&Campaign=' . $campaign . '&pid=' . $project . '&uid=' . $uid;

   //echo $RQurl; //die;

             /*   $RQch = curl_init();
                curl_setopt($RQch, CURLOPT_URL, $RQurl);
                curl_setopt($RQch, CURLOPT_HEADER, 0);
                curl_setopt($RQch, CURLOPT_RETURNTRANSFER);
                $RQresult = curl_exec($RQch);
                curl_close ($ch);
                //echo $RQresult;*/
                
                // $RQch = curl_init();
                // curl_setopt($RQch, CURLOPT_URL, $RQurl);
                // curl_setopt($RQch, CURLOPT_TIMEOUT, 1); 
                // curl_setopt($RQch, CURLOPT_HEADER, 0);
                // curl_setopt($RQch,  CURLOPT_RETURNTRANSFER, false);
                // curl_setopt($RQch, CURLOPT_FORBID_REUSE, true);
                // curl_setopt($RQch, CURLOPT_CONNECTTIMEOUT, 1);
                // curl_setopt($RQch, CURLOPT_DNS_CACHE_TIMEOUT, 10); 
                // curl_setopt($RQch, CURLOPT_FRESH_CONNECT, true);
                // $RQresult = curl_exec($RQch);
		//curl_close($ch);
	//	return $RQresult;
                ?>


                <?php
//	alert('No errors: Form will be submitted');
                if((isset($_POST['name']))&&(isset($_POST['mobile']))&&(isset($_POST['email'])))
                {
                    $to = "hemrajswagh@gmail.com";

                    $servername = "localhost";
                    $username = "rajSaff";
                    $password = "Kumar@123";
                    $dbname = "project-con-form";

// Create PDO connection
                    try {
                     $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
                     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                 } catch (PDOException $e) {
                     echo "Connection failed:" . $e->getMessage();
                 }

// Create connection
                 // $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
                //  if ($conn->connect_error) {
                //     die("Connection failed: " . $conn->connect_error);
                // } 

                 // $query = "INSERT INTO enquiries SET name=:name, email=:email, mobile_no=:phone, call_time=:tym, message=:message, project_name=:pid, campaign=:campaign, source=:source";

                 // $sql = "INSERT INTO conform SET name=:name, email=:email, mobile_no=:phone, call_time=:tym, message=:message, project_name=:pid, campaign=:campaign, source=:source";

                 $sql = "INSERT INTO conform SET name=:1, email=:2, mobile=:3, comment=:4, project=:5, source=:6";

                 // (`name`, `email`, `mobile`, `comment`, `project`,`source`)
                 // VALUES (':name',':email',':mobile',':comment',':project',':source')";

                 $stmt=$conn->prepare($sql);
                 $name=htmlspecialchars(strip_tags($name));
                 $email=htmlspecialchars(strip_tags($email));
                 $mobile=htmlspecialchars(strip_tags($mobile));
                 $comment=htmlspecialchars(strip_tags($comment));
                 $project=htmlspecialchars(strip_tags($project));
                 $source=htmlspecialchars(strip_tags($source));

                 $stmt->bindParam(":1",$name);
                 $stmt->bindParam(":2",$email);
                 $stmt->bindParam(":3",$mobile);             
                 $stmt->bindParam(":4",$comment);
                 $stmt->bindParam(":5",$project);
                 $stmt->bindParam(":6",$source);
                 // $stmt->bindParam($name,':1');
                 // $stmt->bindParam($email,':2');
                 // $stmt->bindParam($mobile,':3');             
                 // $stmt->bindParam($message,':4');
                 // $stmt->bindParam($project,':5');
                 // $stmt->bindParam($source,':6');
                 // $stmt->execute(); 

                 if ($stmt->execute()) {
                   // echo "New record created successfully";
                     } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                    }

                // $conn->close();
               $conn=null;


//                $from = $_REQUEST['email']; 
//                $name = $_REQUEST['name']; 
//     $phone = $_REQUEST['phone'];
//    $countricode=$_REQUEST['countryCode'];
// $phone=$_REQUEST['phone'];
//                $mobile=$_REQUEST['mobile'];
//                if (isset($_REQUEST['message'])) {
//                 $message = $_REQUEST['message'];
//             }
//             $proj= "Saffron";
//             $subject = " Megapolis Saffron Pre-Book Enquiry -".$proj; 
            
//             $body  = '<html><body>';
//             $body .= '<table rules="all" style="border-color: #666;" cellpadding="10">';    
//             $body .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" .$name. "</td></tr>";
//             $body .= "<tr><td><strong>Email:</strong> </td><td>" . $from. "</td></tr>";
//             $body .= "<tr><td><strong>Phone:</strong> </td><td>" .  $mobile. "</td></tr>";
//             $body .= "<tr><td><strong>Calling Time:</strong> </td><td>" .  $tym . "</td></tr>";
//             $body .= "<tr><td><strong>Message:</strong> </td><td>" . $message. "</td></tr>";
//             $body .= "<tr><td><strong>Project:</strong> </td><td>".$proj."</td></tr>";
						
//             $body .= "</table>";
//             $body .= "</body></html>";
            
//             $headers = "From: $from \r\n";
//         $headers .='X-Mailer: PHP/' . phpversion();
//              $headers .= "MIME-Version: 1.0\r\n";
//             $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            
//                 $send = mail($to, $subject, $body, $headers);
   //echo json_encode(array('status' => 'success'));
            
} //else {
  //echo json_encode(array('status' => 'error'));
//}


//echo $status_code;

    ?>
    <!doctype html>

        <head>
            <meta charset="utf-8">
        </head><meta charset="utf-8">
        <title>2 BHK Flats in Hinjewadi | Megapolis Saffron</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Expires" content="30" />
        <link rel="stylesheet" type="text/css" href="css/project.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130797909-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-130797909-1');
      </script> -->

      <!-- Global site tag (gtag.js) - Google Ads: 830484608 -->
      <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=AW-830484608"></script> -->
      <!-- <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'AW-830484608');
      </script> -->

      <!-- Event snippet for MP saffron Conv conversion page -->
      <!-- <script>
          gtag('event', 'conversion', {'send_to': 'AW-830484608/8PXyCNeWspEBEIDhgIwD'});
      </script> -->
      <!--Facebook Pixel Code -->
      <!-- <script>
          !function(f,b,e,v,n,t,s)
          {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
              n.callMethod.apply(n,arguments):n.queue.push(arguments)};
              if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
              n.queue=[];t=b.createElement(e);t.async=!0;
              t.src=v;s=b.getElementsByTagName(e)[0];
              s.parentNode.insertBefore(t,s)}(window, document,'script',
                  'https://connect.facebook.net/en_US/fbevents.js');
              fbq('init', '499314930536922');
              fbq('track', 'PageView');
          </script> -->
          <!-- <noscript><img height="1" width="1" style="display:none"
              src="https://www.facebook.com/tr?id=499314930536922&ev=PageView&noscript=1"
              /></noscript> -->
              <!--End Facebook Pixel Code -->
          </head>
          <body>

           <header class="header header--overlay header--dark">
            <div class="container">
                <div class="header__row">
                    <a href="https://www.megapolis.co.in" class="header__logo" title="Megapolis Township | Property in Pune">
                        <img src="https://www.megapolis.co.in/wp-content/uploads/2017/10/megapolis-new-logo.png" alt="Megapolis Township | Property in Pune">
                    </a>
                    <div class="header__settings">
                    </div>
                    <div class="header__contacts  header__contacts--social ">
                        <a href="tel:+91 9595 110011" class="header__phone">
                            <span class="header__span">Call Us : +91 9595330033
                            </span>
                        </a>
                    </div>

                </div>
            </div>
        </header>
        <nav id="header-nav " class=" navbar navbar--header navbar--overlay navbar--left">
            <div class="container">
                <div class="navbar__row js-navbar-row">
                    <a href="https://www.megapolis.co.in/" class="navbar__brand" title="Kumar Properties | Top Builders In Pune | Real Estate in Pune">
                        <img src="https://www.megapolis.co.in/wp-content/uploads/2017/10/megapolis-new-logo.png" class="navbar__brand-logo navbar__brand-logo--default" alt="Mgapolis Itegrated Township">
                        <img src="https://www.megapolis.co.in/wp-content/uploads/2017/10/megapolis-new-logo.png" class="navbar__brand-logo navbar__brand-logo--hero" alt="Mgapolis Itegrated Township">
                    </a>
                </div>
            </div>
        </nav>
        <div class="clearfix"></div>
        <div class="middle col-md-12 ">
         <div class="container">
          <div class="row">
           <div class="col-md-12 offer">
            <center> <div class="jumbotron" style="#000000;">
                <h2 class="text-center">Thank You!</h2><h3 class=fs-subtitle></h3><h3 class=fs-subtitle>Thank you for sharing your contact details.<span style="color:#000;">Our representative will get back to you shortly!</span><br> OR You can get in touch with us over email <a href=mailto:sales@megapolis.co.in>sales@megapolis.co.in</a> or contact us at +919595330033.</h3>

            </div></center>



            <div class="search-terms" style="display:none;">1 2 3 bhk flats  hinjewadi, 1 bhk flats hinjewadi, 2 bhk flats hinjewadi, 3 bhk flats hinjewadi, flats in hinjewadi, property in hinjewadi, Flats, Apartments for Sale in Hinjewadi, ready to move flats in hinjewadi, Flats in Hinjewadi Rajiv Gandhi Infotech Park, flats in hinjewadi phase 3, Township Projects in Hinjewadi Pune, ready possession flats hinjewadi, RERA Projects in Hinjewadi Pune, RERA Compliant Projects in hinjewadi, New Projects in Hinjewadi Pune, Upcoming Residential Projects in Hinjewadi, Hinjewadi Projects, New Prelaunch and Upcoming Residential hinjewadi, Premium 2 BHK and 3 BHK Flats in Hinjewadi Pune </div>
            <div class="widget__header project">
                <h2 class="widget__title">PROJECTS AT GLANCE</h2>
            </div>
            <div class="clearfix"></div>



            <div class="col-md-3 col-sm-6">
              <div class="india-xen-vpsTable">
                <h3 class="title">MYSTIC</h3>
                <span class="rera">RERA No.: <br> P52100001391</span> 
                <div class="project-image"><a href="https://www.megapolis.co.in/2-2.5-3-bhk-flats-hinjewadi/" class="india-xen-vpsTable-signup"> <img src="http://megapolis.co.in/1-2-3-bhk-flats-sale-hinjewadi/img/mystic1.jpg" alt="1 bhk flats pune"></a></div>
                <div class="price-value"> <span class="amount"> <span class="currency">Premium Homes</span><br>2 , 2.5 & 3 BHK <br> </span> </div>

                <a href="https://www.megapolis.co.in/2-2.5-3-bhk-flats-hinjewadi/" class="india-xen-vpsTable-signup">Read More</a> </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="india-xen-vpsTable">
                <h3 class="title">Saffron</h3>
                <span class="rera">RERA No.: <br> P52100018779</span> 
                <a href="https://www.megapolis.co.in/2-bhk-flats-in-hinjewadi-for-sale/"><img class="new-logo" src="http://megapolis.co.in/1-2-3-bhk-flats-sale-hinjewadi/img/new-launch-mega.png"></a>
                <div class="project-image"> <a href="https://www.megapolis.co.in/2-bhk-flats-in-hinjewadi-for-sale/" class="india-xen-vpsTable-signup"> <img src="http://megapolis.co.in/1-2-3-bhk-flats-sale-hinjewadi/img/best-real-estate-festive-offers2.jpg" alt="2-bhk-flats-hinjewadi"></a></div>
                <div class="price-value"> <span class="amount"> <span class="currency">Smart Home VI</span><br> 2 BHK</span> </div>

                <a href="https://www.megapolis.co.in/2-bhk-flats-in-hinjewadi-for-sale/" class="india-xen-vpsTable-signup">Read More</a> </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="india-xen-vpsTable">
                <h3 class="title">Springs</h3>
                <span class="rera">RERA No.: <br>P52100015188, P52100016848, P52100017386</span> 
                <!-- <a href="https://www.megapolis.co.in/springs/"><img class"new-logo" src="http://kumarworld.com/2-3-bhk-flats-pune/img/new-icon-PRE-BOOK1.gif" style="height: 16%;width: 21%; float: left; position: absolute; top: 65px; left: 25px; z-index: 3;"/></a>-->
                <div class="project-image"><a href="https://www.megapolis.co.in/springs/" class="india-xen-vpsTable-signup"> <img src="http://megapolis.co.in/1-2-3-bhk-flats-sale-hinjewadi/img/springs_elevation.jpg" alt="3-bhk-flats-hinjewadi"></a></div>
                <div class="price-value"> <span class="amount"> <span class="currency">Smart Home V</span><br>1 & 2 BHK </span> </div>

                <a href="https://www.megapolis.co.in/springs/" class="india-xen-vpsTable-signup">Read More</a> </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="india-xen-vpsTable">
                <h3 class="title">Symphony</h3>
                <span class="rera">RERA No.: <br> P52100000887</span> 
                <div class="project-image"> <a href="https://www.megapolis.co.in/2-bhk-flats-hinjewadi-for-sale/" class="india-xen-vpsTable-signup"> <img src="http://megapolis.co.in/1-2-3-bhk-flats-sale-hinjewadi/img/Symphony.jpg" alt="2-bhk-flats-hinjewadi"></a></div>
                <div class="price-value"> <span class="amount"> <span class="currency">Smart Home IV</span><br> 2 BHK</span> </div>

                <a href="https://www.megapolis.co.in/2-bhk-flats-hinjewadi-for-sale/" class="india-xen-vpsTable-signup">Read More</a> </div>
            </div>


            <div class="col-md-3 col-sm-6">
              <div class="india-xen-vpsTable kumar">
                <h3 class="title">Projects in Pune</h3>
                <div class="rera">RERA <br> Registered</div> 
                <div class="project-image"><a href="http://www.kumarworld.com/2-3-bhk-flats-pune/" class="india-xen-vpsTable-signup"> <img src="http://www.megapolis.co.in/1-2-3-bhk-flats-sale-hinjewadi/img/2-3-bhk-flats-phursungi.jpg" alt="one bhk flats hinjewadi pune"></a></div>
                <div class="price-value kumarname"> <span class="amount "> <span class="currency">Kumar Properties</span><br>1, 2 & 3 BHK</span> </div>

                <a href="http://www.kumarworld.com/2-3-bhk-flats-pune/" class="india-xen-vpsTable-signup kumarbtn">Read More</a> </div>
            </div>
            <div class="clearfix"></div>

            <div class="col-md-12 price-range"> <p>Smart Homes Starting from - 36 Lacs All Incl. & Premium Homes Starting from  - 74 Lacs All Incl.</p>   
            </div>


            <div class="clearfix"></div>
            <div class="know-more"><a href="https://www.megapolis.co.in/">Know More</a></div>

            <div class="search-tag"><ul><li>best upcoming projects in pune</li>
                <li>new residential construction in pune</li><li>new projects in phursungi pune</li><li>2 3 bhk flats in pune</li><li>buy new flat in pune phursungi</li><li>housing projects in phursungi pune</li><li>Apartments in pune</li></ul></div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div></div>
    <div class="pfooter col-lg-12">
        <div class="container"> <div class="col-md-6 "> <div class="menu-footer-menu-bar-container"><ul id="menu-footer-menu-bar" class="menu">
            <li id="menu-item-2087" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2087"><a href="https://www.megapolis.co.in/sitemap/">Sitemap</a></li>
            <li id="menu-item-2089" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2089"><a href="https://www.megapolis.co.in/privacypolicy/">Privacy Policy</a></li>

        </ul></div></div><div class="clearfix"></div>
        <div class="col-md-6 "><div class=power>Powered by <a href="https://www.megapolis.co.in">Megapolis</a></div></div><div class="clearfix"></div>
        <div class="col-md-12 maharera">   
           <p><img src='https://www.kumarworld.com/wp-content/uploads/2018/04/rera-logo1.png' width='6%' alt="flats in hinjewadi" >The projects have been registered via MahaRERA registration numbers and available on the website <a class="" href="https://maharera.mahaonline.gov.in">maharera.mahaonline.gov.in </a> under registered projects.</p> </div>
       </div>
   </div>

   <style>
       .new-logo {
         /* height: 27%; */
         width: 44%;
         float: left;
         position: absolute;
         top: 29px;
         left: 3px;
         z-index: 3;
     }
     .col-md-12.col-sm-6.price-range p {
         text-align: center;
         font-weight: bold;
         color: black;
     }
     /*----- Toggle Button -----*/

     .toggle-nav {
        display:none;
    }
    .india-xen-vpsTable.kumar {
     border: 2px solid #ED7D2F;
 }
 .price-value.kumarname {
     background: #ed8d2f;
 }
 .india-xen-vpsTable.kumar .rera{color: #ed8d2f;}
 .rera {
  min-height: 46px;
}.india-xen-vpsTable .india-xen-vpsTable-signup.kumarbtn {
 background: #ED7D2F !important;
 border:2px solid #ED7D2F !important;
}
.project-image .india-xen-vpsTable-signup {
 background: no-repeat;
 border: none;
 padding: 0;
}
.know-more{
    width: 20%;
    text-align: center;
    margin-bottom: 12px;
}
.col-md-12.col-sm-6.offer {
    margin-top: 19px;
}
/*----- Menu -----*/
@media screen and (max-width: 768px) { .menu {
    width:auto;
    padding:10px 18px;
    box-shadow:0px 1px 1px rgba(0,0,0,0.15);
    border-radius:3px;
    background:#ED7D2F ;
}}

@media screen and (min-width: 860px) {

}
.menu ul {
    display:inline-block;
}
.menu li {
    margin:0px 50px 0px 0px;
    float:left;
    list-style:none;
    font-size:17px;
}
.menu li:last-child {
    margin-right:0px;
}
.menu a {
    text-shadow:0px 1px 0px rgba(0,0,0,0.5);
    color:#777;
    transition:color linear 0.15s;
}
.menu a:hover, .menu .current-item a {
    text-decoration:none;
    color:#66a992;
}

/*----- Responsive -----*/

@media screen and (max-width: 1150px) {
    .wrap {
        width:90%;
    }
}
@media screen and (max-width: 970px) {
    .search-form input {
        width:120px;
    }
}
@media screen and (max-width: 860px) {
    .widget__header.project .widget__title {
     font-size: 18px;
     font-weight: 600;
     line-height: 20px;
 }
 .navbar--overlay .navbar__nav > li > a {
     color: #fff !important;
     font-size: 14px !important;
 }
 .menu {
     position: relative;
     display: inline-block;
     width: auto;
 }
 .menu ul.active {
    display:none;
}
.menu ul {
    width:auto;
    position:absolute;
    top:120%;
    left:0px;
    padding:10px 18px;
    box-shadow:0px 1px 1px rgba(0,0,0,0.15);
    border-radius:3px;
    background:#ED7D2F ;
}
.menu ul:after {
    width:0px;
    height:0px;
    position:absolute;
    top:0%;
    left:22px;
    content:'';
    transform:translate(0%, -100%);
    border-left:7px solid transparent;
    border-right:7px solid transparent;
    border-bottom:7px solid #303030;
}
.menu li {
    margin:5px 0px 5px 0px;
    float:none;
    display:block;
}
.menu a {
    display:block;
}

}






</body>
</html>
