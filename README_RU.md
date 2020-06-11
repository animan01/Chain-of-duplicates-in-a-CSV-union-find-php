Problem/Motivation
--
Поиск дубликатов в CSV файле. Суть задачи состояла в связанном поиска дубликатов в таблице с данными. По требованиям нужно найти из ключевых полей дубликат (в любом поле) и присвоить записи **PARENT_ID** первого вхождения дубликата. Был написан алгоритм который находит дубликаты связывает их и формирует результат с **ID** и **PARENT_ID**.

Пример входных данных (за основу взят файл csv):
```
ID,PARENT_ID,EMAIL,CARD,PHONE,TMP
1,NULL,email1,card1,phone1,
2,NULL,email2,card2,phone2,
3,NULL,email3,card3,phone3,
4,NULL,email1,card2,phone4,
5,NULL,email5,card5,phone2,
6,NULL,email6,card6,phone6,
7,NULL,email3,card9,phone7,
8,NULL,email8,card10,phone8,
9,NULL,email9,card9,phone3,     
10,NULL,email10,card10,phone10,
```

Require
--
- php

How to run it?
--
Выполните в консоли: ``php index.php`` или откройте файл в браузере.

Demo results
--
```
ID,PARENT_ID
1,1
2,2
3,3
4,1
5,2
6,6
7,3
8,8
9,3
10,8
```
PS. Вы можете проверить результат здесь: http://sandbox.onlinephpfunctions.com/
