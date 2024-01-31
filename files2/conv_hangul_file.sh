#!/bin/bash
for file in *; do
    original_name=$(echo -e "$file" | xargs -I {} printf "%s\n" "{}")
		echo "This: $file"
    echo "Original name: $original_name"
		mv $file $original_name
done
