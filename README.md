Yii-ECCvalidator2
=================


## 1. Credit Card Validator
## 2. Credit Card type recognition
## 3. Credit Card image tags creator
 
The validator implements Mod 10 algorithm to validate a credit card number.  
Also checks if its prefix and expiration date are correct.
  
References of the Mod 10 algorithm
http://en.wikipedia.org/wiki/Luhn_algorithm#Mod_10.2B5_Variant

Here is the list of the recognized credit/debit cards:

1. American Express
1. Visa
1. Mastercard
1. Discover
1. Maestro
1. Solo
1. Electron
1. JCB
1. Voyager
1. Diners_Club
1. Switch
1. Laser

There is an option to choose smaller subset if you do not want to validate/recognize all of the cards. 
