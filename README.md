#  Manager.IO PHP API #

### Install Using Composer ###

  `composer require chrisgv/manager-io-api`
  
  Business(Host,Username,Password,Business ID)
  
  `new Business(http://yourHost/api/,Username,Password,XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX)`

### Class Methods ###


  __all(Category ID)__ : Returns all ID of entities in category.
  
  __add(Category ID, Data Array)__ : Adds data then returns the ID of inserted entity.
  
  __edit(Entity ID, Data Array)__ : Updates record.
  
  __delete(Entity ID)__ : Deletes record.
  
  __last()__ : Returns ID of last inserted entity.
