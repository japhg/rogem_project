This system has 4 users:
The User, Admin, Super Admin and the Staff.

Once the system detected the account's user type, it will redirect to the page based on your role.
To access the admin panel, you need to login. And if you want to add a new admin, you can create an account and request to whoever the super admin is, to change the usertype from USER to ADMIN.

# User Roles
###### User - Users are the ones who can register and login to the system. They can make a training requests.

###### Admin - Admins are the ones who can add new trainings, and can also add new training requests.

###### Super Admin - Super Admin are the ones who can add new users, set their roles, add, edit and delete the trainings and training requests/

###### Staff - The only role of the staff is to approve the training requests and add trainings. 

# File structure:

###### Assets folder - This folder is the storage of all the resources that are used in the system such as images, fonts, files, css files, javascript file and etc..

###### Components folder - This folder contains all the components that are used in the system such as header, footer, navbar, alertmessage, logout, and sidebar.

###### Controller folder - This folder contains all files that processes the request of users. Controllers can group related request handling logic into a single class before it pass to the Model Folder.

###### Database folder - This folder contains the copy of database.

###### Helpers folder - This folder contains all the helpers that are used in the system such as checker.php. This page is responsible for checking the email and username that the user register.

###### Http folder - This folder contains all the files that are responsible for sending an email.

###### Models folder - This folder contains all the files that are responsible for the database connection and queries.

###### Vendor folder - This folder contains all the libraries that are used in the system such as needim and PHPMailer (For sending emails).

###### Views folder - This folder contains all the files that are responsible for the user interface.
