midterm

A REST API and PostgreSQL database for storing and managing quotes
The system allows users to perform CRUD operations on quotes, authors, and categories


Features
Stores quotes, authors, and categories in a PostgreSQL database
supports full CRUD operations through REST endpoints
Docker container support for easy deployment
Environment variables allow configuration for different database connections


Database Structure
quotes - stores quote text and references authors and categories
authors - stores author names
categories - stores quote categories


Installation

Docker
docker build -t quotes-api .
docker run 0p 8000:80 quotes-api

Environment Variables
DB_HOST
DB_NAME
DB_USER
DB_PASS


API Endpoints
Quotes
GET /quotes
GET /quotes?id={id}
POST /quotes
PUT /quotes
DELETE /quotes

Authors
GET /authors
GET /authors?id={id}
POST /authors
PUT /authors
DELETE /authors

Categories
GET /categories
GET /categories?id={id}
POST /categories
PUT /categories
DELETE /categories