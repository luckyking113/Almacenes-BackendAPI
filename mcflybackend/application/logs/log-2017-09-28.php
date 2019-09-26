<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2017-09-28 06:26:24 --> Severity: error --> Exception: Call to undefined method Api_model::sendRequestToMows() /home/joemow38/public_html/JoeMowApp/application/controllers/Api.php 160
ERROR - 2017-09-28 06:27:07 --> Severity: Notice --> Undefined index: distance /home/joemow38/public_html/JoeMowApp/application/models/Api_model.php 212
ERROR - 2017-09-28 06:27:07 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'and user_available = 1 group by a.user_id' at line 1 - Invalid query: select a.*, avg(b.rating_marks) as user_avgmarks, c.stripe_token, getDistance(42.9, 129.56, a.user_latitude, a.user_longitude) as distance from tb_user a left join user_ratings  b on a.user_id = b.rating_receiver left join tb_user_cards c on a.user_id = c.user_id where a.user_type = 2 and getDistance(42.9, 129.56, a.user_latitude, a.user_longitude) <  and user_available = 1 group by a.user_id
ERROR - 2017-09-28 06:51:22 --> Severity: error --> Exception: Cannot use object of type stdClass as array /home/joemow38/public_html/JoeMowApp/application/models/Api_model.php 221
ERROR - 2017-09-28 08:06:06 --> Query error: FUNCTION joemow38_joemowapp.acgetDistance does not exist - Invalid query: select a.*, b.*, getDistance(a.job_latitude, a.job_longitude, c.user_latitude, c.user_longitude) as distance from tb_jobs a inner join tb_user b on a.job_client = b.user_id inner join tb_user c on acgetDistance(a.job_latitude, a.job_longitude, c.user_latitude, c.user_longitude) < 10 and c.user_id = 2
ERROR - 2017-09-28 18:40:22 --> 404 Page Not Found: Api/cancelRequest
ERROR - 2017-09-28 18:42:33 --> Severity: Notice --> Use of undefined constant job_id - assumed 'job_id' /home/joemow38/public_html/JoeMowApp/application/controllers/Api.php 163
ERROR - 2017-09-28 20:10:43 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'c.user_id = 2' at line 1 - Invalid query: select a.*, b.*, getDistance(a.job_latitude, a.job_longitude, c.user_latitude, c.user_longitude) as distance from tb_jobs a inner join tb_user b on a.job_client = b.user_id inner join tb_user c on getDistance(a.job_latitude, a.job_longitude, c.user_latitude, c.user_longitude) < 10 and a.job_status = 1 c.user_id = 2
ERROR - 2017-09-28 22:26:02 --> Severity: Notice --> Use of undefined constant job_id - assumed 'job_id' /home/joemow38/public_html/JoeMowApp/application/controllers/Api.php 163
ERROR - 2017-09-28 22:26:12 --> Severity: Notice --> Use of undefined constant job_id - assumed 'job_id' /home/joemow38/public_html/JoeMowApp/application/controllers/Api.php 163
ERROR - 2017-09-28 22:26:48 --> Severity: Notice --> Use of undefined constant job_id - assumed 'job_id' /home/joemow38/public_html/JoeMowApp/application/controllers/Api.php 163
ERROR - 2017-09-28 22:28:33 --> Severity: Notice --> Undefined index: job_client /home/joemow38/public_html/JoeMowApp/application/controllers/Api.php 156
ERROR - 2017-09-28 22:28:33 --> Severity: Notice --> Undefined index: job_latitude /home/joemow38/public_html/JoeMowApp/application/controllers/Api.php 157
ERROR - 2017-09-28 22:28:33 --> Severity: Notice --> Undefined index: job_longitude /home/joemow38/public_html/JoeMowApp/application/controllers/Api.php 158
ERROR - 2017-09-28 22:28:33 --> Severity: Notice --> Undefined index: job_address /home/joemow38/public_html/JoeMowApp/application/controllers/Api.php 159
ERROR - 2017-09-28 22:28:33 --> Severity: Notice --> Undefined index: distance /home/joemow38/public_html/JoeMowApp/application/controllers/Api.php 160
ERROR - 2017-09-28 22:28:33 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ' , a.user_latitude, a.user_longitude) as distance from tb_user a left join user_' at line 1 - Invalid query: select a.*, avg(b.rating_marks) as user_avgmarks, c.stripe_token, getDistance(, , a.user_latitude, a.user_longitude) as distance from tb_user a left join user_ratings  b on a.user_id = b.rating_receiver left join tb_user_cards c on a.user_id = c.user_id where a.user_type = 2 and getDistance(, , a.user_latitude, a.user_longitude) <  and user_available = 1 group by a.user_id
ERROR - 2017-09-28 22:36:41 --> 404 Page Not Found: Api/sendAcceptToClient
ERROR - 2017-09-28 22:40:27 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '1 = ''
WHERE `user_id` = '1'' at line 1 - Invalid query: UPDATE `user_unread` SET 1 = ''
WHERE `user_id` = '1'
ERROR - 2017-09-28 22:44:38 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '1 = ''
WHERE `user_id` = '1'' at line 1 - Invalid query: UPDATE `tb_user` SET 1 = ''
WHERE `user_id` = '1'
ERROR - 2017-09-28 22:45:43 --> Severity: error --> Exception: syntax error, unexpected '->' (T_OBJECT_OPERATOR) /home/joemow38/public_html/JoeMowApp/application/models/Api_model.php 265
