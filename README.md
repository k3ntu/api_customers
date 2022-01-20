## PHP Challenge 🚀

Very good everyone, I want to thank you all for the opportunity. I really enjoyed solving this challenge.

It has some very good points which are at the time of loading the APIs. I hope it meets your expectations to a great extent.

## Usage

To get started, make sure you have [Docker installed](https://docs.docker.com/docker-for-mac/install/) on your system, and then clone this repository.

Next, navigate in your terminal to the directory you cloned this, and spin up the containers for the web server by running `docker-compose up -d --build`.

- **nginx** - `:80`
- **postgres** `:4433`
- **mysql** - `:3306`
- **php** - `:9000`

Three additional containers are included that handle Composer, NPM, and Artisan commands.

- `docker-compose run --rm composer update`
- `docker-compose run --rm artisan migrate`
- `docker-compose run --rm composer passport:install`
- `docker-compose run --rm npm install`
- `docker-compose run --rm npm run dev`

Command create by import of data ['customers.csv'] and search location with Google Maps

- `docker-compose run --rm artisan init:project`

The project run [http://localhost](http://localhost)

## Note

- SPA was created with VUE, VUE-ROUTER for maintenance the reactivity and usage the PASSPORT
- It is not necessary to put an .env for Google keys as it has one by default (this was done intentionally for testing if it is not security gap)
