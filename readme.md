About
============

Just a CMS by php programming language, we dedicate to simplicity and rudeness.



Setup
============

Step 1, enter to project directory, and then

	# su
	# bash .setup 1

Step 2, initialing database, if you have not existed database, the following command that will create a default database called `cms_db` for you. or you need a anthor database name of new, configure the `cfg.php` and `archive/00initDB.sql` for parameters `cms_db`,`cms_user`,`cms_pawd` as you want.

	# bash .setup 2

if you have a database, just configure the file `cfg.php` for connecting.



Backup
============

1 backup the dir archive/upload, such as

	# cp archive/upload ~/upload_bak

2 backup your db, such as

	# mysqldump --database cms_db > mydb_bak.sql


