## Installation

- git clone git@github.com:Galinka999/test-custom-framework.git
- composer install
- cp .env.example .env
- cp .env.example .env.testing
- set up database connection in .env file

install migrations:
- php db/migrations/22052023_create_items_table.php
- php db/migrations/220520231800_create_item_history_table.php


## Testing

- set up database connection in .env.testing file

Install migrations in test environment:
- php tests/Feature/migrations/220520231500_create_items_table.php
- php tests/Feature/migrations/220520231800_create_item_history_table.php

Run tests:
- php ./vendor/bin/phpunit --configuration tests/phpunit.xml.dist