<?php

// Restaurant soft deletes
Schedule::command('delete:soft-deletes')->daily()->withoutOverlapping();
// To test, replace daily() with everyMinute()

Schedule::command('cancel:outdated-orders')->everyThirtyMinutes()->withoutOverlapping();
// To test, replace everyThirtyMinutes() with everyMinute()
