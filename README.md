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
1. Download repository from git

>git clone git://github.com/LitleCo/litle-cakePHP-integration.git

2. Download and setup cakePHP 

3. Replace the app folder in cakePHP with the app folder for the git repository

4. Import the database to mysql
 mysql -u LitleCakePHP cake<~rganmukh/git/litle-cakePHP-integration/app/Config/Schema/filename.sql

5. navigate to litle-cakePHP-integration/index.php inside a browser to view demo webb application

