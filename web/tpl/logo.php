<?php
if (isset($params['logoNum']) && ($params['logoNum'] == 2)) { 
    $data = "../icon-svg/Logo%20Dron%20Taxi.svg";
    $padding = "padding: 16px 16px 0px 11px;";
    $style = "margin-right: 15px; height: 55px; width: 55px;";
} else {
    $data = "../icon-svg/Logo_Dron_Taxi.svg";
    $padding = "padding: 16px 16px 0px 16px;";
    $style = "margin-right: 20px; height: 45px; width: 45px;";
};
  ?>
<div style="display: flex; justify-content: flex-start; align-items: center; position: relative; height: 45px; <?=$padding?>">
    <object type="image/svg+xml" data="<?=$data?>" style="<?=$style?>">
    </object>
<div style="font-weight: 600; font-size: 18px; color: white;">DRON TAXI</div>
</div>