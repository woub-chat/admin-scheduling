<?php

namespace Admin\Extend\AdminScheduling;

use Admin\Delegates\Buttons;
use Admin\Delegates\Card;
use Admin\Delegates\CardBody;
use Admin\Delegates\ChartJs;
use Admin\Delegates\ModelTable;
use Admin\Delegates\SearchForm;
use Admin\Delegates\StatisticPeriod;
use Admin\Page;
use Admin\Controllers\Controller;
use Lar\Layout\Respond;

class SchedulingController extends Controller
{
    static int $counter = 0;

    public function index(
        Page $page,
        Card $card,
        CardBody $cardBody,
        StatisticPeriod $statisticPeriod,
        ChartJs $chartJs,
        SearchForm $searchForm,
        ModelTable $modelTable,
        Buttons $buttons,
    ) {
        $data = (new Scheduling())->getTasks();

        return $page->card(
            $card->title('Tasks'),
            $card->model_table(
                $modelTable->model($data),
                $modelTable->col('Task', 'task'),
                $modelTable->col('Expression', 'expression')->badge('success'),
                $modelTable->col('Readable', 'readable'),
                $modelTable->col('Next run date', 'nextRunDate'),
                $modelTable->col('Description', 'description'),
                $modelTable->buttons(
                    [$this, 'buttons']
                )
            )
        );
    }

    public function buttons(Buttons $buttons)
    {
        static::$counter++;
        $num = static::$counter;

        return $buttons->warning()
            ->icon_play()
            ->click(function (Respond $respond) use ($num) {
                (new Scheduling())->runTask($num);
                return $respond->toast_success('Success is running!');
            }, [static::$counter]);
    }
}
