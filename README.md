Litle Online cakePHP demo web application
=====================

About Litle
------------
[Litle &amp; Co.](http://www.litle.com) powers the payment processing engines for leading companies that sell directly to consumers through  internet retail, direct response marketing (TV, radio and telephone), and online services. Litle & Co. is the leading, independent authority in card-not-present (CNP) commerce, transaction processing and merchant services.

About the CakePHP Demo
---------------------
The cakePHP demo application utilizes the Litle SDK for PHP in order to process various transactions. The cakePHP demo application is publically hosted but can also be setup to run locally. Upon opeing the application the demo app will guide you through the transaction process. This application supoorts authorization, capture, refund, credit, authorization reversal, tokenization and sale transactions.

To Set Up Locally
-----------------
- Download repository from git

> git clone git://github.com/LitleCo/litle-cakePHP-integration.git

- Run Litle PHP SDK setup in console

> php app/Lib/litle/Setup.php

- Create a symbolic link to the folder or drop it into the /var/www/html directory

> ln -s ~git/litle-cakePHP-integration /var/www/html/LitleCakePHP

- Import the table into mysql, adjust the app/config/database file to match your database settings

> mysql -u user cake<~/git/litle-cakePHP-integration/app/Config/Schema/litleDemoTable.sql

- Navigate to litle-cakePHP-integration/index.php inside a browser to view demo web application

Please contact Lilte & Co. with any further questions. You can reach us at SDKSupport@litle.com
