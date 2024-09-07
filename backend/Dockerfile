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

# Use build-time arguments
ARG DB_HOST
ARG DB_PASSWORD
ARG DB_USER
ARG DB_NAME

# Set environment variables for runtime
ENV DB_HOST=${DB_HOST}
ENV DB_PASSWORD=${DB_PASSWORD}
ENV DB_USER=${DB_USER}
ENV DB_NAME=${DB_NAME}

# Expose port 8081 for the container
EXPOSE 8081

# Run the web service on container startup.
CMD [ "node", "index.js" ]
