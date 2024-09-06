#!/bin/bash

# Set default values for package.json fields
PACKAGE_NAME=${1:-"my-app"}
PACKAGE_VERSION=${2:-"1.0.0"}
PACKAGE_DESCRIPTION=${3:-"My Node.js App"}
PACKAGE_ENTRY_POINT=${4:-"app.js"}

# Create package.json with default values
cat <<EOF > package.json
{
  "name": "$PACKAGE_NAME",
  "version": "$PACKAGE_VERSION",
  "description": "$PACKAGE_DESCRIPTION",
  "main": "$PACKAGE_ENTRY_POINT",
  "scripts": {
    "start": "node $PACKAGE_ENTRY_POINT"
  },
  "dependencies": {}
}
EOF

echo "package.json created successfully."

