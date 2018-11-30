# DEMO PAYMENTS

### Abstract
The new billing system we are developing has the following constraints that will dictate some of
the design decisions that need to be done:
- Multiple billing gateways: The company uses 3rd party billing solutions and requires a flexible
and extensible system to support them. Those solutions can be traditional Credit Card
gateways (i.e. LocalBilling), PayPal like solutions, Money-less payment solutions (i.e.
Paygarden) and CryptoCurrencies.
- A particular payment should be potentially sent in a fallback strategy to a different
compatible gateway in case of a decline or in a particular set of conditions (i.e. risk level)
- The system must offer a payment solution to all CMP product catalogue with their own
look & feel but from a centralised service approach.
- Billing context needs to notify about the results to other applications / parts of CMP
system (i.e. Membership management)
- Extensive logging (audit logs) and transaction traceability are a must.

### Exercises

You are requested to propose a potential solution to implement this system.
1. Present your proposal including
a. A technical brief on the proposed solution
b. Basic block design of the system
c. Define the core/main E/R diagram for your proposed solution
2. Present a basic (placeholder like) implementation for a basic payment flow supporting 2
billers in a cascade. There is no need to implement the actual functionality fully (i.e.
persistence or hitting the payment gateway can be replaced by a text output)
3. Prepare unit and or functional tests for the implemented classes in the previous point
4. Considering your proposal needs to run in isolation in the cloud, define the Amazon Web
Services architecture that will be needed to host and run it with some detail on the
particular services selected for it.

### Solution

**Exercise 1** is located in folder: **"docs/proposal"**
**Exercise 4** is located in folder: **"docs/aws"**

To execute **Exercise 2 and Exercise 3** execute the following instructions:

First of all, you need to do a "git clone" of this project and after that, composer install:
```
git clone https://github.com/spvernet/demo_payment.git demo_payment
cd demo_payment
composer install
```
Then, we run the server:
```
php bin/console server:run (default url localhost:8000)
```
Once the server is up, we can use postman and call the following endpoint 

```
+ POST localhost:8000/payment -> sending as a parameters a json like this one: 
{
	"amount":"250",
	"card_number":"1111222355559999",
	"cvv": "123",
	"expiration": "09/20",
	"full_name": "test test test"
}

+ POST localhost:8000/payment -> sending as a parameters a json like this one: 
{
	"amount":"300",
	"email":"test@gmail.com",
	"password": "123456789"
}

```

### Tests
This project has tests, that we can execute with the following command:

```
php bin/phpunit 
```
Note: To keep it simple, we use a logger that print the information on stdout.
As a consequence, is posible that during the test execution we see on the screen the info that would be wrote in the logs file   
