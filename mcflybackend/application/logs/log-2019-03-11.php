<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-03-11 00:31:13 --> 404 Page Not Found: Api/index
ERROR - 2019-03-11 01:57:09 --> Severity: Notice --> Undefined index: zipecode /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 47
ERROR - 2019-03-11 01:57:09 --> Severity: Notice --> Undefined index: customerid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 48
ERROR - 2019-03-11 02:23:25 --> Severity: Notice --> Undefined variable: customer_id /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 84
ERROR - 2019-03-11 02:23:25 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ORDER BY a.`id` DESC' at line 1 - Invalid query: SELECT a.*, b.`address_name` AS shippingaddress_name, b.`address_location` AS shipping_addresslocation, b.`address_zipcode` AS shipping_addresszipcode, b.`address_lat` AS shipping_addresslat, b.`address_lng` AS shipping_addresslng, b.`address_imageurl` AS shipping_addressimageurl FROM orders a LEFT JOIN tb_shippingaddress b ON a.shipping_addressid=b.`address_id` WHERE a.`customer_id` =  ORDER BY a.`id` DESC
ERROR - 2019-03-11 04:29:30 --> Severity: error --> Exception: Too few arguments to function Api::getallproducts(), 0 passed in /home/secuamuz/mcflydelivery.com/mcflybackend/system/core/CodeIgniter.php on line 514 and exactly 3 expected /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 77
