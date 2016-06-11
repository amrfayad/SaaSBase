# SaaSBase
We wanted to build a generic S-a-a-S base, generic so that it can be used by all application to serve all
purposes. So now when a developer wants to develop a S-a-a-S application, the developer can use the
base and continue the remaining modules.

installation steps

go to your local host directory in your operating system

git clone https://github.com/amrfayad/SaaSBase.git

setp 1 : 

      run script  
      
      php .generatekey
      
      
      The output will be something like "hnw1ni567eirjfjxncryhgfydg1nn78n".
      copy key generated to  /config/config.php  and key copy of this key to use it to hash your data before 
      send request to api
      
      for ex.      $config['key'] = 'hnw1ni567eirjfjxncryhgfydg1nn78n';

step 2: 
      open config/config.php
      $config['server'] = 'your host name';
      $config['username'] = 'your username' ;
      $config['password']= 'your password';


step 3:
      
      run script  
      php .dbmigrate
      
step 4:
      create your SAAS Applicatin Views and controllers
      and use our api medules
      
      you must hash data before send it with key genrated instep 1
      
            hashdata exmple in php:
       
       
        $hashed_array = $data;
        $key = 'your key generate in step 1 ';
        $hashed_array['key'] = $key;
        $hash = md5(implode("", $hashed_array));
      
      
      first medule : MemberShip
              actions : 
                      1 - signup with team_id
                            send json like
                            {
                                  data  :{
                                              name:'name',
                                              email:'emil@eample.com',
                                              pass:'password',
                                              team_id:'team id that you invited to join it'   // optional
                                        }
                                  hash : 'hashed data'
                            }
                            
                            response will be 
                            response {
                                        message : "", // text message indicates the response 
                                        status : "", // 200  or 400
                                        user_id : "" // if user succefully regestered 
                                    }
                            
      
      

      
