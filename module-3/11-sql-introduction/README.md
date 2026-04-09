# SQL & MySQL Introduction

Databases will allow us to read and write data, store more data, and keep it organised (so that we can access it faster). In this lesson, we'll be setting up our database and go over some basic instructions we can give it so that we can read, add, update, and delete data. 

**Note**: If you are unclear about any of the software or tools we'll be using today and what their role is in our web applications, refer back to the `README.md` for [Lesson 1: PHP Environment Setup](../../module-0/01-local-environment-setup/README.md).


## Terminology 

---

**Database**: A database is a set of tables. Generally, there is one database per application. A web application usually has permission to access all of the tables in a database. 

**Tables**: Tables are a set of columns and rows. Each table should represent a single concept (i.e. a noun or category). This can include products, customers, and orders. In a relational database, there is a relationship between tables. 

> Example: The customers in our customers table have a relationship to their previous orders. These orders are related to the products table. 

**Column**: A column is a set of data of a single simple data type. This not only keeps the data organised, but it also helps the database allocate an appropriate amount of storage space and allows us to locate the data faster.

> Example: A first_name column would be the CHAR data type. An age column would be the INT data type.

**Row**: Also known as a record, a row is the set of data in each column. 

> Example: If the columns are first_name and age, then the record might be "Jane", "32".

**Field**: The intersection of a row and a column (i.e. a single cell).

**Primary Key**: A primary key is a special type of table column. It provides a unique record identifier. 

> Example: There are thousands of students at NAIT. Many of them have the same first and last names. Therefore, each student is given a student identification number. 

**Foreign Key**: A foreign key is a table column whose values reference another table. This is the foundation of relational databases. 

> Example: If you wanted to look at your grades, your name and student identification number would be on your transcript. These values are stored elsewhere. 

**Index**: A data structure on a table to help improve lookup speed. 

> Example: This is like an index at the back of a textbook, where you can look up a keyword and it will tell you which pages has the topic that you want instead of starting at the beginning of the book and searching page by page.

**CRUD**: An acronym for 'Create, Read, Update, and Delete'. These are the four primary operations that we perform on databases. 


## What is MySQL?

It's an open source, free database solution. Because it's relatively easy to use and so commonly used with PHP, there's extensive support for it. Major online platforms (Wikipedia, Google, Facebook) use MySQL.

> Note: Because it's now maintained by Oracle, there are different editions. Current, the Community Edition is still entirely free. 

> Note 2: MongoDB is another solution, which is dynamic (i.e. it creates things as you need them) and easy to use, but it does not work for large-scale or enterprise applications in the same way that MySQL does. It's part of the MEAN stack (a JavaScript-based framework for developing web applications). MEAN is named after MongoDB, Express, Angular, and Node.

We're going to be using MySQL through phpMyAdmin. This is a web-based interface that will allow us to directly interact with our database and issue SQL commands. 

We will also be learning how to write PHP applications that allow us to access our MySQL databases and issue similar commands. For example, if a user wishes to register, we might allow them to do so through a web form that creates a username, password, and so forth for them to use. 


## Is there anything different about MySQL or MariaDB that I need to know?

There may be a few data types that you haven't come across yet, or MariaDB may have slightly different aggregate functions from what you're used to. This is because in DMIT1508 - Database Fundamentals I, you learn a 'Microsoft-flavoured' version of SQL; here, we'll be learning an 'Oracle-flavoured' one.


### Integers

In the current version of MySQL, display lengths are ignored for integers. This means that if I do the following: 

```SQL
CREATE TABLE users (
  `pid` INT(3) AUTO_INCREMENT PRIMARY KEY,
  ... 
);
```

... our DBMS will ignore the display length (3). This means that we are not creating a column whose values range from 0-999, we are creating a column that ranges from -2,147,483,648 to 2,147,483,647.

So, instead of display lengths, we can use discrete integer data types. 

TINYINT
  - 1 byte
  - signed: -128 to 127
  - unsigned: 0 to 255

SMALLINT
  - 2 bytes
  - signed: -32,768 to 32,767
  - unsiged: 0 to 65,535
        
MEDIUMINT
    - 3 bytes
    - signed: -8,388,608 to 8,388,607
    - unsigned: 0 to 16,777,215
        
INT
    - 4 bytes
    - signed: -2,147,483,648 to 2,147,483,647
    - unsigned: 0 to 4,294,967,295
        
BIGINT
    - 8 bytes
    - signed: -9,223,372,036,854,775,808 to 9,223,372,036,854,775,807
    - unsigned: 0 to 18,446,744,073,709,551,615

Remember that we should always use the smallest data type possible when storing anything. This will allow us to keep our database quick and responsive, especially when handling multiple requests at a time.


#### Signed and Unsigned Values
 
For each numerical data type, there are signed and unsigned values. Signed values can be negative, while unsigned values start at zero and can only be positive.

Because of this, the maximum value of a signed number will be half the maximum value of an unsigned number.
