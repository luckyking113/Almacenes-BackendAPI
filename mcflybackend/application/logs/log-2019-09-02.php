<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-09-02 20:08:58 --> Severity: Notice --> Undefined index: userid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 665
ERROR - 2019-09-02 20:08:58 --> Severity: Notice --> Undefined index: usertype /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 666
ERROR - 2019-09-02 20:08:58 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ORDER BY a.`id` DESC' at line 7 - Invalid query: SELECT a.*, 
b.id AS customerid,b.`first_name` AS customer_firstname, b.`last_name` AS customer_lastname, b.`phone` AS customer_phone, b.`image` AS customerimage,
c.`address_name` AS shipping_addressname, c.`address_location` AS shipping_addresslocation, c.`address_lat` AS shipping_addresslat, c.`address_lng` AS shipping_addresslng
FROM orders a 
LEFT JOIN customers b ON a.customer_id=b.`id`
LEFT JOIN tb_shippingaddress c ON a.shipping_addressid=c.`address_id`
WHERE a.`user_id` = ORDER BY a.`id` DESC
