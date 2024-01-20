# Object–relational mapping
#### The project is using for creating custom orm 

### To use the project do these steps
1. Run docker to creat containers

`docker compose --env-file example.env up --build`

2. Create users table and insert data

- 2.1 `docker exec -it mysql bash`

- 2.2 In the container run `mysql -u root -p` and enter your password. Then run sql queries

```sql
CREATE TABLE users(
    id int(10) NOT NULL auto_increment,
    first_name varchar(50) NOT NULL,
    last_name varchar(50) NOT NULL,
    gender ENUM('1','2') NOT NULL,
    PRIMARY KEY (id)
);
```
**Adding dummy data for `users` table**
```sql
INSERT INTO users (first_name, last_name, gender)
VALUES('Max', 'Mustermann', 1);
INSERT INTO users (first_name, last_name, gender)
VALUES('Jane', 'Mustermann', 1);
INSERT INTO users (first_name, last_name, gender)
VALUES('Alice', 'Jorgen', 2);
```

3. Open the local url: http://localhost:8000/