<?php

namespace Simplercode\GAL\Test\Command\Log\Collector\Stat;

class ShortStatValuesFixture
{
    public static $examples = array(
        '4 files changed, 2 insertion(+), 3 deletion(-)' => array(
            'file_num' => 4,
            'insertion_num' => 2,
            'deletion_num' => 3
        ),
        '2 files changed, 3 insertions(+), 4 deletions(-)' => array(
            'file_num' => 2,
            'insertion_num' => 3,
            'deletion_num' => 4
        ),
        '1 file changed, 3 insertions(+), 4 deletions(-)' => array(
            'file_num' => 1,
            'insertion_num' => 3,
            'deletion_num' => 4
        ),
        '2 files changed, 1 insertion(+), 4 deletions(-)' => array(
            'file_num' => 2,
            'insertion_num' => 1,
            'deletion_num' => 4
        ),
        '2 files changed, 4 insertions(+), 1 deletion(-)' => array(
            'file_num' => 2,
            'insertion_num' => 4,
            'deletion_num' => 1
        ),
        '3 files changed, 4 insertions(+)' => array(
            'file_num' => 3,
            'insertion_num' => 4,
            'deletion_num' => null
        ),
        '3 files changed, 4 deletions(-)' => array(
            'file_num' => 3,
            'insertion_num' => null,
            'deletion_num' => 4
        ),
        '1 file changed, 1 insertion(+)' => array(
            'file_num' => 1,
            'insertion_num' => 1,
            'deletion_num' => null
        ),
        '1 file changed, 1 deletion(+)' => array(
            'file_num' => 1,
            'insertion_num' => null,
            'deletion_num' => 1
        ),
    );

    const SHORT_STAT_ALL_SINGULAR = <<<FIX
commit 7b3e0d29edfd4d2134e37f0631c6bdfd02913f94
Author: John Smith <something@example.abc>
Date:   Tue Nov 11 11:25:53 2014 +0100

    Some files changed, made 1 deletion and about 3 insertions.

 1 file changed, 1 insertion(+), 1 deletion(-)

FIX;

    const SHORT_STAT_ALL_MULTI = <<<FIX
commit 7b3e0d29edfd4d2134e37f0631c6bdfd02913f94
Author: John Smith <something@example.abc>
Date:   Tue Nov 11 11:25:53 2014 +0100

    Some files changed, made 1 deletion and about 3 insertions.

 3 files changed, 3 insertions(+), 3 deletions(-)

FIX;

    const SHORT_STAT_ALL_MIX_01 = <<<FIX
commit 7b3e0d29edfd4d2134e37f0631c6bdfd02913f94
Author: John Smith <something@example.abc>
Date:   Tue Nov 11 11:25:53 2014 +0100

    Some files changed, made 1 deletion and about 3 insertions.

 1 file changed, 3 insertions(+), 3 deletions(-)

FIX;

    const SHORT_STAT_ALL_MIX_02 = <<<FIX
commit 7b3e0d29edfd4d2134e37f0631c6bdfd02913f94
Author: John Smith <something@example.abc>
Date:   Tue Nov 11 11:25:53 2014 +0100

    Some files changed, made 1 deletion and about 3 insertions.

 2 files changed, 1 insertion(+), 3 deletions(-)

FIX;

    const SHORT_STAT_ALL_MIX_03 = <<<FIX
commit 7b3e0d29edfd4d2134e37f0631c6bdfd02913f94
Author: John Smith <something@example.abc>
Date:   Tue Nov 11 11:25:53 2014 +0100

    Some files changed, made 1 deletion and about 3 insertions.

 2 files changed, 3 insertions(+), 1 deletion(-)

FIX;

    const SHORT_STAT_FILES_INSERTIONS_PLURAL = <<<FIX
commit 7b3e0d29edfd4d2134e37f0631c6bdfd02913f94
Author: John Smith <something@example.abc>
Date:   Tue Nov 11 11:25:53 2014 +0100

    Some files changed, made 1 deletion and about 3 insertions.

 3 files changed, 3 insertions(+)

FIX;

    const SHORT_STAT_FILES_DELETIONS_PLURAL = <<<FIX
commit 7b3e0d29edfd4d2134e37f0631c6bdfd02913f94
Author: John Smith <something@example.abc>
Date:   Tue Nov 11 11:25:53 2014 +0100

    Some files changed, made 1 deletion and about 3 insertions.

 3 files changed, 3 deletions(-)

FIX;

    const SHORT_STAT_FILES_INSERTIONS_SINGULAR = <<<FIX
commit 7b3e0d29edfd4d2134e37f0631c6bdfd02913f94
Author: John Smith <something@example.abc>
Date:   Tue Nov 11 11:25:53 2014 +0100

    Some files changed, made 1 deletion and about 3 insertions.

 1 file changed, 1 insertion(+)

FIX;

    const SHORT_STAT_FILES_DELETIONS_SINGULAR = <<<FIX
commit 7b3e0d29edfd4d2134e37f0631c6bdfd02913f94
Author: John Smith <something@example.abc>
Date:   Tue Nov 11 11:25:53 2014 +0100

    Some files changed, made 1 deletion and about 3 insertions.

 1 file changed, 1 deletion(-)

FIX;



}