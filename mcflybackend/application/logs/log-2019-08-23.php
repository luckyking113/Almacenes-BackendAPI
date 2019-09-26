<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-08-23 10:16:56 --> Severity: error --> Exception: Too few arguments to function Api::getallproducts(), 1 passed in /home/secuamuz/mcflydelivery.com/mcflybackend/system/core/CodeIgniter.php on line 514 and exactly 3 expected /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 79
ERROR - 2019-08-23 10:18:19 --> Severity: error --> Exception: Too few arguments to function Api::getallproductimage(), 0 passed in /home/secuamuz/mcflydelivery.com/mcflybackend/system/core/CodeIgniter.php on line 514 and exactly 1 expected /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 100
ERROR - 2019-08-23 10:27:34 --> Severity: error --> Exception: Too few arguments to function Api::getallproducts(), 2 passed in /home/secuamuz/mcflydelivery.com/mcflybackend/system/core/CodeIgniter.php on line 514 and exactly 3 expected /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 79
ERROR - 2019-08-23 12:58:28 --> Severity: Notice --> Undefined index: userid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 665
ERROR - 2019-08-23 12:58:28 --> Severity: Notice --> Undefined index: usertype /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 666
ERROR - 2019-08-23 12:58:28 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ORDER BY a.`id` DESC' at line 7 - Invalid query: SELECT a.*, 
b.id AS customerid,b.`first_name` AS customer_firstname, b.`last_name` AS customer_lastname, b.`phone` AS customer_phone,
c.`address_name` AS shipping_addressname, c.`address_location` AS shipping_addresslocation, c.`address_lat` AS shipping_addresslat, c.`address_lng` AS shipping_addresslng
FROM orders a 
LEFT JOIN customers b ON a.customer_id=b.`id`
LEFT JOIN tb_shippingaddress c ON a.shipping_addressid=c.`address_id`
WHERE a.`user_id` = ORDER BY a.`id` DESC
ERROR - 2019-08-23 12:58:29 --> Severity: Notice --> Undefined index: userid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 665
ERROR - 2019-08-23 12:58:29 --> Severity: Notice --> Undefined index: usertype /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 666
ERROR - 2019-08-23 12:58:29 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ORDER BY a.`id` DESC' at line 7 - Invalid query: SELECT a.*, 
b.id AS customerid,b.`first_name` AS customer_firstname, b.`last_name` AS customer_lastname, b.`phone` AS customer_phone,
c.`address_name` AS shipping_addressname, c.`address_location` AS shipping_addresslocation, c.`address_lat` AS shipping_addresslat, c.`address_lng` AS shipping_addresslng
FROM orders a 
LEFT JOIN customers b ON a.customer_id=b.`id`
LEFT JOIN tb_shippingaddress c ON a.shipping_addressid=c.`address_id`
WHERE a.`user_id` = ORDER BY a.`id` DESC
ERROR - 2019-08-23 12:58:35 --> Severity: Notice --> Undefined index: userid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 665
ERROR - 2019-08-23 12:58:35 --> Severity: Notice --> Undefined index: usertype /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 666
ERROR - 2019-08-23 12:58:35 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ORDER BY a.`id` DESC' at line 7 - Invalid query: SELECT a.*, 
b.id AS customerid,b.`first_name` AS customer_firstname, b.`last_name` AS customer_lastname, b.`phone` AS customer_phone,
c.`address_name` AS shipping_addressname, c.`address_location` AS shipping_addresslocation, c.`address_lat` AS shipping_addresslat, c.`address_lng` AS shipping_addresslng
FROM orders a 
LEFT JOIN customers b ON a.customer_id=b.`id`
LEFT JOIN tb_shippingaddress c ON a.shipping_addressid=c.`address_id`
WHERE a.`user_id` = ORDER BY a.`id` DESC
ERROR - 2019-08-23 13:07:57 --> Severity: Notice --> Undefined index: userid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 665
ERROR - 2019-08-23 13:07:57 --> Severity: Notice --> Undefined index: usertype /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 666
ERROR - 2019-08-23 13:07:57 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ORDER BY a.`id` DESC' at line 7 - Invalid query: SELECT a.*, 
b.id AS customerid,b.`first_name` AS customer_firstname, b.`last_name` AS customer_lastname, b.`phone` AS customer_phone,
c.`address_name` AS shipping_addressname, c.`address_location` AS shipping_addresslocation, c.`address_lat` AS shipping_addresslat, c.`address_lng` AS shipping_addresslng
FROM orders a 
LEFT JOIN customers b ON a.customer_id=b.`id`
LEFT JOIN tb_shippingaddress c ON a.shipping_addressid=c.`address_id`
WHERE a.`user_id` = ORDER BY a.`id` DESC
ERROR - 2019-08-23 16:43:21 --> Severity: error --> Exception: Too few arguments to function Api::getalltimesheet(), 0 passed in /home/secuamuz/mcflydelivery.com/mcflybackend/system/core/CodeIgniter.php on line 514 and exactly 1 expected /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 616
ERROR - 2019-08-23 17:42:59 --> Severity: error --> Exception: Too few arguments to function Api::getalltimesheet(), 0 passed in /home/secuamuz/mcflydelivery.com/mcflybackend/system/core/CodeIgniter.php on line 514 and exactly 1 expected /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 616
ERROR - 2019-08-23 18:38:31 --> Severity: Notice --> Undefined index: userid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 628
ERROR - 2019-08-23 18:38:31 --> Severity: Notice --> Undefined index: fromtime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 629
ERROR - 2019-08-23 18:38:31 --> Severity: Notice --> Undefined index: totime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 630
ERROR - 2019-08-23 18:38:43 --> Severity: Notice --> Undefined index: userid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 628
ERROR - 2019-08-23 18:38:43 --> Severity: Notice --> Undefined index: fromtime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 629
ERROR - 2019-08-23 18:38:43 --> Severity: Notice --> Undefined index: totime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 630
ERROR - 2019-08-23 18:38:53 --> Severity: Notice --> Undefined index: userid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 628
ERROR - 2019-08-23 18:38:53 --> Severity: Notice --> Undefined index: fromtime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 629
ERROR - 2019-08-23 18:38:53 --> Severity: Notice --> Undefined index: totime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 630
ERROR - 2019-08-23 18:39:04 --> Severity: Notice --> Undefined index: userid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 628
ERROR - 2019-08-23 18:39:04 --> Severity: Notice --> Undefined index: fromtime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 629
ERROR - 2019-08-23 18:39:04 --> Severity: Notice --> Undefined index: totime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 630
ERROR - 2019-08-23 18:40:24 --> Severity: Notice --> Undefined index: userid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 628
ERROR - 2019-08-23 18:40:24 --> Severity: Notice --> Undefined index: fromtime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 629
ERROR - 2019-08-23 18:40:24 --> Severity: Notice --> Undefined index: totime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 630
ERROR - 2019-08-23 18:40:43 --> Severity: Notice --> Undefined index: userid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 628
ERROR - 2019-08-23 18:40:43 --> Severity: Notice --> Undefined index: fromtime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 629
ERROR - 2019-08-23 18:40:43 --> Severity: Notice --> Undefined index: totime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 630
ERROR - 2019-08-23 18:41:27 --> Severity: Notice --> Undefined index: userid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 628
ERROR - 2019-08-23 18:41:27 --> Severity: Notice --> Undefined index: fromtime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 629
ERROR - 2019-08-23 18:41:27 --> Severity: Notice --> Undefined index: totime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 630
ERROR - 2019-08-23 18:42:11 --> Severity: Notice --> Undefined index: userid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 628
ERROR - 2019-08-23 18:42:11 --> Severity: Notice --> Undefined index: fromtime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 629
ERROR - 2019-08-23 18:42:11 --> Severity: Notice --> Undefined index: totime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 630
ERROR - 2019-08-23 18:42:24 --> Severity: Notice --> Undefined index: userid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 628
ERROR - 2019-08-23 18:42:24 --> Severity: Notice --> Undefined index: fromtime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 629
ERROR - 2019-08-23 18:42:24 --> Severity: Notice --> Undefined index: totime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 630
ERROR - 2019-08-23 18:53:54 --> Severity: Notice --> Undefined index: userid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 628
ERROR - 2019-08-23 18:53:54 --> Severity: Notice --> Undefined index: fromtime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 629
ERROR - 2019-08-23 18:53:54 --> Severity: Notice --> Undefined index: totime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 630
ERROR - 2019-08-23 21:52:34 --> Severity: Notice --> Undefined index: userid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 628
ERROR - 2019-08-23 21:52:34 --> Severity: Notice --> Undefined index: fromtime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 629
ERROR - 2019-08-23 21:52:34 --> Severity: Notice --> Undefined index: totime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 630
ERROR - 2019-08-23 22:03:52 --> Severity: Notice --> Undefined index: userid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 628
ERROR - 2019-08-23 22:03:52 --> Severity: Notice --> Undefined index: fromtime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 629
ERROR - 2019-08-23 22:03:52 --> Severity: Notice --> Undefined index: totime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 630
ERROR - 2019-08-23 22:03:57 --> Severity: Notice --> Undefined index: email /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 499
ERROR - 2019-08-23 22:03:57 --> Severity: Notice --> Undefined index: password /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 500
ERROR - 2019-08-23 22:03:57 --> Severity: Notice --> Undefined index: token /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 501
ERROR - 2019-08-23 22:04:04 --> Severity: error --> Exception: Too few arguments to function Api::getalltimesheet(), 0 passed in /home/secuamuz/mcflydelivery.com/mcflybackend/system/core/CodeIgniter.php on line 514 and exactly 1 expected /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 616
ERROR - 2019-08-23 22:04:45 --> Severity: error --> Exception: Too few arguments to function Api::getalltimesheet(), 0 passed in /home/secuamuz/mcflydelivery.com/mcflybackend/system/core/CodeIgniter.php on line 514 and exactly 1 expected /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 616
ERROR - 2019-08-23 22:06:53 --> Severity: Notice --> Undefined index: userid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 628
ERROR - 2019-08-23 22:06:53 --> Severity: Notice --> Undefined index: fromtime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 629
ERROR - 2019-08-23 22:06:53 --> Severity: Notice --> Undefined index: totime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 630
ERROR - 2019-08-23 22:10:25 --> Severity: Notice --> Undefined index: userid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 628
ERROR - 2019-08-23 22:10:25 --> Severity: Notice --> Undefined index: fromtime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 629
ERROR - 2019-08-23 22:10:25 --> Severity: Notice --> Undefined index: totime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 630
ERROR - 2019-08-23 22:10:38 --> Severity: Notice --> Undefined index: userid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 628
ERROR - 2019-08-23 22:10:38 --> Severity: Notice --> Undefined index: fromtime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 629
ERROR - 2019-08-23 22:10:38 --> Severity: Notice --> Undefined index: totime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 630
ERROR - 2019-08-23 22:11:05 --> Severity: Notice --> Undefined index: userid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 628
ERROR - 2019-08-23 22:11:05 --> Severity: Notice --> Undefined index: fromtime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 629
ERROR - 2019-08-23 22:11:05 --> Severity: Notice --> Undefined index: totime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 630
ERROR - 2019-08-23 22:11:17 --> Severity: Notice --> Undefined index: userid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 628
ERROR - 2019-08-23 22:11:17 --> Severity: Notice --> Undefined index: fromtime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 629
ERROR - 2019-08-23 22:11:17 --> Severity: Notice --> Undefined index: totime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 630
ERROR - 2019-08-23 22:11:25 --> Severity: Notice --> Undefined index: userid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 628
ERROR - 2019-08-23 22:11:25 --> Severity: Notice --> Undefined index: fromtime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 629
ERROR - 2019-08-23 22:11:25 --> Severity: Notice --> Undefined index: totime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 630
ERROR - 2019-08-23 23:20:45 --> Severity: Notice --> Undefined index: userid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 628
ERROR - 2019-08-23 23:20:45 --> Severity: Notice --> Undefined index: fromtime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 629
ERROR - 2019-08-23 23:20:45 --> Severity: Notice --> Undefined index: totime /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 630
