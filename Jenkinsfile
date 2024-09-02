pipeline {
    agent any

    environment {
        DOCKER_REGISTRY = 'shashank9928/tier-survey'
        FRONTEND_IMAGE = "${DOCKER_REGISTRY}/frontend:latest"
        BACKEND_IMAGE = "${DOCKER_REGISTRY}/backend:latest"
        AWS_REGION = 'us-east-1'
        DB_HOST = 'your-rds-endpoint'
        DB_USER = 'your-db-user'
        DB_PASSWORD = 'your-db-password'
        DB_NAME = 'your-db-name'
        GIT_CREDENTIALS_ID = 'git-creds'
        DOCKER_CREDENTIALS_ID = 'dock-creds'
    }

    stages {
        stage('Checkout') {
            steps {
                git(
                    url: 'https://github.com/shashank6613/Tire-survey3T.git',
                    branch: 'main',
                    credentialsId: "${GIT_CREDENTIALS_ID}"
                )
            }
        }

        stage('Build Frontend Docker Image') {
            steps {
                script {
                    docker.build("${env.FRONTEND_IMAGE}", "frontend/")
                }
            }
        }

        stage('Build Backend Docker Image') {
            steps {
                script {
                    docker.build("${env.BACKEND_IMAGE}", "backend/")
                }
            }
        }

        stage('Push Docker Images') {
            steps {
                script {
                    // Use withRegistry for Docker Hub login
                    docker.withRegistry('https://index.docker.io/v1/', "${DOCKER_CREDENTIALS_ID}") {
                        // Push frontend image
                        docker.image("${env.FRONTEND_IMAGE}").push('latest')
                        // Push backend image
                        docker.image("${env.BACKEND_IMAGE}").push('latest')
                    }
                }
            }
        }

        stage('Deploy Frontend') {
            steps {
                script {
                    // Use Docker Compose for deployment if needed
                    sh 'docker run -d -p 80:80 --name frontend ${FRONTEND_IMAGE}'
                }
            }
        }

        stage('Deploy Backend') {
            steps {
                script {
                    // Use Docker Compose for deployment if needed
                    sh 'docker run -d -p 8080:80 --name backend -e DB_HOST=${DB_HOST} -e DB_USER=${DB_USER} -e DB_PASSWORD=${DB_PASSWORD} -e DB_NAME=${DB_NAME} ${BACKEND_IMAGE}'
                }
            }
        }
    }

    post {
        success {
            echo 'Deployment completed successfully!'
        }

        failure {
            echo 'Deployment failed.'
        }
    }
}

