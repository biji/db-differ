default:
	@echo Commands are learn, diff-sql, update, drop

learn:
	@CONN=source vendor/bin/doctrine orm:convert-mapping -f --from-database yml config/yaml/
	@CONN=source vendor/bin/doctrine orm:generate:entities src/

diff-sql:
	@CONN=target vendor/bin/doctrine orm:schema-tool:update --dump-sql

update:
	@CONN=target vendor/bin/doctrine orm:schema-tool:update 
	@echo use make update-force if you are sure

update-force:
	@CONN=target vendor/bin/doctrine orm:schema-tool:update --force

drop:
	@CONN=target vendor/bin/doctrine orm:schema-tool:drop 
	@echo use make drop-force if you are sure

drop-force:
	@CONN=target vendor/bin/doctrine orm:schema-tool:drop --force

