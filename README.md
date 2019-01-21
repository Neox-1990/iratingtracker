# iratingtracker
Quick and dirty tracker api for iRacing driverstats i created mainly to make the signup process for [Sports Car Open](https://sportscaropen.eu) easier and keep the data there up to date.
The mainsource for the data are the CSV Files iRacing updates daily on their S3-Cloudstorage and is accesible from the outside. Those Files contain all drivers and their statistic for each division (road, oval, dirtroad and dirtoval).

The whole project is split in two parts:

## irt_cron
This part is for fetching the files from the S3-Storage and reading the data from the CSV-files into a database (in this case a MySQL database).

## irt_api
This part implements the data fetching. After the tracker is initialized, you can register actions which response to api-calls and fetch the data after some token-authentication as JSON.
In the example-folder you find the example implementation of this project, which is basically the implmentation that runs on [http://irt.rnld.io] .

Feel free to use this for your own project or [contact me](dev@ronaldg.de) if you would like to have access to my example implementation.

###TODOS
* actually use the filter-parameter in the actions
* more elaborate access control using the flag
* request throttling
* Unittests ...
