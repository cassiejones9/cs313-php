set tempdir to system attribute "TMPDIR"
set tempfile to do shell script "mktemp -q " & tempdir & "/pgmsg.txt.XXXXXXXXXX" with administrator privileges
set ret to do shell script "su - postgres -c \"/Library/PostgreSQL/13/bin/pg_ctl reload -D /Library/PostgreSQL/13/data\" > " & tempfile with administrator privileges
set output to do shell script "cat " & tempfile with administrator privileges
set ret to do shell script "rm " & tempfile with administrator privileges
display dialog output buttons {"OK"} with icon 1 default button 1 with title "Reload Configuration"
