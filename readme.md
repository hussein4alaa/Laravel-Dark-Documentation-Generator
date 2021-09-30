# Laravel Dark Documentation Generator 💥
### you can create Documentation for your api easily by using this library



## Installation:
Require this package with composer using the following command:

```sh
composer require g4t/documentation
```

```sh
php artisan vendor:publish --provider=g4t\Documentation\DocumentationServiceProvider
```

## Default Endpoints
##### For documentation `http://yoururl/g4t/doc` 
##### For json `http://yoururl/g4t/json` 
You can change this endpoints from `config/documentation.php`
```sh
<?php
return [
    'json_url' => 'g4t/json',
    'documentation_url' => 'g4t/doc'
];
```


## Usage
##### when you create route in api.php this package will work 😉
##### if you send data in body or query params You should add some comments before function 😔
### Example:
```sh
    /**
     * start FunctionName function
     * auth
     * title: get user by id
     * string $name required
     * int $number
     * email $email required
     * password $password
     * file $image
     * end FunctionName function
     */
```

### Comment Explain
Comment | Description | Status
--------- | ------- | -------
`start FunctionName function` | you should write function Name in `FunctionName` | Required
`auth` | if this function need auth , if you using auth middleware on route you don't need to add this comment | not Required
`title:` | This title will show in documentation , if this not found will use function name | not Required
`string $name required` | name column is string and required | 
`int $number` | number column is integer and not required | 
`email $email required` | email column is string and input type in documentation is email and required | 
`password $password` | password column is string and input type in documentation is password and not required | 
`file $image` | image column is string and input type in documentation is image and not required | 
`end FunctionName function` | you should write function Name in `FunctionName` | Required



### License

Laravel Dark Documentation Generator is free software licensed under the MIT license.
