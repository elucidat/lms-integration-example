# Elucidat LMS integration example

This App is intended to demonstrate how the Elucidat API would work from an LMS's point of view.

It is built in CodeIgniter 3, to work on a LAMP stack.


## Installation

### 1.
To get it running, create a database for the project using the db_schema.sql file at the root of the repository.
Put your database access details into:

```
application/config/database.php
```
(There is an example config files to copy in application/config/examples/database.php)

### 2.
Next, put your Elucidat API credentials into 

```
application/config/elucidat.php
```
(There is an example config files to copy in application/config/examples/elucidat.php)

PLEASE NOTE: This App is designed for Elucidat Reseller Accounts. Not all of it will work if you do not have an Elucidat Reseller account. Please get in touch with support@elucidat.com if you are not sure.

### 3.
Then - point your web server at the public_html folder.

Remember that the API will create accounts for you in Elucidat, which will normally be paid for. So please talk to us before you start development - so that we can arrange for the accounts that create to be non-billed.


## Where the files are

In CodeIgniter, the controllers are stored in

```
application/controllers
```
(you'll be able to see what each action is doing there)

We have also included a 'library' class to interact with Elucidat. This is stored in

```
application/libraries/elucidat.php

```
(you may wish to copy this class into your application)



## Questions?

Don't hesitate - hit us up: support@elucidat.com


---
Copyright Elucidat Ltd, 2015
