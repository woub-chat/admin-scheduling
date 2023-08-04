<?php

namespace Admin\Extend\AdminScheduling\Extension;

use Admin\Core\NavigatorExtensionProvider;
use Admin\Extend\AdminScheduling\SchedulingController;
use Admin\Interfaces\ActionWorkExtensionInterface;

/**
 * Class Navigator
 * @package Admin\Extend\AdminScheduling\Extension
 */
class Navigator extends NavigatorExtensionProvider implements ActionWorkExtensionInterface {

    /**
     * @return void
     */
    public function handle(): void
    {
        $this->item(
            'Task scheduling',
            'task_scheduling',
            [SchedulingController::class, 'index']
        )->icon_flask();
    }
}
