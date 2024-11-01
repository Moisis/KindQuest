<?

declare(strict_types=1);

interface Client extends BaseAccount{

    
    //event class will be implemented later
    abstract function donate(float $amount, Event event);

}