<?php
session_start();
$name = $tym = $message = $email = $phone = $pid = "";
$err = [];

$servername = "localhost";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=contact_form", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

if(isset($_POST['name']) && !empty($_POST['name'])){
  $name = $_POST['name'];
}else{
  $err['name'] = "Name is Required";
}

if (validate_phone_number($_POST['phone']) == true) {
   if(isset($_POST['phone']) && !empty($_POST['phone'])){
    $phone = $_POST['phone'];
  }else{
     $err['phone'] = "Mobile number is Required";
  }
} else {
    $err['phone'] = "Invalid Mobile number";
}

// var_dump(strlen($_POST['email']) > 30);die();
if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
  $err['email'] = "Invalid email format";
}else if(isset($_POST['email']) && !empty($_POST['email'])){
  $email = $_POST['email'];
}else{
  $err['email'] = "Email is Required";
}

if(!preg_match("/^[a-zA-Z0-9]+$/", $_POST['tym'])){
  $err['tym'] = "Only Alphabets & Numbers allowed";
}else if(isset($_POST['tym']) && !empty($_POST['tym'])){
  $tym = $_POST['tym'];
}else{
  $err['tym'] = "Call Time is Required";
}

if(isset($_POST['message']) && !empty($_POST['message'])){
  $message = $_POST['message'];
}else{
  $err['message'] = "Message is Required";
}

if(isset($_POST['pid']) && !empty($_POST['pid'])){
  $pid = $_POST['pid'];
}else{
  $err['pid'] = "Project Name is Required";
}

if(count($err) == 0){
  $projects = array(
  "527663432578816955"  =>"Mystic" ,
  "527664231125816273" => "Kumar Prospera",
  "527663903571816854" => "Kumar Princeville",
  "527663721401816891" => "Park Infinia",
  "527663721401816999" => "Kumar Picasso" ,
  "527663903571816481" => "Princetown Tower",
  "527663903571816278" => "Princetown Royal",
  "527663432578816202" => "Home",
  "540797986297839761" => "Prajwal",
  "537591453447839980" => "Kumar Palmspring",
  "529050893144816332" => "Kumar Siddhachal",
  "560338377402839217"  =>"Palmspring Tower",
  "527922591991816127" => "Primavera",
  "583492743235839735" => "Kumar 47 East",
  "570166517982839433" => "Kumar Pratham",
  "614170064407839897" => "Kumar Peninsula",
  "621664737826839425" =>"Kumar Priyadarshan",
  "527664231125816158" => "Kumar Primus",
  "527664231125816009" => "Kumar Parasmani",
  "542697205146839813" => "Serenity",
  "542697205146839434"   => "Saffron" 
                );

$query = "INSERT INTO enquiries SET name=:name, email=:email, mobile_no=:phone, call_time=:tym, message=:message, project_name=:pid, campaign=:campaign, source=:source";

  $stmt = $conn->prepare($query);
  $name = htmlspecialchars(strip_tags($name));
  $email = htmlspecialchars(strip_tags($email));
  $phone = htmlspecialchars(strip_tags($phone));
  $tym = htmlspecialchars(strip_tags($tym));
  $message = htmlspecialchars(strip_tags($message. " Calling Time:" . $tym));
  $pid = htmlspecialchars(strip_tags($pid));
  $campaign = "KP_Digital";
  $source = "KP_Digital";
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(":email", $email);
  $stmt->bindParam(":phone", $phone);
  $stmt->bindParam(":tym", $tym);
  $stmt->bindParam(":message", $message);

  
  // var_dump($projects[$project_name]);die();
  $stmt->bindParam(":pid", $projects[$pid]);
  $stmt->bindParam(":campaign", $campaign);
  $stmt->bindParam(":source", $source);
  if($stmt->execute()){
  //   return true;
                    
    $project = $projects[$pid];
    $wuid= '527748409256816694_ws_527660047398816469';
    $uid= '527660047398816469';
    $campaign= 'KP_Digital';
    $source= 'KP_Digital';

    $RQurl = 'http://api.realtyredefined.in/rqLeadAPI.php?wuid=' . $wuid . '&name=' . urlencode($name) . '&mobile=' . urlencode($phone) . '&email=' . urlencode($email) . '&Source=' . urlencode($source) . '&Message=' . urlencode($message) . '&Campaign=' . $campaign . '&pid=' . $pid . '&uid=' . $uid;
                          
      $RQch = curl_init();
      curl_setopt($RQch, CURLOPT_URL, $RQurl);
      curl_setopt($RQch, CURLOPT_HEADER, 0);
      curl_setopt($RQch, CURLOPT_RETURNTRANSFER);
      $RQresult = curl_exec($RQch);
      // var_dump($RQresult);die();
      curl_close($RQch);      

      //email

      $to = "megapolis.kp@gmail.com, mayuri.gaikwad@megapolis.co.in, richard.mudaliar85@gmail.com, megapolis.kp@gmail.com, shweta.bhambure@kumarworld.com";
  
        $subject = "Kumar Properties Enquiry -" .$project; 
        
        $body  = '<html><body>';
        $body .= '<table rules="all" style="border-color: #666;" cellpadding="10">';    
        $body .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" .$name. "</td></tr>";
          $body .= "<tr><td><strong>Email:</strong> </td><td>" . $email. "</td></tr>";
        $body .= "<tr><td><strong>Phone:</strong> </td><td>" .  $phone. "</td></tr>";
        $body .= "<tr><td><strong>Calling Time:</strong> </td><td>" .  $tym. "</td></tr>";
        $body .= "<tr><td><strong>Message:</strong> </td><td>" . $message. "</td></tr>";
          $body .= "<tr><td><strong>Project:</strong> </td><td>"  .$project. "</td></tr>";
            $body .= "<tr><td><strong>Source:</strong> </td><td>" .$project. "</td></tr>";
        $body .= "</table>";
          $body .= "</body></html>";
          
      $headers = "From: kumarworld Enquiry \r\n";
        //$headers .='X-Mailer: PHP/' . phpversion();
             //$headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
      
    $send = mail($to, $subject, $body, $headers);

      header('Location: /2-3-bhk-flats-pune/thank-you.php');
    }else{
        return false;
      }  
}else{
  $_SESSION['errors'] = $err;
  $_SESSION['postval'] = $_POST;
  header('Location: enquiry_form.php');
}

