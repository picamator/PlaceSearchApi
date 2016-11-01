Feature Candidate
=================
Features that are nice to have. It's like a TODO for putting in issues list.

Id  | Summary                                               | Description
--- |---                                                    | --- 
1   | Support location in Degrees/minutes/seconds           | 37º41'26"N 97º20'0"W or 37º41'26" –97º20'0"
2   | Alternatively set version number in header            | 
3   | Alternatively set language in header                  |
4   | Put limitation over request number for one session    | 
5   | Extend number of search result up to 60               | Use next_page_token, more details is [here](https://developers.google.com/places/web-service/search#PlaceSearchPaging)
6   | Add more resources                                    | See full list of Google supported [places types](https://developers.google.com/places/web-service/supported_types)
7   | Use Elesticsearch to keep search result               | It'll decrease requests to Google service
8   | Add configuraton structure validator                  | [TreeBuilder](http://symfony.com/doc/current/components/config/definition.html)
9   | Add configuration caching                             |
10  | Add better user data validation                       | 
11  | Add automatic documentation                           | Make all examples tested
12  | Add more examples how to customize                    | 
13  | Add loaded tests to understand real capacity          |
14  | Optimize performance                                  | Concentrate on nested loops and possibility to reuse objects, apply iterators where it's needed
15  | Use RabbitMQ for keeping logs out of execution scope  | [RabbitMQ](https://www.rabbitmq.com), [RabbitMQ docker](https://hub.docker.com/_/rabbitmq/)
16  | Add cache using MongoDB                               | [Mongodb pecl](https://github.com/mongodb/mongo-php-library), [MongoDB](https://www.mongodb.com/),  [MongoDB docker](https://hub.docker.com/_/mongo/)
17  | Prevent saving duplicate information to cache         | 
18  | Add logs errors and tech data                         |     
