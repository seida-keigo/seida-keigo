INSERT
INTO character_table(character_id,character_name,pref)
VALUES(1,'ふなっしー','千葉県')
;
INSERT
INTO character_table(character_id,character_name,pref)
VALUES(2,'ひこにゃん','滋賀県')
;
INSERT
INTO character_table(character_id,character_name,pref)
VALUES(3,'まりもっこり','北海道')
;
SELECT*
FROM character_table
;
INSERT
INTO emp_table(emp_id,emp_name,job,age)
VALUES(1,"山田太郎","manager",50)
;
INSERT
INTO emp_table(emp_id,emp_name,job,age)
VALUES(2,"伊藤静香","manager",45)
;
INSERT
INTO emp_table(emp_id,emp_name,job,age)
VALUES(3,"鈴木三郎","analyst",30)
;
INSERT
INTO emp_table(emp_id,emp_name,job,age)
VALUES(4,"山田花子","clerk",24)
;
SELECT emp_id,emp_name
FROM emp_table
;