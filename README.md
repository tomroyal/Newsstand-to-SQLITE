# Newsstand-to-SQLITE

Scripts to quickly pull Apple Newsstand subscription reports into SQLITE

This comprises two PHP scripts, designed to be run locally. Method:

1) Create a subdirectory called "input"
2) Copy Apple newsstand reports in text format (g-unzipped) into that folder (eg, N_D_D_85783863_20130313.txt )
3) Run php makedatabase.php to create the local SQLite database
4) Run php parsefiles.php to process all subscription records in the reports

The result is a SQLite database, itunes.slqite, containing all subscription (IAY-type) records from every input file, so you can query it using any SQLite tool or script.

Released under an MIT license: http://opensource.org/licenses/MIT

tom at tomroyal dot com
www.tomroyal.com