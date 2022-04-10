#setup
du:
	docker-compose up -d --build
	docker-compose exec php composer install
	docker-compose exec admin-service composer install
db:
	docker-compose build
node-build:
	make clean-build
	make create-build-folders
	docker-compose exec node npm run build
	make move-build-files-to-server
ds:
	docker-compose stop
de:
	docker-compose exec php sh
de-nginx:
	docker-compose exec nginx sh
de-node:
	docker-compose exec node sh
de-admin:
	docker-compose exec admin-service sh
de-database:
	docker-compose exec database sh
dd:
	docker-compose down --rmi all
dstop:
	docker-compose stop
dstart:
	docker-compose start
test:
	docker-compose exec php composer test
	docker-compose exec node npm run test
test-node:
	docker-compose exec node npm run test
node-lint:
	docker-compose exec node npm run lint
node-lint-fix:
	docker-compose exec node npm run lint:fix

# scripts for nuxt build
clean-build:
	rm -rf ./server/public/assets/*
	rm -rf ./server/nuxt_index/
	rm -rf ./node/dist/
create-build-folders:
	mkdir ./node/dist
	mkdir ./node/dist/assets
	mkdir ./server/nuxt_index/
move-build-files-to-server:
	mv ./node/dist/index.html ./server/nuxt_index/
	mv ./node/dist/assets/* ./server/public/assets
	rm -rf ./node/dist/