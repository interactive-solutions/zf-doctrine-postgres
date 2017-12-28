<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Postgres\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class StringArray extends Type
{
    /**
     * @inheritDoc
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value === null) {
            return '{}';
        }

        $quoted = array_map(function (string $str) use ($platform) {
            return $platform->quoteStringLiteral($str);
        }, $value);

        return sprintf('{%s}', implode(', ', $quoted));
    }

    /**
     * @inheritDoc
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null) {
            return [];
        }

        $value = trim($value, '{}');
        if ($value === '') {
            return [];
        }

        $values = [];

        foreach (explode(',', $value) as $val) {
            $values[] = trim($val, '\'');
        }

        return $values;
    }

    /**
     * @inheritDoc
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'TEXT[]';
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'string_array';
    }

    /**
     * @inheritDoc
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }
}
