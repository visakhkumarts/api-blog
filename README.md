
# Blog API 

## Project Overview
A RESTful API for a blog application using Laravel. Includes endpoints for **posts, comments, and tags**, with authentication via Laravel Sanctum.

##  Tech Stack
- Laravel 12
- MySQL Database
- Laravel Sanctum for Authentication
- Eloquent ORM for Database Operations

##  Database Details
**Database Name:** `blog_api`

Tables & Relationships:
- **users** → hasMany `posts`, hasMany `comments`
- **posts** → belongsTo `user`, hasMany `comments`, belongsToMany `tags`
- **comments** → belongsTo `user`, belongsTo `post`
- **tags** → belongsToMany `posts`
- **post_tag** (pivot table) → Many-to-many relationship between `posts` and `tags`

##  API Endpoints
| Method | Endpoint | Description |
|--------|----------|-------------|
| **POST** | `/api/register` | Register a new user |
| **POST** | `/api/login` | User login |
| **POST** | `/api/logout` | User logout (requires token) |
| **GET** | `/api/posts` | Get all posts |
| **POST** | `/api/posts` | Create a new post |
| **GET** | `/api/posts/{post_id}` | Get a single post |
| **PUT/PATCH** | `/api/posts/{post_id}` | Update a post |
| **DELETE** | `/api/posts/{post_id}` | Delete a post (deletes comments & tag relations) |
| **GET** | `/api/posts/{post_id}/comments` | Get comments for a post |
| **POST** | `/api/posts/{post_id}/comments` | Add a comment to a post |
| **PUT** | `/api/comments/{comment_id}` | Update a comment |
| **DELETE** | `/api/comments/{comment_id}` | Delete a comment |
| **GET** | `/api/tags` | Get all tags |
| **POST** | `/api/tags` | Create a tag |
| **GET** | `/api/tags/{tag_id}` | Get posts associated with a tag |
| **PUT/PATCH** | `/api/tags/{tag_id}` | Update a tag |
| **DELETE** | `/api/tags/{tag_id}` | Delete a tag |

---------------------------------------------------------------------------

POST Request to Create a Post
Endpoint:

POST /api/posts

Headers:

Authorization: Bearer YOUR_API_TOKEN
Content-Type: application/json
Body (JSON format):

json
{
    "title": "New Blog Post",
    "body": "This is the content of the blog post.",
    "tag_ids": [1, 3, 5]
}
 This will create a new post and associate it with tag IDs 1, 3, and 5.

-----------------------------------------------------

POST Request to Add a Comment
Endpoint:

POST /api/posts/{post_id}/comments
Replace {post_id} with the ID of the post you want to comment on.

Headers:

Authorization: Bearer YOUR_API_TOKEN
Content-Type: application/json
Body (JSON format):

json
{
    "content": "This is a great post! Really enjoyed reading it."
}


