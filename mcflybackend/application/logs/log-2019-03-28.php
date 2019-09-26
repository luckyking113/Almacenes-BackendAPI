<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-03-28 01:31:28 --> Severity: Notice --> Undefined index: userid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 664
ERROR - 2019-03-28 01:31:28 --> Severity: Notice --> Undefined index: usertype /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 665
ERROR - 2019-03-28 01:31:28 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ORDER BY a.`id` DESC' at line 7 - Invalid query: SELECT a.*, 
b.id AS customerid,b.`first_name` AS customer_firstname, b.`last_name` AS customer_lastname, b.`phone` AS customer_phone,
c.`address_name` AS shipping_addressname, c.`address_location` AS shipping_addresslocation, c.`address_lat` AS shipping_addresslat, c.`address_lng` AS shipping_addresslng
FROM orders a 
LEFT JOIN customers b ON a.customer_id=b.`id`
LEFT JOIN tb_shippingaddress c ON a.shipping_addressid=c.`address_id`
WHERE a.`user_id` = ORDER BY a.`id` DESC
ERROR - 2019-03-28 23:01:56 --> Severity: error --> Exception: syntax error, unexpected '*', expecting function (T_FUNCTION) or const (T_CONST) /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 874
ERROR - 2019-03-28 23:02:03 --> Severity: error --> Exception: syntax error, unexpected '*', expecting function (T_FUNCTION) or const (T_CONST) /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 874
ERROR - 2019-03-28 23:02:53 --> Severity: error --> Exception: syntax error, unexpected '*', expecting function (T_FUNCTION) or const (T_CONST) /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 874
ERROR - 2019-03-28 23:03:03 --> Severity: error --> Exception: syntax error, unexpected end of file /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 927
ERROR - 2019-03-28 23:03:03 --> Severity: Compile Warning --> Unterminated comment starting line 839 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 839
ERROR - 2019-03-28 23:03:38 --> Severity: error --> Exception: syntax error, unexpected end of file /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 927
ERROR - 2019-03-28 23:03:38 --> Severity: Compile Warning --> Unterminated comment starting line 839 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 839
ERROR - 2019-03-28 23:03:43 --> Severity: error --> Exception: syntax error, unexpected end of file /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 927
ERROR - 2019-03-28 23:03:43 --> Severity: Compile Warning --> Unterminated comment starting line 839 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 839
ERROR - 2019-03-28 21:03:55 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 824
ERROR - 2019-03-28 21:03:55 --> Severity: Notice --> Trying to get property 'time_1' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 824
ERROR - 2019-03-28 21:03:55 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 825
ERROR - 2019-03-28 21:03:55 --> Severity: Notice --> Trying to get property 'time_2' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 825
ERROR - 2019-03-28 21:03:55 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 824
ERROR - 2019-03-28 21:03:55 --> Severity: Notice --> Trying to get property 'time_1' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 824
ERROR - 2019-03-28 21:03:55 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 825
ERROR - 2019-03-28 21:03:55 --> Severity: Notice --> Trying to get property 'time_2' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 825
ERROR - 2019-03-28 21:05:50 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 827
ERROR - 2019-03-28 21:05:50 --> Severity: Notice --> Trying to get property 'time_1' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 827
ERROR - 2019-03-28 21:05:50 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 828
ERROR - 2019-03-28 21:05:50 --> Severity: Notice --> Trying to get property 'time_2' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 828
ERROR - 2019-03-28 21:05:50 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 827
ERROR - 2019-03-28 21:05:50 --> Severity: Notice --> Trying to get property 'time_1' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 827
ERROR - 2019-03-28 21:05:50 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 828
ERROR - 2019-03-28 21:05:50 --> Severity: Notice --> Trying to get property 'time_2' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 828
ERROR - 2019-03-28 21:07:24 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 825
ERROR - 2019-03-28 21:07:24 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 827
ERROR - 2019-03-28 21:07:24 --> Severity: Notice --> Trying to get property 'time_1' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 827
ERROR - 2019-03-28 21:07:24 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 828
ERROR - 2019-03-28 21:07:24 --> Severity: Notice --> Trying to get property 'time_2' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 828
ERROR - 2019-03-28 21:07:24 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 825
ERROR - 2019-03-28 21:07:24 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 827
ERROR - 2019-03-28 21:07:24 --> Severity: Notice --> Trying to get property 'time_1' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 827
ERROR - 2019-03-28 21:07:24 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 828
ERROR - 2019-03-28 21:07:24 --> Severity: Notice --> Trying to get property 'time_2' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 828
ERROR - 2019-03-28 21:10:27 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 826
ERROR - 2019-03-28 21:10:27 --> Severity: Notice --> Trying to get property 'time_1' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 826
ERROR - 2019-03-28 21:10:27 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 827
ERROR - 2019-03-28 21:10:27 --> Severity: Notice --> Trying to get property 'time_1' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 827
ERROR - 2019-03-28 21:10:27 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 828
ERROR - 2019-03-28 21:10:27 --> Severity: Notice --> Trying to get property 'time_2' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 828
ERROR - 2019-03-28 21:10:27 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 826
ERROR - 2019-03-28 21:10:27 --> Severity: Notice --> Trying to get property 'time_1' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 826
ERROR - 2019-03-28 21:10:27 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 827
ERROR - 2019-03-28 21:10:27 --> Severity: Notice --> Trying to get property 'time_1' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 827
ERROR - 2019-03-28 21:10:27 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 828
ERROR - 2019-03-28 21:10:27 --> Severity: Notice --> Trying to get property 'time_2' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 828
ERROR - 2019-03-28 21:14:29 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 829
ERROR - 2019-03-28 21:14:29 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 829
