# sampahku-api
Humans are getting more, so thus there are more and more dangerous wastes. However, people still do not dispose of wastes properly, they do not even know how to sort them. For this reason, SampahKu web service was created which contains a guide on how to sort and manage wastes. Besides, you can search the nearest landfill from your house, so don't throw them to river, lake, and another places that aren't proper for wastes collecting. SampahKu project consists of two part, sampahku-api as an RESTful API end-point and SampahKu located in other repository as an website to interact with user.

## Architecture and Infrastructure Design
The picture above is the architecture and infrastructure of the proposed web service. This figure explains how the schematic of a RESTful web service and the data flow that occurs.

## Front-End and Back-End Design
### Resources
+ Resources contained in this service are:
+ Gadget
+ User
+ Waste collector
+ Integrated Waste Processing Site (TPST)
+ Garbage
+ Article
+ Form

### Representation
Once the resource is identified, a standard format is determined so that the server can send the resource and the client can understand the same format. Today most web services represent resources using the JSON format.

### HTTP Methods
The resource URI and its representation have been defined. Next it is necessary to define possible operations on the website and map these operations on the resource URI. Website users can perform browsing, creation, update or deletion operations. Here is the http method to use.

Landfill
+ GET, POST: /landfill 
+ GET, PUT, DELETE: /landfill/{id} 

Waste
+ GET, POST: /waste 
+ GET, PUT, DELETE: /waste/{id} 

Article
+ GET, POST: /article 
+ GET, PUT, DELETE: /article/{id} 
