# Postcode Importer Tech Test

## Introduction
This application was built using a lightweight framework by Laravel called Laravel Zero. This is simply the console
part of the framework making it very small.

## Requirements
* PHP 8.2
* php-json
* php-zip

## Setup
To set up the project, run `composer install` from the root directory.

### Database
Migrate database `php postcode-cli migrate`

## Executing Commands
#### Import
`php postcode-cli postcode:import`

#### Fetch By Partial Postcode String
`php postcode-cli postcode:import --postcode=ME1`

#### Fetch By Latitude and Longitude
Sadly, this was not completed due to difficulties with the data, please see comments below.

## Testing
PHP Pest is the test suite, has PHPUnit running underneath.

Run tests `./vendoe/bin/pest`

## Comments
Although the commands work as expected, I feel the importer maybe on the slow side, the data from Ordnance Survey, is 
very large. the data also only provides Eastings and Northings as coordinate data, the meant having a command to search
via Latitude and Longitude unachievable. From further readings, the conversion calculation is somewhat hard and
making an additional query to an API to make the conversion possible, pointless to the already heavy import.

Having said that, the Import, Downloader and CsvFile classes as have contracts to allow the easy replacement of 
other classes if we choose to make business decisions on type of file we want to import or location of source data.

I have also, tried a DDD approach focusing my implementations around the Domain which is postcode. This allowed the 
application to be small, with the domain architecture obvious and understandable.

## Improvements
#### Performance
Performance is not a great, the amount of data importing is huge, over a million rows. 
With this in mind I have chunked the data into chunks of 10, on hindsight this, we may have
been able to do this in bigger chunks or by file.

Probably add some benchmarking in to the importer might have been good.

#### Testing
Would have liked to have created a few more tests around exceptions.

I would have also, liked to of created some tests around the contracts to demonstrate swapping implementations of 
specific objects.  

#### Migration Factories/Seeder
No use of factories or seeders which may have sped up the process of handling data and testing.
This was due to the fact I went for a DDD approach and find Models and Entities don't work well together.