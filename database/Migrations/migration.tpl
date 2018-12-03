<?php

declare(strict_types=1);

namespace <namespace>;

use Doctrine\DBAL\Schema\Schema;

include_once 'AbstractMigration.php';

class Version<version> extends AbstractMigration
{
    public function up(Schema $schema): void
    {
<up>
    }
}