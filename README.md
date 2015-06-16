#Iowa Climate Calendar
##What is it?
A Drupal(7.x)/Angular(1.4) based site for listing climate change related events. It supports filtering of the events by proximity to
a zip code, filtering by event type, and subscribing to a weekly email of the climate events. Additionally, event 
administrator accounts can be created so multiple people can add events to the site. Currently it's configured for the
state of Iowa, but can easily be customized for other states.

##Installation
Set up the site with your webserver and [install Drupal](https://www.drupal.org/documentation/install). It should default to the Iowa Climate Calendar profile which will
install all the needed themes, roles, views, services, etc. After Drupal is done installing you should see this screen:
![screenshot of Iowa Climate Calendar](http://i.imgur.com/1VITHYy.png)

You'll have to search the code to change the instances of 'Iowa' to whatever other entity you want.

For the weekly emails to work you'll need to set up a 3rd party transactional mailing service. I used Mandrill which
gives you 12,000 free sends per month. This connection info needs to be put here: 
http://iowaclimatecalendar.loc/admin/config/system/smtp

Contact me if you get stuck!


##Caveats
This site was written quickly with no tests and little refactoring. Sorry!

##License
Sed the LICENSE file

