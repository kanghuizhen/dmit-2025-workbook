/*
    UPDATE and DELETE are the U and D part of CRUD. They are the most dangerous. 
    In order to make sure that we aren't affecting every single record in a table, we must use the WHERE clause to limit or specify what we really want to edit.

    The syntax for UPDATE looks like:

    UPDATE table_name
    SET column1 = value1, column2 = value2, ...
    WHERE condition;
*/

-- The SET command is used with UPDATE to specify which columns and values should be updated in a table.
UPDATE cities SET city_name = 'Trana' WHERE cid = 1;

-- Here, we're adding 100 to the populations of any city in Alberta or Saskatchewan. 
UPDATE cities SET population = population + 100 WHERE province = 'AB' OR province = 'SK';

/*
    The syntax for DELETE looks like:

    DELETE FROM table_name WHERE condition;

    Remember that this operation is permanent. There is no undo.
*/

-- Here, we're getting rid of the 20th city in our table.
DELETE FROM cities WHERE cid = 20;

-- And here, we're getting rid of any city with a population less than 5,000.
DELETE FROM cities WHERE population < 5000;

/*
    Take a look at your table. What happened to those rows? Is there anything in there? Is anything missing? 

    Fortunately, we created our own init.sql file as a manual back-up. We can always restore our table by truncating or dropping it (under the Operations tab, near the bottom, in phpMyAdmin) and running our CREATE TABLE or INSERT statements again. 

    Alternatively, you can create a SQL dump using the Export tab in phpMyAdmin, then Import it later. 
*/