# Super Ultra Awesome SMS Gateway on RPI  #

IT'S ALIVE, intr-o oarecare masura

### Seding ###

* api-ul baga in DB
* in 30 de secunde se incearca trimiterea sms-ului
* daca ceva se intampla si sms-ul nu este trimis, se incearca sa se mai trimita de 3 ori, daca nu se trimite de cele 3 ori, se merge mai departe 

### Updates ###

* Cron Locking (no more bugs)
* Restructurat foldere
* added finder.sh
* added cron installer.sh 

### Benchmarks ###

* 100 sms-uri in 14 minute. => 7.1 sms-uri / minut in Vodafone

### Hooking ###

Expect post data

### Status Codes ###

* 200: everything OK
* 400: [major fail](http://cdn.lolhappens.com/wp-content/uploads/2012/12/Majorwedgiefail.jpg)