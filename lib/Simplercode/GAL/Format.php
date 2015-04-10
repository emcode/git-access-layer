<?php

namespace Simplercode\GAL;

class Format
{
    const CS = '=== commit === separator ===';
    const GIT_EOL = '%n';

    // inline formats
    const ABBR_HASH = 'abbr_hash';
    const HASH = 'hash';
    const AUTHOR_NAME = 'author_name';
    const AUTHOR_EMAIL = 'author_email';
    const COMMITTER_NAME = 'committer_name';
    const COMMITTER_EMAIL = 'committer_email';
    const AUTHOR_DATE = 'author_date';
    const AUTHOR_DATE_ISO = 'author_date_iso';
    const AUTHOR_DATE_RFC = 'author_date_rfc';
    const AUTHOR_DATE_RELATIVE = 'author_date_relative';
    const AUTHOR_DATE_TIMESTAMP = 'author_date_timestamp';
    const COMMITTER_DATE = 'committer_date';
    const COMMITTER_DATE_ISO = 'committer_date_iso';
    const COMMITTER_DATE_RFC = 'committer_date_rfc';
    const COMMITTER_DATE_RELATIVE = 'committer_date_relative';
    const COMMITTER_DATE_TIMESTAMP = 'committer_date_timestamp';
    const SUBJECT = 'subject';
    const SANITIZED_SUBJECT = "sanitized_subject";
    const REF_NAMES = "ref_names";

    // block formats
    const BODY = 'body';
    const RAW_BODY = "raw_body";

    public static $inlineFormats = array(
        self::ABBR_HASH => '%h',
        self::HASH => '%H',
        self::AUTHOR_NAME => '%an',
        self::AUTHOR_EMAIL => '%ae',
        self::COMMITTER_NAME => '%cn',
        self::COMMITTER_EMAIL => '%ce',
        self::AUTHOR_DATE => '%ad',
        self::AUTHOR_DATE_ISO => '%ai',
        self::AUTHOR_DATE_RFC => '%aD',
        self::AUTHOR_DATE_RELATIVE => '%ar',
        self::AUTHOR_DATE_TIMESTAMP => '%at',
        self::COMMITTER_DATE => '%cd',
        self::COMMITTER_DATE_ISO => '%ci',
        self::COMMITTER_DATE_RFC => '%cD',
        self::COMMITTER_DATE_RELATIVE => '%cr',
        self::COMMITTER_DATE_TIMESTAMP => '%ct',
        self::SUBJECT => '%s',
        self::SANITIZED_SUBJECT => '%f',
        self::REF_NAMES => '%d'
    );

    public static $blockFormats = array(
        self::BODY => '%b',
        self::RAW_BODY => '%B',
    );
}