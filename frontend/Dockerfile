# Dockerfile for Frontend
# Use Nginx to serve static content
FROM nginx:alpine

# Copy static content into the Nginx image
COPY ./frontend /usr/share/nginx/html

# Expose port 80
EXPOSE 80

# Start Nginx
CMD ["nginx", "-g", "daemon off;"]
