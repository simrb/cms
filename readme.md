About
============

Just a CMS by php programming language, we dedicate to simplicity and rudeness.



Setup
============

initialing the project environment and database by default database, username, userpawd

	# su
	# sh .setup -ed

or, set your custom by options `-h, -n, -u, -p`

	# sh .setup -ed -n db_name -u username -p password

if you have an existed database, just configure the file `cfg.php` for connecting.



Backup
============

1 backup the dir archive/upload, such as

	# cp -r archive/upload ~/upload_bak

2 backup your db, such as

	# mysqldump --database cms_db > mydb_bak.sql


