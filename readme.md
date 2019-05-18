#### prerequisites
install docker and docker-compose

#### Installation 
 1- clone the project
 
    $ git clone https://github.com/abdelrahmanbadr/race-simulation-backend
    
2- run the following command `make init` (this command will build , make host for the app, up docker-compose in background,
composer install, change permission for storage and public folder and finally will copy .env.example to .env)

Notice: in case it did not work you'll just need to update your hosts file `/etc/hosts` with `127.0.0.1 race-simulation.local`
you can replace `127.0.0.1` with your docker host machine ip.

#### API Usage:

1- `http://race-simulation.local:8090/api/horse-races` it can be used through Get or Post http method.
Get method to get all current running races
Post method to create new race

2- `http://race-simulation.local:8090/api/horse-races/advance` it can be used through Get http method.
Used to advance all running races with 10 seconds

3-`http://race-simulation.local:8090/api/horse-races/results` it can be used through Get http method.
To get results of best horse ever stats and top 3 horses foreach race in the last 5 races

#### Design Pattern
- Factory Design Pattern : To create object without exposing the creation logic eg HorseFactoryService.
- Repository: To abstract the data layer, making our application more flexible to maintain.

#### Project structure
- Domain : The domain layer is the heart of the software, and this is where the interesting stuff happens.
- Contracts : Has all interfaces of horse race simulation domain.
- Constants : Has all constants related to the horse race simulation domain.
- Repositories : Has EloquentHorseRaceRepository and EloquentHorseRepository
- Models : Has all entity models of horse race simulation domain.
- Services :  Services  used to hide and encapsulate App Logic.
- Transformers :  Used to transform the response to match the front-end need.

#### These are the other available command you might need in the future
- stop all containers `make stop_all_containers`

- remove all containers `make clear_containers`

- remove all images `make clear_images`

#### Running Unit tests:
    $ make phpunit_test
    
    
#### Improvments and Nice to have (@todo):
    1- Instead of calling endpoints repeatedly, it's better to use socket.io
    2- Instead updating the horses time_to_finish fro http request, it's better to make crone job for this update.
    3- Write more test cases to increase code coverage
   
 