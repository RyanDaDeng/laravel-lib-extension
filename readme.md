
# BaseSubscriber
````PHP
class AuditTrailEventSubscriber extends BaseSubscriber
{
    /**
     * This can either be a one-to-one or one-to-many mappings
     * @var array $eventCollection
     */
    protected $eventCollection = [
        // one listener function can map to multiple events
        'onUpdated' => [
            '{event}',
            '{event}'
        ],
        // one listener function can map to only one event
        'onDeleted' => '{event}'
    ];

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
   
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
      
    }

}
````
