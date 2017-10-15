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

if you have a database, just open the `cfg.php`, `archive/02addRecordLog.sql`,`archive/00fisrtInstall.sql`, change the parameters `cms_db`, `cms_user`, `cms_pawd`, and then

	# mysql -h localhost < 00fisrtInstall.sql
	# mysql -h localhost < 02addRecordLog.sql



Backup
============

1 backup the dir archive/upload, such as

	# cp archive/upload ~/upload_bak

2 backup your db, such as

	# mysqldump --database cms_db > mydb.sql


