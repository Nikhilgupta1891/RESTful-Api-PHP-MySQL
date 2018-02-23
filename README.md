# Introduction

* This is a RESTful API built using the SlimPHP framework. 
* It uses MySQL as DB for Storage.
* Object Oriented Programming concepts.

### Installation

* Install SlimPHP and other related dependencies
* Create database or import from sqlSource/database_data.sql
* Edit db/user params

### API Endpoints
* $ GET /api/users		: Gets all the users from DB 
* $ GET /api/user/{id}		: Get the user with ID from DB
* $ DELETE /api/user/delete/{id}		: Deletes a user of given ID from DB
* $ PUT /api/user/update/{id}		: Updates an existing user of given ID in DB
* $ POST /api/user/add		: Adds a user to the DB
