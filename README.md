Problem/Motivation
--
Find duplicates on CSV file. The problem was the related search for duplicates in the data table. As required, need to find a duplicate from the key fields (in any field) and assign the **PARENT_ID** record of the first occurrence of the duplicate.

The algorithm on PHP is finds chain of duplicates and generates a result with **ID** and **PARENT_ID**.

Example of input data (based on the csv file):
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
Run on console: ``php index.php`` or open in browser.

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
PS. You can check results on: http://sandbox.onlinephpfunctions.com/
