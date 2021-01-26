ignoring application responses
	tell application "Terminal"
		activate
		do script with command "/Library/PostgreSQL/13/scripts/runpsql.sh; exit"
	end tell
end ignoring