function validate_phone_number($phone)
{    
   if (strlen($phone) <= 10) {
      return true;
   } else {
     return false;
   }
}


// include_once 'include/index.php';
// require_once(__DIR__."/include/index.php");
// var_dump($_POST);die(); 

// We'll be outputting a PDF
// header('Content-type: application/pdf');

// It will be called downloaded.pdf
// header('Content-Disposition: attachment; filename="Brouchure.pdf"');

// The PDF source is in original.pdf
// readfile('Doc/KumarWorld - Sheet3.pdf');
 



?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Serenity</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="favicon.ico">

        <!--Google Font link-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link  href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" rel="stylesheet">


        <link rel="stylesheet" href="assets/css/slick/slick.css"> 
        <link rel="stylesheet" href="assets/css/slick/slick-theme.css">
        <link rel="stylesheet" href="assets/css/animate.css">
        <link rel="stylesheet" href="assets/css/iconfont.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/magnific-popup.css">
        <link rel="stylesheet" href="assets/css/bootsnav.css">
        <link rel="stylesheet" href="assets/css/feedback.css">
                <!-- <link rel="stylesheet" href="assets/css/all.css">
                <link rel="stylesheet" href="assets/css/fontawesome.css"> -->

        <!-- xsslider slider css -->


        <!--<link rel="stylesheet" href="assets/css/xsslider.css">-->




        <!--For Plugins external css-->
        <!--<link rel="stylesheet" href="assets/css/plugins.css" />-->

        <!--Theme custom css -->
        <link rel="stylesheet" href="assets/css/style.css">
        <!--<link rel="stylesheet" href="assets/css/colors/maron.css">-->

        <!--Theme Responsive css-->
        <link rel="stylesheet" href="assets/css/responsive.css" />

        <script src="assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-127488485-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-127488485-2');
</script>
<!-- Global site tag (gtag.js) - Google Ads: 830484608 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-830484608"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-830484608');
</script>


<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TT3Q5MB');</script>
<!-- End Google Tag Manager -->
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
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=499314930536922&ev=PageView&noscript=1"
/></noscript> -->
 <!--End Facebook Pixel Code -->
 <!-- Facebook Pixel Code new-->
