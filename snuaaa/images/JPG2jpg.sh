ls | grep '.JPG' | cut -d . -f 1 | while read line; do mv $line.JPG $line.jpg; done
