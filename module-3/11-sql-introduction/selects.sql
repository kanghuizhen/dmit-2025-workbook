-- The SELECT command is what allows us to 'read' or retrieve data. Its syntax looks like the following:

-- SELECT column_name(s) FROM table_name

-- In our cities example, we could run:
SELECT city_name FROM cities;
-- This would return all of the names but nothing else.

-- What if we want to know the structure of our table, or all of the column names, without retrieving everything? 
-- Note: the * reads as 'all', or 'grab everything from this table'.
SELECT * FROM 'cities' LIMIT 3;

-- Now, what if we know the position (ID or index number) of the record we want to retrieve? 
SELECT * FROM 'cities' WHERE cid = 4;
-- Here, the WHERE clause is adding a condition.

SELECT * FROM cities WHERE province = 'ON';
-- This would select every city in our table from Ontario.

SELECT * FROM cities WHERE is_capital = TRUE;
-- This would give us all of the capital cities. 

SELECT * FROM cities WHERE is_capital = 1;
-- Note that in our table, this BOOLEAN value is stored as a 0 or a 1. We could also use this value to return the exact same results. 

SELECT * FROM cities WHERE city_name LIKE '%john%';
-- LIKE lets us look for a pattern in our data.
-- The % is a wildcard. It allows us to match any string of any length (including zero).
-- The _ character lets us match a single character.

-- We can also string together our conditions with the AND operator.
SELECT * FROM cities WHERE province = 'ON' AND population > 1000000;

-- And we can list our results any way we like. Here, we're listing them in descending order.
SELECT * FROM cities WHERE province = 'ON' ORDER BY population DESC;

-- What if we want to know which city has the smallest population?
SELECT population, city_name FROM cities ORDER BY population ASC LIMIT 1;
-- By using LIMIT 1, we're only fetching a single result. This will be handy later when we want to start doing pagination.

-- We can also offset our limit. What if I instead of the top 3 populated cities I wanted the next group of 3? 
SELECT population, city_name FROM cities ORDER BY population DESC LIMIT 3, 3;
-- By adding a comma and number after the limit the system knows to start getting records from there.

/*
    This is a 'Canadian Cities' database, but we actually have cities, towns, and villages. They're each defined by their population size, as follows:

    1. City - 10,000 people or greater
    2. Town - 1,000 people or greater
    3. Village - 300 people or greater

    Source: https://www.alberta.ca/system/files/custom_downloaded_images/ma-alberta-municipalities.pdf
*/

-- So, how might we select only cities? 
SELECT city_name, population FROM cities WHERE population >= 10000;

-- What about only towns? 
SELECT city_name, population FROM cities WHERE population >= 1000 AND population < 10000;

-- Only villages? 
SELECT city_name, population FROM cities WHERE population >= 300 AND population < 1000;

-- We could also use the BETWEEN clause to the same effect; however, it is inclusive, so we have to adjust our ceiling slightly.
SELECT city_name, population FROM cities WHERE population BETWEEN 300 AND 999;