<!-- <script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '2422876934496471');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=2422876934496471&ev=PageView&noscript=1"
/></noscript> -->
<!-- End Facebook Pixel Code -->
    </head>

    <body data-spy="scroll" data-target=".navbar-collapse">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TT3Q5MB"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div id="apDiv4"><div class="apDiv4-call"><a href="tel:+919595330033"><i class="fa fa-phone faa-tada animated"></i> +91 9595330033</a></div></div>
<div id="apDiv5"><div class="apDiv5-call"><a class="website floting" target="_blank" href="https://api.whatsapp.com/send?phone=918308039300"><i class="fa fa-whatsapp"></i>WHATSAPP</a></div></div>
        <!-- Preloader -->
        <div id="loading">
            <div id="loading-center">
                <div id="loading-center-absolute">
                    <div class="object" id="object_one"></div>
                    <div class="object" id="object_two"></div>
                    <div class="object" id="object_three"></div>
                    <div class="object" id="object_four"></div>
                </div>
            </div>
        </div><!--End off Preloader -->


        <div class="culmn">
            <!--Home page style-->


            <nav class="navbar navbar-default bootsnav navbar-fixed">
                <div class="navbar-top bg-grey fix">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="navbar-callus text-left sm-text-center">
                                    <ul class="list-inline">
                                        <li><a href=""><i class="fa fa-phone"></i> Call us: 9595330033</a></li>
                                        
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="navbar-socail text-right sm-text-center">
                                    <ul class="list-inline">
                                        <li><a href=""><i class="fa fa-envelope-o"></i> Contact us: info@megapolis.co.in</a></li
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Start Top Search -->
                <!-- <div class="top-search">
                    <div class="container">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            <input type="text" class="form-control" placeholder="Search">
                            <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                        </div>
                    </div>
                </div> -->
                <!-- End Top Search -->


                <div class="container"> 
                    <div class="enquire">
                        <ul>
                            <li class="search"> <a href="#action" class="btn btn-primary m-top-20" data-toggle="modal" data-target="#myModals">Enquire Now</a></li>
                        </ul>
                    </div> 

                    <!-- Start Header Navigation -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                            <i class="fa fa-bars"></i>
                        </button>
                        <a class="navbar-brand" href="#brand">
                            <img src="assets/images/megapolis-new-logo.png" class="logo" alt="">
                            <!--<img src="assets/images/footer-logo.png" class="logo logo-scrolled" alt="">-->
                        </a>

                    </div>
                    <!-- End Header Navigation -->

                    <!-- navbar menu -->
                    <div class="collapse navbar-collapse" id="navbar-menu">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="http://www.megapolisserenity.com/#home">Home</a></li>
                            <li><a href="http://www.megapolisserenity.com/#business">About</a></li>
                            <li><a href="http://www.megapolisserenity.com/#amenities">Amenities</a></li>
                            <li><a href="http://www.megapolisserenity.com/#features">Specification</a></li>
                            <li><a href="http://www.megapolisserenity.com/#product">Details</a></li>
                            <li><a href="http://www.megapolisserenity.com/#contact">Contact</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div> 

            </nav>

            <!--Home Sections-->

            <sect



            <!--Business Section-->
            <section id="business" class="business bg-grey roomy-70">
                <div class="container">
                    <div class="row">
                        <div class="main_business">
                            
                            
                            <div class="col-md-12">
                                <div class="business_item sm-m-top-50">
                                    <h2 class="text-uppercase">Thank You!</h2>
                                    <ul>
                                        <li><i class="fa fa-arrow-circle-right"></i>2 BHK flats in Hinjewadi</li>
                                        <!-- <li><i class="fa  fa-arrow-circle-right"></i> Fully Responsive</li>
                                        <li><i class="fa  fa-arrow-circle-right"></i> Google Fonts</li> -->
                                    </ul>
                                    <p class="m-top-20">Thank you for sharing your contact details.<br>
                                    Our representative will get back to you shortly! OR You can get in touch with us over email info@megapolis.co.in or contact us at +919595330033.</p>

                                    <div class="business_btn">
                                        
                                        <a href="https://www.megapolis.co.in/1-2-3-bhk-flats-sale-hinjewadi/" class="btn btn-primary m-top-20">Megapolis Projects</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!-- End off Business section -->


           




            <footer id="" class="footer action-lage bg-black">
                <!--<div class="action-lage"></div>-->
                <div class="container">
                    <div class="row">
                        <div class="widget_area">
                        
                           <div class="col-md-6">
                                <div class="widget_item widget_about">
                                    <h5 class="text-white">Contact Us</h5>
                                    
                                    <div class="widget_ab_item m-top-30">
                                        <div class="item_icon"><i class="fa fa-location-arrow"></i></div>
                                        <div class="widget_ab_item_text">
                                            <h6 class="text-white">Site Address</h6>
                                            <p>
                                                R-1 / 1 to R 1/4, Phase III,
                                                Rajiv Gandhi Infotech Park Hinjewadi, 
													Pune 411057, INDIA</p>
                                        </div>
                                    </div>
                                    <div class="widget_ab_item m-top-30">
                                        <div class="item_icon"><i class="fa fa-phone"></i></div>
                                        <div class="widget_ab_item_text">
                                            <h6 class="text-white">Phone :</h6>
                                            <p>+91 9595330033</p>
                                        </div>
                                    </div>
                                    <div class="widget_ab_item m-top-30">
                                        <div class="item_icon"><i class="fa fa-envelope-o"></i></div>
                                        <div class="widget_ab_item_text">
                                            <h6 class="text-white">Email Address :</h6>
                                            <p>info@megapolis.co.in</p>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End off col-md-3 -->

                            <div class="col-md-6">
                                <div class="widget_item widget_newsletter sm-m-top-50">
                                    <h5 class="text-white">Location Map</h5>
                                    
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3781.9346376461376!2d73.68500831442007!3d18.576985287376182!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc2bbc155555555%3A0xe2ed5dd2659dc64!2sMegapolis%20Sales%20Office%20Pune!5e0!3m2!1sen!2sin!4v1573631223424!5m2!1sen!2sin" width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen=""></iframe>

                                </div><!-- End off widget item -->
                            </div><!-- End off col-md-3 -->
                        </div>
                    </div>
                </div>
                <div class="main_footer fix bg-mega text-center p-top-40 p-bottom-30 ">
                    <div class="col-md-12">
                        <p class="wow fadeInRight" data-wow-duration="1s">
                            <i class="fas fa-copyright"></i>
                            <a target="_blank" href="https://www.megapolis.co.in">Megapolis Township</a> 
                            2019. All Rights Reserved
                        </p>
                    </div>
                </div>
            </footer>




        </div>

        <div id="myModals" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title pop_align">Get in touch </h4><br>
    <h6 style="text-align:center;">Fill up form we will send you by email</h6>
      </div>
    <div class="modal-body">
     <form action="/thank-you.php" method="post">
         <input type="hidden" id="pid" name="pid" value="542697205146839434">
                <div class="form-group">
                    <div class="input-group"> 
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input class="form-control" name="name" id="fnames" placeholder="Name" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group"> 
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="email" class="form-control" name="email" id="emails" placeholder="Email" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group"> 
                        <span class="input-group-addon"><i class="fa fa-phone-square" ></i></span>
                        <input type="text" class="form-control" name="mobile" id="mobiles" pattern="\d*" minlength="10" placeholder="Mobile" required>
                    </div>
                </div>

               <!-- <div class="form-group">
                    <div class="input-group"> 
                        <span class="input-group-addon"><i class="fa fa-clock-o" ></i></span>
                        <input type="text" class="form-control" name="tym" id="tym" placeholder="Preferred Time to Call" required>
                    </div>
                </div> -->

                
              <div class="pop_align">
                 <div class="form-group">
                    <input type="submit" name="save" class="btn btn-orange"  value="Submit">
                 </div>
            </div>
          <div class="success_message1 pop_align"></div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- END Popup -->
