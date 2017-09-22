About
============

Just a CMS by php programming language, we dedicate to simplicity and rudeness.



Setup
============

install the mysql, php, apache at first, and notice, 

1 install the mbstring module

	# yum -y install php-mbstring

2 open the short tag

	# echo 'short_open_tag=On' > /etc/php.d/custom.ini

3 copy config file to root dir

	# cp archive/cfg_template cfg.php
	# cp archive/access_template access.php

4 initialing database

	# mysql -h localhost -u root < /var/www/html/project/archive/initdb.sql



Backup
============

1 backup the dir archive/upload that is stored your upload files.

2 backup your db.



