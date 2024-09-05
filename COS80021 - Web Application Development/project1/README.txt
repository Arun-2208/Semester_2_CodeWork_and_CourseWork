Project Overview:

The "Arun Ragav Shipping" project is a web-based shipping system designed for customers to register, log in, and submit shipping requests 
for delivering small items from Melbourne to other parts of Australia. The system includes functionalities 
for customer registration, login, request submission, and an administration panel for managing requests.

URL for the  Project :


    https://mercury.swin.edu.au/cos80021/s104837257/Project1/shiponline.php


Instructions for Using the System:

    Accessing the Homepage:
        Navigate to the URL provided above to access the homepage (shiponline.php) of Arun Ragav Shipping. 
		This page provides links to all major components of the system: customer registration, login/request submission, and administration.

    Customer Registration (register.php):
        Click on the "Register" link on the homepage to navigate to the registration page.
        Fill in the required fields: Name, Password, Retype Password, Email Address, and Phone Number.
        Click the "Register" button. The system will validate your input, ensure the email is unique, and register you in the system.
        Upon successful registration, a unique customer number will be displayed. Note this number as it will be used for login.

    Customer Login (login.php):
        Click on the "Login" link on the homepage to navigate to the login page.
        Enter your customer number and password.
        Click the "Login" button. If the credentials are correct, you will be redirected to the request submission page.

    Submit a Shipping Request (request.php):
        On the request page, enter the required shipping details: item description, weight, pick-up address and suburb, 
		preferred pick-up date and time, receiver name, and delivery address, suburb, and state.
        All inputs are validated according to the guidelines provided (e.g., weight between 2 and 20 kg, 
		pick-up date at least 24 hours from the current time, and pick-up time between 8:00 and 20:00).
        Click the "Submit Request" button. 
		The system will validate your input, generate a request number, and display a confirmation message along with the shipping cost.

    Administration Panel (admin.php):
        Click on the "Admin" link on the homepage to navigate to the administration panel.
        Select a request type (Request Date or Pick-up Date) and provide the desired date.
        Click "Show Requests" to view all requests on the specified date, along with the total number of requests and calculated revenue or weight.

    Logout (logout.php):
        To log out, click the "Log Out" button available on the request page. This action will terminate your session.

List of All Files in the System:

    shiponline.php - The homepage with navigation links to registration, login, and administration pages.
    register.php - Customer registration page that handles user registration and data validation.
    login.php - Customer login page that validates credentials and directs users to the request page.
    request.php - Request submission page for logged-in customers to submit their shipping requests.
    admin.php - Administration panel that provides an overview of requests based on date selection.
    logout.php - Handles the logout process by destroying user sessions.
    style.css - CSS file that provides consistent styling across all pages in the web application.
    db_create_tables.txt - Contains the MySQL queries to create the necessary customers and requests tables.
    checklist.txt - A checklist for tasks completion to ensure all project requirements are met.
    readme.doc - This document providing an overview and instructions for the ShipOnline project.

Additional Notes:

    Email Functionality: It is manadatory for your PHP environment to be configured to send emails correctly.
    Database Setup: The provided db_create_tables.txt file can be used to set up your MySQL tables in your Mercury account.
    