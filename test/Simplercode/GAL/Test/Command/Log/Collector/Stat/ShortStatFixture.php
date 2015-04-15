<?php

namespace Simplercode\GAL\Test\Command\Log\Collector\Stat;

class ShortStatFixture
{
    public static $lineExamples = array(
        self::SHORT_STAT_1_1_1 => '1 file changed, 1 insertion(+), 1 deletion(-)',
        self::SHORT_STAT_3_3_3 => '3 files changed, 3 insertions(+), 3 deletions(-)',
        self::SHORT_STAT_1_3_3 => '1 file changed, 3 insertions(+), 3 deletions(-)',
        self::SHORT_STAT_2_1_3 => '2 files changed, 1 insertion(+), 3 deletions(-)',
        self::SHORT_STAT_2_3_1 => '2 files changed, 3 insertions(+), 1 deletion(-)',
        self::SHORT_STAT_3_3_N => '3 files changed, 3 insertions(+)',
        self::SHORT_STAT_3_N_3 => '3 files changed, 3 deletions(-)',
        self::SHORT_STAT_1_1_N => '1 file changed, 1 insertion(+)',
        self::SHORT_STAT_1_N_1 => '1 file changed, 1 deletion(-)',
    );

    public static $singlelineValueExamples = array(
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
        '1 file changed, 1 deletion(-)' => array(
            'file_num' => 1,
            'insertion_num' => null,
            'deletion_num' => 1
        ),
    );

    public static $multilineValueExamples = array(
        self::SHORT_STAT_1_1_1 => array(
            'file_num' => 1,
            'insertion_num' => 1,
            'deletion_num' => 1
        ),
        self::SHORT_STAT_3_3_3 => array(
            'file_num' => 3,
            'insertion_num' => 3,
            'deletion_num' => 3
        ),
        self::SHORT_STAT_1_3_3 => array(
            'file_num' => 1,
            'insertion_num' => 3,
            'deletion_num' => 3
        ),
        self::SHORT_STAT_2_1_3 => array(
            'file_num' => 2,
            'insertion_num' => 1,
            'deletion_num' => 3
        ),
        self::SHORT_STAT_2_3_1 => array(
            'file_num' => 2,
            'insertion_num' => 3,
            'deletion_num' => 1
        ),
        self::SHORT_STAT_3_3_N => array(
            'file_num' => 3,
            'insertion_num' => 3,
            'deletion_num' => null
        ),
         self::SHORT_STAT_3_N_3 => array(
             'file_num' => 3,
             'insertion_num' => null,
             'deletion_num' => 3
         ),
         self::SHORT_STAT_1_1_N => array(
             'file_num' => 1,
             'insertion_num' => 1,
             'deletion_num' => null
         ),
         self::SHORT_STAT_1_N_1 => array(
             'file_num' => 1,
             'insertion_num' => null,
             'deletion_num' => 1
         ),
    );

    const SHORT_STAT_1_1_1 = <<<FIX
commit 103e0d29edfd4d2134e37f0631c6bdfd02913f94
Author: John Smith <something@example.abc>
Date:   Tue Nov 11 11:25:53 2014 +0100

    Some files changed, made 1 deletion and about 3 insertions.

 1 file changed, 1 insertion(+), 1 deletion(-)

FIX;

    const SHORT_STAT_3_3_3 = <<<FIX
commit 113e0d29edfd4d2134e37f0631c6bdfd02913f94
Author: John Smith <something@example.abc>
Date:   Tue Nov 11 11:25:53 2014 +0100

    Some files changed, made 1 deletion and about 3 insertions.

 3 files changed, 3 insertions(+), 3 deletions(-)

FIX;

    const SHORT_STAT_1_3_3 = <<<FIX
commit 123e0d29edfd4d2134e37f0631c6bdfd02913f94
Author: John Smith <something@example.abc>
Date:   Tue Nov 11 11:25:53 2014 +0100

    Some files changed, made 1 deletion and about 3 insertions.

 1 file changed, 3 insertions(+), 3 deletions(-)

FIX;

    const SHORT_STAT_2_1_3 = <<<FIX
commit 133e0d29edfd4d2134e37f0631c6bdfd02913f94
Author: John Smith <something@example.abc>
Date:   Tue Nov 11 11:25:53 2014 +0100

    Some files changed, made 1 deletion and about 3 insertions.

 2 files changed, 1 insertion(+), 3 deletions(-)

FIX;

    const SHORT_STAT_2_3_1 = <<<FIX
commit 143e0d29edfd4d2134e37f0631c6bdfd02913f94
Author: John Smith <something@example.abc>
Date:   Tue Nov 11 11:25:53 2014 +0100

    Some files changed, made 1 deletion and about 3 insertions.

 2 files changed, 3 insertions(+), 1 deletion(-)

FIX;

    const SHORT_STAT_3_3_N = <<<FIX
commit 153e0d29edfd4d2134e37f0631c6bdfd02913f94
Author: John Smith <something@example.abc>
Date:   Tue Nov 11 11:25:53 2014 +0100

    Some files changed, made 1 deletion and about 3 insertions.

 3 files changed, 3 insertions(+)

FIX;

    const SHORT_STAT_3_N_3 = <<<FIX
commit 163e0d29edfd4d2134e37f0631c6bdfd02913f94
Author: John Smith <something@example.abc>
Date:   Tue Nov 11 11:25:53 2014 +0100

    Some files changed, made 1 deletion and about 3 insertions.

 3 files changed, 3 deletions(-)

FIX;

    const SHORT_STAT_1_1_N = <<<FIX
commit 173e0d29edfd4d2134e37f0631c6bdfd02913f94
Author: John Smith <something@example.abc>
Date:   Tue Nov 11 11:25:53 2014 +0100

    Some files changed, made 1 deletion and about 3 insertions.

 1 file changed, 1 insertion(+)

FIX;

    const SHORT_STAT_1_N_1 = <<<FIX
commit 183e0d29edfd4d2134e37f0631c6bdfd02913f94
Author: John Smith <something@example.abc>
Date:   Tue Nov 11 11:25:53 2014 +0100

    Some files changed, made 1 deletion and about 3 insertions.

 1 file changed, 1 deletion(-)

FIX;



}