
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
        'onRosteredShiftCreated' => [
            'ELMORoster\Events\RosteredShiftCreated'
        ],
        // one listener function can map to only one event
        'onRosteredShiftUpdated' => 'ELMORoster\Events\RosteredShiftUpdated',
        'onTimesheetCreated' => 'ELMORoster\Events\TimesheetCreated',
        'onShiftOfferApproved' => 'ELMORoster\Events\ShiftOfferApproved',
        'onShiftOfferDeclined' => 'ELMORoster\Events\ShiftOfferDeclined',
        'onShiftOfferDeleted' => 'ELMORoster\Events\ShiftOfferDeleted',
        'onShiftSwapApproved' => 'ELMORoster\Events\ShiftSwapApproved',
        'onShiftSwapDeclined' => 'ELMORoster\Events\ShiftSwapDeclined',
    ];

    /**
     * @param $event
     */
    public function onRosteredShiftUpdated($event)
    {
        AuditTrailQuery::logAuditTrailByShift(
            $event->shift,
            'rosteredshift',
            'Update rostered shift'
        );
    }

    /**
     * @param $event
     */
    public function onRosteredShiftCreated($event)
    {
        AuditTrailQuery::logAuditTrailByShift(
            $event->shift,
            'rosteredshift',
            'Create rostered shift'
        );
    }


    /**
     * @param $event
     */
    public function onTimesheetCreated($event)
    {
        // TODO
//        AuditTrailQuery::logAuditTrailByTimesheet(
//        );
    }

    /**
     * @param \ELMORoster\Events\ShiftOfferApproved $event
     */
    public function onShiftOfferApproved($event)
    {
        AuditTrailQuery::logAuditTrailByShift(
            $event->shiftTrade->rostered_shift,
            'offer',
            'Approve offer proposal'
        );
    }

    /**
     * @param \ELMORoster\Events\ShiftOfferDeclined $event
     */
    public function onShiftOfferDeclined($event)
    {
        AuditTrailQuery::logAuditTrailByShift(
            $event->shift,
            'offer',
            'Decline rosteredshift offer'
        );
    }

    /**
     * @param \ELMORoster\Events\ShiftOfferDeleted $event
     */
    public function onShiftOfferDeleted($event)
    {
        AuditTrailQuery::logAuditTrailByShift(
            $event->shift,
            'offer',
            'Delete rosteredshift offer'
        );
    }

    /**
     * @param \ELMORoster\Events\ShiftSwapApproved $event
     */
    public function onShiftSwapApproved($event)
    {
        AuditTrailQuery::logAuditTrailByShift(
            $event->shiftTrade->rostered_shift,
            'swap',
            'Approve swap proposal'
        );
        AuditTrailQuery::logAuditTrailByShift(
            $event->shiftTrade->selected_proposal->rostered_shift,
            'swap',
            'Approve swap proposal'
        );
    }

    /**
     * @param \ELMORoster\Events\ShiftSwapDeclined $event
     */
    public function onShiftSwapDeclined($event)
    {
        AuditTrailQuery::logAuditTrailByShift(
            $event->shift,
            'swap',
            'Decline rosteredshift swap'
        );
    }

}
````
