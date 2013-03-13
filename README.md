Travelistics
============

This is the repository for code developed in the [Travelistics project](http://www.vestforsk.no/prosjekt/travelistics-kartlegge-pilot-teste-og-planlegge-system-for-styringsinformasjon-for-reiselivet) at [the Western Norway Research Institute](http://www.vestforsk.no).

Design and code for Travelistics
================================

The code is covered by the [WTFPL](http://www.wtfpl.net/txt/copying), the logo is a trademark of, and copyrighted [Western Norway Research Institute](http://www.vestforsk.no).

Usage
=====

addfromcsv.php is made to push data from a csv to piwik using the [piwik API](http://piwik.org/docs/analytics-api/reference/).

When loading historical data there are two important things to beware:

1. change site creation date in (piwik_site) to be at the beginning of imported data
2. drop all *_archive_* tables, which forces Piwik to recompute the data

When you have to process a lot of historical data it also comes handy to have the piwik/misc/cron/archive.sh script run from command line instead of accessing Piwik via web interface which will cause to process all historical data (after you dropped *_archive_* tables).
