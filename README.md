Place Search Api
================

RESTfull API to provide search places around choosing radius. 
In other words it can answer to "Where are bars in 2km near me?".

PlaceSearchApi is using [Google Places API](https://developers.google.com/places/web-service/search) as a search source.
But it's possible to integrate different search engine using applications Adapter API.

Requirements
------------
* PHP 7.0
* Silex framework
* MongoDB
* RabbitMQ

Specification
-------------
### Endpoint
The endpoint is `http://place-search.dev/api/v1` where
* `place-search.dev` - development domain
* `api` - indicate that it's api
* `v1` - version parameter

### Resources
Name  | Method | Required parameters    | Optional parameters | Example
---   | ---    | ---                    | ---
bar   | GET    | name, location, radius | lang | GET:bar?location="54.3476107,18.6503288"&radius="2000"

### Parameters
Name     | Type          | Default               | Description | Value range
---      | ---           | ---                   | ---         | ---
location | String,String | 54.3476107,18.6503288 | Comma separated latitude, longitude. Default value is [Neptune’s Fountain in Gdańsk](https://www.google.com.ua/maps/place/Fontanna+Neptuna/@54.3488332,18.6539283,18z/data=!4m13!1m7!3m6!1s0x46fd73a1d2d03071:0x80de874a0a33d731!2sFontanna+Neptuna!3b1!8m2!3d54.348545!4d18.6532295!3m4!1s0x46fd73a1d2d03071:0x80de874a0a33d731!8m2!3d54.348545!4d18.6532295)| For latitude number in range [-90, 90]. For longitude number in range [-180, 180].
radius   | Integer       | 2000                  | Radius over location point in meters | Radius should be in range [1, 50 000]
lang     | String        | en                    | Two character language code | See the [list of supported languages](https://developers.google.com/maps/faq#languagesupport) by Google Places.

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
    data: [
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
    ]
    count: 1,
    link: [
        self: "/bar?location="54.3476107,18.6503288"&radius="2000"
    ],
    code: 200
}
```
where:
* `data` - bar's collection
* `data[0]` - first bar, the bar structure is a limit version of [Google Place Search Response](https://developers.google.com/places/web-service/search#PlaceSearchPaging)
* `count` - number of entities inside collection
* `link` - hypermedia links
* `code` - http status code

The limit for number of bars in response is 20. That limitation is a result of MVP choose and can be extended in next version.
Please view [feature candidate document](FEATURE.CANDIDATE.md) or open an issue to start discussion.

#### Errors
All errors message have one format that is described bellow:
```json
{
    msg: "500 Internal server error",
    code: 500
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
2. Application: RabbitMQ messages listeners, Cache adapters, Logger adapters, Controllers
3. Model (Domain): Repositories, Managers, Repository Factories
4. Data (Domain): value objects, collections, factories

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
