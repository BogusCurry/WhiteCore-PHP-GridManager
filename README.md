# WhiteCore PHP GirdManager #
***
WhiteCore PHP GridManager is a PHP interface to manage the WhiteCore System in Gridmode.

Currently it is able to Start and Stop the Grid aswell as Running a backup of the GridServer Folder.

##Requirements##

This was tested on Ubuntu and Debian Based Distros on PHP 5.
To get up and Running you will need to execute the following Commands:

```
sudo apt-get update && sudo apt-get install libssh2-1 libssh2-php
```

### To-Do ###
* Backup Mysql
* Ability to Restore MySQL and .tar.gt backup
* See Grid Statistics (Memory Usage and CPU Usage)