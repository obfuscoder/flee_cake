<h1>Seller details</h1>
<strong><?php echo $seller["Seller"]["firstname"] . " " . $seller["Seller"]["lastname"] ?></strong><br/>
<?php echo $seller["Seller"]["street"] ?><br/>
<?php echo $seller["Seller"]["zipcode"] . " " . $seller["Seller"]["city"] ?></br>
<?php echo $seller["Seller"]["phone"] ?><br/>
<a href="mailto:<?php echo $seller["Seller"]["email"] ?>"><?php echo $seller["Seller"]["email"] ?></a>
