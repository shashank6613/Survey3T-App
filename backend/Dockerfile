#the official Node.js image.
FROM node:16

# Create and change to the app directory.
WORKDIR /usr/src/app

# Copy the script into the container
COPY generate-package-json.sh ./

# Make the script executable
RUN chmod +x generate-package-json.sh

# Run the script to generate package.json
RUN ./generate-package-json.sh

# Copy application dependency manifests to the container image.
COPY package*.json ./

# Install production dependencies.
RUN npm install -y

# Copy the local code to the container image.
COPY . .

# Set environment variables for runtime
ENV DB_HOST=newdb.clushmnnhufs.us-west-2.rds.amazonaws.com
ENV DB_PASSWORD=admin1234
ENV DB_USER=admin
ENV DB_NAME=survey

# Expose port 8081 for the container
EXPOSE 8081

# Run the web service on container startup.
CMD [ "node", "index.js" ]