<style type="text/css">.business_item {
    margin: 64px auto;
    text-align: center;
}</style>

        <!-- JS includes -->

        <script src="assets/js/vendor/jquery-1.11.2.min.js"></script>
        <script src="assets/js/vendor/bootstrap.min.js"></script>

        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/jquery.magnific-popup.js"></script>
        <script src="assets/js/jquery.easing.1.3.js"></script>
        <script src="assets/css/slick/slick.js"></script>
        <script src="assets/css/slick/slick.min.js"></script>
        <script src="assets/js/jquery.collapse.js"></script>
        <script src="assets/js/bootsnav.js"></script>
        <script src="assets/js/feedback.js"></script>

        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/main.js"></script>

    </body>
</html>
<?php

if(!empty($_REQUEST))
{
      //  echo '<pre>'; print_r($_REQUEST); die('END');
        // $post = [
        //     'secret' => '6LcXy8QZAAAAAAWw4Ojepbj19aGVgxWJ8Lxgsyev',
        //     'response' => $_REQUEST['g-recaptcha-response'],
        // ];
        // $ch = curl_init();

        // curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // $server_output = curl_exec($ch);
        // $json = json_decode($server_output);
        // curl_close ($ch);
       
}

// $conn = mysqli_connect("localhost","root","","project-con-form") or die("Connection failed");
// $fname = $_POST['fname'];
// $email = $_POST['email'];
// $mobile = $_POST['mobile'];
// $message = $_POST['message'];

