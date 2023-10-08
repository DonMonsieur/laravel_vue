#JC Monsieur Edmund Tubiera

## Installation

To install the project, follow the steps below:

    1. Clone the project repository by executing the following command in your terminal or command prompt:

    	git clone https://github.com/DonMonsieur/laravel_vue.git

### Frontend

  	2.  Open your terminal or command prompt and navigate to the "react" folder within the project directory:

		cd vue

	3.	Install the required dependencies by running the following command:

		npm install

	4.	Build the frontend assets by executing the following command:

	    npm run dev

###	Backend

	5.  Open your terminal or command prompt and navigate to the "laravel_vue" folder within the project directory:

		cd laravel_vue or cd ..

	6.	Update the PHP dependencies using Composer by running the following command:

		composer update

	7.	Rename the .env.example file to .env.

	8.	Run the database migrations and seed the initial data by executing the following command:

		php artisan migrate:fresh --seed

	10.	Start the PHP development server by running the following command:

    	php artisan serve

#Setup
### Localhost

	- ensure that the result of the npm run dev of frontend and php artisan serve of backend are <b>localhost:5173</b> and <b>http://127.0.0.1:8000</b>respectively
