<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-03-18 00:41:30 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND a.`status`='1'  ORDER BY a.`order_time`' at line 7 - Invalid query: SELECT a.*, 
b.id AS customerid, b.`first_name`AS customerfirstname, b.`last_name` AS customerlastname, b.`phone` AS customerphone,
c.`address_name` AS shipping_addressname, c.`address_location` AS shipping_addresslocation, c.`address_lat` AS shipping_addresslat, c.`address_lng` AS shipping_addresslng
FROM orders a 
INNER JOIN customers b ON a.customer_id=b.`id`
LEFT JOIN tb_shippingaddress c ON a.shipping_addressid=c.address_id
WHERE a.`warehouse_id` = AND a.`status`='1'  ORDER BY a.`order_time`
ERROR - 2019-03-18 00:43:36 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ORDER BY a.`id` DESC' at line 7 - Invalid query: SELECT a.*, 
b.id AS customerid,b.`first_name` AS customer_firstname, b.`last_name` AS customer_lastname, b.`phone` AS customer_phone,
c.`address_name` AS shipping_addressname, c.`address_location` AS shipping_addresslocation, c.`address_lat` AS shipping_addresslat, c.`address_lng` AS shipping_addresslng
FROM orders a 
LEFT JOIN customers b ON a.customer_id=b.`id`
LEFT JOIN tb_shippingaddress c ON a.shipping_addressid=c.`address_id`
WHERE a.`user_id` = ORDER BY a.`id` DESC
ERROR - 2019-03-18 00:43:42 --> Severity: error --> Exception: Too few arguments to function Api::getalltimesheet(), 0 passed in /home/secuamuz/mcflydelivery.com/mcflybackend/system/core/CodeIgniter.php on line 514 and exactly 1 expected /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 576
ERROR - 2019-03-18 00:44:04 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ORDER BY a.`id` DESC' at line 7 - Invalid query: SELECT a.*, 
b.id AS customerid,b.`first_name` AS customer_firstname, b.`last_name` AS customer_lastname, b.`phone` AS customer_phone,
c.`address_name` AS shipping_addressname, c.`address_location` AS shipping_addresslocation, c.`address_lat` AS shipping_addresslat, c.`address_lng` AS shipping_addresslng
FROM orders a 
LEFT JOIN customers b ON a.customer_id=b.`id`
LEFT JOIN tb_shippingaddress c ON a.shipping_addressid=c.`address_id`
WHERE a.`user_id` = ORDER BY a.`id` DESC
ERROR - 2019-03-18 01:53:51 --> Severity: Notice --> Undefined index: token /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 484
ERROR - 2019-03-18 15:49:23 --> 404 Page Not Found: Api/getallcat
ERROR - 2019-03-18 15:49:30 --> 404 Page Not Found: Api/getallcats
ERROR - 2019-03-18 15:52:09 --> 404 Page Not Found: Api/getallcats
ERROR - 2019-03-18 15:52:13 --> 404 Page Not Found: Api/getallcat
ERROR - 2019-03-18 15:52:22 --> 404 Page Not Found: Api/cat
ERROR - 2019-03-18 13:52:58 --> Severity: error --> Exception: Too few arguments to function Api::getallproducts(), 2 passed in /home/secuamuz/mcflydelivery.com/mcflybackend/system/core/CodeIgniter.php on line 514 and exactly 3 expected /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 77
ERROR - 2019-03-18 13:53:01 --> Severity: error --> Exception: Too few arguments to function Api::getallproducts(), 1 passed in /home/secuamuz/mcflydelivery.com/mcflybackend/system/core/CodeIgniter.php on line 514 and exactly 3 expected /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 77
ERROR - 2019-03-18 13:53:05 --> Severity: error --> Exception: Too few arguments to function Api::getallproducts(), 0 passed in /home/secuamuz/mcflydelivery.com/mcflybackend/system/core/CodeIgniter.php on line 514 and exactly 3 expected /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 77
ERROR - 2019-03-18 14:12:57 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=1631 c&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 360
ERROR - 2019-03-18 14:12:59 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=1631 cal&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 360
ERROR - 2019-03-18 14:12:59 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=1631 calif&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 360
ERROR - 2019-03-18 14:13:00 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=1631 califor&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 360
ERROR - 2019-03-18 14:13:00 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=1631 californi&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 360
ERROR - 2019-03-18 14:13:00 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=1631 california st&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 360
ERROR - 2019-03-18 14:13:01 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=1631 california stre&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 360
ERROR - 2019-03-18 14:13:01 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=1631 california street&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 360
ERROR - 2019-03-18 14:13:01 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=1631 california &amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 360
ERROR - 2019-03-18 14:13:08 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=1631 e california street&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 360
ERROR - 2019-03-18 14:13:11 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=1631 e&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 360
