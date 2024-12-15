## 初期 SETUP

- 1 `COPY ./app/composer.json ./app/composer.lock /usr/src/myapp/`をコメントアウト
- 2 docker compose run --no-deps --rm php bash
- 3 composer init
- 4 Dockerfile を元に戻して build
- 5 docker compose up -d
