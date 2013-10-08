<h2><?php echo __("Seller details") ?></h2>
<strong><?php echo $seller["Seller"]["first_name"] . " " . $seller["Seller"]["last_name"] ?></strong><br/>
<?php echo $seller["Seller"]["street"] ?><br/>
<?php echo $seller["Seller"]["zip_code"] . " " . $seller["Seller"]["city"] ?></br>
<?php echo $seller["Seller"]["phone"] ?><br/>
<a href="mailto:<?php echo $seller["Seller"]["email"] ?>"><?php echo $seller["Seller"]["email"] ?></a>
