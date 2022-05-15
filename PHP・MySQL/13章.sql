SELECT*
FROM goods_table
WHERE price<=500
;
SELECT character_id,character_name
FROM character_table
WHERE pref LIKE'%県'
;
SELECT emp_id,age
FROM emp_table
WHERE job='clerk'
;
SELECT emp_id,emp_name
FROM emp_table
WHERE job='analyst'OR(20<=age AND age<=25)
;