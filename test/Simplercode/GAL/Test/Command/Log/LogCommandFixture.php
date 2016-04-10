<?php

namespace Simplercode\GAL\Test\Command\Log;

class LogCommandFixture
{
    const SPLITTING_FIXTURE_EMPTY = <<<FIX
FIX;

    const SPLITTING_FIXTURE_ONE = <<<FIX
=== commit === separator ===
abcd efgh
FIX;

    const SPLITTING_FIXTURE_THREE = <<<FIX
=== commit === separator ===
abcd efgh
=== commit === separator ===
ijkl mnop
=== commit === separator ===
xyz qwerty
FIX;

    const PARSING_FIXTURE_RAW_COMMIT = <<<FIX
abbr_hash:3f41a16
hash:3f41a16f91a05134dd768728ce6028b0aded8ecd
author_name:John Author
author_email:john.author@example.abc
committer_name:John Committer
committer_email:john.committer@example.abc
author_date:2015-03-10 08:12:35 +0100
author_date_iso:2015-03-10 08:12:35 +0100
author_date_rfc:Tue, 10 Mar 2015 08:12:35 +0100
author_date_relative:4 weeks ago
author_date_timestamp:1425971555
committer_date:2015-03-10 08:12:35 +0100
committer_date_iso:2015-03-10 08:12:35 +0100
committer_date_rfc:Tue, 10 Mar 2015 08:12:35 +0100
committer_date_relative:4 weeks ago
committer_date_timestamp:1425971555
subject:Improvements in LogEvent entity - added ability to easy list events using logger view helper
sanitized_subject:Improvements-in-LogEvent-entity-added-ability-to-easy-list-events-using-logger-view-helper
ref_names:
body:

:body
raw_body:
Improvements in LogEvent entity - added ability to easy list events using logger view helper

:raw_body

FIX;

}
