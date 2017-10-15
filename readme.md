About
============

Just a CMS by php programming language, we dedicate to simplicity and rudeness.



Setup
============

enter to project directory, and then

	# su
	# bash .setup 1

initialing database, if you have not existed database, this is command that will create a default database called `cms_db` for you

	# bash .setup 2

if you have a database, just configure the `cfg.php`



Backup
============

1 backup the dir archive/upload, such as

	# cp archive/upload ~/upload_bak

2 backup your db, such as

	# mysqldump --database cms_db > mydb.sql


