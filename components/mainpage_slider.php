<?php use db\db_news;
$obj = new db_news();
$arrayForSlider = $obj->getNewsForMainSlider(); ?>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php for ($i=0; $i < 1; $i++) :?>
            <li data-target="#carouselExampleIndicators" data-slide-to="<?=$i;?>" class="active"></li>
        <?php endfor; ?>
        <?php for ($i=1; $i < 3; $i++) :?>
            <li data-target="#carouselExampleIndicators" data-slide-to="<?=$i;?>"></li>
        <?php endfor;?>
    </ol>
    <div class="carousel-inner">
        <?php for ($i=0; $i < 1; $i++) :?>
            <div class="carousel-item active">
                <a href="news.php?id=<?=$arrayForSlider[$i]['id']?>"><img class="d-block w-100" src="<?=substr($arrayForSlider[$i][0],3)?>" alt="First slide"></a>
                <div class="carousel-caption d-none d-md-block">
                    <h3><?=$arrayForSlider[$i]['title']?></h3>
                </div>
            </div>
        <?php endfor; ?>
        <?php for ($i=1; $i < 3; $i++) :?>
            <div class="carousel-item">
                <a href="news.php?id=<?=$arrayForSlider[$i]['id']?>"><img class="d-block w-100" src="<?=substr($arrayForSlider[$i][0],3)?>" alt="Second slide"></a>
                <div class="carousel-caption d-none d-md-block">
                    <h3><?=$arrayForSlider[$i]['title']?></h3>
                </div>
            </div>
        <?php endfor; ?>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<br>