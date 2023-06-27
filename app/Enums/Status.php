<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Visible()
 * @method static static Invisible()
 * @method static static Unavailable()
 */
final class Status extends Enum
{
    const Visible = 1;
    const Invisible = 2;
    const Unavailable = 3;
}
