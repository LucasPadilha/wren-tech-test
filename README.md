# CSV-to-mysql CLI importer


### How to run the application 

**If you want to use the included MySQL docker container**

- Open your terminal;
- type `docker-compose up -d` to bring the container up;
- `cd` to `src` folder;
- type `php index [command_name]`.

**If you want to use your local PHP + MySQL**

- Edit the `config/config.php` file with your MySQL credentials;
- `cd` to `src` folder;
- type `php index [command_name]`.

**Available commands**

- `help [<command_name>]`
- `import [file_name]`
- `test [file_name]`


### Notes

- The application expects a table `tblProductData` to exists.
- The `.sql` files to create both the database and table are in the `sql` folder.