SELECT `city_name`,`province` FROM `cities` 

select `city_name`, `province` from cities limit 5;

select city_name from cities where province = 'ab';

select city_name,`province`,`population` from cities order by population desc;

select city_name,`province`,`population` from cities where province = 'on' and population > 1000000;

select city_name,`province`,`population` from cities where province = 'on' or province = 'pe' or province = 'ns' or province = 'nl' ;