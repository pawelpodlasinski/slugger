### Build   
```
docker build . -t slugger  
docker run -it -v $(pwd):/data slugger composer install  
docker run -it -v $(pwd):/data slugger php vendor/bin/phpunit
```

### Usage
```
Slugger::setUp('someSalt', 8);   
$slug = Slugger::encode(5);
$slug2 = Slugger::encodeMany('1-2-3');

$int = Slugger::decode($slug);
$string = Slugger::decodeMany($slug2);
```
