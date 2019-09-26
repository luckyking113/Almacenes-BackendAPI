<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-03-01 02:02:16 --> Severity: Notice --> Undefined variable: toke /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 399
ERROR - 2019-03-01 02:02:24 --> Severity: Notice --> Undefined variable: toke /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 399
ERROR - 2019-03-01 07:29:55 --> Severity: Notice --> Undefined variable: 12 /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 475
ERROR - 2019-03-01 07:29:55 --> Severity: error --> Exception: Call to undefined function get() /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 489
ERROR - 2019-03-01 07:32:25 --> Severity: Notice --> Undefined variable: 12 /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 475
ERROR - 2019-03-01 07:32:25 --> Severity: error --> Exception: Call to undefined function get() /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 489
ERROR - 2019-03-01 07:32:59 --> Severity: error --> Exception: Call to undefined function get() /home/secuamuz/mcflydelivery.com/mcflybackend/application/models/Api_model.php 489
ERROR - 2019-03-01 07:33:51 --> Query error: Table 'secuamuz_warehouse_admin.prducts' doesn't exist - Invalid query: SELECT *
FROM `prducts`
JOIN `warehouse_products` ON `products`.`id` = `warehouse_products`.`product`
WHERE `move_product_id` = '12'
AND `warehouse` = '1'
