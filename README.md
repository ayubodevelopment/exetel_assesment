# Exetel Assesment

This assesment include the API's for handling customer base and UI with default laravel theme to manipulate data using API calls 

## Installation & guid to test

Clone the repo and use the docker configuration build and deploy it.

and run the below commands to migrate the DB inside "backed server" container 
- php artisan migrate

test the application by running " php artisan test ". this should test the CURD functional API calls of customer table.

To access the web

 - Go to http://localhost:8000/ in browser to open the Web application

 - first register a user and use that credentials to login to the application

 - test the application