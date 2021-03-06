# P4 by Yixie Li (Claire)
![PawBook Logo](public/img/logo.png "Logo")

##Live URL
<http://p4.snowyash.me>

##Description
![PawBook Database Relationship](public/img/db_relationship.png "Database Relationship")

**PawBook** is a convenient and portable minisite for pet owners to save their pet information online. Pet owners will no longer need to carry a piece of paper with pet vaccination record at all times, or look up the internet about their vet information when they are out with their pets anymore. PawBook is easy to register, add information, and refer to.

**PawBook** has a total of 5 tables including the user, pet, vet, vaccine, and pet_vaccine pivot table. User and Pet has one-to-many relationship. Vet and Pet also has one-to-many relationship. Pet and Vaccine has many-to-many relationship. 

###Essential features:
* Register user information, with name and surname
* Add as many pets as you like
* Edit pet information, as well as input the latest vaccination and vet information
* Login and recall pet record on-the-go, on mobile devices as well as ipad

###Bonus feature:
* Email pet information to anyone you want, with email input validation

##Demo
<http://screencast.com/t/E83iSbFfAb>

##Details for the teaching team
* Testing email: yixie@li.com
* Testing password: 1234

##Outside Code
* Twitter Bootstrap: <http://http://getbootstrap.com/2.3.2/>