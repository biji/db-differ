
default:
	@echo Commands are learn, diff-sql, update, drop, clean

learn:
	@CONN=source vendor/bin/doctrine orm:convert-mapping -f --from-database yml config/yaml/
	@CONN=source vendor/bin/doctrine orm:generate:entities src/

diff-sql:
	@CONN=target vendor/bin/doctrine orm:schema-tool:update --dump-sql

update:
	@echo use make update-force if you are sure
	@CONN=target vendor/bin/doctrine orm:schema-tool:update 

update-force:
	@CONN=target vendor/bin/doctrine orm:schema-tool:update --force

drop:
	@echo use make drop-force if you are sure
	@CONN=target vendor/bin/doctrine orm:schema-tool:drop 

drop-force:
	@CONN=target vendor/bin/doctrine orm:schema-tool:drop --force

clean:
	@rm -rf config/yaml/*.yml src/*.php


