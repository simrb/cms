== About

Just a CMS by php programming language, we dedicate to simplicity and rudeness.



== Setup

install the mysql, php, apache at first, and notice, 

1 enable the short_open_tag=on in php.ini

2 $ yum -y install php-mbstring

3 execute the archive/01rebuildTables.sql file for initailing database

4 copy the archive/cfg_template,archive/access_template file to project root
	dir, and modify the _template to .php as file suffix name, edit your
	dbname, username, password in cfg.php for database connnection.



== Backup

1 backup the dir archive/upload that is stored your upload files.

2 backup your db.
