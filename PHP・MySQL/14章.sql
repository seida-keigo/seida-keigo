UPDATE emp_table
SET job='CTO'
WHERE emp_id=1
;
SELECT*
FROM emp_table
;
DELETE
FROM emp_table
WHERE age>=40
;
SELECT*
FROM emp_table
;
INSERT
INTO emp_table(emp_id,emp_name,job,age)
VALUES(1,"山田太郎","manager",50)
;
INSERT
INTO emp_table(emp_id,emp_name,job,age)
VALUES(2,"伊藤静香","manager",45)
;