Product Tracker Console App
It allows you to track items from online shops (only BestBuy is included, but it's extendable)

Development Setup
Run make setup to install dependencies, generate .env file, create SQLite database, apply migrations and etc. Add your BestBuy Api Key to .env file!
Run make seed to create BestBuy retailer with Nintendo Switch product to test tracking.
Run make test to execute tests.
run php artisan | grep tracker to view available commands.
