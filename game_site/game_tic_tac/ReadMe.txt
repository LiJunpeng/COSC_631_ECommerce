1- Copy the project folder in to your WAMP or MAMP folder.
2- Install Composer: https://getcomposer.org/ 
*****There are windows, linux, and ubuntu versions for composers. You can find the installation guide here: https://getcomposer.org/doc/00-intro.md or http://www.dev-metal.com/install-update-composer-windows-7-ubuntu-debian-centos/.
3- Install Ratchet: php ~/composer.phar require cboden/ratchet
4- run php bin/chat-server.php
5- Open the index.html file located in the public folder two times
6- Then start playing the game!


Directory structure:—————
I have the following directories based on the link: http://brettrawlins.com/simple-chat-application-in-php-using-ratchet/. I have implemented the tic tac toe by extending the example here: http://socketo.me/docs/hello-world

“bin”:  Holds the web socket server file. This will run in the background listening for connections and handling events.
“public”:  All of our client code goes here. This is the web document root.
“src”:  Holds our custom server side code
“vendor”:  For third-party PHP libraries managed by Composer.


