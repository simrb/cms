About
============

Just a CMS by php programming language, we dedicate to simplicity and rudeness.



Setup
============

Step 1, enter to project directory, and then

	# su
	# bash .setup 1

Step 2, initialing database, if you have not existed database, this is a command that will create a default database called `cms_db` for you

	# bash .setup 2

if you have a database, just open those files `cfg.php`, `archive/00initDB.sql`, change the parameters `cms_db`, `cms_user`, `cms_pawd`, and then

	# mysql -h localhost < archive/00initDB.sql



Backup
============

1 backup the directory archive/upload, such as

	# cp archive/upload ~/upload_bak

2 backup your database, such as

	# mysqldump --database cms_db > mydb_bak.sql