// $sql= "INSERT INTO conform(fname,email,mobile,message) VALUES('{$fname}','{$email}','{$mobile}','{$message}')";

// $result = mysql_query($conn,$sql) or die("Sql Query failed ");

// if (mysql_query($conn,$sql)) {
//     echo "Hello {$fname} your record is save";
// }else{
//     echo 0; 
// }

if(isset($_POST['save'])){

    if(isset($_REQUEST['name'])){
    $name=$_REQUEST['name'];
    };
    if(isset($_REQUEST['email'])){
    $email=$_REQUEST['email'];
    };
    if(isset($_REQUEST['mobile'])){
    $mobile=$_REQUEST['mobile'];
    }
    // if(isset($_REQUEST['tym'])){
    // $tym = $_REQUEST['tym'];
    // }
    //$campaign=$_REQUEST['campaign'];
    $project= '542697205146839813';  //$_REQUEST['pid'];

    // if(isset($_REQUEST['cost-sheet'])){
    // $cost=$_REQUEST['cost-sheet'];
    // };
    if(isset($_REQUEST['message']))
    {
    $message=$_REQUEST['message'];
    }




}

$proj= "Serenity";
//$project=$_REQUEST['project'];

if(isset($_REQUEST['__utmz'])){
    echo "<pre>";
    print_r($__utmz);
    echo "<pre>";
};

// if(isset($_GET['utm_source'])){
// echo htmlentities($_GET['utm_source']);
// echo "<pre>";
// print_r($utm_source);
// echo "<pre>";
//or
//$name = htmlentities($_GET['name']);
//echo $name
print_r($_GET);



//$projects = array(
//      "527663432578816955"  =>"Mystic" ,
//      "527663432578816438" => "Springs",
//      "527663432578816547" => "Symphony",
//      "527663432578816202" => "Home"
//                );
//                
              //$project = $projects[$projectId];
$source= 'MP_Digital';//$_REQUEST['Source'];
  
$wuid='527748409256816694_ws_527660047398816469';
$uid='527660047398816469';
$campaign='Megapolis_Digital';
// $honeypot=$_REQUEST['firstname'];
// if(empty($honeypot && $json->success==1)){
// $RQurl = 'http://api.realtyredefined.in/rqLeadApi_v2.php?wuid='.$wuid.'&name='.urlencode($name).'&mobile='.urlencode($mobile).'&email='.urlencode($email).'&Source='.urlencode($source).'&Message='.urlencode($message).'&Campaign='.urlencode($campaign).'&pid='.$project.'&token=977u3zb4vtlp2rfn';


