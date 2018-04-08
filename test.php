
<?php /*?><!DOCTYPE html>
<html lang="fr">

<head>
    <title>Original'creatioN</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
</head>


<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

</head>
<body class="body">






<div class="row">
    <div class="container">
        <div class="col-xl-12 col-lg-12  col-md-12 col-sm-12 col-xs-12" id="main">
            <ul class="nav nav-pills nav-justified">
                <li class="nav-item">
                    <a class="nav-link <?php if(isset($_POST['man']) || !isset($_POST['woman'])): ?>active<?php endif; ?>" id="button-man" data-toggle="tab" href="#man" role="tab">Homme</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if(isset($_POST['woman'])): ?>active<?php endif; ?>" id="button-woman" data-toggle="tab" href="#woman" role="tab">Femme</a>
                </li>
            </ul>
        </div>
    </div>
</div>







<div class="tab-content">
    <div class="tab-pane  <?php if(isset($_POST['man']) || !isset($_POST['woman'])): ?>active<?php endif; ?>" id="man" role="tabpanel">
        <div class="row d-flex align-items-center justify-content-center" id="popular-shirt-man">
            <div class="container">
                <div class="row" >
                    <?php while($itemTeeshirt = $queryShirtMan->fetch()): ?>
                        <div class="col-xl-3 col-lg-3  col-md-3 col-sm-6 col-xs-12 d-flex flex-wrap align-items-center justify-content-center">
                            <?php if(!empty($itemTeeshirt['image'])): ?>
                                <div class="d-flex align-items-center justify-content-around">
                                    <a href="item-page.php?item_id=<?php echo $itemTeeshirt['id']; ?>">
                                        <img class="rounded-circle rounded-circle-man hvr-bounce-in"  src="image/image-all/<?php echo $itemTeeshirt['image']; ?>" alt="<?php echo $itemTeeshirt['title']; ?>">
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="row d-flex justify-content-end align-items-center more-items">
                    <a href="latest-item-tee-shirt.php?man_shirt">Our latest tee-shirt ></a>
                </div>
            </div>
        </div>


        <div class="row d-flex align-items-center justify-content-center" id="popular-sweat-man">
            <div class="container">
                <div class="row">
                    <?php while($itemSweatshirt = $querySweatMan->fetch()): ?>
                        <div class="col-xl-3 col-lg-3  col-md-3 col-sm-6 col-xs-12 d-flex flex-wrap align-items-center justify-content-center">
                            <?php if(!empty($itemSweatshirt['image'])): ?>
                                <div class="d-flex align-items-center justify-content-around">
                                    <a href="item-page.php?item_id=<?php echo $itemSweatshirt['id']; ?>"><img class="rounded-circle rounded-circle-man hvr-bounce-in" src="image/image-all/<?php echo $itemSweatshirt['image']; ?>" alt="<?php echo $itemSweatshirt['title']; ?>"></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="row d-flex justify-content-end align-items-center more-items">
                    <a href="latest-item-sweat-shirt.php?man_sweat">Our latest sweat-shirt ></a>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane <?php if(isset($_POST['woman'])): ?>active<?php endif; ?>" id="woman" role="tabpanel">
        <div class="row d-flex align-items-center justify-content-center" id="popular-shirt-woman">
            <div class="container">
                <div class="row">
                    <?php while($itemTeeshirt = $queryShirtWoman->fetch()): ?>
                        <div class="col-xl-3 col-lg-3  col-md-3 col-sm-6 col-xs-12 flex-wrap d-flex align-items-center justify-content-center">
                            <?php if(!empty($itemTeeshirt['image'])): ?>
                                <div class="d-flex align-items-center justify-content-around">
                                    <a href="item-page.php?item_id=<?php echo $itemTeeshirt['id']; ?>"><img class="rounded-circle rounded-circle-woman hvr-bounce-in" src="image/image-all/<?php echo $itemTeeshirt['image']; ?>" alt="<?php echo $itemTeeshirt['title']; ?>"></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="row d-flex justify-content-end align-items-center more-items">
                    <a href="latest-item-tee-shirt.php?woman_shirt">Our latest tee-shirt ></a>
                </div>
            </div>
        </div>
        <div class="row d-flex align-items-center justify-content-center" id="popular-sweat-woman">
            <div class="container">
                <div class="row">
                    <?php while($itemSweatshirt = $querySweatWoman->fetch()): ?>
                        <div class="col-xl-3 col-lg-3  col-md-3 col-sm-6 col-xs-12 flex-wrap d-flex align-items-center justify-content-center">
                            <?php if(!empty($itemSweatshirt['image'])): ?>
                                <div class="d-flex align-items-center justify-content-around">
                                    <a href="item-page.php?item_id=<?php echo $itemSweatshirt['id']; ?>"><img class="rounded-circle rounded-circle-woman hvr-bounce-in" src="image/image-all/<?php echo $itemSweatshirt['image']; ?>" alt="<?php echo $itemSweatshirt['title']; ?>"></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="row d-flex justify-content-end align-items-center more-items">
                    <a href="latest-item-sweat-shirt.php?woman_sweat">Our latest sweat-shirt ></a>
                </div>
            </div>
        </div>
    </div>
</div>















<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
 <?php */?>
<?php

require_once 'tools/common.php';


//index.php
$connect = mysqli_connect("localhost", "root", "", "testing");
function make_query($connect)
{
    $query = "SELECT * FROM image ORDER BY image.id ASC";
    $result = mysqli_query($,$connect, $query);
    return $result;
}

function make_slide_indicators($connect)
{
    $output = '';
    $count = 0;
    $result = make_query($connect);
    while($row = mysqli_fetch_array($result))
    {
        if($count == 0)
        {
            $output .= '
   <li data-target="#dynamic_slide_show" data-slide-to="'.$count.'" class="active"></li>
   ';
        }
        else
        {
            $output .= '
   <li data-target="#dynamic_slide_show" data-slide-to="'.$count.'"></li>
   ';
        }
        $count = $count + 1;
    }
    return $output;
}

function make_slides($connect)
{
    $output = '';
    $count = 0;
    $result = make_query($connect);
    while($row = mysqli_fetch_array($result))
    {
        if($count == 0)
        {
            $output .= '<div class="item active">';
        }
        else
        {
            $output .= '<div class="item">';
        }
        $output .= '
   <img src="banner/'.$row["banner_image"].'" alt="'.$row["banner_title"].'" />
   <div class="carousel-caption">
    <h3>'.$row["banner_title"].'</h3>
   </div>
  </div>
  ';
        $count = $count + 1;
    }
    return $output;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>How to Make Dynamic Bootstrap Carousel with PHP</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<br />
<div class="container">
    <h2 align="center">How to Make Dynamic Bootstrap Carousel with PHP</h2>
    <br />
    <div id="dynamic_slide_show" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php echo make_slide_indicators($connect); ?>
        </ol>

        <div class="carousel-inner">
            <?php echo make_slides($connect); ?>
        </div>
        <a class="left carousel-control" href="#dynamic_slide_show" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>

        <a class="right carousel-control" href="#dynamic_slide_show" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>

    </div>
</div>





























