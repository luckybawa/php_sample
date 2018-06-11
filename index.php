<?php
session_start();
include_once 'buslogic.php';
if(isset($_REQUEST["scod"]) && $_REQUEST["scod"]=="L")
{
   unset($_SESSION["ucod"]);
   unset($_SESSION["rol"]);
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Reddit</title>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<header class="main-header">
  <div class="container">
    <div class="col-md-6">
      <div class="logo-main"> <img src="images/logo.png" alt=""> </div>
    </div>
    <div class="col-md-6">
      <div class="top-banner"> <img src="images/header-banner.jpg" alt=""> </div>
    </div>
  </div>
  <!-- Navigations -->
<nav class="navbar navbar-default main-navigations">
  <div class="container"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
    </div>
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li ><a href="index.php">Home</a></li>
       <li><a href="frmpst.php">Submit Post</a></li>
        <li><a href="frmsubred.php">Create New SubReddit</a></li>
        <li><a href="frmsubredmon.php">SubReddit Of Month</a></li>
        <?php
        if(isset($_SESSION["ucod"]))
        {
     echo "<li><a href=frmmysubred.php >My SubReddits</a></li>"; 
     echo "<li><a href=index.php?scod=L >Logout</a></li>";
        }
        else
        {
     echo "<li><a href=frmreg.php >Sign Up</a></li>";
     echo "<li><a href=login.php >Sign In</a></li>"; 
        }
      ?>
        </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
</header>


<div class="highlight">
  <div class="container">
    <div class="col-md-12">
      <div class="mkd-bn-title">Categories<span class="mkd-bn-icon ion-ios-arrow-forward"></span></div>
      <ul class="mkd-bn-slide">
          <?php
          $obj=new clscat();
          $arr=$obj->dsp_rec();
          for($i=0;$i<count($arr);$i++)
          {
       echo "<li class=mkd-bn-text flex-active-slide >"; 
       echo "<a href=index.php?ccod=".$arr[$i][0]. ">".$arr[$i][1]."</a> </li>";      
          }
          ?>
        
      </ul>
    </div>
  </div>
</div>

<!-- Content Part -->
<div class="content-area">
  <div class="container">
   
   
    <div class="two-parts featured-area">
      <div class="col-md-8">
        <div class="mkd-layout-title-holder"> <span class="mkd-st-title">
        <?php
        if(isset($_REQUEST["ccod"]))
            $a=$_REQUEST["ccod"];
        else
            $a=1;
        $obj=new clscat();
        $obj->catcod=$a;
        $obj->fnd_rec();
        echo $obj->catnam;
        ?>
            </span></div>
        <div class="news-list">
        <?php
            $obj=new clssubred();
       $arr=$obj->dsp_rec($a);
          for($i=0;$i<count($arr);$i++)
          {?>
        <div class="mkd-pt-six-item mkd-post-item mkd-active-post-page">
          <div class="mkd-pt-six-image-holder">
                      <div class="mkd-post-info-category"><a href="" rel="category tag">
                <?php  echo $arr[$i][4]; ?>
                  </a></div>
            <a itemprop="url" class="mkd-pt-six-slide-link mkd-image-link" href="" target="_self"> 
                <img src="subredban/<?php echo $arr[$i][1]; ?>"/>    
            </a> </div>
          <div class="mkd-pt-six-content-holder">
            <div class="mkd-pt-six-title-holder">
              <h5 class="mkd-pt-six-title"> 
 <a itemprop="url" class="mkd-pt-link" href="frmdet.php?scod=<?php echo $arr[$i][0]; ?>" >
                     <?php echo $arr[$i][2];  ?></a> </h5>
            </div>
            <div itemprop="dateCreated" class="mkd-post-info-date entry-date updated">
                <a itemprop="url" href="">
                <?php echo $arr[$i][3]; ?>
                </a>
                &nbsp;&nbsp;&nbsp;&nbsp;
               <a itemprop="url" href="">
                Total Posts:<?php echo $arr[$i][5]; ?>
                </a>
                <?php
                $obj2=new clstrf();
                $arr2=$obj2->dsp_rec($arr[$i][0]);
                if(count($arr2)>0)
                {
     echo "<img src=images/trf.png height=80px width=80px />";
     for($t=0;$t<count($arr2);$t++)
     {
         echo "<b>".$arr2[$t][3]."</b><br>";
     }
                }
                ?>
            </div>
          </div>
        </div>      
              
              
              <?php
          }
                ?>
     
        </div>
      </div>
      
    </div>
  </div>
</div>
<footer class="main-footer">
<!--  <div class="container">
    <div class="col-md-3 col-sm-3">
      <div class="left-address"> <a href="#" target="_self"><img src="images/footer-logo.png" alt="a"></a>
        <div class="widget mkd-image-widget" style="padding: 25px 0 15px"> <img src="http://discussion.mikado-themes.com/wp-content/uploads/2016/03/footer-img.jpg" alt="a"> </div>
        <div id="text-8" class="widget mkd-footer-column-1 widget_text">
          <h5>Address</h5>
          <p>98 West 21th Street, Suite 721 New York,
            NY 10010 : E: youremail@yourdomain.com<br>
            P: +88 (0) 101 0000 000</p>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-3">
      <div class="footer-mid">
        <h3>Links</h3>
        <ul>
          <li ><a href="index.html">Home</a></li>
          <li  ><a href="news.html">Latest News</a></li>
          <li  ><a href="our-gallery.html">Our Gallery</a></li>
          <li ><a href="contact-us.html">Contact</a></li>
        </ul>
      </div>
    </div>
    <div class="col-md-3 col-sm-3">
      <div class="footer-mid1">
        <h3>Lorem Ipsum</h3>
        <div class="post-block">
          <div class="post-img"><img src="images/post-img.jpg" alt="" /></div>
          <div class="post-info">
            <h6>Lorem ipsum</h6>
            <div class="updated"> <i class="fa fa-calendar"></i>8. February 2016</div>
          </div>
        </div>
        <div class="post-block">
          <div class="post-img"><img src="images/post-img.jpg" alt="" /></div>
          <div class="post-info">
            <h6>Lorem ipsum</h6>
            <div class="updated"> <i class="fa fa-calendar"></i>8. February 2016</div>
          </div>
        </div>
        <div class="post-block">
          <div class="post-img"><img src="images/post-img.jpg" alt="" /></div>
          <div class="post-info">
            <h6>Lorem ipsum</h6>
            <div class="updated"> <i class="fa fa-calendar"></i>8. February 2016</div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-3">
      <div class="footer-contact">
        <h3>Contact us</h3>
        <form>
          <input type="text" placeholder="Email" />
          <input type="text" placeholder="Password" />
          <textarea></textarea>
          <input type="button" value="send" />
        </form>
      </div>
    </div>
  </div>-->
  <div class="copyright">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="copy-text">
            <p>Reedit &copy; Copyright 2017</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<script src="js/jquery-3.1.1.min.js" type="text/javascript"></script> 
<script src="js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>