//$RQurl = 'http://api.realtyredefined.in/rqLeadAPI.php?wuid=' . $wuid . '&name=' . urlencode($name) . '&mobile=' . urlencode($mobile) . '&email=' . urlencode($email) . '&Source=' . urlencode($source) . '&Message=' .urlencode($message)  . '&Campaign=' . $campaign . '&pid=' . $project . '&uid=' . $uid;
  
  // echo $RQurl; //die;
                
             /*   $RQch = curl_init();
                curl_setopt($RQch, CURLOPT_URL, $RQurl);
                curl_setopt($RQch, CURLOPT_HEADER, 0);
                curl_setopt($RQch, CURLOPT_RETURNTRANSFER);
                $RQresult = curl_exec($RQch);
                curl_close ($ch);
                //echo $RQresult;*/
                
    //               $RQch = curl_init();
    //   curl_setopt($RQch, CURLOPT_URL, $RQurl);
    // curl_setopt($RQch, CURLOPT_TIMEOUT, 1); 
    //     curl_setopt($RQch, CURLOPT_HEADER, 0);
    //     curl_setopt($RQch,  CURLOPT_RETURNTRANSFER, false);
    //     curl_setopt($RQch, CURLOPT_FORBID_REUSE, true);
    //     curl_setopt($RQch, CURLOPT_CONNECTTIMEOUT, 1);
    //     curl_setopt($RQch, CURLOPT_DNS_CACHE_TIMEOUT, 10); 
    //     curl_setopt($RQch, CURLOPT_FRESH_CONNECT, true);
    // $RQresult = curl_exec($RQch);
    //curl_close($ch);
  //  return $RQresult;


                if(isset($_POST['name']) && !empty($_POST['name'])){
                  $name = $_POST['name'];
                }else{
                  $err['name'] = "Name is Required";
                }

                if (validate_phone_number($_POST['mobile']) == true) {
                   if(isset($_POST['mobile']) && !empty($_POST['mobile'])){
                    $mobile = $_POST['mobile'];
                  }else{
                     $err['mobile'] = "Mobile number is Required";
                  }
                } else {
                    $err['mobile'] = "Invalid Mobile number";
                }

                // var_dump(strlen($_POST['email']) > 30);die();
                if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                  $err['email'] = "Invalid email format";
                }else if(isset($_POST['email']) && !empty($_POST['email'])){
                  $email = $_POST['email'];
                }else{
                  $err['email'] = "Email is Required";
                }

                if(!preg_match("/^[a-zA-Z0-9]+$/", $_POST['tym'])){
                  $err['tym'] = "Only Alphabets & Numbers allowed";
                }else if(isset($_POST['tym']) && !empty($_POST['tym'])){
                  $tym = $_POST['tym'];
                }else{
                  $err['tym'] = "Call Time is Required";
                }

                if(isset($_POST['message']) && !empty($_POST['message'])){
                  $message = $_POST['message'];
                }else{
                  $err['message'] = "Message is Required";
                }

                if(isset($_POST['pid']) && !empty($_POST['pid'])){
                  $pid = $_POST['pid'];
                }else{
                  $err['pid'] = "Project Name is Required";
                }

                if(count($err) == 0){
                  $projects = array(
                  "527663432578816955"  =>"Mystic" ,
                  "527664231125816273" => "Kumar Prospera",
                  "527663903571816854" => "Kumar Princeville",
                  "527663721401816891" => "Park Infinia",
                  "527663721401816999" => "Kumar Picasso" ,
                  "527663903571816481" => "Princetown Tower",
                  "527663903571816278" => "Princetown Royal",
                  "527663432578816202" => "Home",
                  "540797986297839761" => "Prajwal",
                  "537591453447839980" => "Kumar Palmspring",
                  "529050893144816332" => "Kumar Siddhachal",
                  "560338377402839217"  =>"Palmspring Tower",
                  "527922591991816127" => "Primavera",
                  "583492743235839735" => "Kumar 47 East",
                  "570166517982839433" => "Kumar Pratham",
                  "614170064407839897" => "Kumar Peninsula",
                  "621664737826839425" =>"Kumar Priyadarshan",
                  "527664231125816158" => "Kumar Primus",
                  "527664231125816009" => "Kumar Parasmani",
                  "542697205146839813" => "Serenity",
                  "542697205146839434"   => "Saffron" 
                                );



    
?>



<?php
//  alert('No errors: Form will be submitted');
if((isset($_POST['name']))&&(isset($_POST['mobile']))&&(isset($_POST['email'])))
{

      $to = "richard.mudaliar@megapolis.co.in, himanshu.chhatraband@kumarworld.com, hanmant.sankpal@kumarworld.com, hemraj.wagh@kumarworld.com" ;

        $servername = "localhost";
$username = "root";
$password = "";
// $dbname = "project-con-form";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// $servername = "localhost";
// $username = "root";
// $password = "FHrRHRpNrkLmoFoI";

try {
  $conn = new PDO("mysql:host=$servername;dbname=project-con-form", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

$query = "INSERT INTO enquiries SET name=:name, email=:email, mobile_no=:mobile, message=:message, project_name=:pid, campaign=:campaign, source=:source";

  $stmt = $conn->prepare($query);
  $name = htmlspecialchars(strip_tags($name));
  $email = htmlspecialchars(strip_tags($email));
  $phone = htmlspecialchars(strip_tags($phone));
  $tym = htmlspecialchars(strip_tags($tym));
  $message = htmlspecialchars(strip_tags($message. " Calling Time:" . $tym));
  $pid = htmlspecialchars(strip_tags($pid));
  $campaign = "KP_Digital";
  $source = "KP_Digital";
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(":email", $email);
  $stmt->bindParam(":phone", $mobile);
  // $stmt->bindParam(":tym", $tym);
  $stmt->bindParam(":message", $message);


// $sql = "INSERT INTO conform (`name`, `email`, `mobile`, `comment`, `project`,`source`)
// VALUES ('$name','$email','$mobile','$message','$proj','$campaign')";
// //echo $name;
// if ($conn->query($sql) === TRUE) {
//     //echo "New record created successfully";
// } else {
//     echo "Error: " . $sql . "<br>" . $conn->error;
// }

// $conn->close();


  $from = $_REQUEST['email']; 
    $name = $_REQUEST['name']; 
    //$phone = $_REQUEST['phone'];
   // $countricode=$_REQUEST['countryCode'];
//$phone=$_REQUEST['phone'];
$mobile=$_REQUEST['mobile'];
     $message = $_REQUEST['message'];
     $proj= "Serenity";
           $subject = " Megapolis Serenity Pre-Book Enquiry -".$proj; 
        
        $body  = '<html><body>';
        // $body .= '<table rules="all" style="border-color: #666;" cellpadding="10">';    
        // $body .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" .$name. "</td></tr>";
        //   $body .= "<tr><td><strong>Email:</strong> </td><td>" . $from. "</td></tr>";
        // $body .= "<tr><td><strong>Phone:</strong> </td><td>" .  $mobile. "</td></tr>";
        // $body .= "<tr><td><strong>Calling Time:</strong> </td><td>" .  $tym . "</td></tr>";
        // $body .= "<tr><td><strong>Message:</strong> </td><td>" . $message. "</td></tr>";
        //   $body .= "<tr><td><strong>Project:</strong> </td><td>".$proj."</td></tr>";
            //$body .= '<tr><td><strong>Source:</strong> </td><td> Smart Homes V - Springs</td></tr>';
        $body .= "</table>";
          $body .= "</body></html>";
          
           $headers = "From: Megapolis-Serenity@megapolis.co.in \r\n";
        //$headers .='X-Mailer: PHP/' . phpversion();
             //$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
      
    // $send = mail($to, $subject, $body, $headers);
   //echo json_encode(array('status' => 'success'));
   
} 
//else {
  //echo json_encode(array('status' => 'error'));
//}
      
// $from = $_REQUEST['email'];
// $email = 'EMAIL_ADDRESS';
// $list_id = '4dd7e2825d';
// $api_key = 'd1ce4d09562e5eb3b319dc58f7876511-us19';
 
// $data_center = substr($api_key,strpos($api_key,'-')+1);
 
// $url = 'https://'. $data_center .'.api.mailchimp.com/3.0/lists/'. $list_id .'/members';
 
// $json = json_encode([
//     'email_address' => $from,
    // 'merge_fields' => ['FNAME'=>$name,'PHONE'=> $mobile],
//     'status'        => 'subscribed', //pass 'subscribed' or 'pending'
// ]);
 
// $ch = curl_init($url);
// curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $api_key);
// curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_TIMEOUT, 10);
// curl_setopt($ch, CURLOPT_POST, 1);
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
// $result = curl_exec($ch);
// $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
// curl_close($ch);
//echo $status_code;


if(!empty($_POST["booknow"])){
  echo '<script>window.location.href = "https://www.megapolis.co.in/booknow/";</script>';
}
}
?>



