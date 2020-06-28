Alhoritm
--
[Disjoint-set/Union-find Forest](https://ru.wikipedia.org/wiki/%D0%A1%D0%B8%D1%81%D1%82%D0%B5%D0%BC%D0%B0_%D0%BD%D0%B5%D0%BF%D0%B5%D1%80%D0%B5%D1%81%D0%B5%D0%BA%D0%B0%D1%8E%D1%89%D0%B8%D1%85%D1%81%D1%8F_%D0%BC%D0%BD%D0%BE%D0%B6%D0%B5%D1%81%D1%82%D0%B2)

Problem/Motivation
--
Поиск дубликатов в CSV файле. Суть задачи состояла в связанном поиска дубликатов в таблице с данными. По требованиям нужно найти из ключевых полей дубликат (в любом поле) и присвоить записи **PARENT_ID** первого вхождения дубликата. Было решено использовать **Union find**, алгоритм который реализовали на PHP находит дубликаты связывает их и формирует результат с **ID** и **PARENT_ID**.

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
