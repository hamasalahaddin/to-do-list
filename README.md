# Full-Stack To-Do List

A full-stack To-Do List web application built with **React**, **PHP**, and **MySQL**. Users can create an account, log in securely, and manage their own personal tasks.

## Features

* User registration
* User login and logout
* Session-based authentication
* Stay logged in after refreshing the page
* Add new tasks
* Edit existing tasks
* Delete tasks
* Mark tasks as completed
* Each user can only view and manage their own tasks

## Technologies Used

### Frontend

* React
* JavaScript
* HTML
* CSS

### Backend

* PHP

### Database

* MySQL

### Other Tools

* Git
* GitHub
* XAMPP
* Visual Studio Code

## Project Structure

```
to-do-list/
│
├── client/      # React frontend
├── server/      # PHP backend
└── README.md
```

## Getting Started

### Requirements

* XAMPP (Apache & MySQL)
* Node.js
* npm

### Installation

1. Clone the repository.

2. Start **Apache** and **MySQL** using XAMPP.

3. Import the `todo_db` database into phpMyAdmin.

4. Open the `client` folder and install dependencies:

```bash
npm install
```

5. Start the React development server:

```bash
npm run dev
```

6. Open the application in your browser.

## What I Learned

This project helped me practice full-stack web development by combining a React frontend with a PHP and MySQL backend.

During this project I learned how to:

* Build CRUD applications
* Connect React to a PHP backend using the Fetch API
* Work with MySQL databases
* Use prepared statements for database queries
* Implement user authentication with PHP sessions
* Protect user data so each user can only access their own tasks
* Organize React components and state
* Use Git and GitHub for version control

## Future Improvements

Some features that could be added in the future include:

* Task search
* Task categories
* Due dates
* Task priorities
* Better mobile responsiveness
* Loading indicators and improved notifications

## Author

Mohammed Salahaddin
