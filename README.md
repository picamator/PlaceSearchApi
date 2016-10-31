Place Search Api
================

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/3d5ba498-102e-43de-8b16-f8f53b95a080/mini.png)](https://insight.sensiolabs.com/projects/3d5ba498-102e-43de-8b16-f8f53b95a080)

Master
------
[![Build Status](https://travis-ci.org/picamator/PlaceSearchApi.svg?branch=master)](https://travis-ci.org/picamator/PlaceSearchApi)
[![Coverage Status](https://coveralls.io/repos/github/picamator/PlaceSearchApi/badge.svg?branch=master)](https://coveralls.io/github/picamator/PlaceSearchApi?branch=master)

Dev
---
[![Build Status](https://travis-ci.org/picamator/PlaceSearchApi.svg?branch=dev)](https://travis-ci.org/picamator/PlaceSearchApi)
[![Coverage Status](https://coveralls.io/repos/github/picamator/PlaceSearchApi/badge.svg?branch=dev)](https://coveralls.io/github/picamator/PlaceSearchApi?branch=dev)

RESTfull API to provide search places around choosing radius. 
In other words it can answer to "Where are bars in 2km near me?".

PlaceSearchApi is using [Google Places API](https://developers.google.com/places/web-service/search) as a search source.
But it's possible to integrate different search engine using applications Adapter API.

Requirements
------------
* [PHP 7.0](http://php.net/manual/en/migration70.new-features.php)
* [Silex](http://silex.sensiolabs.org/)
* [MongoDB](https://www.mongodb.com/)
* [Mongodb pecl](https://github.com/mongodb/mongo-php-library)
* [RabbitMQ](https://www.rabbitmq.com)

Installation
------------
* Run composer install --no-dev
* Create `/config/parameters.yaml` and put data using [parameters.yaml.dist](config/parameters.yml.dist) as example

Specification
-------------
### Endpoint
The endpoint is `http://place-search.dev/api/v1` where
* `place-search.dev` - development domain
* `api` - indicate that it's api
* `v1` - version parameter

### Resources
Name  | Method | Required parameters    | Optional parameters   | Example
---   | ---    | ---                    | ---                   | ---
bar   | GET    | location, radius       | language              | GET:bar?location="54.3476107,18.6503288"&radius="2000"

### Parameters
Name     | Type          | Default               | Description | Value range
---      | ---           | ---                   | ---         | ---
location | String,String | 54.3476107,18.6503288 | Comma separated latitude, longitude. Default value is [Neptune’s Fountain in Gdańsk](https://www.google.com.ua/maps/place/Fontanna+Neptuna/@54.3488332,18.6539283,18z/data=!4m13!1m7!3m6!1s0x46fd73a1d2d03071:0x80de874a0a33d731!2sFontanna+Neptuna!3b1!8m2!3d54.348545!4d18.6532295!3m4!1s0x46fd73a1d2d03071:0x80de874a0a33d731!8m2!3d54.348545!4d18.6532295)| For latitude number in range [-90, 90]. For longitude number in range [-180, 180].
radius   | Integer       | 2000                  | Radius over location point in meters | Radius should be in range [1, 50 000]
language | String        | en                    | Two character language code | See the [list of supported languages](https://developers.google.com/maps/faq#languagesupport) by Google Places.

### Response
#### Bar
Here is request-response example for Bar resource
Request:
```
GET:bar?location="54.3476107,18.6503288"&radius="2000"
```

Response:
```json
{
    "data": [
        {
            "id" : "21a0b251c9b8392186142c798263e289fe45b4aa",
            "placeId" : "ChIJyWEHuEmuEmsRm9hTkapTCrk",
            "location" : {
               "lat" : -33.870775,
               "lng" : 151.199025
            },
            "name" : "Rhythmboat Cruises",
            "icon" : "http://maps.gstatic.com/mapfiles/place_api/icons/travel_agent-71.png",
            "vicinity" : "Pyrmont Bay Wharf Darling Dr, Sydney",
            "scope" : "GOOGLE"
        }
    ],
    "count": 1,
    "code": 200
}
```
where:
* `data` - bar's collection
* `data[0]` - first bar, the bar structure is a limit version of [Google Place Search Response](https://developers.google.com/places/web-service/search#PlaceSearchPaging)
* `count` - number of entities inside collection
* `code` - http status code

The limit for number of bars in response is 20. That limitation is a result of MVP choose and can be extended in next version.
Please view [feature candidate document](FEATURE.CANDIDATE.md) or open an issue to start discussion.

#### Errors
All errors message have one format that is described bellow:
```json
{
    "msg": "500 Internal server error",
    "code": 500
}
```

#### HTTP codes
Table bellow shows list of supported HTTP codes.
Code | Message                      | Description
---  | ---                          |              
500  | 500 Internal Server Error    | Critical application error
501  | 501 Not Implemented          | HTTP method was not implemented for that resource
404  | 404 Not Found                | Resource was not found

Architecture
------------
Architecture is based on Hexagonal Architecture. To see what that architecture involve please visit:

1. [Matthias Noback: "Hexagonal architecture - message-oriented software design"](https://vimeo.com/153825261), [PHPCon-2015](http://www.phpcon.pl/2015/en)
2. [Fideloper: Hexagonal Architecture](http://fideloper.com/hexagonal-architecture) 

PlaceSearchApi has those layers:

1. Framework: Silex
2. Application: App
3. Domain: Search, Engine, Command
4. Core Domain: Model

### RabbitMQ
[RabbitMQ](https://www.rabbitmq.com) is using to execute technical tasks such as logging, caching without impact to current request.
 
Queue               | Message | Description
---                 | ---     | ---  
logData             | '{"level": "info", "msg": "Data was send to 3-rd party server"}' | Log technical data
saveCache           | '{"id": ...}' | Save data to cache

### MongoDB
[MongoDB](https://www.mongodb.com/) serves as a data storage for:

* logger's data
* cache

### Cache
Cache is used if user does not change location in 4 square meters.
It's automatically invalidate after 24 hours. 

Moreover it's implemented functionality to avoid saving duplicate information in cache.
In other words cache key builds based on query parameters and contains only list of location coordinates.
But each entity saves in separate cache.

Extensibility
-------------
PlaceSearchApi follows loyer architecture with DI using Interfaces therefore it's possible to provide any modification.

### How to change Framework
PlaceSearchApi is using Silex with controllers as a services so to use aoother frmaework ti's need:

* inject controllers services to new ones
* put DI instantiating to new frameworks bootstrap

### Add new place type
PlaceSearchApi supports for now `Bar` to add more places it's need only send parameter to `Service/Place/GetService`.

### Extend response data
To make possible return working hours in api response it's need:

* update `Model\Data\Place` value objects interface and builders
* update `Engine\GoogleSearchPlace\SchemaCollectionFactory`

### Use different HTTP client
* implement interface `Search\Api\Http\ClientInterface`
* update DI configuration

Dependency
----------
That section describes how PlaceSearchApi deals with dependency.

### Framework dependency
PlaceSearchApi does not have Framework dependency:

* all controllers are services
* domain does not use Frameworks components

### 3-rd party dependency
PlaceSearchApi uses own Interfaces and wrappers over 3-rd party applications additionally it's catch and resent own Exceptions.

### Code coupling
Having layer architecture additional with composition bring independent and clear communication between modules.

Here is a list of rules that were placed over PlaceSearchApi:

* layer SHOULD throw only it's own exceptions
* message SHOULD go directly from top layer to inner one not vice versa
* using interfaces as dependency
* keeping value objects immutable
* depending on abstraction

Documentation
-------------
* UML class diagram: [class.diagram.png](doc/uml/class.diagram.png)
* Use case diagram: [activity.diagram.png](doc/uml/activity.diagram.png)
* Component diagram: [activity.diagram.png](doc/uml/component.diagram.png)

Developing
----------
To configure developing environment please:

1. [Install and run Docker container](dev/docker/README.md)
2. Run inside project root in Docker container `composer install` 

### Debug
Docker container is configured to use xDebug.

### Proxy
Please use proxy client to see requests to Google Places API, e.g. [Fiddler](https://www.telerik.com/download/fiddler)
for Windows or [Fiddler for Mono](http://fiddler.wikidot.com/mono) for Linux machine. 
  
Future features candidates
--------------------------
Feature candidates are in separate [file](FEATURE.CANDIDATE.md). 
It's a list of ideas that were appeared during development process.
After review some of them will be moved to [issues](https://github.com/picamator/PlaceSearchApi/issues?utf8=%E2%9C%93&q=is%3Aissue%20is%3Aopen%20label%3A%22feature%22) with `feature` label.

Contribution
------------
If you find this project worth to use please add a star. Follow changes to see all activities.
And if you see room for improvement, proposals please feel free to create an issue or send pull request.
Here is a great [guide to start contributing](https://guides.github.com/activities/contributing-to-open-source/).

Please note that this project is released with a [Contributor Code of Conduct](http://contributor-covenant.org/version/1/4/).
By participating in this project and its community you agree to abide by those terms.

License
-------
PlaceSearchApi is licensed under the MIT License. Please see the [LICENSE](LICENSE.txt) file for details.
