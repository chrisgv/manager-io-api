#  Manager.IO PHP API

### Install Using Composer
  composer require chrisgv/manager-io-api
  
  new Business(http://yourHost/api/,Username,Password,XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX)

### Class Methods
  __all(Category ID)__ : Returns all ID of records in category.
  __add(Category ID, Data Array)__ : Adds data then returns the ID of inserted record.
  __edit(Entity ID, Data Array)__ : Updates record.
  __delete(Entity ID)__ : Deletes record.
  __last()__ : Returns last inserted ID.
