#!/bin/bash

files=$(git status --porcelain | sed 's/^...//')

if [ -z "$files" ]; then
    exit 0
fi

for file in $files; do
    if [ ! -f "$file" ]; then
        continue
    fi

    echo "File: $file"
    read -p "Message (s: skip, q: quit): " message
    
    case "$message" in
        q)
            exit 0
            ;;
        s|"")
            continue
            ;;
        *)
            git add "$file"
            git commit -m "$message"
            ;;
    esac
done

git status