Simple Shopping Cart with Admin Panel using Laravel Framework
Technologies used:  
•	MySQL  (XAMPP Control Panel)
•	PHP(Laravel)
•	Bootstrap 
Project’s details:
1)	After I created the database in MySQL, in order to create the migrations and models for the tables I’ve installed the applications that are mentioned upper in the ‘Technologies used’ section. For the next step, I used the property “Seeding” of Laravel for seeding my database with data using seed classes.
2)	I’ve made an Admin Panel that contains: login and logout page for “admin user” with encrypted credentials  and  CRUD operations that allow the management of the product table. Each page of this section can be accessed only if the user is logged in.
3)	I’ve made an Client Interface part  that contains: 
•	display page of all existing products with „ADD to Cart” button for each of them (using sessions); 
•	login, logout and register page for a “normal user” (the password being encrypted ); 
•	user profile page -  where you can see all the placed orders; 
•	checkout page - this page can be accesed only if the user is logged in;
•	shopping cart page;



