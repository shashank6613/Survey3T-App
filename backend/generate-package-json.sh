#!/bin/bash

# Define the contents of the package.json
cat <<EOF > package.json
{
  "name": "my-app",
  "version": "1.0.0",
  "description": "A simple Node.js app",
  "main": "index.js",
  "scripts": {
    "start": "node index.js"
  },
  "dependencies": {
    "express": "^4.17.1",
    "mysql2": "^2.3.3"
  },
  "author": "",
  "license": "ISC"
}
EOF

