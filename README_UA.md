Problem/Motivation
--
Пошук дублікатів в CSV файлі. Суть задачі полягала в зв'язаному пошуку дублікатів в таблиці з даними. По вимогам потрібно знайти з ключових полів дублікат (в будь якому полі) і присвоїти запису **PARENT_ID** першого входження дубліката. 

Був написаний алгоритм на PHP який знаходить дублікати зв'язує їх і формує результат з **ID** та **PARENT_ID**.

Приклад вхідних даних (за основу взятий файл csv):
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
Виконайте в консолі: ``php index.php`` або відкрийте файл в браузері.

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
PS. Ви можете перевірити результат тут: http://sandbox.onlinephpfunctions.com/