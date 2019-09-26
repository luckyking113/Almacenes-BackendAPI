<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2017-09-30 21:04:03 --> Severity: Notice --> Undefined index: user_id /home/joemow38/public_html/JoeMowApp/application/models/Api_model.php 139
ERROR - 2017-09-30 21:04:10 --> Severity: Notice --> Undefined index: user_id /home/joemow38/public_html/JoeMowApp/application/models/Api_model.php 139
ERROR - 2017-09-30 21:04:28 --> Severity: Notice --> Undefined index: user_id /home/joemow38/public_html/JoeMowApp/application/models/Api_model.php 139
ERROR - 2017-09-30 21:04:58 --> Severity: Notice --> Undefined index: user_id /home/joemow38/public_html/JoeMowApp/application/models/Api_model.php 139
ERROR - 2017-09-30 21:05:04 --> Severity: Notice --> Undefined index: user_id /home/joemow38/public_html/JoeMowApp/application/models/Api_model.php 139
ERROR - 2017-09-30 21:05:05 --> Severity: Notice --> Undefined index: user_id /home/joemow38/public_html/JoeMowApp/application/models/Api_model.php 139
ERROR - 2017-09-30 21:06:05 --> Severity: Notice --> Undefined index: user_id /home/joemow38/public_html/JoeMowApp/application/models/Api_model.php 139
ERROR - 2017-09-30 22:27:08 --> 404 Page Not Found: Api/uploadPosition
ERROR - 2017-09-30 23:07:22 --> Severity: error --> Exception: syntax error, unexpected '}', expecting ';' /home/joemow38/public_html/JoeMowApp/application/models/Api_model.php 445
ERROR - 2017-09-30 23:08:06 --> Severity: Notice --> Undefined variable: user_id /home/joemow38/public_html/JoeMowApp/application/models/Api_model.php 420
ERROR - 2017-09-30 23:08:06 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 1 - Invalid query: select a.*, b.*, getDistance(a.job_latitude, a.job_longitude, c.user_latitude, c.user_longitude) as distance from tb_jobs a inner join tb_user b on a.job_client = b.user_id inner join tb_user c on getDistance(a.job_latitude, a.job_longitude, c.user_latitude, c.user_longitude) < 10 and a.job_status = 1 and c.user_id = 
