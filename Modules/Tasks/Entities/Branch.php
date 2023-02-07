<?php

namespace Modules\Tasks\Entities;

use App\Models\Branch as SystemBranch;
use Modules\Tasks\Traits\SharedRelations;

class Branch extends SystemBranch
{
    use  SharedRelations;
}
