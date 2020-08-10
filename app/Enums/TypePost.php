<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Pending()
 * @method static static Active()
 * @method static static Hide()
 * @method static static Disabled()
 */
final class TypePost extends Enum
{
    const TEXT = 'text';
    const VIDEO = 'video';
    const IMAGE = 'image';
    const FILE = 'file';
}
