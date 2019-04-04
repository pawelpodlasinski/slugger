`docker build . -t slugger`  
`docker run -it -v $(pwd):/data slugger composer install`  
`docker run -it -v $(pwd):/data slugger php vendor/bin/phpunit`
