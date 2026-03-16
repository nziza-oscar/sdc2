#!/bin/bash

# Get list of unstaged files (both modified and untracked)
files=$(git status --porcelain | awk '{print $2}')

# Check if there are any unstaged files
if [ -z "$files" ]; then
    echo "No unstaged files found."
    exit 0
fi

# Loop through each file
for file in $files; do
    echo "----------------------------------------"
    echo "File: $file"
    echo "----------------------------------------"
    
    # Show git diff for the file
    git diff --color=never $file
    
    echo ""
    # Ask for commit message
    echo -n "Enter commit message for this file (or 's' to skip, 'q' to quit): "
    read message
    
    if [ "$message" = "q" ]; then
        echo "Exiting."
        exit 0
    elif [ "$message" = "s" ]; then
        continue
    elif [ -n "$message" ]; then
        # Stage and commit the file
        git add $file
        git commit -m "$message"
    fi
    
    echo ""
done

git status