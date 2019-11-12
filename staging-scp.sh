#!/bin/bash

URL="kathrynesterswine@esterswineshop.com"
REMOTE_DIR="/home/kathrynesterswine/theme2019.esterswineshop.com"

upload() {
	echo "Uploading $1"
	scp -r "$1" "$URL:$REMOTE_DIR/$1"
}

download() {
	echo "Downloading $1"
	scp -r "$URL:$REMOTE_DIR/$1" "$1"
}

if [[ $# == 0 ]]; then
	echo "No path or action specified."
	exit 1
fi

while [[ $# > 0 ]]; do
	if [[ -z $ACTION ]]; then
		if [[ "$1" != "u" ]] && [[ "$1" != "d" ]]; then
			echo "First param must be 'u' or 'd'"
			exit 1
		fi
		ACTION="$1"
	else
		if [[ "$ACTION" == "u" ]]; then upload "$1"; fi
		if [[ "$ACTION" == "d" ]]; then download "$1"; fi
	fi
	shift
done

exit 0
