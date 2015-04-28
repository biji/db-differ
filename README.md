# db-differ
General database schema comparer, updater

(c) Khad

To use:

1. git clone https://github.com/biji/db-differ.git
2. cd db-differ
3. composer update
4. cp config/db.yml.asli config/db.yml
5. Edit config/db.yml
6. make [command]
7. if you have multiple configuration:
    DB_YML=config/db2.yml make [command]

Commands are:
    Commands are learn, diff-sql, update, update-source, drop, clean

make learn:

Learn new schema from source database, usually from your existing/development database. Will generate files in config/yaml/

make diff-sql:

Compare databases source and target, and generate diff in SQL commands

make update:

Update target database using difference from source database 

make drop:

Drop tables from target database

make clean

Clean generated files

make update-source:

Update source database after you have modify generated yaml files in config/yaml/

