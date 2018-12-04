<?php 
return array (
  'get' => 
  array (
    'test/:action' => 
    array (
      'rule' => 'test/:action',
      'route' => 'TestController/get:action',
      'var' => 
      array (
        'action' => 1,
      ),
      'option' => 
      array (
      ),
      'pattern' => 
      array (
      ),
    ),
    'loc/all' => 
    array (
      'rule' => 'loc/all',
      'route' => 'LocController/all',
      'var' => 
      array (
      ),
      'option' => 
      array (
      ),
      'pattern' => 
      array (
      ),
    ),
    'loc/school' => 
    array (
      'rule' => 'loc/school',
      'route' => 'LocController/school',
      'var' => 
      array (
      ),
      'option' => 
      array (
      ),
      'pattern' => 
      array (
      ),
    ),
    'user/question' => 
    array (
      'rule' => 'user/question',
      'route' => 'UserController/getQuestion',
      'var' => 
      array (
      ),
      'option' => 
      array (
      ),
      'pattern' => 
      array (
      ),
    ),
    'user/info' => 
    array (
      'rule' => 'user/info',
      'route' => 'UserController/getShareCode',
      'var' => 
      array (
      ),
      'option' => 
      array (
      ),
      'pattern' => 
      array (
      ),
    ),
    'user/getloc' => 
    array (
      'rule' => 'user/getloc',
      'route' => 'UserController/getByShareCode',
      'var' => 
      array (
      ),
      'option' => 
      array (
      ),
      'pattern' => 
      array (
      ),
    ),
    'user/over' => 
    array (
      'rule' => 'user/over',
      'route' => 'UserController/submitQuestion',
      'var' => 
      array (
      ),
      'option' => 
      array (
      ),
      'pattern' => 
      array (
      ),
    ),
    'user/rank' => 
    array (
      'rule' => 'user/rank',
      'route' => 'UserController/rank',
      'var' => 
      array (
      ),
      'option' => 
      array (
      ),
      'pattern' => 
      array (
      ),
    ),
    'user/inc' => 
    array (
      'rule' => 'user/inc',
      'route' => 'UserController/shareFunc',
      'var' => 
      array (
      ),
      'option' => 
      array (
      ),
      'pattern' => 
      array (
      ),
    ),
  ),
  'post' => 
  array (
    'test/:action' => 
    array (
      'rule' => 'test/:action',
      'route' => 'TestController/post:action',
      'var' => 
      array (
        'action' => 1,
      ),
      'option' => 
      array (
      ),
      'pattern' => 
      array (
      ),
    ),
    'user/auth' => 
    array (
      'rule' => 'user/auth',
      'route' => 'UserController/login',
      'var' => 
      array (
      ),
      'option' => 
      array (
        'complete_match' => true,
      ),
      'pattern' => 
      array (
      ),
    ),
    'user/up' => 
    array (
      'rule' => 'user/up',
      'route' => 'UserController/updateAddress',
      'var' => 
      array (
      ),
      'option' => 
      array (
      ),
      'pattern' => 
      array (
      ),
    ),
  ),
  'put' => 
  array (
    'test/:action' => 
    array (
      'rule' => 'test/:action',
      'route' => 'TestController/put:action',
      'var' => 
      array (
        'action' => 1,
      ),
      'option' => 
      array (
      ),
      'pattern' => 
      array (
      ),
    ),
  ),
  'delete' => 
  array (
    'test/:action' => 
    array (
      'rule' => 'test/:action',
      'route' => 'TestController/delete:action',
      'var' => 
      array (
        'action' => 1,
      ),
      'option' => 
      array (
      ),
      'pattern' => 
      array (
      ),
    ),
  ),
  'patch' => 
  array (
    'test/:action' => 
    array (
      'rule' => 'test/:action',
      'route' => 'TestController/patch:action',
      'var' => 
      array (
        'action' => 1,
      ),
      'option' => 
      array (
      ),
      'pattern' => 
      array (
      ),
    ),
  ),
  'head' => 
  array (
  ),
  'options' => 
  array (
  ),
  '*' => 
  array (
  ),
  'alias' => 
  array (
  ),
  'domain' => 
  array (
  ),
  'pattern' => 
  array (
  ),
  'name' => 
  array (
    'testcontroller/get:action' => 
    array (
      0 => 
      array (
        0 => 'test/:action',
        1 => 
        array (
          'action' => 1,
        ),
        2 => NULL,
        3 => NULL,
      ),
    ),
    'testcontroller/post:action' => 
    array (
      0 => 
      array (
        0 => 'test/:action',
        1 => 
        array (
          'action' => 1,
        ),
        2 => NULL,
        3 => NULL,
      ),
    ),
    'testcontroller/put:action' => 
    array (
      0 => 
      array (
        0 => 'test/:action',
        1 => 
        array (
          'action' => 1,
        ),
        2 => NULL,
        3 => NULL,
      ),
    ),
    'testcontroller/delete:action' => 
    array (
      0 => 
      array (
        0 => 'test/:action',
        1 => 
        array (
          'action' => 1,
        ),
        2 => NULL,
        3 => NULL,
      ),
    ),
    'testcontroller/patch:action' => 
    array (
      0 => 
      array (
        0 => 'test/:action',
        1 => 
        array (
          'action' => 1,
        ),
        2 => NULL,
        3 => NULL,
      ),
    ),
    'usercontroller/login' => 
    array (
      0 => 
      array (
        0 => 'user/auth',
        1 => 
        array (
        ),
        2 => NULL,
        3 => NULL,
      ),
    ),
    'loccontroller/all' => 
    array (
      0 => 
      array (
        0 => 'loc/all',
        1 => 
        array (
        ),
        2 => NULL,
        3 => NULL,
      ),
    ),
    'loccontroller/school' => 
    array (
      0 => 
      array (
        0 => 'loc/school',
        1 => 
        array (
        ),
        2 => NULL,
        3 => NULL,
      ),
    ),
    'usercontroller/getquestion' => 
    array (
      0 => 
      array (
        0 => 'user/question',
        1 => 
        array (
        ),
        2 => NULL,
        3 => NULL,
      ),
    ),
    'usercontroller/getsharecode' => 
    array (
      0 => 
      array (
        0 => 'user/info',
        1 => 
        array (
        ),
        2 => NULL,
        3 => NULL,
      ),
    ),
    'usercontroller/getbysharecode' => 
    array (
      0 => 
      array (
        0 => 'user/getloc',
        1 => 
        array (
        ),
        2 => NULL,
        3 => NULL,
      ),
    ),
    'usercontroller/updateaddress' => 
    array (
      0 => 
      array (
        0 => 'user/up',
        1 => 
        array (
        ),
        2 => NULL,
        3 => NULL,
      ),
    ),
    'usercontroller/submitquestion' => 
    array (
      0 => 
      array (
        0 => 'user/over',
        1 => 
        array (
        ),
        2 => NULL,
        3 => NULL,
      ),
    ),
    'usercontroller/rank' => 
    array (
      0 => 
      array (
        0 => 'user/rank',
        1 => 
        array (
        ),
        2 => NULL,
        3 => NULL,
      ),
    ),
    'usercontroller/sharefunc' => 
    array (
      0 => 
      array (
        0 => 'user/inc',
        1 => 
        array (
        ),
        2 => NULL,
        3 => NULL,
      ),
    ),
  ),
);