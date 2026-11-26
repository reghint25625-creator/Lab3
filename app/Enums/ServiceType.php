<?php

namespace App\Enums;

enum ServiceType: string
{
    case Diagnostics = 'Комп\'ютерна діагностика';
    case OilChange = 'Заміна мастила та фільтрів';
    case SuspensionRepair = 'Ремонт підвіски / ходової';
    case Maintenance = 'Технічне обслуговування (ТО)';
    case EngineRepair = 'Діагностика та ремонт двигуна';
}
