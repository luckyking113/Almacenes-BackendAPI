<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-03-26 00:35:28 --> Severity: Notice --> Undefined index: orderid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 571
ERROR - 2019-03-26 00:35:28 --> Severity: Notice --> Undefined index: driverid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 572
ERROR - 2019-03-26 00:35:28 --> Severity: Notice --> Undefined index: drivername /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 573
ERROR - 2019-03-26 00:35:28 --> Severity: Notice --> Undefined index: status /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 574
ERROR - 2019-03-26 00:37:02 --> Severity: Notice --> Undefined index: orderid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 571
ERROR - 2019-03-26 00:37:02 --> Severity: Notice --> Undefined index: driverid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 572
ERROR - 2019-03-26 00:37:02 --> Severity: Notice --> Undefined index: drivername /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 573
ERROR - 2019-03-26 00:37:02 --> Severity: Notice --> Undefined index: status /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 574
ERROR - 2019-03-26 00:40:40 --> Severity: Notice --> Undefined index: orderid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 571
ERROR - 2019-03-26 00:40:40 --> Severity: Notice --> Undefined index: driverid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 572
ERROR - 2019-03-26 00:40:40 --> Severity: Notice --> Undefined index: drivername /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 573
ERROR - 2019-03-26 00:40:40 --> Severity: Notice --> Undefined index: status /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 574
ERROR - 2019-03-26 03:09:17 --> Severity: Notice --> Undefined index: zipecode /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 47
ERROR - 2019-03-26 03:09:17 --> Severity: Notice --> Undefined index: customerid /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 48
ERROR - 2019-03-26 03:09:17 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ORDER BY a.`id` DESC' at line 1 - Invalid query: SELECT a.*, b.`address_name` AS shippingaddress_name, b.`address_location` AS shipping_addresslocation, b.`address_zipcode` AS shipping_addresszipcode, b.`address_lat` AS shipping_addresslat, b.`address_lng` AS shipping_addresslng, b.`address_imageurl` AS shipping_addressimageurl FROM orders a LEFT JOIN tb_shippingaddress b ON a.shipping_addressid=b.`address_id` WHERE a.`customer_id` =  ORDER BY a.`id` DESC
ERROR - 2019-03-26 05:06:29 --> Severity: error --> Exception: Call to undefined function check_warehouseworkingtime() /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 68
ERROR - 2019-03-26 12:14:19 --> Severity: error --> Exception: Too few arguments to function Api::getalltips(), 0 passed in /home/secuamuz/mcflydelivery.com/mcflybackend/system/core/CodeIgniter.php on line 514 and exactly 1 expected /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 648
ERROR - 2019-03-26 12:14:33 --> Severity: error --> Exception: Too few arguments to function Api::getalltips(), 0 passed in /home/secuamuz/mcflydelivery.com/mcflybackend/system/core/CodeIgniter.php on line 514 and exactly 1 expected /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 648
ERROR - 2019-03-26 12:55:00 --> Severity: error --> Exception: Too few arguments to function Api::getalltips(), 0 passed in /home/secuamuz/mcflydelivery.com/mcflybackend/system/core/CodeIgniter.php on line 514 and exactly 1 expected /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 648
ERROR - 2019-03-26 12:55:34 --> Severity: Notice --> Undefined index: drivername /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 575
ERROR - 2019-03-26 12:55:34 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 388
ERROR - 2019-03-26 12:55:34 --> Severity: Notice --> Trying to get property 'customer_id' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 388
ERROR - 2019-03-26 12:55:34 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 389
ERROR - 2019-03-26 12:55:34 --> Severity: Notice --> Trying to get property 'order_id' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 389
ERROR - 2019-03-26 12:55:34 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 390
ERROR - 2019-03-26 12:55:34 --> Severity: Notice --> Trying to get property 'deliverman_id' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 390
ERROR - 2019-03-26 12:55:34 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 391
ERROR - 2019-03-26 12:55:34 --> Severity: Notice --> Trying to get property 'allow_stageemail' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 392
ERROR - 2019-03-26 12:55:34 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 393
ERROR - 2019-03-26 12:55:34 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 393
ERROR - 2019-03-26 12:55:34 --> Severity: Notice --> Trying to get property 'email' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 394
ERROR - 2019-03-26 12:55:34 --> Severity: Notice --> Trying to get property 'token' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 395
ERROR - 2019-03-26 23:29:51 --> Severity: Notice --> Undefined index: drivername /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 575
ERROR - 2019-03-26 23:29:51 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 388
ERROR - 2019-03-26 23:29:51 --> Severity: Notice --> Trying to get property 'customer_id' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 388
ERROR - 2019-03-26 23:29:51 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 389
ERROR - 2019-03-26 23:29:51 --> Severity: Notice --> Trying to get property 'order_id' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 389
ERROR - 2019-03-26 23:29:51 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 390
ERROR - 2019-03-26 23:29:51 --> Severity: Notice --> Trying to get property 'deliverman_id' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 390
ERROR - 2019-03-26 23:29:51 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 391
ERROR - 2019-03-26 23:29:51 --> Severity: Notice --> Trying to get property 'allow_stageemail' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 392
ERROR - 2019-03-26 23:29:51 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 393
ERROR - 2019-03-26 23:29:51 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 393
ERROR - 2019-03-26 23:29:51 --> Severity: Notice --> Trying to get property 'email' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 394
ERROR - 2019-03-26 23:29:51 --> Severity: Notice --> Trying to get property 'token' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 395
ERROR - 2019-03-26 23:29:56 --> Severity: Notice --> Undefined index: drivername /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 575
ERROR - 2019-03-26 23:29:56 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 388
ERROR - 2019-03-26 23:29:56 --> Severity: Notice --> Trying to get property 'customer_id' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 388
ERROR - 2019-03-26 23:29:56 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 389
ERROR - 2019-03-26 23:29:56 --> Severity: Notice --> Trying to get property 'order_id' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 389
ERROR - 2019-03-26 23:29:56 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 390
ERROR - 2019-03-26 23:29:56 --> Severity: Notice --> Trying to get property 'deliverman_id' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 390
ERROR - 2019-03-26 23:29:56 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 391
ERROR - 2019-03-26 23:29:56 --> Severity: Notice --> Trying to get property 'allow_stageemail' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 392
ERROR - 2019-03-26 23:29:56 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 393
ERROR - 2019-03-26 23:29:56 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 393
ERROR - 2019-03-26 23:29:56 --> Severity: Notice --> Trying to get property 'email' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 394
ERROR - 2019-03-26 23:29:56 --> Severity: Notice --> Trying to get property 'token' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 395
ERROR - 2019-03-26 23:30:05 --> Severity: Notice --> Undefined index: drivername /home/secuamuz/mcflydelivery.com/mcflybackend/application/controllers/Api.php 575
ERROR - 2019-03-26 23:30:05 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 388
ERROR - 2019-03-26 23:30:05 --> Severity: Notice --> Trying to get property 'customer_id' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 388
ERROR - 2019-03-26 23:30:05 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 389
ERROR - 2019-03-26 23:30:05 --> Severity: Notice --> Trying to get property 'order_id' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 389
ERROR - 2019-03-26 23:30:05 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 390
ERROR - 2019-03-26 23:30:05 --> Severity: Notice --> Trying to get property 'deliverman_id' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 390
ERROR - 2019-03-26 23:30:05 --> Severity: Notice --> Undefined offset: 0 /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 391
ERROR - 2019-03-26 23:30:05 --> Severity: Notice --> Trying to get property 'allow_stageemail' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 392
ERROR - 2019-03-26 23:30:05 --> Severity: Notice --> Trying to get property 'first_name' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 393
ERROR - 2019-03-26 23:30:05 --> Severity: Notice --> Trying to get property 'last_name' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 393
ERROR - 2019-03-26 23:30:05 --> Severity: Notice --> Trying to get property 'email' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 394
ERROR - 2019-03-26 23:30:05 --> Severity: Notice --> Trying to get property 'token' of non-object /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 395
