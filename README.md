# Project API

## Requirements

- Git
- Docker
- Docker compose

## Installation

### 1. Clone latest Git master

```bash
git clone https://github.com/vmalchev/project-api.git
```

### 2. Manage containers

This will bring 3 containers up, and forward needed ports to the localhost:

| Name / hostname | Ports | Description   |
|-----------------|-------|---------------|
| nginx           | 8001  | Nginx         |
| app             | -     | PHP-FPM       |
| mysql           | 8982  | MySQL         |


Containers are accessible internally via their hostnames. For example you can access **mysql** from **php** container by connecting to **mysql** as hostname.

The full configuration can be found in **docker-compose.yaml** file

### 3. Environment setup

Start(initialize) containers
```bash
docker compose -up -d
```

Get inside container
```bash
docker exec -it app-php bash
```

The `.env` file is under gitignore and can be used to customize the local environment.
Copy template environment file.

```bash
cp .env.example .env
```

Once the container is running install dependencies with:
```bash
composer install
```

Create and Run database migrations:
```bash
php bin/console make:migration
php bin/console doctrine:migrations:migrate


```

Generate SSL keys:
```bash
php bin/console lexik:jwt:generate-keypair
```

## Authentication

### Example
| Method | URL                | Payload                                            | Description             |
|--------|--------------------|----------------------------------------------------|-------------------------|
| `POST` | `/api/register`    | `{"username":"project_admin","password":"r00tme"}` | Add new user.           |
| `POST` | `/api/login_check` | `{"username":"project_admin","password":"r00tme"}` | Obtain an access token. |

## Endpoints
The access token received from the curl should be used for making requests to the API.
```bash

curl -X POST -H "Content-Type: application/json" http://localhost:8001/api/login_check -d '{"username":"project_admin","password":"r00tme"}'
```

Pass the JWT on each request to the protected firewall, either as an authorization header or as a query parameter.

### Examples
| Method   | URL                                                               | Payload                                                                                                                                                                      | Description                                                          |
|----------|-------------------------------------------------------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|----------------------------------------------------------------------|
| `GET`    | `/api/projects`                                                   | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | Retrieve all projects(not deleted).                                  |
| `POST`   | `/api/projects`                                                   | `{"title": "Example title", "description": "example description", "status": "IN_PROGRESS", "duration": "PT2M3D", "client": "Example client", "company": "Example company"}`  | Create a new project.                                                |
| `GET`    | `/api/projects/{id}`                                              | `{"title": "Example title", "description": "example description", "status": "IN_PROGRESS", "duration": "PT2M3D", "client": "Example client", "company": "Example company"}`  | Retrieve project #ID.                                                |
| `PUT`    | `/api/projects/{id}`                                              | `{"title": "Example title", "description": "example description", "status": "IN_PROGRESS", "duration": "PT2M3D", "client": "Example client", "company": "Example company"}`  | Update data in project #ID.                                          |
| `DELETE` | `/api/projects/{id}`                                              | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | Delete project #ID.                                                  |
| `GET`    | `/api/tasks`                                                      | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | Retrieve all tasks(not deleted).                                     |
| `POST`   | `/api/tasks`                                                      | `{"name": "Example name", "project": "1ef3c933-57bc-6c76-8be2-d361f2478593"}`                                                                                                | Create a new task.                                                   |
| `GET`    | `/api/tasks/{id}`                                                 | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | Retrieve task #ID.                                                   |
| `PUT`    | `/api/tasks/{id}`                                                 | `{"name": "Example name", "project": "1ef3c933-57bc-6c76-8be2-d361f2478593"}`                                                                                                | Update data in task #ID.                                             |
| `DELETE` | `/api/tasks/{id}`                                                 | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | Delete task #ID.                                                     |

