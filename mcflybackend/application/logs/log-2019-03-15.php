<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-03-15 05:36:55 --> Severity: Notice --> Undefined index: userid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 603
ERROR - 2019-03-15 05:36:55 --> Severity: Notice --> Undefined index: lognumber /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 604
ERROR - 2019-03-15 05:42:49 --> Severity: Notice --> Undefined index: userid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 603
ERROR - 2019-03-15 05:42:49 --> Severity: Notice --> Undefined index: lognumber /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 604
ERROR - 2019-03-15 06:06:36 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 492
ERROR - 2019-03-15 06:06:36 --> Severity: Notice --> Trying to get property 'id' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 497
ERROR - 2019-03-15 06:08:45 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 492
ERROR - 2019-03-15 06:08:45 --> Severity: Notice --> Trying to get property 'id' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 498
ERROR - 2019-03-15 06:10:00 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 492
ERROR - 2019-03-15 06:10:00 --> Severity: Notice --> Trying to get property 'id' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 497
ERROR - 2019-03-15 06:10:27 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 492
ERROR - 2019-03-15 06:12:18 --> Severity: Notice --> Undefined property: CI_DB_mysqli_result::$id /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 498
ERROR - 2019-03-15 06:18:34 --> Query error: Unknown column 'product' in 'where clause' - Invalid query: UPDATE `products` SET `total_moved` = 1
WHERE `product` = '188'
ERROR - 2019-03-15 06:31:25 --> Severity: Notice --> Undefined property: stdClass::$m_capacity /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 570
ERROR - 2019-03-15 06:33:52 --> Severity: Notice --> Undefined property: stdClass::$m_capacity /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 570
ERROR - 2019-03-15 06:48:19 --> Severity: Notice --> Undefined property: stdClass::$m_capacity /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 570
ERROR - 2019-03-15 07:34:29 --> Severity: Notice --> Undefined property: stdClass::$m_capacity /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 577
ERROR - 2019-03-15 07:34:29 --> Query error: Unknown column 'avail_quantity' in 'field list' - Invalid query: INSERT INTO `warehouse_products` (`warehouse`, `product`, `quantity`, `avail_quantity`, `min_capacity`, `max_capacity`) VALUES ('1', 195, '10', '10', '2', NULL)
ERROR - 2019-03-15 07:38:44 --> Query error: Unknown column 'avail_quantity' in 'field list' - Invalid query: INSERT INTO `warehouse_products` (`warehouse`, `product`, `quantity`, `avail_quantity`, `min_capacity`, `max_capacity`) VALUES ('1', 196, '10', '10', '2', '100')
ERROR - 2019-03-15 07:40:06 --> Query error: Unknown column 'avail_quantity' in 'field list' - Invalid query: INSERT INTO `warehouse_products` (`warehouse`, `product`, `quantity`, `avail_quantity`, `min_capacity`, `max_capacity`) VALUES ('1', 197, '10', '10', '2', '100')
ERROR - 2019-03-15 12:39:09 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND a.`status`='1'  ORDER BY a.`order_time`' at line 7 - Invalid query: SELECT a.*, 
b.id AS customerid, b.`first_name`AS customerfirstname, b.`last_name` AS customerlastname, b.`phone` AS customerphone,
c.`address_name` AS shipping_addressname, c.`address_location` AS shipping_addresslocation, c.`address_lat` AS shipping_addresslat, c.`address_lng` AS shipping_addresslng
FROM orders a 
INNER JOIN customers b ON a.customer_id=b.`id`
LEFT JOIN tb_shippingaddress c ON a.shipping_addressid=c.address_id
WHERE a.`warehouse_id` = AND a.`status`='1'  ORDER BY a.`order_time`
ERROR - 2019-03-15 19:44:15 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=boulevsrd &amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-15 19:44:19 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=boulevard &amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-15 19:44:19 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=boulevard vo&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-15 19:44:20 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=boulevard vosq&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-15 19:44:20 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=boulevard vosque&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-15 19:44:20 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=boulevard vosq&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-15 19:44:21 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=boulevard vo&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-15 19:44:21 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=boulevard &amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-15 19:44:25 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=boulevard &amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-15 19:44:27 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=boulevard &amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-15 19:44:28 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=boulevard &amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-15 19:44:29 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=boulevard &amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-15 19:44:32 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=boulevard bo&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-15 19:44:32 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=boulevard bosq&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-15 19:44:33 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=boulevard bosque&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-15 19:44:34 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=boulevard bosque d&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-15 19:44:34 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=boulevard bosque de &amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-15 19:44:35 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=boulevard bosque de la&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-15 19:44:35 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=boulevard bosque de la l&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-15 19:44:35 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=boulevard bosque de la luz&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-15 19:44:38 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=boulevard bosque de la luz 1&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-15 19:44:41 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=boulevard bosque de la luz 12v&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-15 19:44:42 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=boulevard bosque de la luz 12c&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-15 19:44:43 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=boulevard bosque de la luz 12b&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-15 19:45:08 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle &amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-15 19:45:10 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle 8 &amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-15 19:45:11 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle 8 or&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-15 19:45:11 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle 8 orie&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-15 19:45:11 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle 8 orient&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-15 19:45:13 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle 8 oriente &amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-15 19:45:15 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle 8 orient&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-15 19:45:16 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle 8 orie&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-15 19:45:17 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle 8 or&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-15 19:45:17 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle 8 &amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-15 19:45:18 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle &amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
