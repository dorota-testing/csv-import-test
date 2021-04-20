## Installation
You need composer installed for this, and php either globally on your system or on local server such as xampp. Clone or download this repo on your machine (to a place where php runs). In terminal navigate to project folder and run:
```
  composer install
```
Then, change name of file config_example.json to config.json. Open config.json file and enter credentials to your database. 
Then in terminal run: 
```
  php db_init.php
```
This sets up empty table for products in your database. It can also be used to delete all data inserted when running the code.

## Using in Command Line
Make sure you have navigated to this folder and run for proper import: 
```
  php index.php
``` 
To run in test mode add line argument 'test': 
```
  php index.php test
``` 

## Unit Testing
In terminal navigate to this folder and run: 
```
  vendor/bin/phpunit
``` 

## View in browser
Install on a server with php and open index.php in the browser. 