/**
 * script of dumping oa sql
 */
#!/bin/bash
ROOT="/home/iat/workspace/PHPsite/backup/db/"
DIRNAME=$ROOT`date +%Y%m%d`
if [ ! -d "$DIRNAME" ]
then
    mkdir $DIRNAME
fi
DATE=`date +%Y%m%d_%H%M%S`
mysqldump --opt -uroot -pysl oa > $DIRNAME/$DATE.sql
