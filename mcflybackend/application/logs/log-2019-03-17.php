<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-03-17 08:49:22 --> Severity: Notice --> Undefined index: token /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 478
ERROR - 2019-03-17 08:49:44 --> Severity: Notice --> Undefined index: token /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 478
ERROR - 2019-03-17 08:49:53 --> Severity: Notice --> Undefined index: token /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 478
ERROR - 2019-03-17 08:50:25 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND a.`status`='1'  ORDER BY a.`order_time`' at line 7 - Invalid query: SELECT a.*, 
b.id AS customerid, b.`first_name`AS customerfirstname, b.`last_name` AS customerlastname, b.`phone` AS customerphone,
c.`address_name` AS shipping_addressname, c.`address_location` AS shipping_addresslocation, c.`address_lat` AS shipping_addresslat, c.`address_lng` AS shipping_addresslng
FROM orders a 
INNER JOIN customers b ON a.customer_id=b.`id`
LEFT JOIN tb_shippingaddress c ON a.shipping_addressid=c.address_id
WHERE a.`warehouse_id` = AND a.`status`='1'  ORDER BY a.`order_time`
ERROR - 2019-03-17 10:55:22 --> Severity: Notice --> Undefined index: token /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 478
ERROR - 2019-03-17 16:00:42 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle &amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:00:43 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle 8 &amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:00:44 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle 8 or&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:00:45 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle 8 orie&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:00:46 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle 8 orient&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:00:47 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle 8 oriente &amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:00:49 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle 8 orient&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:00:49 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle 8 orie&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:00:50 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle 8 &amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:00:50 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle 8 or&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:00:50 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle &amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:00:54 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle &amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:00:54 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle 8 &amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:00:57 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle 8 or&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:00:58 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle 8 orie&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:00:58 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle 8 orient&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:00:58 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle 8 orient&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:00:59 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle 8 orie&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:00:59 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle &amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:00:59 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle 8 or&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:01:00 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=san &amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:01:00 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=san an&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:01:00 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle 8 &amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:01:01 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=san andr&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:01:01 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=san andres&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:01:02 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=san andres c&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:01:02 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=san andres cho&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:01:02 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=san andres cholu&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:01:03 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=san andres cholula&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:01:05 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=san andres cholu&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:01:05 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=san andres cho&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:01:05 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=san andres&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:01:05 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=san andres c&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:01:06 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=san andr&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:01:08 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=san an&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 16:01:08 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=san &amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 21:00:35 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle &amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 354
ERROR - 2019-03-17 21:08:45 --> Severity: Warning --> file_get_contents( https://maps.googleapis.com/maps/api/place/findplacefromtext/json?input=calle&amp;inputtype=textquery&amp;fields=photos,formatted_address,name,rating,opening_hours,geometry&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: No such file or directory /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 356
ERROR - 2019-03-17 21:09:34 --> Severity: Warning --> file_get_contents( https://maps.googleapis.com/maps/api/place/findplacefromtext/json?input=calle&amp;inputtype=textquery&amp;fields=formatted_address,name,geometry&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: No such file or directory /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 356
ERROR - 2019-03-17 21:11:20 --> Severity: Warning --> file_get_contents( https://maps.googleapis.com/maps/api/place/textsearch/json?query=calle&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: No such file or directory /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 357
ERROR - 2019-03-17 21:11:39 --> Severity: Warning --> file_get_contents( https://maps.googleapis.com/maps/api/place/textsearch/json?query=ca&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: No such file or directory /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 357
ERROR - 2019-03-17 21:11:39 --> Severity: Warning --> file_get_contents( https://maps.googleapis.com/maps/api/place/textsearch/json?query=call&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: No such file or directory /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 357
ERROR - 2019-03-17 21:11:43 --> Severity: Warning --> file_get_contents( https://maps.googleapis.com/maps/api/place/textsearch/json?query=ca&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: No such file or directory /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 357
ERROR - 2019-03-17 21:11:46 --> Severity: Warning --> file_get_contents( https://maps.googleapis.com/maps/api/place/textsearch/json?query=ca&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: No such file or directory /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 357
ERROR - 2019-03-17 21:11:48 --> Severity: Warning --> file_get_contents( https://maps.googleapis.com/maps/api/place/textsearch/json?query=ca&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: No such file or directory /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 357
ERROR - 2019-03-17 21:12:11 --> Severity: Warning --> file_get_contents( https://maps.googleapis.com/maps/api/place/textsearch/json?query=ca&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: No such file or directory /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 357
ERROR - 2019-03-17 21:13:20 --> Severity: Warning --> file_get_contents( https://maps.googleapis.com/maps/api/place/textsearch/json?query=calle&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: No such file or directory /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 357
ERROR - 2019-03-17 21:21:11 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle 8 Santiago&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 360
ERROR - 2019-03-17 21:21:57 --> Severity: Warning --> file_get_contents(https://maps.googleapis.com/maps/api/place/autocomplete/json?input=calle 8&amp;key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI): failed to open stream: HTTP request failed! HTTP/1.0 400 Bad Request
 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 360
