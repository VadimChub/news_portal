<?php

namespace components;

use db\db_advert;

$advertObj = new db_advert();
$arrayOfAdvert = $advertObj->getAdverts();
?>
<?php for($i=4; $i<8;$i++): ?>
    <br>
    <div class="row">
        <div class="col-sm-12">
            <div class="card advert">
                <div class="card-body">
                    <p class="nameOfAdvert"><b><?=$arrayOfAdvert[$i]['title']?></b></p>
                    <p class="priceAdvert"><i>Price:</i> <span class="priceNumber"><?=$arrayOfAdvert[$i]['price']?></span>$</p>
                    <p class="orderAdvert text-muted"><?=$arrayOfAdvert[$i]['owner']?></p>
                </div>
                <div class="card discount" id="discount"><h3 class="discount-title">Discount card</h3><p><?=$advertObj->generatePassword();?></p><p>Take it and get discount</p><p class="discount-procent">10%</p></div>
            </div>
        </div>
    </div>
<?php endfor; ?>