<?php


use \Exception;

/**
 * Class BaseSubscriber
 * @package ELMORoster\Services\Shared\Subscribers
 */
class BaseSubscriber
{

    /**
     * @var array $eventCollection
     */
    protected $eventCollection = [];

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        foreach ($this->eventCollection as $eventHandlerFunction => $eventClassLocation) {
            $events->listen(
                $eventClassLocation,
                static::class . '@' . $eventHandlerFunction
            );
        }
    }

    /**
     * @return array
     */
    public function getEventCollection()
    {
        return $this->eventCollection;
    }


    /**
     * This is currently used for testing reasons in tests
     * @return bool
     * @throws Exception
     */
    public function validateEventCollection()
    {
        foreach ($this->eventCollection as $eventHandlerFunction => $eventClassLocation) {

            // check if the handler function exists
            if (!method_exists(static::class, $eventHandlerFunction)) {
                throw new Exception($eventHandlerFunction . ' does not exist');
            }

            // check if event exists
            if (is_array($eventClassLocation)) {
                foreach ($eventClassLocation as $class) {
                    if (!class_exists($class)) {
                        throw new Exception($class . ' does not exist');
                    }
                }
            } else {
                if (!class_exists($eventClassLocation)) {
                    throw new Exception($eventClassLocation . ' does not exist');
                }
            }
        }
        return true;
    }
}
