<?php

// Verwijder soft-deleted Restaurants, om te testen wijzig daily() naar everyMinute()
Schedule::command('delete:soft-deletes')->daily()->withoutOverlapping();

// Annuleer verlopen bestellingen, om te testen wijzig EveryThirtyMinutes() naar EveryMinute()
Schedule::command('cancel:outdated-orders')->everyThirtyMinutes()->withoutOverlapping();
